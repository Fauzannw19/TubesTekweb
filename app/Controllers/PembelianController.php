<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\ProdukModel;
use App\Models\SupplierModel;

class PembelianController extends BaseController
{
    // Halaman untuk menampilkan semua data pembelian
    public function index()
    {
        $pembelianModel = new PembelianModel();
        
        // Ambil keyword pencarian dari URL
        $keyword = $this->request->getGet('search') ?? '';

        // Siapkan query builder dengan atau tanpa keyword pencarian
        $queryBuilder = $pembelianModel->search($keyword);

        // Siapkan data untuk view
        $data = [
            'title'     => 'Data Pembelian',
            // Gunakan paginate() dari query builder, bukan findAll()
            'pembelian' => $queryBuilder->paginate(10, 'pembelian'), // 10 data per halaman, grup 'pembelian'
            'pager'     => $pembelianModel->pager,
            'search'    => $keyword, // Kirim keyword kembali ke view untuk ditampilkan di form
        ];

        helper('number');
        return view('pembelian/index', $data);
    }

    // Halaman untuk menampilkan form tambah pembelian
    public function tambah()
    {
        $data = [
            'title'     => 'Tambah Data Pembelian',
            'newID'     => (new PembelianModel())->generateID(),
            'produk'    => (new ProdukModel())->orderBy('Namaproduk', 'ASC')->findAll(),
            'supplier'  => (new SupplierModel())->orderBy('Namasupplier', 'ASC')->findAll(),
            'validation'=> \Config\Services::validation()
        ];
        return view('pembelian/tambah', $data);
    }

    // Proses untuk menyimpan data dari form
    public function simpan()
    {
        // Aturan validasi input
        $rules = [
            'idsupplier' => 'required',
            'idproduk' => 'required',
            'tanggal' => 'required',
            'jumlahitem' => 'required|numeric|greater_than[0]',
            'hargasatuan' => 'required|numeric|greater_than_equal_to[0]',
            'metodepembayaran' => 'required'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error dan input lama
            return redirect()->to('/pembelian/tambah')->withInput();
        }

        // Jika validasi berhasil, mulai proses penyimpanan
        $pembelianModel = new PembelianModel();
        $produkModel = new ProdukModel();
        
        // Gunakan Transaksi Database untuk memastikan data konsisten
        $db = \Config\Database::connect();
        $db->transStart();

        // 1. Simpan data ke tabel pembelian
        $pembelianModel->insert([
            'IDPembelian'       => $this->request->getPost('idpembelian'),
            'IDSupplier'        => $this->request->getPost('idsupplier'),
            'IDProduk'          => $this->request->getPost('idproduk'),
            'Tanggal'           => $this->request->getPost('tanggal'),
            'Jumlahitem'        => (int) $this->request->getPost('jumlahitem'),
            'Hargasatuan'       => (float) $this->request->getPost('hargasatuan'),
            'Totalharga'        => (float) $this->request->getPost('totalharga'),
            'Metodepembayaran'  => $this->request->getPost('metodepembayaran')
        ]);

        // 2. Update stok di tabel produk
        $jumlahBeli = (int) $this->request->getPost('jumlahitem');
        $idProduk = $this->request->getPost('idproduk');
        $produkModel->set('Stok', "Stok + $jumlahBeli", false)->where('IDProduk', $idProduk)->update();

        $db->transComplete();

        // Siapkan pesan notifikasi berdasarkan status transaksi
        if ($db->transStatus() === false) {
            session()->setFlashdata('pesan_error', 'Gagal menambahkan data. Terjadi kesalahan pada database.');
        } else {
            session()->setFlashdata('pesan_sukses', 'Data pembelian berhasil ditambahkan dan stok telah diperbarui!');
        }
        
        return redirect()->to('/pembelian');
    }
}
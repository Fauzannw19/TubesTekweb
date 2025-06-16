<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    // Method index untuk menampilkan semua produk (sudah ada)
    public function index()
    {
        $produkModel = new ProdukModel();
        
        // Ambil keyword pencarian dari URL
        $keyword = $this->request->getGet('search') ?? '';

        // Ambil data produk yang stoknya menipis
        $stokTipisResult = $produkModel->getProdukStokTipis();
        // Ekstrak hanya nama produknya ke dalam array sederhana
        $produkStokTipis = array_column($stokTipisResult, 'Namaproduk');
        
        // Siapkan data untuk view, termasuk pencarian dan pagination
        $data = [
            'title'      => 'Data Barang',
            'stok_tipis' => $produkStokTipis,
            // Lakukan pencarian lalu paginate hasilnya
            'produk'     => $produkModel->search($keyword)->paginate(10, 'produk'),
            'pager'      => $produkModel->pager,
            'search'     => $keyword,
        ];

        helper('number');
        return view('produk/index', $data);
    }

    // GANTI METHOD INI: Method untuk menampilkan form tambah produk
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Produk Baru',
            'newID' => (new \App\Models\ProdukModel())->generateID(),
            'validation' => \Config\Services::validation()
        ];

        

        return view('produk/tambah', $data);
    }

    // METHOD BARU: Untuk menyimpan data produk baru
    public function simpan()
    {
        // 1. Aturan Validasi
        $rules = [
            'namaproduk' => 'required|min_length[3]',
            'kategoriproduk' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|integer'
        ];

        // 2. Lakukan Validasi
        if (!$this->validate($rules)) {
            // Jika gagal, kembali ke form dengan error dan input sebelumnya
            return redirect()->to('/produk/tambah')->withInput();
        }

        // 3. Jika validasi berhasil, simpan ke database
        $produkModel = new ProdukModel();
        $data = [
            'IDProduk' => $produkModel->generateID(),
            'Namaproduk' => $this->request->getPost('namaproduk'),
            'Kategoriproduk' => $this->request->getPost('kategoriproduk'),
            'Harga' => $this->request->getPost('harga'),
            'Deskripsi' => $this->request->getPost('deskripsi'),
            'Stok' => $this->request->getPost('stok')
        ];

        if ($produkModel->insert($data)) {
            // Jika berhasil, set pesan sukses dan redirect
            session()->setFlashdata('pesan_sukses', 'Produk baru berhasil ditambahkan!');
        } else {
            // Jika gagal
            session()->setFlashdata('pesan_error', 'Gagal menambahkan produk baru.');
        }

        return redirect()->to('/produk');
    }

    // METHOD UNTUK MENAMPILKAN FORM EDIT
    public function edit($id = null)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if (!$produk) {
            // Jika produk dengan ID tersebut tidak ditemukan
            throw new PageNotFoundException('Produk tidak ditemukan untuk ID: ' . $id);
        }

        $data = [
            'title'      => 'Edit Produk: ' . $produk['Namaproduk'],
            'produk'     => $produk,
            'validation' => \Config\Services::validation()
        ];

        return view('produk/edit', $data);
    }

    // METHOD UNTUK MEMPROSES UPDATE DATA
    public function update()
    {
        // Ambil ID dari hidden input di form
        $idProduk = $this->request->getPost('IDProduk');

        // Aturan Validasi
        $rules = [
            'Namaproduk' => 'required|min_length[3]',
            'Kategoriproduk' => 'required',
            'Harga' => 'required|numeric',
            'Deskripsi' => 'required',
            'Stok' => 'required|integer'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form edit dengan error
            return redirect()->to('/produk/edit/' . $idProduk)->withInput();
        }

        // Jika valid, siapkan data untuk diupdate
        $data = [
            'Namaproduk'     => $this->request->getPost('Namaproduk'),
            'Kategoriproduk' => $this->request->getPost('Kategoriproduk'),
            'Harga'          => $this->request->getPost('Harga'),
            'Deskripsi'      => $this->request->getPost('Deskripsi'),
            'Stok'           => $this->request->getPost('Stok')
        ];

        $produkModel = new ProdukModel();
        if ($produkModel->update($idProduk, $data)) {
            session()->setFlashdata('pesan_sukses', 'Data produk berhasil diperbarui.');
        } else {
            session()->setFlashdata('pesan_error', 'Gagal memperbarui data produk.');
        }

        return redirect()->to('/produk');
    }
    public function hapus($id = null)
    {
        $produkModel = new ProdukModel();

        // Cari data produk berdasarkan ID
        $dataProduk = $produkModel->find($id);

        if ($dataProduk) {
            // Jika data ditemukan, lakukan penghapusan
            $produkModel->delete($id);

            // Siapkan pesan sukses untuk ditampilkan setelah redirect
            session()->setFlashdata('pesan_sukses', 'Produk berhasil dihapus.');
        } else {
            // Jika data tidak ditemukan, siapkan pesan error
            session()->setFlashdata('pesan_error', 'Produk tidak ditemukan atau sudah dihapus.');
        }

        // Arahkan pengguna kembali ke halaman daftar produk
        return redirect()->to('/produk');
    }
}
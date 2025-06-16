<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\SupplierModel;
use App\Models\PembelianModel;
use App\Models\PesananModel;

class CetakController extends BaseController
{
    public function index()
    {
        // 1. Ambil semua input dari URL (GET request)
        $jenis = $this->request->getGet('jenis');
        $tanggal_mulai = $this->request->getGet('tanggal_mulai');
        $tanggal_selesai = $this->request->getGet('tanggal_selesai');

        $data_hasil = [];
        $nama_judul = '';

        // 2. Jika ada jenis data yang dipilih, proses dan ambil datanya
        if ($jenis) {
            $model = null; // Inisialisasi model
            
            switch ($jenis) {
                case 'produk':
                    $nama_judul = 'Produk';
                    $model = new ProdukModel();
                    $data_hasil = $model->orderBy('Namaproduk', 'ASC')->findAll();
                    break;

                case 'supplier':
                    $nama_judul = 'Supplier';
                    $model = new SupplierModel();
                    $data_hasil = $model->orderBy('Namasupplier', 'ASC')->findAll();
                    break;

                case 'pembelian':
                    $nama_judul = 'Pembelian';
                    $model = new PembelianModel();
                    // Terapkan filter tanggal jika ada
                    if ($tanggal_mulai) $model->where('Tanggal >=', $tanggal_mulai);
                    if ($tanggal_selesai) $model->where('Tanggal <=', $tanggal_selesai);
                    $data_hasil = $model->orderBy('Tanggal', 'ASC')->findAll();
                    break;

                case 'pesanan':
                    $nama_judul = 'Penjualan (Pesanan)';
                    $model = new PesananModel();
                    // Terapkan filter tanggal jika ada
                    if ($tanggal_mulai) $model->where('Tanggalpesanan >=', $tanggal_mulai);
                    if ($tanggal_selesai) $model->where('Tanggalpesanan <=', $tanggal_selesai);
                    $data_hasil = $model->orderBy('Tanggalpesanan', 'ASC')->findAll();
                    break;
            }
        }
        
        // 3. Siapkan semua data untuk dikirim ke view
        $data = [
            'title'           => 'Cetak Data Laporan',
            'jenis_terpilih'  => $jenis,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'nama_judul'      => $nama_judul,
            'hasil_data'      => $data_hasil,
        ];
        
        helper('number'); // Muat helper untuk format Rupiah
        return view('cetak/index', $data);
    }
}
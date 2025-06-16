<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PembelianModel;
use App\Models\PesananModel;

class LaporanController extends BaseController
{
    public function index()
    {
        // Ambil input filter dari URL, jika tidak ada, gunakan waktu saat ini
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        // Panggil model
        $pembelianModel = new PembelianModel();
        $pesananModel = new PesananModel();

        // Ambil data total dari masing-masing model
        $total_pembelian = $pembelianModel->getTotalPembelian((int)$bulan, (int)$tahun);
        $total_penjualan = $pesananModel->getTotalPenjualan((int)$bulan, (int)$tahun);
        
        // Lakukan perhitungan
        $keuntungan = $total_penjualan - $total_pembelian;

        // Siapkan data untuk dikirim ke view
        $data = [
            'title'             => 'Laporan Keuangan Bulanan',
            'total_pembelian'   => $total_pembelian,
            'total_penjualan'   => $total_penjualan,
            'keuntungan'        => $keuntungan,
            'bulan_terpilih'    => $bulan,
            'tahun_terpilih'    => $tahun,
        ];

        return view('laporan/index', $data);
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\SupplierModel;
use App\Models\AdminModel;
use App\Models\PegawaiModel;
use App\Models\PesananModel;
use App\Models\PembelianModel;
use DateTime;

class DashboardController extends BaseController
{
    public function index()
    {
        // 1. Data untuk Summary Cards
        $total_barang = (new ProdukModel())->countAllResults();
        $total_supplier = (new SupplierModel())->countAllResults();
        $total_user_aktif = (new AdminModel())->countAllResults() + (new PegawaiModel())->countAllResults();

        // 2. Data untuk Grafik Keuangan Bulanan (6 bulan terakhir)
        $laporan_keuangan_labels = [];
        $data_bulanan = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = new DateTime(date('Y-m-01') . " -$i months");
            $month_year_key = $date->format('Y-m');
            $laporan_keuangan_labels[] = $date->format('M Y');
            $data_bulanan[$month_year_key] = ['pemasukan' => 0, 'pengeluaran' => 0];
        }

        $pesananModel = new PesananModel();
        $pemasukanData = $pesananModel->select("DATE_FORMAT(Tanggalpesanan, '%Y-%m') as bulan_tahun, SUM(Totalharga) as total")
            ->where('Tanggalpesanan >=', date('Y-m-d', strtotime('-6 months')))
            ->groupBy('bulan_tahun')->get()->getResultArray();

        foreach ($pemasukanData as $row) {
            if (isset($data_bulanan[$row['bulan_tahun']])) {
                $data_bulanan[$row['bulan_tahun']]['pemasukan'] = (float) $row['total'];
            }
        }

        $pembelianModel = new PembelianModel();
        $pengeluaranData = $pembelianModel->select("DATE_FORMAT(Tanggal, '%Y-%m') as bulan_tahun, SUM(Totalharga) as total")
            ->where('Tanggal >=', date('Y-m-d', strtotime('-6 months')))
            ->groupBy('bulan_tahun')->get()->getResultArray();

        foreach ($pengeluaranData as $row) {
            if (isset($data_bulanan[$row['bulan_tahun']])) {
                $data_bulanan[$row['bulan_tahun']]['pengeluaran'] = (float) $row['total'];
            }
        }
        
        $laporan_keuangan_pemasukan = [];
        $laporan_keuangan_pengeluaran = [];
        $laporan_keuangan_keuntungan = [];
        foreach ($data_bulanan as $data) {
            $laporan_keuangan_pemasukan[] = $data['pemasukan'];
            $laporan_keuangan_pengeluaran[] = $data['pengeluaran'];
            $laporan_keuangan_keuntungan[] = $data['pemasukan'] - $data['pengeluaran'];
        }

        // 3. Data untuk Distribusi Kategori Barang
        $produkModel = new ProdukModel();
        $kategoriData = $produkModel->select('Kategoriproduk, COUNT(IDProduk) as jumlah')
            ->groupBy('Kategoriproduk')->orderBy('jumlah', 'DESC')->get()->getResultArray();
        $distribusi_kategori_labels = array_column($kategoriData, 'Kategoriproduk');
        $distribusi_kategori_data = array_column($kategoriData, 'jumlah');
        
        // 4. LOGIKA BARU: Data untuk Top 5 Barang Sering Dibeli
        $db = db_connect();
        $topProdukData = $db->table('pesanan ps')
            ->select('p.Namaproduk, SUM(ps.Jumlahitem) as total_terjual')
            ->join('produk p', 'ps.IDProduk = p.IDProduk', 'left')
            ->groupBy('p.Namaproduk')
            ->orderBy('total_terjual', 'DESC')
            ->limit(5)
            ->get()->getResultArray();
        $barang_sering_dibeli_labels = array_column($topProdukData, 'Namaproduk');
        $barang_sering_dibeli_data = array_column($topProdukData, 'total_terjual');

        // Menggabungkan semua data untuk dikirim ke view
        $data = [
            'title'                     => 'Dashboard Admin',
            'total_barang'              => $total_barang,
            'total_supplier'            => $total_supplier,
            'total_user_aktif'          => $total_user_aktif,
            'laporan_keuangan_labels'   => json_encode($laporan_keuangan_labels),
            'laporan_keuangan_pemasukan'=> json_encode($laporan_keuangan_pemasukan),
            'laporan_keuangan_pengeluaran'=> json_encode($laporan_keuangan_pengeluaran),
            'laporan_keuangan_keuntungan' => json_encode($laporan_keuangan_keuntungan),
            'distribusi_kategori_labels'=> json_encode($distribusi_kategori_labels),
            'distribusi_kategori_data'  => json_encode($distribusi_kategori_data),
            'barang_sering_dibeli_labels' => json_encode($barang_sering_dibeli_labels),
            'barang_sering_dibeli_data'   => json_encode($barang_sering_dibeli_data),
        ];

        return view('dashboard/index', $data);
    }
}
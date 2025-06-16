<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PesananModel;

class PenjualanController extends BaseController
{
    public function index()
    {
        $pesananModel = new PesananModel();

        $data = [
            'title'     => 'Data Penjualan',
            // Ambil SEMUA data pesanan, karena akan diolah oleh DataTables
            'penjualan' => $pesananModel->orderBy('Tanggalpesanan', 'DESC')
                                       ->orderBy('IDPesanan', 'DESC')
                                       ->findAll(),
        ];

        // Helper 'number' tetap berguna untuk format mata uang
        helper('number');

        return view('penjualan/index', $data);
    }
}
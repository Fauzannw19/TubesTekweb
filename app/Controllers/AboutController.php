<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AboutController extends BaseController
{
    public function index()
    {
        // Siapkan data anggota tim di sini
        $anggota = [
            [
                'nama' => 'Yosua Immanuel D',
                'nim'  => '2250081022'
                // 'foto' => 'path/to/foto1.jpg' // Opsional jika ingin menambahkan foto
            ],
            [
                'nama' => 'Fauzan Wicaksono',
                'nim'  => '2250081039'
                // 'foto' => 'path/to/foto2.jpg'
            ],
            [
                'nama' => 'Acep Nugraha',
                'nim'  => '2250081042'
                // 'foto' => 'path/to/foto3.jpg'
            ]
        ];

        // Siapkan data untuk dikirim ke view
        $data = [
            'title'   => 'Tentang Kami',
            'anggota' => $anggota
        ];

        // Tampilkan view
        return view('about/index', $data);
    }
}
<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;   // Import model Admin
use App\Models\PegawaiModel; // Import model Pegawai

class UserController extends BaseController
{
    /**
     * Menampilkan halaman Kelola User yang berisi data Admin dan Staff.
     */
    public function index()
    {
        // Buat instance dari kedua model
        $adminModel = new AdminModel();
        $pegawaiModel = new PegawaiModel();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title'   => 'Kelola User',
            // Ambil semua data dari tabel admin
            'admins'  => $adminModel->findAll(),
            // Ambil semua data dari tabel pegawai
            'pegawai' => $pegawaiModel->findAll(),
        ];

        // Tampilkan view dan kirimkan data
        return view('user/index', $data);
    }

    public function tambah()
    {
        $data = [
            'title'      => 'Registrasi Staff Baru',
            'validation' => \Config\Services::validation()
        ];
        return view('user/tambah', $data);
    }

    // METHOD UNTUK MENYIMPAN DATA STAFF BARU
    public function store()
    {
        // 1. Aturan Validasi
        $rules = [
            'nama'       => 'required|min_length[3]',
            'email'      => 'required|valid_email|is_unique[pegawai.Email]',
            'password'   => 'required|min_length[3]',
            'no_telepon' => 'required|numeric|min_length[10]',
            'alamat'     => 'required'
        ];
        $errors = [
            'email' => [
                'is_unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.'
            ]
        ];

        // 2. Lakukan Validasi
        if (!$this->validate($rules, $errors)) {
            return redirect()->to('/user/tambah')->withInput();
        }

        // 3. Jika validasi berhasil, simpan ke database
        $pegawaiModel = new PegawaiModel();
        
        $data = [
            'IDPegawai'  => $pegawaiModel->generateID(),
            'Nama'       => $this->request->getPost('nama'),
            'Email'      => $this->request->getPost('email'),
            'Password'   => $this->request->getPost('password'),
            'No_Telepon' => $this->request->getPost('no_telepon'),
            'Alamat'     => $this->request->getPost('alamat')
        ];

        // Gunakan metode pengecekan yang andal
        $pegawaiModel->insert($data);

        if (empty($pegawaiModel->errors())) {
            session()->setFlashdata('pesan_sukses', 'Staff baru berhasil tambah');
        } else {
            session()->setFlashdata('pesan_error', 'Gagal menambah staff baru.');
        }

        return redirect()->to('/user');
    }

    public function hapus($id)
    {
        // Contoh logika hapus
        $pegawaiModel = new PegawaiModel();
        if ($pegawaiModel->find($id)) {
            $pegawaiModel->delete($id);
            session()->setFlashdata('pesan_sukses', 'Data staff berhasil dihapus.');
        } else {
            session()->setFlashdata('pesan_error', 'Data staff tidak ditemukan.');
        }
        return redirect()->to('/user');
    }
}
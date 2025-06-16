<?php

namespace App\Controllers;
use App\Models\AdminModel;

class RegisterController extends BaseController
{
    public function index()
    {
        return view('admin/registeradmin');
    }

    public function store()
    {
        $model = new AdminModel();

        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password'); // Enkripsi nanti ya
        $no_telepon = $this->request->getPost('no_telepon');

        $newID = $model->generateNewIDAdmin();

        $data = [
            'IDAdmin'    => $newID,
            'Nama'       => $nama,
            'Email'      => $email,
            'Password'   => $password,
            'No_Telepon' => $no_telepon
        ];

        if ($model->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registrasi admin berhasil!');
        } else {
            return redirect()->back()->with('error', 'Registrasi gagal!');
        }

    }
}

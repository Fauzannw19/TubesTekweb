<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

    public function loginPost()
    {
        $session = session();
        $model = new AdminModel();
    
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        $admin = $model->where('Email', $email)->first();
    
        if ($admin) {
            // PENTING: Pengecekan ini TIDAK AMAN, tetapi sesuai permintaan Anda
            if ($password === $admin['Password']) { 
                
                $sessionData = [
                    'IDAdmin' => $admin['IDAdmin'],
                    'Nama'    => $admin['Nama'],
                    'isLoggedIn' => true // <-- INI PERBAIKANNYA. Nama session sudah disamakan.
                ];
                $session->set($sessionData);
    
                return redirect()->to('/dashboard');
    
            } else {
                return redirect()->back()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

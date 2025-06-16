<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Fungsi ini akan dijalankan SEBELUM controller diakses.
     * Tugasnya adalah memeriksa apakah pengguna sudah login atau belum.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'isLoggedIn' tidak ada atau nilainya false
        if (!session()->get('isLoggedIn')) {
            // Jika belum login, paksa pengguna untuk kembali ke halaman login
            return redirect()->to(site_url('login'));
        }
    }

    /**
     * Fungsi ini akan dijalankan SETELAH controller diakses.
     * Untuk kasus autentikasi, kita tidak perlu melakukan apa-apa di sini.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Biarkan kosong
    }
}
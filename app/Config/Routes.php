<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// =====================================================================
// == RUTE PUBLIK (Boleh diakses siapa saja, tidak perlu login)
// =====================================================================
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/auth/login', 'Auth::loginPost');

// Rute untuk registrasi
$routes->get('/registeradmin', 'RegisterController::index');
$routes->get('/register', 'RegisterController::index');
$routes->post('/register/store', 'RegisterController::store');


// =====================================================================
// == RUTE TERLINDUNGI (Wajib login untuk mengakses semua rute di sini)
// =====================================================================
$routes->group('', ['filter' => 'auth'], static function ($routes) {

    // Rute dashboard
    $routes->get('/dashboard', 'DashboardController::index');
    
    // Rute logout (hanya bisa diakses jika sudah login)
    $routes->get('/logout', 'Auth::logout');

    $routes->get('pembelian', 'PembelianController::index');
    $routes->get('pembelian/tambah', 'PembelianController::tambah');
    $routes->post('pembelian/simpan', 'PembelianController::simpan');

    $routes->get('penjualan', 'PenjualanController::index');

    $routes->get('produk', 'ProdukController::index');
    $routes->get('produk/tambah', 'ProdukController::tambah');
    $routes->post('produk/simpan', 'ProdukController::simpan'); 
    $routes->get('produk/edit/(:alphanum)', 'ProdukController::edit/$1');
    $routes->post('produk/update', 'ProdukController::update');
    $routes->get('produk/hapus/(:alphanum)', 'ProdukController::hapus/$1');
    
    $routes->get('supplier', 'SupplierController::index');
    $routes->get('supplier/tambah', 'SupplierController::tambah');
    $routes->post('supplier/simpan', 'SupplierController::simpan');
    $routes->get('supplier/edit/(:alphanum)', 'SupplierController::edit/$1');
    $routes->post('supplier/update', 'SupplierController::update');
    $routes->get('supplier/hapus/(:alphanum)', 'SupplierController::hapus/$1');


    $routes->get('user', 'UserController::index');
    $routes->get('user/tambah', 'UserController::tambah');
    $routes->post('user/store', 'UserController::store');
    $routes->get('user/hapus/(:alphanum)', 'UserController::hapus/$1');

    $routes->get('laporan', 'LaporanController::index');

    $routes->get('cetak', 'CetakController::index');

    $routes->get('about', 'AboutController::index');
});

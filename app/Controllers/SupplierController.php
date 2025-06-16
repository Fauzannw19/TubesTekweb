<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class SupplierController extends BaseController
{
    public function index()
    {
        $supplierModel = new SupplierModel();
        
        // Ambil keyword pencarian dari URL
        $keyword = $this->request->getGet('search') ?? '';

        // Siapkan query builder dengan atau tanpa keyword pencarian
        $queryBuilder = $supplierModel->search($keyword);

        // Siapkan data untuk view
        $data = [
            'title'     => 'Data Supplier',
            // Gunakan paginate() untuk mengambil data + mengatur pagination
            'supplier'  => $queryBuilder->paginate(10, 'supplier'), // 10 data per halaman
            'pager'     => $supplierModel->pager, // Ambil objek pager
            'search'    => $keyword, // Kirim keyword kembali ke view
        ];

        return view('supplier/index', $data);
    }

    // METHOD UNTUK MENAMPILKAN FORM TAMBAH SUPPLIER
    public function tambah()
    {
        $data = [
            'title'      => 'Tambah Supplier Baru',
            'newID'      => (new SupplierModel())->generateID(),
            'validation' => \Config\Services::validation()
        ];
        return view('supplier/tambah', $data);
    }

    // METHOD UNTUK MENYIMPAN DATA SUPPLIER BARU
    public function simpan()
    {
        // 1. Aturan Validasi
        $rules = [
            'namasupplier'  => 'required|min_length[3]',
            'alamat'        => 'required',
            'notelp'        => 'required|numeric|min_length[10]',
            'email'         => 'required|valid_email|is_unique[supplier.Email]',
            'Kategoriproduk'=> 'required'
        ];
        $errors = [
            'email' => [
                'is_unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.'
            ]
        ];

        // 2. Lakukan Validasi
        if (!$this->validate($rules, $errors)) {
            // Jika gagal, kembali ke form dengan error dan input sebelumnya
            return redirect()->to('/supplier/tambah')->withInput();
        }

        // 3. Jika validasi berhasil, simpan ke database
        $supplierModel = new SupplierModel();
        
        // Perhatikan di sini: 'name' dari form adalah 'notelp', 
        // tapi nama kolom di DB adalah 'No_Telepon'. Kita sesuaikan di sini.
        $data = [
            'IDSupplier'     => $this->request->getPost('idsupplier'), 
            'Namasupplier'   => $this->request->getPost('namasupplier'),
            'Alamat'         => $this->request->getPost('alamat'),
            'No_Telepon'     => $this->request->getPost('notelp'),
            'Email'          => $this->request->getPost('email'),
            'Kategoriproduk' => $this->request->getPost('Kategoriproduk')
        ];

        $supplierModel->insert($data);

        // Sekarang, periksa apakah ada error setelah mencoba insert
        if (empty($supplierModel->errors())) {
            // JIKA TIDAK ADA ERROR, berarti operasi SUKSES
            session()->setFlashdata('pesan_sukses', 'Supplier baru berhasil ditambahkan!');
        } else {
            // JIKA ADA ERROR yang dilaporkan oleh model, berarti GAGAL
            $errors = $supplierModel->errors();
            session()->setFlashdata('pesan_error', 'Gagal menambahkan supplier: ' . implode(', ', $errors));
        }

        return redirect()->to('/supplier');
    }

    public function edit($id = null)
    {
        $supplierModel = new SupplierModel();
        $supplier = $supplierModel->find($id);

        if (!$supplier) {
            throw new PageNotFoundException('Supplier dengan ID ' . $id . ' tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Supplier: ' . $supplier['Namasupplier'],
            'supplier'   => $supplier,
            'validation' => \Config\Services::validation()
        ];

        return view('supplier/edit', $data);
    }

    /**
     * Memproses data yang dikirim dari form edit.
     */
    public function update()
    {
        // Ambil ID dari hidden input di form
        $idSupplier = $this->request->getPost('IDSupplier');

        // Aturan Validasi
        // Untuk email, kita cek keunikan TAPI abaikan data saat ini
        $emailRule = 'required|valid_email|is_unique[supplier.Email,IDSupplier,' . $idSupplier . ']';

        $rules = [
            'Namasupplier'   => 'required|min_length[3]',
            'Alamat'         => 'required',
            'No_Telepon'     => 'required|numeric|min_length[10]',
            'Email'          => $emailRule,
            'Kategoriproduk' => 'required'
        ];
        $errors = [
            'Email' => [
                'is_unique' => 'Email ini sudah terdaftar untuk supplier lain.'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            // Jika validasi gagal, kembalikan ke form edit dengan error
            return redirect()->to('/supplier/edit/' . $idSupplier)->withInput();
        }

        // Jika valid, siapkan data untuk diupdate
        $data = [
            'Namasupplier'   => $this->request->getPost('Namasupplier'),
            'Alamat'         => $this->request->getPost('Alamat'),
            'No_Telepon'     => $this->request->getPost('No_Telepon'),
            'Email'          => $this->request->getPost('Email'),
            'Kategoriproduk' => $this->request->getPost('Kategoriproduk')
        ];

        $supplierModel = new SupplierModel();
        if ($supplierModel->update($idSupplier, $data)) {
            session()->setFlashdata('pesan_sukses', 'Data supplier berhasil diperbarui.');
        } else {
            session()->setFlashdata('pesan_error', 'Gagal memperbarui data supplier.');
        }

        return redirect()->to('/supplier');
    }

    public function hapus($id)
    {
        // Contoh logika hapus
        $supplierModel = new SupplierModel();
        if ($supplierModel->find($id)) {
            $supplierModel->delete($id);
            session()->setFlashdata('pesan_sukses', 'Data supplier berhasil dihapus.');
        } else {
            session()->setFlashdata('pesan_error', 'Data supplier tidak ditemukan.');
        }
        return redirect()->to('/supplier');
    }
}
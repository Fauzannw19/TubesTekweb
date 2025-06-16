<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'IDProduk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['IDProduk', 'Namaproduk', 'Harga', 'Deskripsi', 'Stok', 'Kategoriproduk'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // METHOD BARU UNTUK MEMBUAT ID OTOMATIS
    public function generateID()
    {
        $lastID = $this->select('IDProduk')->orderBy('IDProduk', 'DESC')->first();
        $prefix = "PRD";

        if ($lastID) {
            // PERUBAHAN: Substring dimulai dari indeks 3 karena prefix 'PRD' ada 3 karakter
            $number = (int) substr($lastID['IDProduk'], 3) + 1;
        } else {
            // Jika ini adalah produk pertama
            $number = 1;
        }

        // Gabungkan prefix dengan angka yang sudah di-padding menjadi 3 digit
        $newID = $prefix . str_pad($number, 3, "0", STR_PAD_LEFT);
        return $newID;
    }

    public function search($keyword)
    {
        // Hanya mencari di kolom Namaproduk
        if ($keyword) {
            $this->like('Namaproduk', $keyword);
        }
        return $this; // Mengembalikan instance model agar bisa di-chain
    }

    /**
     * METHOD BARU
     * Mengambil semua produk yang stoknya di bawah 20.
     */
    public function getProdukStokTipis()
    {
        return $this->select('Namaproduk')
                    ->where('Stok <', 20)
                    ->findAll();
    }
}

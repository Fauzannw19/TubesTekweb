<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'IDSupplier';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['IDSupplier', 'Namasupplier', 'Alamat', 'No_Telepon', 'Email', 'Kategoriproduk'];

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

    public function generateID()
    {
        // Mengambil ID terakhir dari database
        $lastID = $this->select('IDSupplier')->orderBy('IDSupplier', 'DESC')->first();
        
        // PERUBAHAN: Menggunakan prefix 'SUP' dan offset 3
        $prefix = "SUP";

        if ($lastID) {
            // Ambil angka dari ID terakhir, misal dari 'SUP010' menjadi '10'
            $number = (int) substr($lastID['IDSupplier'], 3) + 1;
        } else {
            // Jika ini adalah supplier pertama
            $number = 1;
        }
        
        // Gabungkan prefix dengan angka yang sudah di-padding (misal: SUP + 011)
        $newID = $prefix . str_pad($number, 3, "0", STR_PAD_LEFT);
        
        return $newID;
    }

    /**
     * METHOD BARU
     * Fungsi untuk mencari data supplier berdasarkan keyword.
     */
    public function search($keyword)
    {
        $builder = $this->table('supplier');
        if ($keyword) {
            // Mencari di kolom Namasupplier atau Email
            $builder->like('Namasupplier', $keyword)
                    ->orLike('Email', $keyword);
        }
        return $builder;
    }
}

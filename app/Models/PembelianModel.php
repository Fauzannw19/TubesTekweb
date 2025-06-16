<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    // ... (properti lain yang sudah ada)
    protected $table            = 'pembelian';
    protected $primaryKey       = 'IDPembelian';
    protected $allowedFields    = ['IDPembelian', 'IDSupplier', 'IDProduk', 'Tanggal', 'Jumlahitem', 'Hargasatuan', 'Totalharga', 'Metodepembayaran'];

    public function generateID()
    {
        $lastID = $this->select('IDPembelian')->orderBy('IDPembelian', 'DESC')->first();

        if ($lastID) {
            // Ambil angka dari ID terakhir, misal dari 'PEM009' menjadi 9
            $lastNum = (int) substr($lastID['IDPembelian'], 3);
            $newNum = $lastNum + 1;
            $newID = 'PEM' . str_pad($newNum, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada data sama sekali, mulai dari PEM001
            $newID = 'PEM001';
        }
        return $newID;
    }

    public function getTotalPembelian(int $bulan, int $tahun)
    {
        $result = $this->selectSum('Totalharga', 'total')
                        ->where('MONTH(Tanggal)', $bulan)
                        ->where('YEAR(Tanggal)', $tahun)
                        ->get()
                        ->getRow();

        return $result->total ?? 0;
    }

    public function search($keyword)
    {
        $builder = $this->table('pembelian');
        if ($keyword) {
            // orLike() akan membuat query: WHERE IDPembelian LIKE '%keyword%' OR IDSupplier LIKE '%keyword%' ...
            $builder->like('IDPembelian', $keyword)
                    ->orLike('IDSupplier', $keyword)
                    ->orLike('IDProduk', $keyword);
        }
        return $builder;
    }
}
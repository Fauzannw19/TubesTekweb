<?= $this->extend('layouts/main') ?>

<?= $this->section('pageStyles') ?>
<style>
    /* CSS ini hanya akan aktif saat mode cetak/print preview */
    @media print {
        body * { visibility: hidden; }
        .print-area, .print-area * { visibility: visible !important; }
        .print-area { position: absolute !important; left: 0; top: 0; width: 100%; margin: 0; padding: 15px; }
        .no-print, #sidebar, #mainContent > header { display: none !important; }
        #mainContent { margin-left: 0 !important; }
        .print-header { display: block !important; text-align: center; margin-bottom: 20px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .print-header .logo-nama-toko { display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px; }
        .print-header .logo-nama-toko img { width: 50px !important; height: auto !important; }
        .print-header .logo-nama-toko h2 { font-size: 22pt !important; font-weight: bold; color: #000 !important; margin: 0 !important; }
        .print-header .alamat-toko { font-size: 10pt !important; margin: 0; color: #333 !important; }
        .print-header .judul-laporan { margin-top: 15px !important; font-weight: bold; font-size: 14pt !important; text-transform: uppercase; }
        .print-info { display: block !important; font-size: 9pt; text-align: left; margin-top: 20px; }
        table { width: 100% !important; border-collapse: collapse !important; font-size: 10pt !important; margin-top: 10px; }
        th, td { border: 1px solid #666 !important; padding: 5px 7px !important; text-align: left !important; word-break: break-all; }
        thead { background-color: #E5E7EB !important; color: #111827 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        @page { size: A4 landscape; margin: 1.5cm; } /* Dibuat landscape agar tabel lebar muat */
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<header class="no-print mb-6 border-b-4 border-[#537d5d] pb-2">
    <h1 class="text-4xl font-extrabold text-[#2e4a37]">Cetak Data</h1>
</header>

<div class="no-print bg-white p-6 rounded-lg shadow-lg mb-6">
    <h2 class="text-xl font-semibold mb-4 text-[#2e4a37]">Pilih Data untuk Dicetak</h2>
    <form method="get" action="<?= site_url('cetak') ?>">
        <div class="flex flex-col md:flex-row md:items-end gap-4">
            <div class="flex-grow">
                <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Data:</label>
                <select name="jenis" id="jenis" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                    <option value="">-- Pilih Jenis Data --</option>
                    <option value="produk" <?= $jenis_terpilih == 'produk' ? 'selected' : '' ?>>Data Barang</option>
                    <option value="supplier" <?= $jenis_terpilih == 'supplier' ? 'selected' : '' ?>>Data Supplier</option>
                    <option value="pembelian" <?= $jenis_terpilih == 'pembelian' ? 'selected' : '' ?>> Data Pembelian</option>
                    <option value="pesanan" <?= $jenis_terpilih == 'pesanan' ? 'selected' : '' ?>> Data Penjualan</option>
                </select>
            </div>

            <?php if ($jenis_terpilih == 'pembelian' || $jenis_terpilih == 'pesanan'): ?>
            <div class="flex-grow">
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai:</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="<?= esc($tanggal_mulai ?? '') ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
            </div>
            <div class="flex-grow">
                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai:</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="<?= esc($tanggal_selesai ?? '') ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                 <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold text-sm">Filter</button>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php if ($jenis_terpilih): ?>
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex justify-between items-center no-print">
            <h2 class="text-2xl font-semibold text-[#2e4a37]">Hasil Laporan: <?= esc($nama_judul) ?></h2>
            <?php if (!empty($hasil_data)): ?>
                <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm">Cetak Data</button>
            <?php endif; ?>
        </div>
        <hr class="my-4 no-print">
        
        <div id="print-area" class="print-area">
            <div class="print-header" style="display:none;">
                <div class="logo-nama-toko">
                    <img src="<?= base_url('Asset/LOGO.png') ?>" alt="Logo">
                    <h2>GudangKita</h2>
                </div>
                <p class="alamat-toko">Jalan Pakuhaji No. 123, Kota Bandung Barat, Indonesia</p>
                <p class="judul-laporan">Laporan Data <?= esc(ucfirst($nama_judul)) ?></p>
            </div>
            
            <div class="print-info" style="display:none;">
                <?php if ($tanggal_mulai || $tanggal_selesai): ?>
                    Periode: <strong><?= esc($tanggal_mulai ? date('d-m-Y', strtotime($tanggal_mulai)) : 'Semua') ?></strong> s/d <strong><?= esc($tanggal_selesai ? date('d-m-Y', strtotime($tanggal_selesai)) : 'Semua') ?></strong><br>
                <?php endif; ?>
                Dicetak oleh: <strong><?= esc(session()->get('Nama')) ?></strong> pada <?= date('d-m-Y H:i:s') ?>
            </div>

            <div class="overflow-x-auto">
                <?php if (!empty($hasil_data)): ?>
                    <?= $this->include('cetak/_tabel_' . $jenis_terpilih, ['hasil_data' => $hasil_data]) ?>
                <?php else: ?>
                    <div class="text-center text-gray-500 py-10 no-print">Tidak ada data ditemukan untuk jenis dan filter yang dipilih.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>
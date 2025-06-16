<?= $this->extend('layouts/main') ?>

<?= $this->section('pageStyles') ?>
<style>
    @media print {
        body * { visibility: hidden; }
        #laporanUntukCetak, #laporanUntukCetak * { visibility: visible !important; }
        #laporanUntukCetak { position: absolute !important; left: 0; top: 0; width: 100%; margin: 0; padding: 20px; border: none !important; box-shadow: none !important; font-family: 'Times New Roman', Times, serif; }
        .no-print, #sidebar, #mainContent > header { display: none !important; }
        #mainContent { margin-left: 0 !important; }
        .print-header { display: block !important; text-align: center; margin-bottom: 25px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .print-header .logo-nama-toko { display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 10px; }
        .print-header .logo-nama-toko img { width: 50px !important; height: auto !important; }
        .print-header .logo-nama-toko h2 { font-size: 22pt !important; font-weight: bold; color: #000 !important; margin: 0 !important; }
        .print-header .alamat-toko { font-size: 10pt !important; margin: 0; color: #333 !important; }
        .print-header .judul-laporan { margin-top: 20px !important; font-weight: bold; font-size: 14pt !important; text-decoration: underline; text-transform: uppercase; }
        table { width: 100% !important; border-collapse: collapse !important; font-size: 12pt !important; margin-top: 20px; }
        th, td { border: 1px solid #333 !important; padding: 9px !important; text-align: left !important; }
        th { background-color: #E5E7EB !important; color: #111827 !important; }
        tr.font-bold { font-weight: bold !important; }
        @page { size: A4 portrait; margin: 1.5cm; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="flex-1 p-4 sm:p-6 overflow-auto">
    <header class="no-print mb-6 border-b-4 border-[#537d5d] pb-2">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-[#2e4a37]">Laporan Keuangan Bulanan</h1>
    </header>

    <div class="no-print bg-white p-4 sm:p-6 rounded-lg shadow-lg mb-6">
        <form method="GET" action="<?= site_url('laporan') ?>" class="space-y-4 md:space-y-0 md:flex md:items-end md:space-x-4">
            <div class="flex-1">
                <label for="bulan" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bulan:</label>
                <select name="bulan" id="bulan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-[#456849] focus:border-[#456849] sm:text-sm">
                    <?php for ($i = 1; $i <= 12; $i++): ?>
                        <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= ($i == $bulan_terpilih) ? 'selected' : '' ?>><?= namaBulan($i) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="flex-1">
                <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Pilih Tahun:</label>
                <input type="number" name="tahun" id="tahun" value="<?= esc($tahun_terpilih) ?>" min="2020" max="<?= date('Y') + 5 ?>" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[#456849] focus:border-[#456849] sm:text-sm">
            </div>
            <button type="submit" class="w-full md:w-auto px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md font-semibold text-sm shadow-sm">
                Tampilkan Laporan
            </button>
        </form>
    </div>

    <div id="laporanUntukCetak" class="bg-white p-4 sm:p-6 rounded-lg shadow-lg mb-6">
        <div class="print-header" style="display:none;">
            <div class="logo-nama-toko">
                <img src="<?= base_url('Asset/LOGO.png') ?>" alt="Logo">
                <h2>GudangKita</h2>
            </div>
            <p class="alamat-toko">Alamat Toko Anda di Sini, Kota, Kode Pos</p>
            <p class="judul-laporan">Laporan Keuangan Periode <?= esc(namaBulan((int)$bulan_terpilih)) ?> <?= esc($tahun_terpilih) ?></p>
        </div>
        <div class="text-center mb-4 no-print">
            <p class="text-md sm:text-lg text-gray-700">Periode: <span class="font-semibold text-[#537d5d]"><?= esc(namaBulan((int)$bulan_terpilih)) ?> <?= esc($tahun_terpilih) ?></span></p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-3 sm:px-4 border border-gray-300 text-left text-xs sm:text-sm font-semibold text-gray-700">Deskripsi</th>
                        <th class="py-2 px-3 sm:px-4 border border-gray-300 text-right text-xs sm:text-sm font-semibold text-gray-700">Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-3 sm:px-4 border border-gray-300 text-gray-700 text-xs sm:text-sm">Total Penjualan (Pemasukan)</td>
                        <td class="py-2 px-3 sm:px-4 border border-gray-300 text-right text-gray-700 text-xs sm:text-sm"><?= number_to_currency($total_penjualan, 'IDR', 'id_ID', 0) ?></td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-3 sm:px-4 border border-gray-300 text-gray-700 text-xs sm:text-sm">Total Pembelian (Pengeluaran)</td>
                        <td class="py-2 px-3 sm:px-4 border border-gray-300 text-right text-red-600 text-xs sm:text-sm">(<?= number_to_currency($total_pembelian, 'IDR', 'id_ID', 0) ?>)</td>
                    </tr>
                    <tr class="bg-green-100 hover:bg-green-200 font-bold">
                        <td class="py-2 px-3 sm:px-4 border-t-2 border-gray-400 text-green-700 text-sm sm:text-base">Keuntungan / Laba Bersih</td>
                        <td class="py-2 px-3 sm:px-4 border-t-2 border-gray-400 text-right text-green-700 text-sm sm:text-base"><?= number_to_currency($keuntungan, 'IDR', 'id_ID', 0) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-6 text-right">
            <button onclick="window.print()" class="no-print px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-semibold text-sm shadow-sm">
                Cetak Laporan
            </button>
        </div>
    </div>
</main>
<?= $this->endSection() ?>
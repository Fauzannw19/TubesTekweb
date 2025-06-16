<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<header class="mb-8">
    <h1 class="text-3xl font-bold text-[#2e4a37]">Selamat Datang, <?= esc(session()->get('Nama')) ?>!</h1>
</header>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center">
        <div class="mb-3 text-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
        </div>
        <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Data Barang</h2>
        <p class="text-4xl font-bold text-blue-600"><?= esc($total_barang) ?></p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center">
        <div class="mb-3 text-purple-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.508 1.07-1.134L20.61 11.26c-.086-.64-.638-1.134-1.282-1.134H14.25M5.25 6h9.75M5.25 9h9.75M3.75 12h15.75m-15.75 0h15.75M5.25 6V3.75c0-.621.504-1.125 1.125-1.125h6.75c.621 0 1.125.504 1.125 1.125V6m-11.25 0h11.25" /></svg>
        </div>
        <h2 class="text-lg font-semibold text-gray-600 mb-1">Total Supplier</h2>
        <p class="text-4xl font-bold text-purple-600"><?= esc($total_supplier) ?></p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg flex flex-col items-center">
        <div class="mb-3 text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-3.471-5.456c1.52.225 2.98.863 4.283 1.745A4.98 4.98 0 0018 18.72zm-1.047-5.456c-.23-.105-.467-.198-.704-.286A11.942 11.942 0 0012 15c-.34 0-.673-.016-.996-.046c-1.061-.096-2.074-.307-3.009-.629A5.974 5.974 0 006 13.263m10.953-5.456A11.952 11.952 0 0012 6c-1.352 0-2.65.24-3.84.687C6.99 7.33 6 8.484 6 9.933V13.26m10.953-5.456c.23.105.467.198.704.286m1.407-1.123A3 3 0 0018 6.045c-.24-.373-.527-.709-.854-1.002A4.975 4.975 0 0012.003 4.02c-1.154 0-2.22.312-3.125.845A4.993 4.993 0 006 6.045c0 .24.02.474.058.702m11.995 0A11.94 11.94 0 0012 7.5c-1.036 0-2.025-.15-2.953-.433M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
        </div>
        <h2 class="text-lg font-semibold text-gray-600 mb-1">Total User Aktif</h2>
        <p class="text-4xl font-bold text-indigo-600"><?= esc($total_user_aktif) ?></p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-[#2e4a37] mb-4">Laporan Keuangan Bulanan (6 Bulan Terakhir)</h2>
        <canvas id="grafikKeuanganBulanan"></canvas>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-xl font-semibold text-[#2e4a37] mb-4">Distribusi Kategori Barang</h2>
        <div class="max-w-xs mx-auto h-[350px] flex items-center justify-center">
             <canvas id="distribusiKategoriBarang"></canvas>
        </div>
    </div>
</div>

<div class="bg-white p-6 rounded-xl shadow-lg">
    <h2 class="text-xl font-semibold text-[#2e4a37] mb-4">5 Barang Sering Dibeli</h2>
    <canvas id="barangSeringDibeli"></canvas>
</div>

<?= $this->endSection() ?>


<?= $this->section('pageScripts') ?>
<script>
    // Data untuk Chart.js (dari Controller, sudah di-json_encode)
    const laporanKeuanganLabels = <?= $laporan_keuangan_labels ?>;
    const laporanKeuanganPemasukan = <?= $laporan_keuangan_pemasukan ?>;
    const laporanKeuanganPengeluaran = <?= $laporan_keuangan_pengeluaran ?>;
    const laporanKeuanganKeuntungan = <?= $laporan_keuangan_keuntungan ?>;

    const distribusiKategoriLabels = <?= $distribusi_kategori_labels ?>;
    const distribusiKategoriData = <?= $distribusi_kategori_data ?>;

    const barangSeringDibeliLabels = <?= $barang_sering_dibeli_labels ?>;
    const barangSeringDibeliData = <?= $barang_sering_dibeli_data ?>;

    // Inisialisasi Grafik Keuangan Bulanan
    const ctxKeuangan = document.getElementById('grafikKeuanganBulanan');
    if (ctxKeuangan) {
        new Chart(ctxKeuangan, {
            type: 'bar',
            data: {
                labels: laporanKeuanganLabels,
                datasets: [
                    { label: 'Pemasukan (Rp)', data: laporanKeuanganPemasukan, backgroundColor: 'rgba(75, 192, 192, 0.7)' },
                    { label: 'Pengeluaran (Rp)', data: laporanKeuanganPengeluaran, backgroundColor: 'rgba(255, 99, 132, 0.7)' },
                    { label: 'Keuntungan (Rp)', data: laporanKeuanganKeuntungan, backgroundColor: 'rgba(54, 162, 235, 0.7)', borderColor: 'rgba(54, 162, 235, 1)', borderWidth: 2, type: 'line', fill: false, tension: 0.1 }
                ]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true, ticks: { callback: (value) => 'Rp ' + value.toLocaleString('id-ID') } } }, plugins: { tooltip: { callbacks: { label: (context) => { let label = context.dataset.label || ''; if (label) { label += ': '; } if (context.parsed.y !== null) { label += 'Rp ' + context.parsed.y.toLocaleString('id-ID'); } return label; } } } } }
        });
    }

    // Inisialisasi Distribusi Kategori Barang
    const ctxKategori = document.getElementById('distribusiKategoriBarang');
    if (ctxKategori && distribusiKategoriLabels.length > 0) {
        new Chart(ctxKategori, {
            type: 'doughnut',
            data: { labels: distribusiKategoriLabels, datasets: [{ label: 'Jumlah Produk', data: distribusiKategoriData, backgroundColor: ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(75, 192, 192, 0.8)', 'rgba(153, 102, 255, 0.8)', 'rgba(255, 159, 64, 0.8)'], hoverOffset: 4 }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });
    } else if(ctxKategori) {
        const context = ctxKategori.getContext('2d');
        context.textAlign = 'center'; context.font = '14px Arial';
        context.fillText("Tidak ada data kategori produk.", ctxKategori.width / 2, ctxKategori.height / 2);
    }

    // Inisialisasi Barang Sering Dibeli
    const ctxTopProduk = document.getElementById('barangSeringDibeli');
    if (ctxTopProduk && barangSeringDibeliLabels.length > 0) {
        new Chart(ctxTopProduk, {
            type: 'bar',
            data: {
                labels: barangSeringDibeliLabels,
                datasets: [{ label: 'Total Terjual (Unit)', data: barangSeringDibeliData, backgroundColor: 'rgba(153, 102, 255, 0.7)', borderColor: 'rgba(153, 102, 255, 1)', borderWidth: 1 }]
            },
            options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }, plugins: { legend: { display: false } } }
        });
    } else if(ctxTopProduk) {
        const context = ctxTopProduk.getContext('2d');
        context.textAlign = 'center'; context.font = '14px Arial';
        context.fillText("Belum ada data produk yang sering dibeli.", ctxTopProduk.width / 2, ctxTopProduk.height / 2);
    }
</script>
<?= $this->endSection() ?>
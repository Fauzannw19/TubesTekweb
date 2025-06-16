<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'GudangKita') ?></title>
    <?= $this->renderSection('pageStyles') ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Style spesifik dari file asli Anda */
        #grafikKeuanganBulanan, #barangSeringDibeli { height: 350px !important; }
        #distribusiKategoriBarang { max-height: 350px !important; }
    </style>
</head>
<body class="flex h-screen bg-gray-100">

<aside id="sidebar" class="fixed top-0 left-0 z-30 h-full w-64 bg-[#537d5d] text-white transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col md:translate-x-0">
    <div class="flex items-center justify-center h-15 border-b border-[#456849] px-4"> 
        <img src="<?= base_url('Asset/LOGO.png') ?>" alt="Logo GudangKita" class="h-16 w-auto" /> 
        <h1 class="ml-3 text-xl font-bold tracking-wide">GudangKita</h1>
    </div>
    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-4 text-sm font-medium"> 
        <div>
            <p class="text-[#d9cba1] text-xs font-semibold mb-2 px-3">HOME</p>
            <a href="<?= site_url('dashboard') ?>" class="flex items-center px-3 py-2 rounded <?= (uri_string() == 'dashboard' || uri_string() == '/') ? 'bg-[#456849]' : 'hover:bg-[#456849]' ?> text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0H7v6h6v-6z" /></svg>
                Dashboard
            </a>
        </div>
        <div>
            <p class="text-[#d9cba1] text-xs font-semibold mb-2 px-3">DATA TRANSAKSI</p>
            <a href="<?= site_url('pembelian') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Data Pembelian
            </a>
            <a href="<?= site_url('penjualan') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                Data Penjualan
            </a>
        </div>
        <div>
            <p class="text-[#d9cba1] text-xs font-semibold mb-2 px-3">DATA MASTER</p>
            <a href="<?= site_url('produk') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                Data Barang
            </a>
            <a href="<?= site_url('supplier') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                Data Supplier
            </a>
        </div>
        <div>
            <p class="text-[#d9cba1] text-xs font-semibold mb-2 px-3">REPORT</p>
            <a href="<?= site_url('laporan') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a3 3 0 013-3h0m-3 3H6m3 0v6m0-6h3m6 0v6m0-6h3m-3 0h-3m-3-3h0a3 3 0 00-3-3H6m12 0a3 3 0 00-3-3h0m3 3c0 1.657-1.343 3-3 3h-3m0 0v6m0-6H6" /></svg> 
                Laporan Keuangan
            </a>
            <a href="<?= site_url('cetak') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
               <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                Cetak Data
            </a>
        </div>
        <div>
            <p class="text-[#d9cba1] text-xs font-semibold mb-2 px-3">KELOLA USER</p>
            <a href="<?= site_url('user') ?>" class="flex items-center px-3 py-2 rounded hover:bg-[#456849] text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                Kelola User
            </a>
        </div>

        <div>
            <p class="text-[#d9cba1] text-xs font-semibold mb-2 px-3 uppercase">Tentang</p>
            <a href="<?= site_url('about') ?>" class="flex items-center px-3 py-2 rounded <?= (service('uri')->getSegment(1) == 'about') ? 'bg-[#456849]' : 'hover:bg-[#456849]' ?> text-white">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                About us
            </a>
        </div>

        <div class="mt-auto pt-6"> <div class="px-3 py-4 border-t border-[#456849]">
                <a href="<?= site_url('logout') ?>" class="block w-full px-3 py-3 bg-red-600 hover:bg-red-700 rounded text-white font-semibold text-center">Logout</a>
            </div>
        </div>
    </nav>
</aside>
<div class="flex flex-col flex-1 transition-all duration-300 ease-in-out md:ml-64" id="mainContent">
    <header class="sticky top-0 z-20 flex items-center justify-between bg-[#537d5d] text-white px-4 py-5">
        <div class="flex items-center space-x-4">
            <button id="openSidebar" class="text-2xl font-bold focus:outline-none hover:bg-[#456849] p-1 rounded cursor-pointer md:hidden" aria-label="Toggle Sidebar" title="Toggle Sidebar">
                &#9776;
            </button>
       
        </div>
        <div class="flex items-center space-x-2 text-sm font-semibold select-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#d9cba1]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1112 21a9.003 9.003 0 01-6.879-3.196z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span><?= esc(session()->get('Nama')) ?></span>
        </div>
    </header>
    <main class="flex-1 p-6 overflow-auto">
        <?= $this->renderSection('content') ?>
    </main>
    <?= $this->renderSection('pageScripts') ?>
    </div>

<script>
    // Skrip sidebar toggle dari file asli Anda
    const sidebar = document.getElementById('sidebar');
    const openSidebarBtn = document.getElementById('openSidebar');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const mainContent = document.getElementById('mainContent');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        mainContent.classList.toggle('ml-64');
    }

    openSidebarBtn.addEventListener('click', toggleSidebar);
    closeSidebarBtn.addEventListener('click', toggleSidebar);

    if (openSidebarBtn) {
        openSidebarBtn.addEventListener('click', toggleSidebar);
    }
    
    // Fungsi untuk menyesuaikan layout saat ukuran layar berubah atau halaman dimuat
    function adjustLayoutOnResize() {
        if (sidebar && mainContent) {
            if (window.innerWidth < 768) { // Jika layar kecil
                 sidebar.classList.add('-translate-x-full'); // Selalu sembunyikan sidebar
                 mainContent.classList.remove('md:ml-64'); 
            } else { // Jika layar besar
                sidebar.classList.remove('-translate-x-full'); // Selalu tampilkan sidebar
                mainContent.classList.add('md:ml-64');
            }
        }
    }

    // Panggil saat halaman dimuat dan saat ukuran window berubah
    window.addEventListener('load', adjustLayoutOnResize);
    window.addEventListener('resize', adjustLayoutOnResize);


    // Render script spesifik halaman jika ada
    <?= $this->renderSection('pageScripts') ?>
</script>
</body>
</html>
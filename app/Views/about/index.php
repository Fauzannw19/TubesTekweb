<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<header class="mb-6 border-b-4 border-[#537d5d] pb-2">
    <h1 class="text-4xl font-extrabold text-[#2e4a37]">Profil Anggota Kelompok</h1>
</header>

<div class="bg-white p-6 rounded-lg shadow-lg">
    <p class="text-gray-700 leading-relaxed mb-6">
        Aplikasi **GudangKita** ini dirancang dan dikembangkan sebagai bagian dari proyek untuk memenuhi tugas besar dari matakuliah Teknologi web.
    </p>

    <h2 class="text-2xl font-bold text-[#2e4a37] mb-4 border-l-4 border-[#537d5d] pl-3">Tim Pengembang</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <?php foreach ($anggota as $item): ?>
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-5 text-center shadow-md hover:shadow-xl transition-shadow duration-300">
            <div class="mb-4">
                <div class="w-24 h-24 rounded-full bg-gray-300 mx-auto flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-xl font-bold text-gray-800"><?= esc($item['nama']) ?></h3>
            <p class="text-gray-500 font-mono"><?= esc($item['nim']) ?></p>
        </div>
        <?php endforeach; ?>

    </div>
</div>

<?= $this->endSection() ?>
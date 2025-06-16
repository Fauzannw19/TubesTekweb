<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<header class="mb-6 border-b-4 border-[#537d5d] pb-2">
    <h1 class="text-4xl font-extrabold text-[#2e4a37]"><?= esc($title) ?></h1>
</header>

<?php if(session()->getFlashdata('pesan_sukses')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg shadow-sm" role="alert">
        <?= session()->getFlashdata('pesan_sukses') ?>
    </div>
<?php endif; ?>

<section id="admin" class="content-section mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-[#2e4a37]">Data Admin</h2>
    </div>
    <div class="overflow-x-auto rounded-lg shadow-md bg-white">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-[#537d5d] text-white text-left">
                <tr>
                    <th class="py-3 px-4 text-sm">ID Admin</th>
                    <th class="py-3 px-4 text-sm">Nama</th>
                    <th class="py-3 px-4 text-sm">Email</th>
                    <th class="py-3 px-4 text-sm">No Telepon</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm"><?= esc($admin['IDAdmin']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($admin['Nama']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($admin['Email']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($admin['No_Telepon']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" class="text-center py-4 text-gray-500 italic">Tidak ada data admin.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<section id="pegawai" class="content-section">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-[#2e4a37]">Data Staff</h2>
        <a href="<?= site_url('user/tambah') ?>" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-semibold text-sm">+ Tambah Staff</a>
    </div>
    <div class="overflow-x-auto rounded-lg shadow-md bg-white">
        <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-[#537d5d] text-white text-left">
                <tr>
                    <th class="py-3 px-4 text-sm">ID Staff</th>
                    <th class="py-3 px-4 text-sm">Nama</th>
                    <th class="py-3 px-4 text-sm">Email</th>
                    <th class="py-3 px-4 text-sm">Password</th>
                    <th class="py-3 px-4 text-sm">No Telepon</th>
                    <th class="py-3 px-4 text-sm">Alamat</th>
                    <th class="py-3 px-4 text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($pegawai)): ?>
                    <?php foreach ($pegawai as $item): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm"><?= esc($item['IDPegawai']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($item['Nama']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($item['Email']) ?></td>
                            <td class="py-3 px-4 text-sm break-all font-mono text-xs"><?= esc($item['Password']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($item['No_Telepon']) ?></td>
                            <td class="py-3 px-4 text-sm"><?= esc($item['Alamat']) ?></td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center gap-2 flex-wrap">
                                    <a href="<?= site_url('user/hapus/' . $item['IDPegawai']) ?>" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs font-semibold" onclick="return confirm('Yakin ingin menghapus pegawai ini?');">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-4 text-gray-500 italic">Tidak ada data staff.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>
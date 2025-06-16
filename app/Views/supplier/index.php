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

<div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
    <a href="<?= site_url('supplier/tambah') ?>" class="w-full md:w-auto">
        <button class="w-full px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow-md">
            + Tambah Supplier
        </button>
    </a>
    <form action="<?= site_url('supplier') ?>" method="get" class="flex w-full md:w-auto">
        <input type="text" name="search" value="<?= esc($search, 'attr') ?>" placeholder="Cari nama atau email..." class="px-3 py-2 border rounded-l-md text-sm w-full focus:ring-1 focus:ring-green-500">
        <button type="submit" class="px-4 py-2 bg-[#537d5d] text-white rounded-r-md text-sm hover:bg-[#456849]">Cari</button>
    </form>
</div>

<section id="supplier" class="content-section">
    <div class="overflow-x-auto rounded-lg shadow bg-white">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead class="bg-[#537d5d] text-white text-left">
                <tr>
                    <th class="py-3 px-4 border-b">ID</th>
                    <th class="py-3 px-4 border-b">Nama Supplier</th>
                    <th class="py-3 px-4 border-b">Alamat</th>
                    <th class="py-3 px-4 border-b">No Telepon</th>
                    <th class="py-3 px-4 border-b">Email</th>
                    <th class="py-3 px-4 border-b">Kategori Produk</th>
                    <th class="py-3 px-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($supplier) && is_array($supplier)): ?>
                    <?php foreach ($supplier as $item): ?>
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="py-2 px-4"><?= esc($item['IDSupplier']) ?></td>
                        <td class="py-2 px-4 font-semibold"><?= esc($item['Namasupplier']) ?></td>
                        <td class="py-2 px-4 text-sm text-gray-600"><?= esc($item['Alamat']) ?></td>
                        <td class="py-2 px-4"><?= esc($item['No_Telepon']) ?></td>
                        <td class="py-2 px-4"><?= esc($item['Email']) ?></td>
                        <td class="py-2 px-4"><?= esc($item['Kategoriproduk']) ?></td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center gap-2 flex-wrap">
                                <a href="<?= site_url('supplier/edit/' . $item['IDSupplier']) ?>" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-yellow-800 rounded text-xs font-semibold">Edit</a>
                                <a href="<?= site_url('supplier/hapus/' . $item['IDSupplier']) ?>" onclick="return confirm('Anda yakin?');" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-4 text-gray-500">
                        Data supplier tidak ditemukan.
                    </td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php if ($pager): ?>
            <?= $pager->links('supplier', 'tailwind_pagination') ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
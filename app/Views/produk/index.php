<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<header class="mb-6 border-b-4 border-[#537d5d] pb-2">
    <h1 class="text-4xl font-extrabold text-[#2e4a37]"><?= esc($title) ?></h1>
</header>

<?php if(session()->getFlashdata('pesan_sukses')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg" role="alert">
        <?= session()->getFlashdata('pesan_sukses') ?>
    </div>
<?php endif; ?>

<?php if (!empty($stok_tipis)): ?>
<div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 shadow rounded-md">
  <div class="flex items-center">
    <div class="flex-shrink-0">
      <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.636-1.214 2.852-1.214 3.488 0l6.237 11.898c.636 1.214-.473 2.753-1.744 2.753H3.764c-1.27 0-2.38-1.54-1.744-2.753l6.237-11.898zM10 14a1 1 0 110-2 1 1 0 010 2zm-1-4a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" /></svg>
    </div>
    <div class="ml-3">
      <p class="text-sm font-semibold text-yellow-800">Peringatan: Stok beberapa produk menipis (kurang dari 20)!</p>
      <p class="text-sm text-yellow-700 mt-1">Harap segera lakukan pembelian untuk: <?= implode(', ', array_map('esc', $stok_tipis)) ?></p>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
    <a href="<?= site_url('produk/tambah') ?>" class="w-full md:w-auto">
        <button class="w-full px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow-md">
            + Tambah Produk
        </button>
    </a>
    <form action="<?= site_url('produk') ?>" method="get" class="flex w-full md:w-auto">
        <input type="text" name="search" value="<?= esc($search, 'attr') ?>" placeholder="Cari nama produk..." class="px-3 py-2 border rounded-l-md text-sm w-full focus:ring-1 focus:ring-green-500">
        <button type="submit" class="px-4 py-2 bg-[#537d5d] text-white rounded-r-md text-sm hover:bg-[#456849]">Cari</button>
    </form>
</div>

<section id="produk" class="content-section">
    <div class="overflow-x-auto rounded-lg shadow bg-white">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead class="bg-[#537d5d] text-white text-left">
                <tr>
                    <th class="py-3 px-4">ID</th>
                    <th class="py-3 px-4">Nama Produk</th>
                    <th class="py-3 px-4">Kategori</th>
                    <th class="py-3 px-4 text-right">Harga</th>
                    <th class="py-3 px-4">Deskripsi</th>
                    <th class="py-3 px-4 text-center">Stok</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produk)): ?>
                    <?php foreach ($produk as $item): ?>
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="py-2 px-4"><?= esc($item['IDProduk']) ?></td>
                        <td class="py-2 px-4 font-semibold"><?= esc($item['Namaproduk']) ?></td>
                        <td class="py-2 px-4"><?= esc($item['Kategoriproduk'] ?? 'N/A') ?></td>
                        <td class="py-2 px-4 text-right"><?= number_to_currency($item['Harga'], 'IDR', 'id_ID', 0) ?></td>
                        <td class="py-2 px-4 text-sm text-gray-600 truncate max-w-xs"><?= esc($item['Deskripsi']) ?></td>
                        <td class="py-2 px-4 text-center <?= ($item['Stok'] < 20) ? 'text-red-600 font-bold' : '' ?>"><?= esc($item['Stok']) ?></td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="<?= site_url('produk/edit/' . $item['IDProduk']) ?>" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-yellow-800 rounded text-xs font-semibold">Edit</a>
                                <a href="<?= site_url('produk/hapus/' . $item['IDProduk']) ?>" onclick="return confirm('Anda yakin?');" class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-semibold">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" class="text-center py-4 text-gray-500">Data tidak ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php if ($pager): ?>
            <?= $pager->links('produk', 'tailwind_pagination') ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
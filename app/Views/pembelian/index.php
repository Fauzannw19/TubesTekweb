<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<header class="mb-6 border-b-4 border-[#537d5d] pb-2">
    <h1 class="text-4xl font-extrabold text-[#2e4a37]">Data Pembelian</h1>
</header>

<?php if(session()->getFlashdata('pesan_sukses')): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-lg shadow-sm" role="alert">
        <?= session()->getFlashdata('pesan_sukses') ?>
    </div>
<?php endif; ?>

<div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
    <a href="<?= site_url('pembelian/tambah') ?>" class="inline-block w-full md:w-auto">
        <button class="w-full px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow-md">
            + Lakukan Pembelian
        </button>
    </a>
    <form action="<?= site_url('pembelian') ?>" method="get" class="flex w-full md:w-auto">
        <input type="text" name="search" value="<?= esc($search, 'attr') ?>" placeholder="Cari ID Pembelian/Supplier/Produk..." class="px-3 py-2 border rounded-l-md text-sm w-full focus:ring-1 focus:ring-green-500 focus:border-green-500">
        <button type="submit" class="px-4 py-2 bg-[#537d5d] text-white rounded-r-md text-sm hover:bg-[#456849]">Cari</button>
    </form>
</div>


<section id="pembelian" class="content-section">
    <div class="overflow-x-auto rounded-lg shadow bg-white">
        <table id="pembelianTable" class="min-w-full border-collapse border border-gray-300">
            <thead class="bg-[#537d5d] text-white text-left">
                <tr>
                    <th class="py-3 px-4 border-b">ID Pembelian</th>
                    <th class="py-3 px-4 border-b">ID Supplier</th>
                    <th class="py-3 px-4 border-b">ID Produk</th>
                    <th class="py-3 px-4 border-b">Tanggal</th>
                    <th class="py-3 px-4 border-b">Jumlah</th>
                    <th class="py-3 px-4 border-b text-right">Harga Satuan</th>
                    <th class="py-3 px-4 border-b text-right">Total Harga</th>
                    <th class="py-3 px-4 border-b">Metode Bayar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pembelian) && is_array($pembelian)): ?>
                    <?php foreach ($pembelian as $item): ?>
                        <tr class="hover:bg-gray-100 border-b border-gray-200">
                            <td class="py-2 px-4"><?= esc($item['IDPembelian']); ?></td>
                            <td class="py-2 px-4"><?= esc($item['IDSupplier']); ?></td>
                            <td class="py-2 px-4"><?= esc($item['IDProduk']); ?></td>
                            <td class="py-2 px-4"><?= esc(date('d-m-Y H:i', strtotime($item['Tanggal']))); ?></td>
                            <td class="py-2 px-4 text-center"><?= esc($item['Jumlahitem']); ?></td>
                            <td class="py-2 px-4 text-right"><?= number_to_currency($item['Hargasatuan'], 'IDR', 'id_ID', 0); ?></td>
                            <td class="py-2 px-4 text-right font-semibold"><?= number_to_currency($item['Totalharga'], 'IDR', 'id_ID', 0); ?></td>
                            <td class="py-2 px-4"><?= esc($item['Metodepembayaran']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">
                            Tidak ada data pembelian ditemukan.
                            <?php if (!empty($search)): ?>
                                <span class="block text-sm">Coba ubah kata kunci pencarian Anda.</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        <?php if ($pager): ?>
            <?= $pager->links('pembelian', 'tailwind_pagination') ?>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection() ?>
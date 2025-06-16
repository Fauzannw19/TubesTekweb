<?= $this->extend('layouts/main') ?>

<?php // Bagian untuk menambahkan CSS khusus halaman ini ?>
<?= $this->section('pageStyles') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <style>
        /* Kustomisasi tampilan DataTables agar menyatu dengan tema */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin-bottom: 1.5rem;
            margin-top: 1.5rem;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
             padding: 0.5em 1em;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #537d5d !important;
            color: white !important;
            border-color: #456849 !important;
        }
    </style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<header class="mb-6 border-b-4 border-[#537d5d] pb-2">
    <h1 class="text-4xl font-extrabold text-[#2e4a37]"><?= esc($title) ?></h1>
</header>

<section id="pesanan" class="content-section">
    <div class="overflow-x-auto rounded-lg shadow bg-white p-6">
        <table id="tabelPenjualan" class="display min-w-full">
            <thead class="bg-[#537d5d] text-white">
                <tr>
                    <th class="py-3 px-4 text-left text-sm">ID Penjualan</th>
                    <th class="py-3 px-4 text-left text-sm">ID Produk</th>
                    <th class="py-3 px-4 text-left text-sm">Tanggal Pesanan</th>
                    <th class="py-3 px-4 text-center text-sm">Jumlah Item</th>
                    <th class="py-3 px-4 text-right text-sm">Total Harga</th>
                    <th class="py-3 px-4 text-left text-sm">Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($penjualan)): ?>
                    <?php foreach ($penjualan as $item): ?>
                        <tr>
                            <td class="py-2 px-4 text-sm"><?= esc($item['IDPesanan']); ?></td>
                            <td class="py-2 px-4 text-sm"><?= esc($item['IDProduk']); ?></td>
                            <td class="py-2 px-4 text-sm"><?= esc(date('d-m-Y H:i', strtotime($item['Tanggalpesanan']))); ?></td>
                            <td class="py-2 px-4 text-sm text-center"><?= esc($item['Jumlahitem']); ?></td>
                            <td class="py-2 px-4 text-sm text-right font-semibold"><?= number_to_currency($item['Totalharga'], 'IDR', 'id_ID', 0); ?></td>
                            <td class="py-2 px-4 text-sm"><?= esc($item['Metodepembayaran']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?= $this->endSection() ?>


<?php // Bagian untuk menambahkan JavaScript khusus halaman ini ?>
<?= $this->section('pageScripts') ?>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        // Inisialisasi DataTables pada tabel dengan ID 'tabelPenjualan'
        $(document).ready(function () {
            $('#tabelPenjualan').DataTable({
                "paging": true,      // Aktifkan pagination
                "searching": true,   // Aktifkan fitur pencarian
                "responsive": true,  // Buat tabel responsif
                "language": {        // Terjemahkan label ke Bahasa Indonesia
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(difilter dari total _MAX_ data)",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
<?= $this->endSection() ?>
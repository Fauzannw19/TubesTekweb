<table class="min-w-full border-collapse border border-gray-300 text-sm">
    <thead class="bg-[#537d5d] text-white">
        <tr>
            <th class="px-3 py-2 border text-left">ID Pembelian</th>
            <th class="px-3 py-2 border text-left">ID Supplier</th>
            <th class="px-3 py-2 border text-left">ID Produk</th>
            <th class="px-3 py-2 border text-left">Tanggal</th>
            <th class="px-3 py-2 border text-right">Jumlah</th>
            <th class="px-3 py-2 border text-right">Harga Satuan</th>
            <th class="px-3 py-2 border text-right">Total Harga</th>
            <th class="px-3 py-2 border text-left">Metode Bayar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($hasil_data as $row): ?>
        <tr class="hover:bg-gray-50 even:bg-gray-100">
            <td class="px-3 py-2 border"><?= esc($row['IDPembelian']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['IDSupplier']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['IDProduk']) ?></td>
            <td class="px-3 py-2 border"><?= esc(date('d-m-Y', strtotime($row['Tanggal']))) ?></td>
            <td class="px-3 py-2 border text-right"><?= esc($row['Jumlahitem']) ?></td>
            <td class="px-3 py-2 border text-right"><?= number_to_currency($row['Hargasatuan'], 'IDR', 'id_ID', 0) ?></td>
            <td class="px-3 py-2 border text-right"><?= number_to_currency($row['Totalharga'], 'IDR', 'id_ID', 0) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Metodepembayaran']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
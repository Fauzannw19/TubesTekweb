<table class="min-w-full">
    <thead class="bg-[#537d5d] text-white">
        <tr>
            <th class="px-3 py-2 border text-left">ID</th>
            <th class="px-3 py-2 border text-left">Nama Produk</th>
            <th class="px-3 py-2 border text-left">Kategori</th>
            <th class="px-3 py-2 border text-right">Harga</th>
            <th class="px-3 py-2 border text-left">Deskripsi</th>
            <th class="px-3 py-2 border text-right">Stok</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($hasil_data as $row): ?>
        <tr>
            <td class="px-3 py-2 border"><?= esc($row['IDProduk']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Namaproduk']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Kategoriproduk']) ?></td>
            <td class="px-3 py-2 border text-right"><?= number_to_currency($row['Harga'], 'IDR', 'id_ID', 0) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Deskripsi']) ?></td>
            <td class="px-3 py-2 border text-right"><?= esc($row['Stok']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
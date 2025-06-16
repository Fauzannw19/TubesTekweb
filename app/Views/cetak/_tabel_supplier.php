<table class="min-w-full border-collapse border border-gray-300 text-sm">
    <thead class="bg-[#537d5d] text-white">
        <tr>
            <th class="px-3 py-2 border text-left">ID Supplier</th>
            <th class="px-3 py-2 border text-left">Nama Supplier</th>
            <th class="px-3 py-2 border text-left">Alamat</th>
            <th class="px-3 py-2 border text-left">No Telepon</th>
            <th class="px-3 py-2 border text-left">Email</th>
            <th class="px-3 py-2 border text-left">Kategori Produk</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($hasil_data as $row): ?>
        <tr class="hover:bg-gray-50 even:bg-gray-100">
            <td class="px-3 py-2 border"><?= esc($row['IDSupplier']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Namasupplier']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Alamat']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['No_Telepon']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Email']) ?></td>
            <td class="px-3 py-2 border"><?= esc($row['Kategoriproduk']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#ede6d1] flex items-center justify-center min-h-screen font-sans px-4 py-8">
    <div class="bg-[#537d5d] w-full max-w-sm sm:max-w-md p-8 rounded-lg shadow-lg text-[#d9cba1]">
        <h2 class="text-2xl font-bold mb-8 text-center">EDIT PRODUK</h2>

        <?php if($validation->getErrors()): ?>
            <div class="mb-4 p-3 bg-red-900/50 border border-red-700 text-red-300 rounded-md text-sm">
                <ul class="list-disc list-inside">
                    <?php foreach ($validation->getErrors() as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('produk/update') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            <input type="hidden" name="IDProduk" value="<?= esc($produk['IDProduk']) ?>">

            <div>
                <label class="block font-semibold mb-1">ID PRODUK</label>
                <input type="text" value="<?= esc($produk['IDProduk']) ?>" class="w-full bg-[#456849] text-white py-2 px-3 rounded-md cursor-not-allowed" readonly />
            </div>

            <div>
                <label for="Namaproduk" class="block font-semibold mb-1">NAMA PRODUK</label>
                <input id="Namaproduk" name="Namaproduk" type="text" value="<?= old('Namaproduk', $produk['Namaproduk']) ?>" class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="Kategoriproduk" class="block font-semibold mb-1">KATEGORI PRODUK</label>
                <input id="Kategoriproduk" name="Kategoriproduk" type="text" value="<?= old('Kategoriproduk', $produk['Kategoriproduk']) ?>" class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="Harga" class="block font-semibold mb-1">HARGA</label>
                <input id="Harga" name="Harga" type="number" value="<?= old('Harga', $produk['Harga']) ?>" class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" min="0" required />
            </div>

            <div>
                <label for="Deskripsi" class="block font-semibold mb-1">DESKRIPSI</label>
                <textarea id="Deskripsi" name="Deskripsi" class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required><?= old('Deskripsi', $produk['Deskripsi']) ?></textarea>
            </div>

            <div>
                <label for="Stok" class="block font-semibold mb-1">STOK</label>
                <input id="Stok" name="Stok" type="number" value="<?= old('Stok', $produk['Stok']) ?>" class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" min="0" required />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#415c41] py-3 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
                    SIMPAN PERUBAHAN
                </button>
                <a href="<?= site_url('produk') ?>" class="block text-center py-3 text-[#d9cba1] hover:underline text-sm">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
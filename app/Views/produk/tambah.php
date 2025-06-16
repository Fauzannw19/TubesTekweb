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
        <h2 class="text-2xl font-bold mb-8 text-center"><?= esc($title) ?></h2>

        <?php if($validation->getErrors()): ?>
            <div class="mb-4 p-3 bg-red-900/50 border border-red-700 text-red-300 rounded-md text-sm">
                <ul class="list-disc list-inside">
                    <?php foreach ($validation->getErrors() as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('produk/simpan') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            <div>
                <label class="block font-semibold mb-1">ID PRODUK</label>
                <input type="text" value="<?= esc($newID) ?>" class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1" readonly />
            </div>

            <div>
                <label for="namaproduk" class="block font-semibold mb-1">NAMA PRODUK</label>
                <input id="namaproduk" name="namaproduk" type="text" value="<?= old('namaproduk') ?>" placeholder="Masukkan Nama Produk" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="kategoriproduk" class="block font-semibold mb-1">KATEGORI PRODUK</label>
                <input id="kategoriproduk" name="kategoriproduk" type="text" value="<?= old('kategoriproduk') ?>" placeholder="Cth: merek hp " class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="harga" class="block font-semibold mb-1">HARGA</label>
                <input id="harga" name="harga" type="number" value="<?= old('harga') ?>" placeholder="Masukkan Harga (angka saja)" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" min="0" required />
            </div>

            <div>
                <label for="deskripsi" class="block font-semibold mb-1">DESKRIPSI</label>
                <textarea id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Produk" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required><?= old('deskripsi') ?></textarea>
            </div>

            <div>
                <label for="stok" class="block font-semibold mb-1">STOK AWAL</label>
                <input id="stok" name="stok" type="number" value="<?= old('stok') ?>" placeholder="Masukkan Jumlah Stok" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" min="0" required />
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#415c41] py-3 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
                    TAMBAH PRODUK
                </button>
                <a href="<?= site_url('produk') ?>" class="block text-center py-3 text-[#d9cba1] hover:underline text-sm">Kembali ke Data Produk</a>
            </div>
        </form>
    </div>
</body>
</html>
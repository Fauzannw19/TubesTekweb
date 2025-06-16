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

        <form action="<?= site_url('supplier/simpan') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>

            <div>
                <label for="idsupplier" class="block font-semibold mb-1">ID SUPPLIER</label>
                <input id="idsupplier" name="idsupplier" type="text" value="<?= esc($newID) ?>" readonly class="w-full bg-[#537d5d] border-b border-[#a39d7a] text-[#d9cba1] py-1 cursor-not-allowed" />
            </div>

            <div>
                <label for="namasupplier" class="block font-semibold mb-1">NAMA SUPPLIER</label>
                <input id="namasupplier" name="namasupplier" type="text" value="<?= old('namasupplier') ?>" placeholder="Masukkan Nama Supplier" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="alamat" class="block font-semibold mb-1">ALAMAT</label>
                <textarea id="alamat" name="alamat" placeholder="Masukkan Alamat Supplier" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required><?= old('alamat') ?></textarea>
            </div>

            <div>
                <label for="notelp" class="block font-semibold mb-1">NO TELEPON</label>
                <input id="notelp" name="notelp" type="tel" value="<?= old('notelp') ?>" placeholder="Masukkan No Telepon" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="email" class="block font-semibold mb-1">EMAIL</label>
                <input id="email" name="email" type="email" value="<?= old('email') ?>" placeholder="Masukkan Email" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div>
                <label for="Kategoriproduk" class="block font-semibold mb-1">KATEGORI PRODUK</label>
                <input id="Kategoriproduk" name="Kategoriproduk" type="text" value="<?= old('Kategoriproduk') ?>" placeholder="Cth: Infinix, iphone" class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" required />
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-[#415c41] py-3 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
                    TAMBAH SUPPLIER
                </button>
                <a href="<?= site_url('supplier') ?>" class="block text-center py-3 text-[#d9cba1] hover:underline text-sm">Kembali ke Data Supplier</a>
            </div>
        </form>
    </div>
</body>
</html>
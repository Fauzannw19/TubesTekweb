<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#ede6d1] flex items-center justify-center min-h-screen font-sans px-4">
    <div class="bg-[#537d5d] w-full max-w-md p-8 rounded-lg shadow-lg text-[#d9cba1]">
        <h2 class="text-2xl font-bold mb-8 text-center">EDIT SUPPLIER</h2>

        <?php if($validation->getErrors()): ?>
            <div class="mb-4 p-3 bg-red-900/50 border border-red-700 text-red-300 rounded-md text-sm">
                <ul class="list-disc list-inside">
                    <?php foreach ($validation->getErrors() as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('supplier/update') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            <input type="hidden" name="IDSupplier" value="<?= esc($supplier['IDSupplier']) ?>">
            
            <div>
                <label class="block font-semibold mb-1">ID SUPPLIER</label>
                <input type="text" value="<?= esc($supplier['IDSupplier']) ?>" class="w-full bg-[#456849] text-white py-2 px-3 rounded-md cursor-not-allowed" readonly />
            </div>
            
            <div>
                <label for="Namasupplier" class="block font-semibold mb-1">NAMA SUPPLIER</label>
                <input name="Namasupplier" id="Namasupplier" type="text" value="<?= old('Namasupplier', $supplier['Namasupplier']) ?>" required class="w-full bg-[#537d5d] border-b border-[#a39d7a] py-1 text-[#d9cba1] focus:outline-none">
            </div>

            <div>
                <label for="Alamat" class="block font-semibold mb-1">ALAMAT</label>
                <input name="Alamat" id="Alamat" type="text" value="<?= old('Alamat', $supplier['Alamat']) ?>" required class="w-full bg-[#537d5d] border-b border-[#a39d7a] py-1 text-[#d9cba1] focus:outline-none">
            </div>

            <div>
                <label for="No_Telepon" class="block font-semibold mb-1">NO TELEPON</label>
                <input name="No_Telepon" id="No_Telepon" type="text" value="<?= old('No_Telepon', $supplier['No_Telepon']) ?>" required class="w-full bg-[#537d5d] border-b border-[#a39d7a] py-1 text-[#d9cba1] focus:outline-none">
            </div>

            <div>
                <label for="Email" class="block font-semibold mb-1">EMAIL</label>
                <input name="Email" id="Email" type="email" value="<?= old('Email', $supplier['Email']) ?>" required class="w-full bg-[#537d5d] border-b border-[#a39d7a] py-1 text-[#d9cba1] focus:outline-none">
            </div>

            <div>
                <label for="Kategoriproduk" class="block font-semibold mb-1">KATEGORI PRODUK</label>
                <input name="Kategoriproduk" id="Kategoriproduk" type="text" value="<?= old('Kategoriproduk', $supplier['Kategoriproduk']) ?>" required class="w-full bg-[#537d5d] border-b border-[#a39d7a] py-1 text-[#d9cba1] focus:outline-none">
            </div>

            <div class="mt-8 space-y-2">
                <button type="submit" class="w-full bg-[#415c41] py-3 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
                    SIMPAN PERUBAHAN
                </button>
                <a href="<?= site_url('supplier') ?>" class="block text-center py-3 text-[#d9cba1] hover:underline text-sm">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= esc($title) ?> - GudangKita</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input[type="datetime-local"]::-webkit-calendar-picker-indicator { filter: invert(0.7) brightness(100%); }
        .form-error { border-color: #ef4444; }
        .error-text { color: #f87171; font-size: 0.875rem; }
    </style>
</head>
<body class="bg-[#ede6d1] flex items-center justify-center min-h-screen px-4 py-8 font-sans">
    <div class="bg-[#537d5d] w-full max-w-lg p-8 rounded-xl shadow-2xl text-[#d9cba1]">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold tracking-tight"><?= esc($title) ?></h2>
        </div>

        <?php if($validation->getErrors()): ?>
            <div class="mb-4 p-3 bg-red-900/50 border border-red-700 text-red-300 rounded-md text-sm">
                <p class="font-semibold">Mohon perbaiki kesalahan berikut:</p>
                <ul class="list-disc list-inside mt-1">
                    <?php foreach ($validation->getErrors() as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('pembelian/simpan') ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label for="idpembelian" class="block text-sm font-semibold mb-1">ID PEMBELIAN</label>
                <input type="text" id="idpembelian" name="idpembelian" value="<?= esc($newID) ?>" readonly class="w-full bg-[#456849] text-white py-2 px-3 rounded-md cursor-not-allowed" />
            </div>

            <div>
                <label for="idsupplier" class="block text-sm font-semibold mb-1">SUPPLIER</label>
                <select id="idsupplier" name="idsupplier" class="w-full bg-[#ede6d1] border text-[#333] py-2 px-3 rounded-md <?= $validation->hasError('idsupplier') ? 'form-error' : 'border-[#a39d7a]' ?>">
                    <option value="" disabled selected>Pilih Supplier</option>
                    <?php foreach($supplier as $s): ?>
                        <option value="<?= esc($s['IDSupplier']) ?>" <?= old('idsupplier') == $s['IDSupplier'] ? 'selected' : '' ?>>
                            <?= esc($s['Namasupplier']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="idproduk" class="block text-sm font-semibold mb-1">PRODUK</label>
                <select id="idproduk" name="idproduk" class="w-full bg-[#ede6d1] border text-[#333] py-2 px-3 rounded-md <?= $validation->hasError('idproduk') ? 'form-error' : 'border-[#a39d7a]' ?>">
                    <option value="" disabled selected>Pilih Produk</option>
                     <?php foreach($produk as $p): ?>
                        <option value="<?= esc($p['IDProduk']) ?>" <?= old('idproduk') == $p['IDProduk'] ? 'selected' : '' ?>>
                            <?= esc($p['Namaproduk']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="tanggal" class="block text-sm font-semibold mb-1">TANGGAL & WAKTU</label>
                <input type="datetime-local" id="tanggal" name="tanggal" value="<?= old('tanggal') ?>" class="w-full bg-[#ede6d1] border text-[#333] py-2 px-3 rounded-md <?= $validation->hasError('tanggal') ? 'form-error' : 'border-[#a39d7a]' ?>" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="jumlahitem" class="block text-sm font-semibold mb-1">JUMLAH ITEM</label>
                    <input type="number" id="jumlahitem" name="jumlahitem" value="<?= old('jumlahitem') ?>" min="1" placeholder="0" class="w-full bg-[#ede6d1] border text-[#333] py-2 px-3 rounded-md <?= $validation->hasError('jumlahitem') ? 'form-error' : 'border-[#a39d7a]' ?>" />
                </div>
                <div>
                    <label for="hargasatuan" class="block text-sm font-semibold mb-1">HARGA SATUAN (Rp)</label>
                    <input type="number" id="hargasatuan" name="hargasatuan" value="<?= old('hargasatuan') ?>" min="0" placeholder="0" class="w-full bg-[#ede6d1] border text-[#333] py-2 px-3 rounded-md <?= $validation->hasError('hargasatuan') ? 'form-error' : 'border-[#a39d7a]' ?>" />
                </div>
            </div>

            <div>
                <label for="totalharga" class="block text-sm font-semibold mb-1">TOTAL HARGA (Rp)</label>
                <input type="number" id="totalharga" name="totalharga" value="<?= old('totalharga') ?>" readonly class="w-full bg-[#e0d9c5] text-[#444] py-2 px-3 rounded-md cursor-not-allowed" />
            </div>
            
            <div>
                <label for="metodepembayaran" class="block text-sm font-semibold mb-1">METODE PEMBAYARAN</label>
                <select id="metodepembayaran" name="metodepembayaran" class="w-full bg-[#ede6d1] border text-[#333] py-2 px-3 rounded-md <?= $validation->hasError('metodepembayaran') ? 'form-error' : 'border-[#a39d7a]' ?>">
                    <option value="" disabled selected>Pilih metode</option>
                    <option value="Transfer Bank" <?= old('metodepembayaran') == 'Transfer Bank' ? 'selected' : '' ?>>Transfer Bank</option>
                    <option value="Tunai" <?= old('metodepembayaran') == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                </select>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-green-700 py-3 rounded-lg text-white font-bold text-lg hover:bg-green-800 transition-colors">SIMPAN PEMBELIAN</button>
                <a href="<?= site_url('pembelian') ?>" class="block text-center mt-3 py-2 text-sm text-[#d9cba1] hover:text-white">Batal</a>
            </div>
        </form>
    </div>

    <script>
        const jumlahItemInput = document.getElementById('jumlahitem');
        const hargaSatuanInput = document.getElementById('hargasatuan');
        const totalHargaInput = document.getElementById('totalharga');

        function hitungTotal() {
            const jumlah = parseInt(jumlahItemInput.value) || 0;
            const harga = parseFloat(hargaSatuanInput.value) || 0;
            totalHargaInput.value = jumlah * harga;
        }

        if (jumlahItemInput && hargaSatuanInput) {
            jumlahItemInput.addEventListener('input', hitungTotal);
            hargaSatuanInput.addEventListener('input', hitungTotal);
        }
        document.addEventListener('DOMContentLoaded', hitungTotal);
    </script>
</body>
</html>
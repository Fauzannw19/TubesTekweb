<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register Admin Kasirku</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="relative bg-[#ede6d1] flex items-center justify-center min-h-screen font-sans px-4">
  <!-- Latar Lingkaran Dekoratif -->
  <div class="absolute w-full h-full top-0 left-0 overflow-hidden -z-10">
    <div class="w-52 h-52 border-[20px] border-[#537d5d] rounded-full absolute top-[-40px] left-[-40px] opacity-50"></div>
    <div class="w-36 h-36 border-[15px] border-[#537d5d] rounded-full absolute top-[80px] right-[-30px] opacity-50"></div>
    <div class="w-28 h-28 border-[10px] border-[#537d5d] rounded-full absolute bottom-[-40px] left-[20px] opacity-50"></div>
    <div class="w-16 h-16 border-[6px] border-[#537d5d] rounded-full absolute bottom-[30px] right-[30px] opacity-50"></div>
  </div>
    <div class="bg-[#537d5d] w-full max-w-sm sm:max-w-md p-8 rounded-lg shadow-lg text-[#d9cba1]">
    <h2 class="text-2xl font-bold mb-8 text-center">REGISTER ADMIN</h2>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="text-red-500 text-sm mb-4"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('/register/store') ?>" method="POST" class="space-y-6">
      <div>
        <label for="nama" class="block font-semibold mb-1">NAMA</label>
        <input id="nama" name="nama" type="text" placeholder="Masukkan Nama" required
               class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" />
      </div>

      <div>
        <label for="email" class="block font-semibold mb-1">EMAIL</label>
        <input id="email" name="email" type="email" placeholder="Masukkan Email" required
               class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" />
      </div>

      <div>
        <label for="password" class="block font-semibold mb-1">PASSWORD</label>
        <input id="password" name="password" type="password" placeholder="Masukkan Password" required
               class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" />
      </div>

      <div>
        <label for="no_telepon" class="block font-semibold mb-1">NO TELEPON</label>
        <input id="no_telepon" name="no_telepon" type="text" placeholder="08xxxxxxxxxx" required
               class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none" />
      </div>

      <div class="mt-8">
        <button type="submit"
                class="w-full bg-[#415c41] py-3 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
          REGISTER
        </button>
        <a href="<?= base_url('/login') ?>" class="block text-center py-3 text-[#d9cba1] hover:underline text-sm">
          Kembali ke Data Admin
        </a>
      </div>
    </form>
  </div>
</body>
</html>

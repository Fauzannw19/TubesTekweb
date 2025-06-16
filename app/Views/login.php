<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Gudangku</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative bg-[#ede6d1] min-h-screen flex items-center justify-center px-4 font-sans">
    <!-- Latar Lingkaran Dekoratif -->
    <div class="absolute w-full h-full top-0 left-0 overflow-hidden -z-10">
      <div class="w-52 h-52 border-[20px] border-[#537d5d] rounded-full absolute top-[-40px] left-[-40px] opacity-50"></div>
      <div class="w-36 h-36 border-[15px] border-[#537d5d] rounded-full absolute top-[80px] right-[-30px] opacity-50"></div>
      <div class="w-28 h-28 border-[10px] border-[#537d5d] rounded-full absolute bottom-[-40px] left-[20px] opacity-50"></div>
      <div class="w-16 h-16 border-[6px] border-[#537d5d] rounded-full absolute bottom-[30px] right-[30px] opacity-50"></div>
    </div>

  <div class="bg-[#537d5d] w-full max-w-md p-8 rounded-lg shadow-lg text-[#d9cba1]">
    <div class="text-center mb-6">
    <img src="<?= base_url('Asset/LOGO.png') ?>" alt="Logo Kasirku" class="h-28 mx-auto mb-0">
      <h2 class="text-2xl font-bold">LOGIN ADMIN</h2>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4 text-sm text-center">
        <?= esc(session()->getFlashdata('error')) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('auth/login') ?>" class="space-y-6">
      <!-- Email -->
      <div>
        <label for="email" class="block font-semibold mb-1">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Masukkan Email"
          required
          class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 focus:outline-none"
        />
      </div>

      <!-- Password -->
      <div class="relative">
        <label for="password" class="block font-semibold mb-1">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Masukkan Password"
          required
          class="w-full bg-[#537d5d] border-b border-[#a39d7a] placeholder-[#a39d7a] text-[#d9cba1] py-1 pr-10 focus:outline-none"
        />
        <!-- Toggle Eye -->
        <button type="button" onclick="togglePassword()" class="absolute right-0 top-7 px-2 py-1 cursor-pointer">
          <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#d9cba1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064
               7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
          </svg>
        </button>
      </div>

      <!-- Tombol -->
      <div class="flex justify-between mt-8">
        <a href="<?= base_url('registeradmin') ?>" class="bg-[#415c41] px-6 py-2 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
          Register
        </a>
        <button type="submit" class="bg-[#415c41] px-6 py-2 rounded text-[#d9cba1] font-semibold shadow-md hover:bg-[#354b35] transition">
          Login
        </button>
      </div>
    </form>
  </div>

  <!-- Script Toggle Password -->
  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19
          c-5.523 0-10-4.477-10-10a9.964 9.964 0 012.223-6.029M3 3l18 18" />
        `;
      } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = `
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064
             7-9.542 7-4.478 0-8.268-2.943-9.542-7z" />
        `;
      }
    }
  </script>
</body>
</html>

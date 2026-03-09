<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>404 | Halaman Tidak Ditemukan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Tailwind CDN (AMAN untuk error page) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/icon/icon_1x1_pasti.svg') ?>">
</head>
<header class="bg-gradient-to-r from-[#0D87B0] to-[#0D588F] font-sans">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

<!-- Logo -->
<div class="flex items-center gap-3 text-white">
    <img 
        src="<?= base_url('assets/icon/icon_pasti.svg') ?>" 
        alt="Logo PASTI"
        class="h-24 w-24 object-contain"
    >
</div>


            <!-- Desktop Auth -->
            <div class="hidden md:flex items-center gap-3">
                <a href="/login"
                   class="border border-white text-white px-5 py-1.5 rounded-full text-sm hover:bg-white hover:text-indigo-900 transition">
                    Daftar Seminar
                </a>
                <a href="/register"
                   class="border border-white text-white px-5 py-1.5 rounded-full text-sm hover:bg-white hover:text-indigo-900 transition">
                    Daftar Anggota PASTI
                </a>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <button id="menuBtn" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <nav class="flex flex-col gap-3 mt-4">
                <a href="<?= base_url('pendaftaran') ?>" class="bg-rose-500 text-white px-4 py-2 rounded-full text-sm">
                    Daftar Seminar
                </a>
                  <a href="<?= base_url('pendaftaran/anggota') ?>" class="border border-white text-white px-4 py-2 rounded-full text-sm">
                    Daftar Anggota PASTI
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Toggle Script -->
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

<body class="bg-white text-slate-800">

    <div class="min-h-screen flex items-center justify-center px-6">
        <div class="max-w-md w-full text-center">

            <!-- SVG -->
            <img src="<?= base_url('assets/icon/404.svg') ?>"
                 alt="404 Not Found"
                 class="mx-auto w-64 mb-8">


            <p class="text-slate-500 leading-relaxed mb-8">
                <?php if (ENVIRONMENT !== 'production') : ?>
                    <?= nl2br(esc($message)) ?>
                <?php else : ?>
                    Halaman yang kamu cari tidak ditemukan atau sudah dipindahkan.
                <?php endif; ?>
            </p>

            <a href="<?= base_url('/') ?>"
               class="inline-flex items-center gap-2
                      px-6 py-3 rounded-full
                      bg-slate-800 text-white font-semibold
                      hover:bg-slate-700 transition">

                Kembali ke Beranda
            </a>

        </div>
    </div>
<footer class="relative bg-gradient-to-r from-[#0D588F] to-[#0D87B0] text-white overflow-hidden">

    <!-- Ornamen Blur Halus -->
    <div class="absolute -top-20 -left-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 -right-20 w-64 h-64 bg-black/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-10">

        <div class="flex items-center justify-between gap-6">

            <!-- Brand -->
            <div class="flex items-center justify-center gap-3">
                <img
                    class="w-24 block"
                    src="<?= base_url('assets/icon/icon_pasti.svg') ?>"
                    alt="PASTI Logo">

                <span class="font-semibold text-lg hidden md:inline leading-none">
                    Prestasi Aktif Mahasiswa Teknologi Informasi
                </span>
            </div>


            <!-- Sosial Media -->
            <div class="flex gap-4">
                <a href="#"
                    class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center
                          hover:bg-white hover:text-[#0D588F] transition">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#"
                    class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center
                          hover:bg-white hover:text-[#0D588F] transition">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
                <a href="#"
                    class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center
                          hover:bg-white hover:text-[#0D588F] transition">
                    <i class="fa-brands fa-youtube"></i>
                </a>
            </div>

        </div>


    </div>
</footer>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <!-- BASIC META -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- TITLE -->
    <title>
        <?= $this->renderSection('title') ?? 'PASTI - Prestasi Aktif Mahasiswa Teknologi Informasi' ?>
    </title>

    <!-- SEO META -->
    <meta name="description"
          content="<?= $this->renderSection('meta_description') ?? 
          'PASTI adalah program pengembangan prestasi, seminar, dan pelatihan mahasiswa Teknologi Informasi.' ?>">

    <meta name="keywords"
          content="<?= $this->renderSection('meta_keywords') ?? 
          'PASTI, Mahasiswa TI, Seminar IT, Pelatihan IT, Prestasi Mahasiswa' ?>">

    <meta name="author" content="PASTI HMJ TI">
    <meta name="robots" content="index, follow">

    <!-- CANONICAL -->
    <link rel="canonical" href="<?= current_url() ?>">

    <!-- OPEN GRAPH (WA / FB) -->
    <meta property="og:title"
          content="<?= $this->renderSection('og_title') ?? 'PASTI - Prestasi Aktif Mahasiswa Teknologi Informasi' ?>">
    <meta property="og:description"
          content="<?= $this->renderSection('og_description') ?? 
          'Program seminar, dan pengembangan prestasi mahasiswa Teknologi Informasi.' ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:image"
          content="<?= base_url('assets/images/icon/icon_1x1_pasti.svg') ?>">

    <!-- TWITTER CARD -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
          content="<?= $this->renderSection('og_title') ?? 'PASTI - Prestasi Aktif Mahasiswa Teknologi Informasi' ?>">
    <meta name="twitter:description"
          content="<?= $this->renderSection('og_description') ?? 
          'Program seminar, dan pengembangan prestasi mahasiswa Teknologi Informasi.' ?>">
    <meta name="twitter:image"
          content="<?= base_url('assets/images/icon/icon_1x1_pasti.svg') ?>">

    <!-- FAVICON -->
    <link rel="icon" type="image/png"
          href="<?= base_url('assets/icon/icon_1x1_pasti.svg') ?>">

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'ui-sans-serif', 'system-ui'],
                    }
                }
            }
        }
    </script>

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>


<style>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>



<body class="font-sans bg-gray-50">

<!-- LOADING SCREEN -->
<div id="page-loader"
     class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
    
    <div class="flex flex-col items-center gap-4">
        <!-- Spinner -->
        <div class="w-14 h-14 border-4 border-[#0D87B0] border-t-transparent rounded-full animate-spin"></div>

        <!-- Text -->
        <p class="text-[#0D588F] font-semibold tracking-wide">
            Memuat halaman...
        </p>
    </div>
</div>


    <?= $this->include('partials/header') ?>

    <main id="page-content" class="content opacity-0 transition-opacity duration-500">
        <?= $this->renderSection('content') ?>
    </main>

      <?= $this->include('partials/footer') ?>
<script>
// ===== AUTO SCROLL TESTIMONIAL =====
const wrapper = document.getElementById('testimonial-wrapper');
let scrollSpeed = 0.5;

function autoScroll() {
    if (!wrapper) return;

    wrapper.scrollLeft += scrollSpeed;

    if (wrapper.scrollLeft + wrapper.clientWidth >= wrapper.scrollWidth) {
        wrapper.scrollLeft = 0;
    }
}

let scrollInterval = setInterval(autoScroll, 20);

// Pause saat hover
wrapper.addEventListener('mouseenter', () => clearInterval(scrollInterval));
wrapper.addEventListener('mouseleave', () => {
    scrollInterval = setInterval(autoScroll, 20);
});

// ===== COUNTER ANIMATION =====
const counters = document.querySelectorAll('.counter');
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counter = entry.target;
            const target = +counter.dataset.target;
            const suffix = counter.dataset.suffix || '';
            let count = 0;

            const update = () => {
                count += target / 80;
                if (count < target) {
                    counter.textContent = Math.ceil(count) + suffix;
                    requestAnimationFrame(update);
                } else {
                    counter.textContent = target + suffix;
                }
            };
            update();
            observer.unobserve(counter);
        }
    });
}, { threshold: 0.6 });

counters.forEach(c => observer.observe(c));
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flash-success');
        if (flash) {
            setTimeout(() => {
                flash.classList.add('opacity-0');
                setTimeout(() => flash.remove(), 500); // hapus setelah animasi
            }, 3000); // 3 detik tampil
        }
    });
</script>

<script>
window.addEventListener('load', function () {
    const loader = document.getElementById('page-loader');
    const content = document.getElementById('page-content');

    if (content) content.classList.remove('opacity-0');

    if (loader) {
        loader.classList.add('opacity-0');
        setTimeout(() => loader.remove(), 500);
    }
});
</script>



</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $this->renderSection('title') ?></title>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
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

    <!-- Font Awesome -->
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

    <?= $this->include('partials/header') ?>

    <main class="content">
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

</body>
</html>

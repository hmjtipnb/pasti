<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
PASTI (Prestasi Aktif Mahasiswa Teknologi Informasi)
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="relative bg-white py-24 overflow-hidden">
    <?php if (session()->getFlashdata('success')): ?>
        <div id="flash-success"
            class="fixed top-6 right-6 z-50
                max-w-sm w-full
                bg-green-100 border border-green-300 text-green-700
                px-6 py-4 rounded-xl shadow-lg
                transition-opacity duration-500">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div id="flash-error"
            class="fixed top-6 right-6 z-50 max-w-sm
            bg-red-100 border border-red-300 text-red-700
            px-6 py-4 rounded-xl shadow-lg">
            <?= session()->getFlashdata('error') ?>
        </div>

        <script>
            setTimeout(() => {
                const el = document.getElementById('flash-error');
                if (el) el.remove();
            }, 4000);
        </script>
    <?php endif; ?>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        spinSlow: 'spin 12s linear infinite',
                    }
                }
            }
        }
    </script>




    <!-- BLUR BACKGROUND BLOBS -->
    <div class="absolute -top-24 -left-24 w-[420px] h-[420px] bg-[#0D87B0]/30 rounded-full blur-3xl"></div>
    <div class="absolute top-1/2 -right-24 w-[360px] h-[360px] bg-[#0D588F]/30 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <!-- LEFT: IMAGE + LAYER -->
            <div class="relative flex justify-center md:justify-start">


                <!-- Circle accent -->
                <div class="absolute -bottom-10 right-4 w-28 h-28 animate-spinSlow">
                    <div class="absolute inset-0 border-4 border-[#0D87B0]/40 rounded-full"></div>

                    <!-- titik kecil -->
                    <span class="absolute top-0 left-1/2 -translate-x-1/2
                 w-3 h-3 bg-[#0D87B0] rounded-full shadow-lg"></span>
                </div>

                <img
                    src="<?= base_url('assets/images/hero_sec.png') ?>"
                    alt="Mahasiswa PASTI"
                    class="relative z-10 w-96 md:w-[520px] drop-shadow-2xl" />

            </div>

            <!-- RIGHT: CONTENT -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    <span class="text-[#0D588F]">PASTI</span><br>
                    <span class="text-[#0D87B0]">Prestasi Aktif Mahasiswa</span>
                    <span class="text-[#b9dce8] hover:text-[#0D87B0] transition duration-300">Teknologi Informasi</span>
                </h1>

                <p class="mt-6 text-slate-600 leading-relaxed max-w-xl">
                    <strong>PASTI</strong> adalah salah satu prgram kerja dari <span class="italic">Himpunanan Mahasiswa Jurusan Teknologi Informasi</span> Bidang I, Daftar seminar dan menjadi peserta aktif PASTI sekarang 
                </p>

              <div class="mt-10 flex flex-wrap gap-4 justify-center">

    <!-- SECONDARY CTA -->
    <a href="<?= base_url('pendaftaran') ?>"
       class="group inline-flex items-center gap-3
              px-8 py-3 rounded-full
              border border-[#0D87B0]/60
              text-[#0D87B0] font-medium
              backdrop-blur-sm
              hover:bg-[#0D87B0] hover:text-white
              hover:shadow-[0_10px_30px_rgba(13,135,176,0.35)]
              transition-all duration-300">

        <span>Daftar Seminar</span>

        <i class="fa-solid fa-calendar-days
                  text-sm opacity-70
                  group-hover:translate-x-1
                  transition-transform"></i>
    </a>

    <!-- PRIMARY CTA -->
    <a href="<?= base_url('pendaftaran/anggota/') ?>"
       class="group inline-flex items-center gap-3
              px-9 py-3 rounded-full
              bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
              text-white font-semibold
              shadow-lg shadow-[#0D87B0]/40
              hover:shadow-xl hover:shadow-[#0D87B0]/60
              hover:scale-[1.03]
              transition-all duration-300">

        <span>Daftar Anggota</span>

        <i class="fa-solid fa-arrow-right
                  group-hover:translate-x-1
                  transition-transform"></i>
    </a>

</div>

            </div>

        </div>
    </div>
</section>



<section class="relative py-24 bg-slate-50 overflow-hidden">

    <!-- BLUR ORNAMENT -->
    <div class="absolute -top-24 right-0 w-[420px] h-[420px] bg-[#0D87B0]/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 -left-24 w-[360px] h-[360px] bg-[#0D588F]/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6">

        <!-- TITLE -->
        <div class="max-w-2xl mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-[#0D588F]">
                Ulasan PASTI
            </h2>
            <p class="mt-4 text-slate-600">
             Apa kata Mahasiswa terkait
                <strong>PASTI</strong>.
            </p>
        </div>

        <!-- STATS -->
        <!-- <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white rounded-3xl p-8 text-center shadow-lg">
                <i class="fa-solid fa-user-graduate text-4xl text-[#0D87B0] mb-4"></i>
                <h3 class="text-4xl font-bold text-[#0D588F] counter" data-target="500">0</h3>
                <p class="mt-2 text-slate-600">Mahasiswa Terlibat</p>
            </div>

            <div class="bg-white rounded-3xl p-8 text-center shadow-lg">
                <i class="fa-solid fa-award text-4xl text-[#0D87B0] mb-4"></i>
                <h3 class="text-4xl font-bold text-[#0D588F] counter" data-target="120">0</h3>
                <p class="mt-2 text-slate-600">Prestasi & Sertifikasi</p>
            </div>

            <div class="bg-white rounded-3xl p-8 text-center shadow-lg">
                <i class="fa-solid fa-briefcase text-4xl text-[#0D87B0] mb-4"></i>
                <h3 class="text-4xl font-bold text-[#0D588F] counter" data-target="90" data-suffix="%">0</h3>
                <p class="mt-2 text-slate-600">Siap Dunia Profesional</p>
            </div>
        </div> -->

        <!-- TESTIMONIALS -->
        <div id="testimonial-wrapper"
            class="flex gap-8 overflow-x-auto scroll-smooth pb-6 no-scrollbar">

            <?php foreach ($reviews as $r): ?>
                <div
                    class="testimonial-card min-w-[300px] md:min-w-[360px]
                           bg-white rounded-3xl p-8 shadow-lg
                           transition hover:-translate-y-2 hover:shadow-2xl">

                    <p class="text-slate-600 leading-relaxed mb-6">
                        “<?= esc($r['review']) ?>”
                    </p>

                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-[#0D87B0]/20 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-user text-[#0D87B0] text-xl"></i>
                        </div>

                        <div>
                            <h4 class="font-semibold text-[#0D588F]">
                                <?= esc($r['name']) ?>
                            </h4>
                            <span class="text-sm text-slate-500">
                                <?= esc($r['role']) ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>

        <!-- FORM ULASAN -->
        <div class="mt-20 max-w-7xl">

            <h3 class="text-2xl font-bold text-[#0D588F] mb-6">
                Tulis Ulasan Anda
            </h3>

            <form action="<?= base_url('review/store') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <input type="text" name="name" required
                    placeholder="Nama Anda"
                    class="w-full border rounded-xl px-4 py-3">

                <textarea name="content" rows="4" required
                    placeholder="Tulis ulasan Anda..."
                    class="w-full border rounded-xl px-4 py-3"></textarea>

                <button
                    class="bg-[#0D87B0] hover:bg-[#0D588F] text-white px-6 py-3 rounded-full transition">
                    Kirim Ulasan
                </button>
            </form>
        </div>

    </div>
</section>





<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll(".counter");
        let started = false;

        const runCounter = () => {
            counters.forEach(counter => {
                const target = +counter.getAttribute("data-target");
                const suffix = counter.getAttribute("data-suffix") || "";
                let count = 0;
                const speed = target / 80; // makin kecil makin cepat

                const update = () => {
                    count += speed;
                    if (count < target) {
                        counter.innerText = Math.floor(count) + suffix;
                        requestAnimationFrame(update);
                    } else {
                        counter.innerText = target + suffix;
                    }
                };

                update();
            });
        };

        // Trigger saat section terlihat
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting && !started) {
                started = true;
                runCounter();
            }
        }, {
            threshold: 0.4
        });

        observer.observe(document.querySelector(".counter"));
    });
</script>


<?= $this->endSection() ?>
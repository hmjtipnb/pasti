<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
About | Visual Design (UI/UX)
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="relative bg-white overflow-hidden py-24">
    <div class="absolute inset-0 pointer-events-none">
        <svg class="absolute right-0 top-1/2 -translate-y-1/2 opacity-20" width="800" height="600">
            <circle cx="400" cy="300" r="280" stroke="#0d75a4" stroke-width="2" fill="none" />
            <circle cx="400" cy="300" r="220" stroke="#0d75a4" stroke-width="2" fill="none" />
            <circle cx="400" cy="300" r="160" stroke="#0d75a4" stroke-width="2" fill="none" />
        </svg>
    </div>

    <div class="relative w-full">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div class="relative overflow-hidden">
                <img
                    src="<?= base_url('assets/images/divisi_web.png') ?>"
                    alt="Mahasiswa Program PASTI"
                    class="w-[120%] max-w-none h-auto object-contain drop-shadow-2xl
                           -ml-[10%]">
            </div>
            <div class="max-w-7xl mx-auto px-6">
                <span class="text-sm font-semibold text-[#ef4444] uppercase tracking-wider">
                    About Us
                </span>

                <h1 class="mt-4 text-4xl md:text-5xl font-bold text-[#0D588F] leading-tight">
                    Visual Design (UI/UX)
                </h1>

                <p class="mt-6 text-slate-600 leading-relaxed text-lg">
                    <strong>Divisi Visual (UI/UX Design)</strong>
                    merupakan divisi dalam program PASTI (Prestasi Aktif Mahasiswa Teknologi Informasi)
                    yang berfokus pada pengembangan kemampuan mahasiswa di bidang
                    <strong>desain antarmuka (User Interface)</strong> dan
                    <strong>pengalaman pengguna (User Experience)</strong>.
                </p>

                <p class="mt-4 text-slate-600 leading-relaxed">
                    Divisi ini dirancang untuk membekali mahasiswa dengan pemahaman desain yang kuat,
                    mulai dari konsep visual, struktur informasi, hingga perancangan antarmuka
                    yang estetis, fungsional, dan berorientasi pada kebutuhan pengguna.
                </p>

                <p class="mt-4 text-slate-600 leading-relaxed">
                    Mahasiswa akan mempelajari proses desain secara menyeluruh, seperti
                    <strong>user research, wireframing, prototyping, design system</strong>,
                    serta kolaborasi dengan tim developer agar desain dapat diimplementasikan
                    secara optimal ke dalam produk digital.
                </p>

                <p class="mt-4 text-slate-600 leading-relaxed">
                    Tech stack utama yang digunakan dalam divisi ini meliputi
                    <strong>Figma</strong> sebagai tools utama desain UI/UX,
                    serta pemahaman dasar <strong>UI pattern, UX flow, dan visual consistency</strong>
                    yang sesuai dengan standar industri.
                </p>

                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="<?= base_url('pendaftaran') ?>"
                        class="px-8 py-3 rounded-full
                              bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
                              text-white font-semibold
                              shadow-lg hover:shadow-xl
                              transition-all duration-300">
                        Daftar Sekarang
                    </a>

                    <a href="<?= base_url('kontak') ?>"
                        class="px-8 py-3 rounded-full
                              border border-[#0D87B0]
                              text-[#0D87B0] font-medium
                              hover:bg-[#0D87B0] hover:text-white
                              transition-all duration-300">
                        Hubungi Kami
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<?= $this->endSection() ?>
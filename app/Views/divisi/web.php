<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
About | Divisi Web Programming
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- ================= GALAXY STYLES ================= -->
<style>
/* ===== GALAXY BACKGROUND ===== */
.galaxy-dark {
    position: relative;
    background:
        radial-gradient(circle at 20% 20%, #020617 0%, #000000 60%),
        radial-gradient(circle at 80% 80%, #020617 0%, #000000 70%);
    color: #e5e7eb;
}

/* ===== ROTATION ===== */
@keyframes rotate-cw {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}
@keyframes rotate-ccw {
    from { transform: rotate(360deg); }
    to   { transform: rotate(0deg); }
}

.rotate-cw      { animation: rotate-cw 90s linear infinite;  transform-origin: 50% 50%; }
.rotate-ccw     { animation: rotate-ccw 130s linear infinite; transform-origin: 50% 50%; }
.rotate-cw-slow { animation: rotate-cw 180s linear infinite; transform-origin: 50% 50%; }

/* ===== ORBIT ===== */
.galaxy-orbit {
    fill: none;
    stroke: #8b5cf6;
    stroke-width: 2.8;
    opacity: 0.45;
    filter: drop-shadow(0 0 30px rgba(139,92,246,0.9));
}

/* ===== PLANET ===== */
.planet {
    filter: drop-shadow(0 0 22px rgba(216,180,254,1));
}
.planet-1 { fill: #c4b5fd; }
.planet-2 { fill: #a78bfa; }
.planet-3 { fill: #e9d5ff; }

/* ===== NEBULA ===== */
.nebula {
    position: absolute;
    inset: -40%;
    background:
        radial-gradient(circle at 30% 40%, rgb(13,93,147), transparent 45%),
        radial-gradient(circle at 70% 60%,rgb(13,123,167), transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(76,29,149,0.5), transparent 65%);
    filter: blur(160px);
    animation: nebula-float 50s ease-in-out infinite alternate;
}

@keyframes nebula-float {
    from { transform: translateY(-40px); }
    to   { transform: translateY(40px); }
}

/* ===== METEOR ===== */
.meteor {
    position: absolute;
    width: 240px;
    height: 3px;
    background: linear-gradient(
        90deg,
        rgba(255,255,255,0),
        rgba(255,255,255,1),
        rgba(255,255,255,0)
    );
    opacity: 1;
    filter:
        drop-shadow(0 0 12px #fff)
        drop-shadow(0 0 30px rgba(216,180,254,1));
    mix-blend-mode: screen;
    animation: meteor-fall 1.3s linear forwards;
}

@keyframes meteor-fall {
    from {
        transform: translate(0, 0) rotate(-30deg);
        opacity: 1;
    }
    to {
        transform: translate(-900px, 900px) rotate(-30deg);
        opacity: 0;
    }
}
</style>

<!-- ================= SECTION ================= -->
<section class="galaxy-dark overflow-hidden py-28 relative">

    <!-- ===== GALAXY ORNAMENT ===== -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">

        <!-- NEBULA -->
        <div class="nebula"></div>

        <!-- GALAXY SVG -->
        <svg
            class="absolute -right-[35%] top-1/2 -translate-y-1/2 opacity-50"
            width="1600"
            height="1400"
            viewBox="0 0 1600 1400"
            xmlns="http://www.w3.org/2000/svg"
        >
            <!-- ORBITS -->
            <g class="rotate-cw">
                <circle cx="800" cy="700" r="580" class="galaxy-orbit"/>
            </g>
            <g class="rotate-ccw">
                <circle cx="800" cy="700" r="470" class="galaxy-orbit"/>
            </g>
            <g class="rotate-cw-slow">
                <circle cx="800" cy="700" r="360" class="galaxy-orbit"/>
            </g>

            <!-- PLANETS -->
            <g class="rotate-cw">
                <circle cx="1380" cy="700" r="16" class="planet planet-1"/>
            </g>
            <g class="rotate-ccw">
                <circle cx="800" cy="220" r="12" class="planet planet-2"/>
            </g>
            <g class="rotate-cw-slow">
                <circle cx="420" cy="1120" r="10" class="planet planet-3"/>
            </g>
        </svg>

        <!-- METEOR LAYER -->
        <div id="meteor-layer"></div>
    </div>

    <!-- ===== CONTENT ===== -->
    <div class="relative z-10 w-full">
        <div class="grid md:grid-cols-2 gap-16 items-center">

            <!-- IMAGE -->
            <div class="relative overflow-hidden">
                <img
                    src="<?= base_url('assets/images/divisi_web.png') ?>"
                    alt="Divisi Web Programming"
                    class="w-[120%] max-w-none h-auto object-contain drop-shadow-2xl -ml-[10%]"
                >
            </div>

            <!-- TEXT -->
            <div class="max-w-7xl mx-auto px-6">
                <span class="text-sm font-semibold text-white-400 uppercase tracking-wider">
                    About Us
                </span>

                <h1 class="mt-4 text-4xl md:text-5xl font-bold text-white">
                    Web Programming
                </h1>

                <p class="mt-6 text-slate-200 text-lg leading-relaxed">
                    <strong>Divisi Web Programming</strong> merupakan divisi unggulan
                    program PASTI yang berfokus pada pengembangan aplikasi web modern,
                    aman, dan siap industri.
                </p>

                <p class="mt-4 text-slate-300 leading-relaxed">
                    Mahasiswa dibekali skill dari dasar hingga lanjutan untuk
                    membangun website dan aplikasi web profesional.
                </p>

                <p class="mt-4 text-slate-400 leading-relaxed">
                    Tech stack:
                    <strong class="text-slate-200">
                        HTML, CSS, JavaScript, PHP, Laravel
                    </strong>
                </p>

                <!-- CTA -->
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="<?= base_url('pendaftaran') ?>"
                       class="px-8 py-3 rounded-full
                              bg-gradient-to-r from-[#f13f5f] to-[#f13f5f]/80
                              text-white font-semibold shadow-lg hover:shadow-xl transition">
                        Daftar Sekarang
                    </a>

                    <a href="<?= base_url('kontak') ?>"
                       class="px-8 py-3 rounded-full
                              border border-white text-white
                              hover:bg-[#f13f5f]/80 hover:text-white hover:border-transparent transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= METEOR SCRIPT ================= -->
<script>
const meteorLayer = document.getElementById('meteor-layer');
const galaxySection = document.querySelector('.galaxy-dark');

function spawnMeteor() {
    if (!meteorLayer || !galaxySection) return;

    const meteor = document.createElement('div');
    meteor.className = 'meteor';

    const sectionHeight = galaxySection.offsetHeight;
    const sectionWidth  = galaxySection.offsetWidth;

    meteor.style.top = Math.random() * sectionHeight + 'px';

    // RANDOM ARAH
    const fromRight = Math.random() > 0.5;
    meteor.style.left = fromRight
        ? sectionWidth + Math.random() * 300 + 'px'
        : -300 + 'px';

    // RANDOM ROTASI
    const angle = fromRight ? -30 : -150;
    meteor.style.transform = `rotate(${angle}deg)`;

    meteorLayer.appendChild(meteor);

    setTimeout(() => meteor.remove(), 1600);
}

// ===== INTENSITAS METEOR =====
setInterval(() => {
    const count = 2 + Math.floor(Math.random() * 3);
    for (let i = 0; i < count; i++) {
        setTimeout(spawnMeteor, i * 120);
    }
}, 1200);
</script>

<?= $this->endSection() ?>

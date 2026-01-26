<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="relative min-h-screen flex items-center justify-center px-6 overflow-hidden">

    <!-- Decorative background -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#0D87B0]/30 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-[#0D588F]/30 rounded-full blur-3xl"></div>

    <div class="relative bg-white/80 backdrop-blur-xl max-w-xl w-full
                rounded-[2rem] p-10 shadow-2xl border border-white">

        <h2 class="text-3xl font-extrabold text-center text-[#0D588F] mb-2">
            Pendaftaran Seminar PASTI
        </h2>
        <p class="text-center text-slate-500 mb-8">
            Isi data dengan benar untuk mengikuti kegiatan
        </p>

        <?php if (session()->getFlashdata('success')): ?>
            <div id="flash-success"
                 class="mb-6 bg-green-100 border border-green-300
                        text-green-700 px-4 py-3 rounded-xl text-center animate-pulse">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form id="pendaftaranForm"
              action="<?= base_url('pendaftaran/store') ?>"
              method="post"
              class="space-y-5">

            <?= csrf_field() ?>

            <!-- Nama -->
            <div>
                <label class="text-sm font-semibold text-slate-600">Nama Lengkap</label>
                <input type="text" name="nama" required
                       class="mt-1 w-full rounded-xl border px-4 py-3
                              focus:ring-2 focus:ring-[#0D87B0] transition"
                       placeholder="Masukkan nama lengkap">
            </div>

            <!-- NIM & Kelas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-slate-600">NIM</label>
                    <input type="text" name="nim" required
                           class="mt-1 w-full rounded-xl border px-4 py-3
                                  focus:ring-2 focus:ring-[#0D87B0] transition"
                           placeholder="NIM">
                </div>

                <div>
                    <label class="flex items-center gap-2 text-sm font-semibold text-slate-600">
                        Kelas
                        <span class="text-xs font-normal text-slate-400">
                            Contoh: 4B
                        </span>
                    </label>
                    <input type="text" name="kelas" required
                           class="mt-1 w-full rounded-xl border px-4 py-3
                                  focus:ring-2 focus:ring-[#0D87B0] transition"
                           placeholder="Kelas">
                </div>
            </div>

            <!-- Prodi -->
            <div>
                <label class="text-sm font-semibold text-slate-600">
                    Program Studi
                </label>
                <select name="prodi" required
                        class="mt-1 w-full rounded-xl border px-4 py-3
                               focus:ring-2 focus:ring-[#0D87B0] transition">
                    <option value="" disabled selected>Pilih Program Studi</option>
                    <option value="D4_TRPL">D4 Teknologi Rekayasa Perangkat Lunak</option>
                    <option value="D3_MI">D3 Manajemen Informatika</option>
                    <option value="D2_AJK">D2 Administrasi Jaringan Komputer</option>
                </select>
            </div>

            <!-- Telp & Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-semibold text-slate-600">WhatsApp</label>
                    <input type="tel" name="telp" required
                           class="mt-1 w-full rounded-xl border px-4 py-3
                                  focus:ring-2 focus:ring-[#0D87B0] transition"
                           placeholder="08xxxxxxxxxx">
                </div>

                <div>
                    <label class="text-sm font-semibold text-slate-600">Email</label>
                    <input type="email" name="email" required
                           class="mt-1 w-full rounded-xl border px-4 py-3
                                  focus:ring-2 focus:ring-[#0D87B0] transition"
                           placeholder="email@contoh.com">
                </div>
            </div>

            <!-- Sesi -->
            <div>
                <label class="text-sm font-semibold text-slate-600">Pilihan Sesi</label>
                <select name="sesi" required
                        class="mt-1 w-full rounded-xl border px-4 py-3
                               focus:ring-2 focus:ring-[#0D87B0] transition">
                    <option value="">Pilih Sesi</option>
                    <option value="Offline">Offline</option>
                    <option value="Online">Online</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button id="submitBtn"
                    type="submit"
                    class="w-full mt-6 py-3 rounded-full font-bold text-white
                           bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
                           hover:scale-[1.02] hover:shadow-xl
                           transition-all duration-300
                           flex items-center justify-center gap-2">

                <span id="btnText">Kirim Pendaftaran</span>

                <svg id="spinner"
                     class="hidden w-5 h-5 animate-spin text-white"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </form>
    </div>
</section>

<!-- FULLSCREEN LOADING -->
<div id="loadingOverlay"
     class="fixed inset-0 z-50 hidden
            bg-white/80 backdrop-blur-md
            flex flex-col items-center justify-center">

    <p class="mb-6 text-lg font-semibold text-[#0D588F]">
        Mengirim pendaftaran...
    </p>

    <div class="w-72 h-3 bg-slate-200 rounded-full overflow-hidden">
        <div id="progressBar"
             class="h-full w-0 bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
                    transition-all duration-300">
        </div>
    </div>
</div>

<!-- SCRIPTS -->
<script>
    // Auto hide flash
    const flash = document.getElementById('flash-success');
    if (flash) {
        setTimeout(() => {
            flash.classList.add('opacity-0');
            setTimeout(() => flash.remove(), 500);
        }, 3000);
    }

    // Submit loading handler
    const form = document.getElementById('pendaftaranForm');
    const overlay = document.getElementById('loadingOverlay');
    const progressBar = document.getElementById('progressBar');
    const btn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const spinner = document.getElementById('spinner');

    form.addEventListener('submit', () => {
        // Button state
        btn.disabled = true;
        btn.classList.add('opacity-80', 'cursor-not-allowed');
        btnText.textContent = 'Mengirim...';
        spinner.classList.remove('hidden');

        // Overlay
        overlay.classList.remove('hidden');

        // Fake progress
        let progress = 0;
        const interval = setInterval(() => {
            if (progress < 90) {
                progress += 10;
                progressBar.style.width = progress + '%';
            }
        }, 300);
    });
</script>

<?= $this->endSection() ?>

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $this->section('title') ?>
PASTI (Prestasi Aktif Mahasiswa Teknologi Informasi) - Daftar Anggota Aktif
<?= $this->endSection() ?>

<section class="relative min-h-screen flex items-center justify-center px-6 overflow-hidden">

    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#0D87B0]/30 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-[#0D588F]/30 rounded-full blur-3xl"></div>

    <div class="relative bg-white/80 backdrop-blur-xl max-w-xl w-full
                rounded-[2rem] p-10 shadow-2xl border border-white">

        <h2 class="text-3xl font-extrabold text-center text-[#0D588F] mb-2">
            Pendaftaran Anggota Aktif PASTI
        </h2>
        <p class="text-center text-slate-500 mb-8">
            Bergabung dan berkembang bersama PASTI
        </p>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-center animate-pulse">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form id="anggotaForm"
              action="<?= base_url('pendaftaran/anggota/store') ?>"
              method="post"
              class="space-y-5">

            <?= csrf_field() ?>

            <input id="nama" type="text" name="nama" required placeholder="Nama Lengkap"
                   class="w-full rounded-xl border px-4 py-3">

            <div class="grid grid-cols-2 gap-4">
                <input id="nim" type="text" name="nim" required placeholder="NIM"
                       class="w-full rounded-xl border px-4 py-3">

                <input id="kelas" type="text" name="kelas" required placeholder="Kelas cth: 4B"
                       class="w-full rounded-xl border px-4 py-3">
            </div>

            <select name="prodi" required class="w-full rounded-xl border px-4 py-3">
                <option value="">Pilih Program Studi</option>
                <option value="D4_TRPL">D4 Teknologi Rekayasa Perangkat Lunak</option>
                <option value="D3_MI">D3 Manajemen Informatika</option>
                <option value="D2_AJK">D2 Administrasi Jaringan Komputer</option>
            </select>

            <div class="grid grid-cols-2 gap-4">
                <input id="wa" type="text" name="telp" required placeholder="WhatsApp"
                       class="w-full rounded-xl border px-4 py-3">
                <input id="email" type="email" name="email" required placeholder="Email"
                       class="w-full rounded-xl border px-4 py-3">
            </div>

            <select name="divisi" required class="w-full rounded-xl border px-4 py-3">
                <option value="">Pilih Divisi</option>
                <option value="WEB_PROGRAMMING">Divisi WEB Programming</option>
                <option value="VISUAL">Divisi Visual</option>
                <option value="KTI">Divisi Karya Tulis Ilmiah</option>
            </select>

            <!-- Submit Button -->
            <button id="submitBtn"
                    type="submit"
                    class="w-full mt-6 py-3 rounded-full font-bold text-white
                           bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
                           hover:scale-[1.02] hover:shadow-xl
                           transition-all duration-300
                           flex items-center justify-center gap-2">

                <span id="btnText">Daftar Sekarang</span>

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
    const form = document.getElementById('anggotaForm');
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

        // Overlay show
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

<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<section class="min-h-screen flex items-center justify-center px-6">
    <div class="bg-white max-w-lg w-full rounded-2xl p-10 shadow-xl text-center">

        <div class="text-6xl mb-4">🎉</div>

        <h2 class="text-3xl font-extrabold text-[#0D588F] mb-3">
            Pendaftaran Berhasil
        </h2>

        <p class="text-slate-600 mb-6">
            Terima kasih telah mendaftar sebagai <strong>Anggota Aktif PASTI</strong>.
            Silakan cek email kamu untuk informasi selanjutnya.
        </p>

        <a href="<?= base_url('/') ?>"
           class="inline-block px-6 py-3 rounded-full
                  bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
                  text-white font-bold hover:scale-105 transition">
            Kembali ke Beranda
        </a>

    </div>
</section>

<?= $this->endSection() ?>

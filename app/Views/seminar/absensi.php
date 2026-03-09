<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>
PASTI - Absensi Seminar
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class="relative min-h-screen flex items-center justify-center px-6 overflow-hidden">

    <!-- Decorative background -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-[#0D87B0]/30 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-[#0D588F]/30 rounded-full blur-3xl"></div>

    <div class="relative bg-white/80 backdrop-blur-xl max-w-xl w-full
                rounded-[2rem] p-10 shadow-2xl border border-white">

        <h2 class="text-3xl font-extrabold text-center text-[#0D588F] mb-2">
            Absensi Seminar PASTI
        </h2>
        <p class="text-center text-slate-500 mb-8">
            Masukkan NIM dan Nama Lengkap, serta upload bukti foto mengikuti seminar
        </p>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl text-center animate-pulse">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-center animate-pulse">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('seminar/absensi/store') ?>" method="post" enctype="multipart/form-data" class="space-y-5">
            <?= csrf_field() ?>

            <!-- Nama Lengkap -->
            <div>
                <label class="text-sm font-semibold text-slate-600">Nama Lengkap</label>
                <input type="text" name="nama" required
                       class="mt-1 w-full rounded-xl border px-4 py-3
                              focus:ring-2 focus:ring-[#0D87B0] transition"
                       placeholder="Masukkan nama lengkap">
            </div>

            <!-- NIM -->
            <div>
                <label class="text-sm font-semibold text-slate-600">NIM</label>
                <input type="text" name="nim" required
                       class="mt-1 w-full rounded-xl border px-4 py-3
                              focus:ring-2 focus:ring-[#0D87B0] transition"
                       placeholder="Masukkan NIM">
            </div>
<?php
// Ambil status sesi dari model SeminarSettingsModel
$settingsModel = new \App\Models\Seminar\SeminarSettingsModel();
$settings = $settingsModel->first();

// Default aktif/inaktif
$sesi1Aktif = $settings['sesi_1_aktif'] ?? 0;
$sesi2Aktif = $settings['sesi_2_aktif'] ?? 0;
?>

<!-- Sesi -->
<div>
    <label class="text-sm font-semibold text-slate-600">Sesi</label>
    <select name="sesi" required
            class="mt-1 w-full rounded-xl border px-4 py-3
                   focus:ring-2 focus:ring-[#0D87B0] transition">
        <option value="">Pilih Sesi</option>

        <option value="1" <?= $sesi1Aktif ? '' : 'disabled class="bg-gray-100 text-gray-400"' ?>>
            Sesi 1 <?= $sesi1Aktif ? '' : '(Tidak Aktif)' ?>
        </option>

        <option value="2" <?= $sesi2Aktif ? '' : 'disabled class="bg-gray-100 text-gray-400"' ?>>
            Sesi 2 <?= $sesi2Aktif ? '' : '(Tidak Aktif)' ?>
        </option>
    </select>
</div>


            <!-- Upload Foto -->
            <div>
                <label class="text-sm font-semibold text-slate-600">Upload Bukti Foto</label>
                <input type="file" name="foto" required accept="image/*"
                       class="mt-1 w-full rounded-xl border px-4 py-3
                              focus:ring-2 focus:ring-[#0D87B0] transition">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full mt-6 py-3 rounded-full font-bold text-white
                           bg-gradient-to-r from-[#0D87B0] to-[#0D588F]
                           hover:scale-[1.02] hover:shadow-xl
                           transition-all duration-300">
                Submit Absensi
            </button>
        </form>
    </div>
</section>

<?= $this->endSection() ?>

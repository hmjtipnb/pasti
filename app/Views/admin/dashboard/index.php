<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<h2>Dashboard</h2>
<p>Selamat datang di halaman admin 👋</p>

<div class="mt-6 grid grid-cols-1 gap-6">

    <!-- Card 1: Total Pendaftaran (besar) -->
    <div class="card p-8 bg-white rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700">Total Pendaftaran</h3>
        <p class="text-4xl font-bold text-[#0D588F]"><?= $totalPeserta ?></p>
    </div>

    <!-- Bawah: 2 card side by side -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Total Offline -->
        <div class="card p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Total Offline</h3>
            <p class="text-3xl font-bold text-[#0D588F]"><?= $totalOffline ?></p>
        </div>

        <!-- Total Online -->
        <div class="card p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Total Online</h3>
            <p class="text-3xl font-bold text-[#0D588F]"><?= $totalOnline ?></p>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

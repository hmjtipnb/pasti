<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<h2>Dashboard</h2>
<p>Selamat datang di halaman admin 👋</p>

<div class="mt-6 grid grid-cols-1 gap-6">

    <!-- Total Pendaftaran -->
    <div class="card p-8 bg-white rounded-lg shadow-md">
        <h3 class="text-xl font-semibold text-gray-700">Total Pendaftaran</h3>
        <p class="text-4xl font-bold text-[#0D588F]"><?= $totalPeserta ?></p>
    </div>

    <!-- Total Offline & Online -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Total Offline</h3>
            <p class="text-3xl font-bold text-[#0D588F]"><?= $totalOffline ?></p>
        </div>
        <div class="card p-6 bg-white rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700">Total Online</h3>
            <p class="text-3xl font-bold text-[#0D588F]"><?= $totalOnline ?></p>
        </div>
    </div>

    <!-- Grafik Pendaftaran -->
    <div class="mt-6 card p-6 bg-white rounded-lg shadow-md relative">

        <!-- Filter responsive: flex-wrap untuk mobile, right top untuk desktop -->
        <div class="flex flex-col md:flex-row md:justify-end md:items-center gap-2 mb-4 w-full">
            <form method="get" class="flex flex-wrap md:flex-nowrap items-center gap-2 w-full md:w-auto z-10">
                <label class="text-sm font-medium w-full md:w-auto">Bulan:</label>
                <select name="bulan" class="border rounded px-3 py-2 text-sm w-full md:w-auto mb-2 md:mb-0">
                    <?php 
                    for ($i=1; $i<=12; $i++):
                        $selected = ($i == $selectedBulan) ? 'selected' : '';
                        $namaBulan = DateTime::createFromFormat('!m', $i)->format('F');
                    ?>
                    <option value="<?= $i ?>" <?= $selected ?>><?= $namaBulan ?></option>
                    <?php endfor; ?>
                </select>

                <label class="text-sm font-medium w-full md:w-auto">Tahun:</label>
                <select name="tahun" class="border rounded px-3 py-2 text-sm w-full md:w-auto mb-2 md:mb-0">
                    <?php 
                    $tahunSekarang = date('Y');
                    for ($t = $tahunSekarang - 5; $t <= $tahunSekarang; $t++):
                        $selected = ($t == $selectedTahun) ? 'selected' : '';
                    ?>
                    <option value="<?= $t ?>" <?= $selected ?>><?= $t ?></option>
                    <?php endfor; ?>
                </select>

                <button type="submit" class="bg-[#f97316] text-white px-4 py-2 rounded text-sm w-full md:w-auto hover:bg-[#00345e] transition">Filter</button>
            </form>
        </div>

        <h3 class="text-lg font-semibold text-gray-700 mb-2">Grafik Pendaftaran</h3>
        <h4 class="text-md font-medium text-gray-500 mb-4">
            Bulan: <?= DateTime::createFromFormat('!m', $selectedBulan)->format('F') ?> <?= $selectedTahun ?>
        </h4>
        <canvas id="pendaftaranChart" height="100"></canvas>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('pendaftaranChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($bulan) ?>,
            datasets: [
                {
                    label: 'Offline',
                    data: <?= json_encode($offlinePerBulan) ?>,
                    backgroundColor: 'rgba(13, 88, 143, 0.7)'
                },
                {
                    label: 'Online',
                    data: <?= json_encode($onlinePerBulan) ?>,
                    backgroundColor: 'rgba(0, 200, 83, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { beginAtZero: true }
            },
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            }
        }
    });
});
</script>

<?= $this->endSection() ?>

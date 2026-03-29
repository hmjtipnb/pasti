<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="flex flex-col gap-2 mb-6">
    <h1 class="text-3xl font-bold text-[#00345e]">Dashboard Overview</h1>
    <p class="text-gray-500">Selamat datang kembali di panel administrasi PASTI 👋</p>
</div>

<!-- STATS CARDS -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Seminar -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition">
        <div class="w-14 h-14 bg-blue-50 text-[#00345e] rounded-xl flex items-center justify-center text-2xl">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Pendaftaran Seminar</p>
            <h3 class="text-2xl font-bold text-[#00345e]"><?= $totalSeminar ?></h3>
        </div>
    </div>

    <!-- Total Anggota -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition">
        <div class="w-14 h-14 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-2xl">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Anggota</p>
            <h3 class="text-2xl font-bold text-[#00345e]"><?= $totalAnggota ?></h3>
        </div>
    </div>

    <!-- Seminar Offline -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition">
        <div class="w-14 h-14 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-2xl">
            <i class="fa-solid fa-building"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Seminar Offline</p>
            <h3 class="text-2xl font-bold text-[#00345e]"><?= $totalOffline ?></h3>
        </div>
    </div>

    <!-- Seminar Online -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition">
        <div class="w-14 h-14 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-2xl">
            <i class="fa-solid fa-globe"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Seminar Online</p>
            <h3 class="text-2xl font-bold text-[#00345e]"><?= $totalOnline ?></h3>
        </div>
    </div>
</div>

<!-- CHARTS SECTION -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- LEFT: Main Charts (Seminar & Anggota) -->
    <div class="lg:col-span-2 flex flex-col gap-8">
        
        <!-- Filter & Header -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h3 class="text-lg font-bold text-[#00345e]">Statistik Pendaftaran</h3>
                    <p class="text-sm text-gray-400">Periode: <?= DateTime::createFromFormat('!m', $selectedBulan)->format('F') ?> <?= $selectedTahun ?></p>
                </div>

                <form method="get" class="flex items-center gap-2 bg-gray-50 p-1.5 rounded-xl border border-gray-200">
                    <select name="bulan" class="bg-transparent border-none text-sm font-medium focus:ring-0 cursor-pointer pl-3">
                        <?php for ($i=1; $i<=12; $i++): ?>
                            <option value="<?= $i ?>" <?= ($i == $selectedBulan) ? 'selected' : '' ?>><?= DateTime::createFromFormat('!m', $i)->format('F') ?></option>
                        <?php endfor; ?>
                    </select>
                    <div class="w-px h-4 bg-gray-300"></div>
                    <select name="tahun" class="bg-transparent border-none text-sm font-medium focus:ring-0 cursor-pointer">
                        <?php $tahunSekarang = date('Y'); for ($t = $tahunSekarang - 3; $t <= $tahunSekarang; $t++): ?>
                            <option value="<?= $t ?>" <?= ($t == $selectedTahun) ? 'selected' : '' ?>><?= $t ?></option>
                        <?php endfor; ?>
                    </select>
                    <button type="submit" class="bg-[#00345e] text-white p-2 rounded-lg hover:bg-blue-800 transition">
                        <i class="fa-solid fa-filter"></i>
                    </button>
                </form>
            </div>

            <!-- GRAFIK SEMINAR -->
            <div class="mb-10">
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-4 bg-blue-600 rounded-full"></div>
                    <h4 class="text-md font-semibold text-gray-700">Pendaftaran Seminar</h4>
                </div>
                <div class="h-64">
                    <canvas id="seminarChart"></canvas>
                </div>
            </div>

            <hr class="border-gray-100 my-8">

            <!-- GRAFIK ANGGOTA -->
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-1.5 h-4 bg-orange-500 rounded-full"></div>
                    <h4 class="text-md font-semibold text-gray-700">Pendaftaran Anggota</h4>
                </div>
                <div class="h-64">
                    <canvas id="anggotaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT: Side Stats (Divisi) -->
    <div class="flex flex-col gap-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-full">
            <h3 class="text-lg font-bold text-[#00345e] mb-6">Anggota per Divisi</h3>
            
            <div class="mb-8">
                <canvas id="divisiChart"></canvas>
            </div>

            <div class="space-y-4">
                <?php 
                $colors = ['bg-blue-500', 'bg-orange-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500', 'bg-yellow-500'];
                foreach ($divisiData as $index => $div): 
                    $color = $colors[$index % count($colors)];
                    $percent = ($totalAnggota > 0) ? round(($div['jumlah'] / $totalAnggota) * 100) : 0;
                ?>
                <div class="flex flex-col gap-1.5">
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-medium text-gray-700 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full <?= $color ?>"></span>
                            <?= $div['divisi'] ?>
                        </span>
                        <span class="text-gray-400"><?= $div['jumlah'] ?> (<?= $percent ?>%)</span>
                    </div>
                    <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                        <div class="<?= $color ?> h-full" style="width: <?= $percent ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
window.addEventListener('DOMContentLoaded', () => {
    // 📊 CHART SEMINAR
    const ctxSeminar = document.getElementById('seminarChart').getContext('2d');
    new Chart(ctxSeminar, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [
                {
                    label: 'Offline',
                    data: <?= json_encode($offlinePerHari) ?>,
                    backgroundColor: '#00345e',
                    borderRadius: 4
                },
                {
                    label: 'Online',
                    data: <?= json_encode($onlinePerHari) ?>,
                    backgroundColor: '#10b981',
                    borderRadius: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                x: { grid: { display: false } }
            }
        }
    });

    // 📈 CHART ANGGOTA
    const ctxAnggota = document.getElementById('anggotaChart').getContext('2d');
    const gradient = ctxAnggota.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(249, 115, 22, 0.4)');
    gradient.addColorStop(1, 'rgba(249, 115, 22, 0)');

    new Chart(ctxAnggota, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Anggota',
                data: <?= json_encode($anggotaPerHari) ?>,
                borderColor: '#f97316',
                borderWidth: 3,
                fill: true,
                backgroundColor: gradient,
                tension: 0.4,
                pointRadius: 0,
                pointHoverRadius: 5,
                pointHoverBackgroundColor: '#f97316',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [5, 5] } },
                x: { grid: { display: false } }
            }
        }
    });

    // 🍩 CHART DIVISI
    const ctxDivisi = document.getElementById('divisiChart').getContext('2d');
    new Chart(ctxDivisi, {
        type: 'doughnut',
        data: {
            labels: <?= json_encode(array_column($divisiData, 'divisi')) ?>,
            datasets: [{
                data: <?= json_encode(array_column($divisiData, 'jumlah')) ?>,
                backgroundColor: ['#3b82f6', '#f97316', '#10b981', '#a855f7', '#ef4444', '#eab308'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            cutout: '75%',
            plugins: {
                legend: { display: false }
            }
        }
    });
});
</script>

<?= $this->endSection() ?>

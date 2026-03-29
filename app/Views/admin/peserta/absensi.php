<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#00345e]">Daftar Absensi Seminar</h1>
        <p class="text-gray-500 text-sm">Kelola status sesi dan lihat data kehadiran peserta</p>
    </div>

    <!-- CARD PENGATURAN SESI -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold mb-5 text-[#00345e] flex items-center gap-2">
                <i class="fa-solid fa-toggle-on"></i>
                Status Sesi Absensi
            </h3>

            <div class="space-y-4">
                <!-- Sesi 1 -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <span class="font-semibold text-gray-700">Sesi 1</span>
                    <a href="<?= base_url('admin/users/toggleSesi/1') ?>"
                       class="px-5 py-2 rounded-lg text-sm font-bold shadow-sm transition
                       <?= $sesi1Aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                        <?= $sesi1Aktif ? 'AKTIF' : 'NONAKTIF' ?>
                    </a>
                </div>

                <!-- Sesi 2 -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <span class="font-semibold text-gray-700">Sesi 2</span>
                    <a href="<?= base_url('admin/users/toggleSesi/2') ?>"
                       class="px-5 py-2 rounded-lg text-sm font-bold shadow-sm transition
                       <?= $sesi2Aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                        <?= $sesi2Aktif ? 'AKTIF' : 'NONAKTIF' ?>
                    </a>
                </div>

                <!-- Sesi 3 -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                    <span class="font-semibold text-gray-700">Sesi 3</span>
                    <a href="<?= base_url('admin/users/toggleSesi/3') ?>"
                       class="px-5 py-2 rounded-lg text-sm font-bold shadow-sm transition
                       <?= $sesi3Aktif ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                        <?= $sesi3Aktif ? 'AKTIF' : 'NONAKTIF' ?>
                    </a>
                </div>
            </div>
        </div>

        <!-- FILTER FORM -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-full">
            <h3 class="text-lg font-bold mb-5 text-[#00345e] flex items-center gap-2">
                <i class="fa-solid fa-filter"></i>
                Filter Data
            </h3>

            <form action="<?= base_url('admin/peserta/absensi') ?>" method="get" class="flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Pilih Sesi</label>
                        <select name="sesi" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm font-medium focus:ring-[#00345e]">
                            <option value="">Semua Sesi</option>
                            <option value="1" <?= ($selectedSesi == '1') ? 'selected' : '' ?>>Sesi 1</option>
                            <option value="2" <?= ($selectedSesi == '2') ? 'selected' : '' ?>>Sesi 2</option>
                            <option value="3" <?= ($selectedSesi == '3') ? 'selected' : '' ?>>Sesi 3</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Pilih Tahun</label>
                        <select name="tahun" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm font-medium focus:ring-[#00345e]">
                            <option value="">Semua Tahun</option>
                            <?php 
                            $now = date('Y');
                            for($y = $now; $y >= 2024; $y--): ?>
                                <option value="<?= $y ?>" <?= ($selectedTahun == $y) ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-[#00345e] text-white py-3 rounded-xl font-bold hover:bg-blue-800 transition shadow-md">
                        Terapkan Filter
                    </button>
                    <?php if($selectedSesi || $selectedTahun): ?>
                        <a href="<?= base_url('admin/peserta/absensi') ?>" class="bg-gray-100 text-gray-600 px-4 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                            Reset
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLE ABSENSI -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-4">

        <table id="absensiTable" class="min-w-full text-sm text-gray-700">
            <thead class="bg-[#00345e] text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">NIM</th>
                    <th class="px-4 py-3 text-left">Sesi</th>
                    <th class="px-4 py-3 text-left">Foto Bukti</th>
                    <th class="px-4 py-3 text-left">Tanggal Absensi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                <?php $i = 1; foreach($absensi as $a): ?>
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3"><?= $i++ ?></td>
                    <td class="px-4 py-3 font-semibold"><?= esc($a['nama']) ?></td>
                    <td class="px-4 py-3"><?= esc($a['nim']) ?></td>

                    <!-- BADGE SESI -->
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            <?= $a['sesi'] == 1 
                                ? 'bg-purple-600 text-white' 
                                : ($a['sesi'] == 2 ? 'bg-blue-500 text-white' : 'bg-orange-500 text-white') ?>">
                            Sesi <?= esc($a['sesi']) ?>
                        </span>
                    </td>

                    <!-- FOTO -->
                    <td class="px-4 py-3">
                        <?php if($a['foto']): ?>
                            <a href="<?= base_url('uploads/'.$a['foto']) ?>"
                               target="_blank"
                               class="text-blue-600 hover:underline font-medium">
                                Lihat Foto
                            </a>
                        <?php else: ?>
                            <span class="text-gray-400 italic">Tidak ada</span>
                        <?php endif; ?>
                    </td>

                    <!-- TANGGAL -->
                    <td class="px-4 py-3 text-gray-500">
                        <?= date('d M Y H:i', strtotime($a['created_at'])) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<!-- FLOATING DOWNLOAD BUTTON -->
<button id="downloadExcel"
    class="fixed bottom-6 right-6 flex items-center gap-2 
           bg-green-600 hover:bg-green-700 
           text-white px-5 py-3 rounded-full shadow-xl 
           transition z-50">
    <i class="fa-solid fa-file-excel"></i> Download Excel
</button>

<!-- XLSX -->
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<script>
document.getElementById('downloadExcel').addEventListener('click', () => {

    const table = document.getElementById('absensiTable');
    const wb = XLSX.utils.table_to_book(table, { sheet: "Absensi" });
    const ws = wb.Sheets["Absensi"];

    const range = XLSX.utils.decode_range(ws['!ref']);

    // Styling Header
    for(let C = range.s.c; C <= range.e.c; ++C) {
        const cell_address = XLSX.utils.encode_cell({r:0, c:C});
        if(!ws[cell_address]) continue;

        ws[cell_address].s = {
            font: { bold: true, color: { rgb: "FFFFFFFF" } },
            fill: { fgColor: { rgb: "FF00345E" } },
            alignment: { horizontal: "center", vertical: "center" }
        };
    }

    // Auto Width
    const colWidths = [];
    for(let C = range.s.c; C <= range.e.c; ++C){
        let maxLength = 10;
        for(let R = range.s.r; R <= range.e.r; ++R){
            const cell = ws[XLSX.utils.encode_cell({r:R, c:C})];
            if(cell && cell.v){
                maxLength = Math.max(maxLength, cell.v.toString().length);
            }
        }
        colWidths.push({ wch: maxLength + 2 });
    }
    ws['!cols'] = colWidths;

    XLSX.writeFile(wb, 'absensi_seminar.xlsx', { bookType: 'xlsx', cellStyles:true });
});
</script>

<?= $this->endSection() ?>
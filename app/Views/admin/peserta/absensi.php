<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="p-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-[#00345e]">Daftar Absensi Seminar</h1>
        <p class="text-gray-500 text-sm">Kelola status sesi dan lihat data kehadiran peserta</p>
    </div>

    <!-- CARD PENGATURAN SESI -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6 max-w-xl">
        <h3 class="text-lg font-semibold mb-4 text-gray-700">
            Pengaturan Sesi Absensi
        </h3>

        <!-- Sesi 1 -->
        <div class="flex items-center justify-between mb-4">
            <span class="font-medium text-gray-600">Sesi 1</span>

            <a href="<?= base_url('admin/users/toggleSesi/1') ?>"
               class="px-5 py-2 rounded-full text-sm font-semibold text-white transition shadow
               <?= $sesi1Aktif 
                    ? 'bg-green-600 hover:bg-green-700' 
                    : 'bg-red-600 hover:bg-red-700' ?>">
                <?= $sesi1Aktif ? '🟢 Aktif' : '🔴 Nonaktif' ?>
            </a>
        </div>

        <!-- Sesi 2 -->
        <div class="flex items-center justify-between">
            <span class="font-medium text-gray-600">Sesi 2</span>

            <a href="<?= base_url('admin/users/toggleSesi/2') ?>"
               class="px-5 py-2 rounded-full text-sm font-semibold text-white transition shadow
               <?= $sesi2Aktif 
                    ? 'bg-green-600 hover:bg-green-700' 
                    : 'bg-red-600 hover:bg-red-700' ?>">
                <?= $sesi2Aktif ? '🟢 Aktif' : '🔴 Nonaktif' ?>
            </a>
        </div>
    </div>

    <!-- TABLE ABSENSI -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-md p-4">

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
                                : 'bg-blue-500 text-white' ?>">
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
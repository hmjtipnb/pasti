<?= $this->extend('admin/layout/main') ?>
<br>
<br>
<?= $this->section('content') ?>


<div class="overflow-x-auto bg-white rounded-2xl shadow-lg p-4">
    <table id="usersTable" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#00345e] text-white">
            <tr>
                <th class="px-6 py-3 text-left">No</th>
                <th class="px-6 py-3 text-left">Kode</th>
                <th class="px-6 py-3 text-left">Nama</th>
                <th class="px-6 py-3 text-left">NIM</th>
                <th class="px-6 py-3 text-left">Kelas</th>
                <th class="px-6 py-3 text-left">Prodi</th>
                <th class="px-6 py-3 text-left">Telp</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-left">Sesi</th>
                <th class="px-6 py-3 text-left">Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $i = 1; foreach($users as $user): ?>
            <tr class="hover:bg-gray-100 transition">
                <td class="px-6 py-3"><?= $i++ ?></td>
                <td class="px-6 py-3"><?= esc($user['kode_pendaftaran']) ?></td>
                <td class="px-6 py-3"><?= esc($user['nama']) ?></td>
                <td class="px-6 py-3"><?= esc($user['nim']) ?></td>
                <td class="px-6 py-3"><?= esc($user['kelas']) ?></td>
                <td class="px-6 py-3"><?= esc($user['prodi']) ?></td>
                <td class="px-6 py-3"><?= esc($user['telp']) ?></td>
                <td class="px-6 py-3"><?= esc($user['email']) ?></td>
              <td class="px-6 py-3">
    <span class="<?= $user['sesi'] === 'Offline' ? 'bg-purple-500 text-white px-2 py-1 rounded-full' : 'bg-blue-200 text-blue-800 px-2 py-1 rounded-full' ?>">
        <?= esc($user['sesi']) ?>
    </span>
</td>

                <td class="px-6 py-3"><?= esc($user['created_at']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Floating Download Button -->
<button id="downloadExcel"
        class="fixed bottom-6 right-6 flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-full shadow-lg transition z-50">
    <i class="fa-solid fa-file-excel"></i> Download Excel
</button>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script>
document.getElementById('downloadExcel').addEventListener('click', () => {
    // Ambil tabel HTML
    const table = document.getElementById('usersTable');
    
    // Convert ke workbook
    const wb = XLSX.utils.table_to_book(table, {sheet: "Peserta"});

    // Pilih sheet
    const ws = wb.Sheets["Peserta"];

    // Styling: header bold & background
    const range = XLSX.utils.decode_range(ws['!ref']);
    for(let C = range.s.c; C <= range.e.c; ++C) {
        const cell_address = XLSX.utils.encode_cell({r:0, c:C});
        if(!ws[cell_address]) continue;
        ws[cell_address].s = {
            font: { bold: true, color: { rgb: "FFFFFFFF" } },
            fill: { fgColor: { rgb: "FF1E40AF" } }, 
            alignment: { horizontal: "center", vertical: "center" }
        };
    }

    // Auto width kolom
    const colWidths = [];
    for(let C = range.s.c; C <= range.e.c; ++C){
        let maxLength = 10;
        for(let R = range.s.r; R <= range.e.r; ++R){
            const cell_address = XLSX.utils.encode_cell({r:R, c:C});
            const cell = ws[cell_address];
            if(cell && cell.v){
                maxLength = Math.max(maxLength, cell.v.toString().length);
            }
        }
        colWidths.push({ wch: maxLength + 2 });
    }
    ws['!cols'] = colWidths;

    // Simpan Excel
    XLSX.writeFile(wb, 'daftar_peserta.xlsx', { bookType: 'xlsx', cellStyles:true });
});
</script>


<?= $this->endSection() ?>

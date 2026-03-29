<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>

<div class="overflow-x-auto bg-white rounded-2xl shadow-lg p-4 mt-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#00345e] flex items-center gap-2">
            <i class="fa-solid fa-id-card"></i>
            Daftar Anggota PASTI
        </h1>

        <!-- SEARCH -->
        <div class="flex gap-3 items-center">
            <form action="<?= base_url('admin/anggota') ?>" method="get" class="flex gap-2">
                <div class="relative">
                    <input type="text" name="search" value="<?= esc($search) ?>" 
                           placeholder="Cari anggota..." 
                           class="pl-10 pr-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#00345e] outline-none w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <button type="submit" class="bg-[#00345e] text-white px-4 py-2 rounded-xl hover:bg-blue-800 transition shadow-md">
                    Cari
                </button>
                <?php if($search): ?>
                    <a href="<?= base_url('admin/anggota') ?>" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-xl hover:bg-gray-300 transition flex items-center">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <table id="anggotaTable" class="min-w-full divide-y divide-gray-200">
        <thead class="bg-[#00345e] text-white">
            <tr> 
                <th class="px-6 py-3 text-left rounded-tl-xl font-semibold">Kode</th>
                <th class="px-6 py-3 text-left font-semibold">Nama</th>
                <th class="px-6 py-3 text-left font-semibold">NIM</th>
                <th class="px-6 py-3 text-left font-semibold">Kelas</th>
                <th class="px-6 py-3 text-left font-semibold">Prodi</th>
                <th class="px-6 py-3 text-left font-semibold">Divisi</th> 
                <th class="px-6 py-3 text-left font-semibold">Email</th> 
                <th class="px-6 py-3 text-center rounded-tr-xl font-semibold text-white">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
            <?php if(empty($anggota)): ?>
                <tr>
                    <td colspan="8" class="px-6 py-10 text-center text-gray-500 italic">
                        Tidak ada data anggota ditemukan.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach($anggota as $item): ?>
                <tr class="hover:bg-blue-50/50 transition duration-200">
                    <td class="px-6 py-4 font-medium text-[#00345e]"><?= esc($item['kode_anggota']) ?></td>
                    <td class="px-6 py-4"><?= esc($item['nama']) ?></td>
                    <td class="px-6 py-4 text-gray-600 font-mono text-sm"><?= esc($item['nim']) ?></td>
                    <td class="px-6 py-4 text-gray-600"><?= esc($item['kelas']) ?></td>
                    <td class="px-6 py-4 text-gray-600"><?= esc($item['prodi']) ?></td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            <?= esc($item['divisi']) ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-sm"><?= esc($item['email']) ?></td>
                    <td class="px-6 py-4 flex justify-center gap-2">
                         <form action="<?= base_url('admin/anggota/delete/'.$item['id']) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2.5 rounded-xl transition shadow-sm hover:shadow-md">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Floating Download Button -->
<button id="downloadExcel"
        title="Download Excel"
        class="fixed bottom-6 right-6 flex items-center justify-center w-14 h-14 bg-green-600 hover:bg-green-700 text-white rounded-full shadow-2xl transition-all duration-300 hover:scale-110 z-50">
    <i class="fa-solid fa-file-excel text-2xl"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<script>
document.getElementById('downloadExcel').addEventListener('click', () => {
    const table = document.getElementById('anggotaTable');
    
    // Convert to workbook
    const wb = XLSX.utils.table_to_book(table, {sheet: "Anggota PASTI"});

    // Auto width columns
    const ws = wb.Sheets["Anggota PASTI"];
    const range = XLSX.utils.decode_range(ws['!ref']);
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

    // Save Excel
    XLSX.writeFile(wb, 'daftar_anggota_pasti.xlsx');
});
</script>

<?= $this->endSection() ?>

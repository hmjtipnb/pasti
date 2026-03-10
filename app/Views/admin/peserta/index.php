<?= $this->extend('admin/layout/main') ?>
<br>
<br>
<?= $this->section('content') ?>

<div class="overflow-x-auto bg-white rounded-2xl shadow-lg p-4">
<div class="flex gap-4">
    <!-- ONLINE -->
    <form action="<?= base_url('admin/sesi-setting/toggle/online') ?>" method="post">
        <?= csrf_field() ?>
        <button type="submit" class="px-4 py-2 rounded font-semibold
            <?= ($onlineAktif ?? 0) == 1 ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-400 text-gray-200' ?>">
            <?= ($onlineAktif ?? 0) == 1 ? 'Online Dibuka' : 'Online Ditutup' ?>
        </button>
    </form>

    <!-- OFFLINE -->
    <form action="<?= base_url('admin/sesi-setting/toggle/offline') ?>" method="post">
        <?= csrf_field() ?>
        <button type="submit" class="px-4 py-2 rounded font-semibold
            <?= ($offlineAktif ?? 0) == 1 ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-gray-400 text-gray-200' ?>">
            <?= ($offlineAktif ?? 0) == 1 ? 'Offline Dibuka' : 'Offline Ditutup' ?>
        </button>
    </form>

    <!-- FILTER -->
    <div class="ml-auto flex gap-2">
        <a href="<?= base_url('admin/users') ?>" class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300 font-semibold">Semua</a>
        <a href="<?= base_url('admin/users?filter=online') ?>" class="px-4 py-2 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 font-semibold">Online</a>
        <a href="<?= base_url('admin/users?filter=offline') ?>" class="px-4 py-2 rounded bg-orange-100 text-orange-700 hover:bg-orange-200 font-semibold">Offline</a>
    </div>
</div>
<br>
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
                <th class="px-6 py-3 text-left">Aksi</th>
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
    <span class="<?= $user['sesi'] === 'Offline' ? 'bg-[#f97316] text-white px-2 py-1 rounded-full' : 'bg-blue-200 text-blue-800 px-2 py-1 rounded-full' ?>">
        <?= esc($user['sesi']) ?>
    </span>
</td>

                <td class="px-6 py-3"><?= esc($user['created_at']) ?></td>
                <td class="px-6 py-3 flex gap-2">
                    <!-- Edit Button (Session Only) -->
                    <button onclick="editSesi('<?= $user['id'] ?>', '<?= $user['sesi'] ?>')" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded transition">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <!-- Delete Button -->
                    <a href="<?= base_url('admin/users/delete/'.$user['id']) ?>" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                       class="bg-red-600 hover:bg-red-700 text-white p-2 rounded transition">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit Sesi -->
<div id="editSesiModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[100]">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md shadow-2xl animate-fade-in-up">
        <h3 class="text-xl font-bold mb-4 text-[#00345e]">Edit Sesi Peserta</h3>
        <form action="<?= base_url('admin/users/updateSesi') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="editUserId">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Sesi</label>
                <select name="sesi" id="editSesiSelect" class="w-full border rounded-xl px-4 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="Online">Online</option>
                    <option value="Offline">Offline</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()" class="px-4 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition font-semibold">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-[#00345e] text-white hover:bg-blue-800 transition font-semibold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function editSesi(id, currentSesi) {
        document.getElementById('editUserId').value = id;
        document.getElementById('editSesiSelect').value = currentSesi;
        document.getElementById('editSesiModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editSesiModal').classList.add('hidden');
    }

    // Filter Logic in JS (Optional if server-side filtering is implemented)
    // Here we'll implement simple row hiding for instant filter
    const urlParams = new URLSearchParams(window.location.search);
    const filter = urlParams.get('filter');
    if (filter) {
        const rows = document.querySelectorAll('#usersTable tbody tr');
        rows.forEach(row => {
            const sesi = row.children[8].innerText.trim();
            if (filter === 'online' && sesi !== 'Online') row.style.display = 'none';
            if (filter === 'offline' && sesi !== 'Offline') row.style.display = 'none';
        });
    }
</script>

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

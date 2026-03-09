<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold mb-4">Data Review</h2>

    <table class="min-w-full border rounded-lg overflow-hidden">
        <thead class="bg-[#00345e] text-white">
            <tr>
                <th class="px-4 py-2 text-center">No</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Role</th>
                <th class="px-4 py-2">Review</th>
                <th class="px-4 py-2 text-center">IP</th>
                <th class="px-4 py-2 text-center">Tanggal</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach ($reviews as $r): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2 text-center"><?= $i++ ?></td>
                <td class="px-4 py-2"><?= esc($r['name']) ?></td>
                <td class="px-4 py-2"><?= esc($r['role']) ?></td>
                <td class="px-4 py-2"><?= esc($r['review']) ?></td>
                <td class="px-4 py-2 text-center"><?= esc($r['ip_address'] ?? '-') ?></td>
                <td class="px-4 py-2 text-center"><?= esc($r['created_at']) ?></td>
                <td class="px-4 py-2 text-center">
                    <form action="<?= base_url('admin/review/delete/' . $r['id']) ?>"
                          method="post"
                          class="delete-form inline">
                        <?= csrf_field() ?>
                        <button type="button"
                                class="btn-delete text-sm bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md"
                                data-action="<?= base_url('admin/review/delete/' . $r['id']) ?>">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
/* ===============================
   ALERT HAPUS (MINIMAL)
================================ */
document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function () {
        const form = this.closest('form');

        Swal.fire({
            title: 'Hapus review?',
            text: 'Data tidak bisa dikembalikan',
            icon: 'warning',
            width: 360,
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#9ca3af',
            customClass: {
                popup: 'rounded-xl text-sm'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});

/* ===============================
   ALERT SUKSES DARI SESSION
================================ */
<?php if (session()->getFlashdata('success')): ?>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '<?= session()->getFlashdata('success') ?>',
    timer: 2000,
    showConfirmButton: false,
    width: 360,
    customClass: {
        popup: 'rounded-xl text-sm'
    }
});
<?php endif; ?>
</script>

<?= $this->endSection() ?>

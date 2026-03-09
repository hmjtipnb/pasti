<?= $this->extend('admin/layout/main') ?>
<?= $this->section('content') ?>

<div class="bg-gray-100 flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-7xl bg-white border border-gray-200 rounded-xl p-8">

        <!-- Header -->
        <div class="flex items-center justify-center gap-3 mb-6">
            <i class="fa-solid fa-lock text-[#00345e] text-2xl"></i>
            <h2 class="text-2xl font-semibold text-[#00345e]">
                Ubah Password Admin
            </h2>
        </div>

        <!-- Flash Message -->
        <?php if(session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-700 border border-red-200 px-4 py-3 rounded-lg mb-4 text-sm">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-green-50 text-green-700 border border-green-200 px-4 py-3 rounded-lg mb-4 text-sm">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form id="passwordForm" action="<?= base_url('admin/password/update') ?>" method="POST" class="space-y-5">

            <!-- Password Lama -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                <div class="relative">
                    <input type="password" name="old_password" required
                        class="password-field w-full px-4 py-3 border border-gray-300 rounded-lg pr-12
                               focus:ring-2 focus:ring-[#00345e]/40 focus:border-[#00345e]">
                    <button type="button" class="toggle-password absolute right-3 top-3 text-gray-400">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>

            <!-- Password Baru -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <div class="relative">
                    <input type="password" id="new_password" name="new_password" required
                        class="password-field w-full px-4 py-3 border border-gray-300 rounded-lg pr-12
                               focus:ring-2 focus:ring-[#00345e]/40 focus:border-[#00345e]">
                    <button type="button" class="toggle-password absolute right-3 top-3 text-gray-400">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <!-- Strength Indicator -->
                <div class="mt-2">
                    <div class="h-2 rounded bg-gray-200 overflow-hidden">
                        <div id="strengthBar" class="h-full w-0 transition-all"></div>
                    </div>
                    <p id="strengthText" class="text-xs mt-1 text-gray-500"></p>
                </div>
            </div>

            <!-- Konfirmasi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <div class="relative">
                    <input type="password" id="confirm_password" name="confirm_password" required
                        class="password-field w-full px-4 py-3 border border-gray-300 rounded-lg pr-12
                               focus:ring-2 focus:ring-[#00345e]/40 focus:border-[#00345e]">
                    <button type="button" class="toggle-password absolute right-3 top-3 text-gray-400">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                <p id="matchText" class="text-xs mt-1"></p>
            </div>

            <!-- Submit -->
            <button id="submitBtn" type="submit"
                class="w-full bg-[#00345e] text-white py-3 rounded-lg font-semibold
                       hover:bg-[#002a4c] transition flex items-center justify-center gap-2">
                <span id="btnText">Simpan Perubahan</span>
                <i id="btnLoader" class="fa-solid fa-spinner fa-spin hidden"></i>
            </button>

        </form>
    </div>
</div>

<!-- JS -->
<script>
/* =========================
   Toggle Show / Hide
========================= */
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', () => {
        const input = btn.previousElementSibling;
        const icon = btn.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    });
});

/* =========================
   Password Strength
========================= */
const newPassword = document.getElementById('new_password');
const strengthBar = document.getElementById('strengthBar');
const strengthText = document.getElementById('strengthText');

newPassword.addEventListener('input', () => {
    const val = newPassword.value;
    let score = 0;

    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { text: '', color: '', width: '0%' },
        { text: 'Lemah', color: 'bg-red-500', width: '25%' },
        { text: 'Cukup', color: 'bg-yellow-500', width: '50%' },
        { text: 'Kuat', color: 'bg-blue-500', width: '75%' },
        { text: 'Sangat Kuat', color: 'bg-green-500', width: '100%' }
    ];

    const level = levels[score];
    strengthBar.className = `h-full transition-all ${level.color}`;
    strengthBar.style.width = level.width;
    strengthText.textContent = level.text;
});

/* =========================
   Password Match
========================= */
const confirmPassword = document.getElementById('confirm_password');
const matchText = document.getElementById('matchText');

confirmPassword.addEventListener('input', () => {
    if (confirmPassword.value === newPassword.value) {
        matchText.textContent = 'Password cocok';
        matchText.className = 'text-xs mt-1 text-green-600';
    } else {
        matchText.textContent = 'Password tidak cocok';
        matchText.className = 'text-xs mt-1 text-red-600';
    }
});

/* =========================
   Submit Animation
========================= */
const form = document.getElementById('passwordForm');
const btnText = document.getElementById('btnText');
const btnLoader = document.getElementById('btnLoader');

form.addEventListener('submit', () => {
    btnText.textContent = 'Menyimpan...';
    btnLoader.classList.remove('hidden');
});
</script>

<?= $this->endSection() ?>

<?php
$adminName  = session()->get('admin_name');
$adminEmail = session()->get('admin_email');
$initial    = strtoupper(substr($adminName, 0, 1));
?>

<header
    id="header"
    class="fixed top-0 left-0 w-full h-16 bg-white border-b border-gray-200
           z-40 flex items-center justify-between pl-72 pr-6">

    <!-- LEFT -->
    <div class="flex items-center gap-4">
        <button id="toggleSidebar"
                class="text-gray-600 hover:text-gray-900 transition">
            <i id="toggleIcon" class="fa-solid fa-bars text-xl"></i>
        </button>
    </div>

    <!-- RIGHT -->
    <div class="relative">
        <!-- TRIGGER -->
        <button id="profileButton"
                class="flex items-center gap-3 focus:outline-none">

            <div class="text-right leading-tight hidden sm:block">
                <p class="text-sm font-semibold text-gray-800">
                    <?= esc($adminName) ?>
                </p>
                <p class="text-xs text-gray-500">
                    <?= esc($adminEmail) ?>
                </p>
            </div>

            <div
                class="w-10 h-10 rounded-full bg-gray-300
                       flex items-center justify-center
                       font-semibold text-gray-700">
                <?= $initial ?>
            </div>
        </button>

        <!-- DROPDOWN -->
        <div id="profileDropdown"
             class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl
                    shadow-lg border border-gray-100 overflow-hidden">

            <!-- Ubah Password -->
            <a href="<?= base_url('admin/password') ?>"
               class="flex items-center gap-3 px-4 py-3
                      text-sm text-gray-700 hover:bg-gray-100 transition">
                <i class="fa-solid fa-key text-gray-500"></i>
                Ubah Password
            </a>

            <div class="border-t border-gray-100"></div>

            <!-- Logout -->
            <form id="logoutForm"
                  action="<?= base_url('admin/logout') ?>"
                  method="post">
                <?= csrf_field() ?>
                <button type="button" id="logoutButton"
                        class="w-full flex items-center gap-3 px-4 py-3
                               text-sm text-red-600 hover:bg-red-50 transition">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<!-- LOGOUT MODAL -->
<div id="logoutModal"
     class="fixed inset-0 z-50 hidden items-center justify-center">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    <!-- Modal Box -->
    <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 animate-scaleIn">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-800">
                Konfirmasi Logout
            </h3>
        </div>

        <p class="text-sm text-gray-600 mb-6">
            Apakah Anda yakin ingin keluar dari akun admin?
        </p>

        <div class="flex justify-end gap-3">
            <button id="cancelLogout"
                    class="px-4 py-2 rounded-xl text-gray-600
                           hover:bg-gray-100 transition">
                Batal
            </button>

            <button id="confirmLogout"
                    class="px-4 py-2 rounded-xl text-white
                           bg-red-600 hover:bg-red-700 transition">
                Logout
            </button>
        </div>
    </div>
</div>



<script>
    const profileBtn = document.getElementById('profileButton');
    const dropdown = document.getElementById('profileDropdown');

    const logoutBtn = document.getElementById('logoutButton');
    const logoutModal = document.getElementById('logoutModal');
    const cancelLogout = document.getElementById('cancelLogout');
    const confirmLogout = document.getElementById('confirmLogout');

    // Toggle dropdown profil
    profileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', () => {
        dropdown.classList.add('hidden');
    });

    // Tampilkan modal logout
    logoutBtn.addEventListener('click', () => {
        dropdown.classList.add('hidden');
        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');
    });

    // Batal logout
    cancelLogout.addEventListener('click', () => {
        logoutModal.classList.add('hidden');
        logoutModal.classList.remove('flex');
    });

    // Konfirmasi logout
    confirmLogout.addEventListener('click', () => {
        document.getElementById('logoutForm').submit();
    });
</script>

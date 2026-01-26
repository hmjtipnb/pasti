<aside id="sidebar"
       class="fixed top-0 left-0 z-50 w-64 h-screen
              bg-[#00345e] text-gray-200 flex flex-col transition-transform duration-300">

    <!-- LOGO -->
    <div class="flex items-center gap-2 px-6 py-5 border-b border-white/10">
    <img 
        src="<?= base_url('assets/icon/icon_pasti.svg') ?>" 
        alt="Logo PASTI"
        class="w-24 object-contain"
    >
    <p class="text-gray-200">Panel</p>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-3 py-4 space-y-1 text-sm">

        <!-- Dashboard -->
        <a href="<?= base_url('admin/dashboard') ?>"
           class="flex items-center gap-4 px-4 py-3 rounded-xl font-medium transition
           <?= (isset($activeMenu) && $activeMenu === 'dashboard') ? 'bg-white text-[#00345e] shadow-inner' : 'text-gray-200 hover:bg-white/10' ?>">
            <i class="fa-solid fa-house w-5 text-center"></i>
            <span>Dashboard</span>
        </a>

        <!-- Daftar Peserta -->
        <a href="<?= base_url('admin/peserta') ?>"
           class="flex items-center justify-between gap-4 px-4 py-3 rounded-xl font-medium transition
           <?= (isset($activeMenu) && $activeMenu === 'peserta') ? 'bg-white text-[#00345e] shadow-inner' : 'text-gray-200 hover:bg-white/10' ?>">
            <div class="flex items-center gap-4">
                <i class="fa-solid fa-users w-5 text-center"></i>
                <span>Daftar Peserta</span>
            </div>
            <span class="text-[10px] bg-orange-500 text-white px-2 py-0.5 rounded-full">
                NEW
            </span>
        </a>


    </nav>
</aside>

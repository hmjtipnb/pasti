<header class="bg-gradient-to-r from-[#0D87B0] to-[#0D588F] font-sans">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

<!-- Logo -->
<div class="flex items-center gap-3 text-white">
    <img 
        src="<?= base_url('assets/icon/icon_pasti.svg') ?>" 
        alt="Logo PASTI"
        class="h-24 w-24 object-contain"
    >
</div>


            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="#" class="bg-[#f97316] text-white px-5 py-1.5 rounded-full text-sm font-medium">
                    Home
                </a>
                <a href="#" class="text-white text-sm hover:text-rose-300">About</a>
                <a href="#" class="text-white text-sm hover:text-rose-300">Program</a>
                <a href="#" class="text-white text-sm hover:text-rose-300">Update</a>
                <a href="#" class="text-white text-sm hover:text-rose-300">Contact</a>
            </nav>

            <!-- Desktop Auth -->
            <div class="hidden md:flex items-center gap-3">
                <a href="/login"
                   class="border border-white text-white px-5 py-1.5 rounded-full text-sm hover:bg-white hover:text-indigo-900 transition">
                    Login
                </a>
                <a href="/register"
                   class="border border-white text-white px-5 py-1.5 rounded-full text-sm hover:bg-white hover:text-indigo-900 transition">
                    Register
                </a>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <button id="menuBtn" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <nav class="flex flex-col gap-3 mt-4">
                <a href="#" class="bg-rose-500 text-white px-4 py-2 rounded-full text-sm">
                    Home
                </a>
                <a href="#" class="text-white text-sm px-4 py-2 hover:text-rose-300">About</a>
                <a href="#" class="text-white text-sm px-4 py-2 hover:text-rose-300">Program</a>
                <a href="#" class="text-white text-sm px-4 py-2 hover:text-rose-300">Update</a>
                <a href="#" class="text-white text-sm px-4 py-2 hover:text-rose-300">Contact</a>

            
            </nav>
        </div>
    </div>
</header>

<!-- Toggle Script -->
<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
</script>

<!-- HEADER -->
<header id="mainHeader"
    class="sticky top-0 z-50 bg-gradient-to-r from-[#0D87B0] to-[#0D588F] 
           font-sans transition-all duration-300">

    <div class="max-w-7xl mx-auto px-6">
        <div id="navInner"
            class="flex items-center justify-between h-20 transition-all duration-300">

<!-- LOGO -->
<div class="flex items-center">
<img 
    src="<?= base_url('assets/icon/icon_pasti.svg') ?>" 
    alt="Logo PASTI"
    class="logo h-16 w-auto object-contain transition-all duration-300"
>
</div>


            <!-- DESKTOP NAV -->
            <div class="hidden md:flex items-center justify-between w-full">

                <!-- MENU -->
                <nav class="flex items-center gap-8 text-sm text-white mx-auto">

                    <!-- DIVISI -->
                    <div class="relative group">
                        <button class="flex items-center gap-1 hover:text-white/80 transition">
                            Divisi Pasti
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-rose-500 font-semibold animate-pulse">
                                NEW
                            </span>
                        </button>

                        <div class="absolute left-0 mt-3 w-56 bg-white text-gray-700 rounded-xl shadow-lg
                                    opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                    transition-all duration-200">

                            <a href="/divisi/web" class="block px-4 py-2 hover:bg-gray-100">
                                Divisi WEB Programming
                            </a>

                            <a href="/divisi/visual" class="block px-4 py-2 hover:bg-gray-100">
                                Divisi Visual
                            </a>

                            <a href="/divisi/kti" class="block px-4 py-2 hover:bg-gray-100 rounded-b-xl">
                                Divisi Karya Tulis Ilmiah
                            </a>
                        </div>
                    </div>

                    <!-- CONTACT -->
                    <div class="relative group">
                        <button class="flex items-center gap-1 hover:text-white/80 transition">
                            Contact Person
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-rose-500 font-semibold animate-pulse">
                                NEW
                            </span>
                        </button>

                        <div class="absolute left-0 mt-3 w-56 bg-white text-gray-700 rounded-xl shadow-lg
                                    opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                    transition-all duration-200">

                            <a href="#" class="block px-4 py-2 hover:bg-gray-100">
                                Gus Eka (+62 2288282)
                            </a>

                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 rounded-b-xl">
                                Rima (+62 8882828)
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- CTA -->
                <div class="flex items-center gap-3">
                    <a href="/pendaftaran"
                        class="px-5 py-2 rounded-full text-sm border border-white text-white
                               hover:bg-white hover:text-[#0D588F] transition">
                        Daftar Seminar
                    </a>

                    <a href="/pendaftaran/anggota"
                        class="px-5 py-2 rounded-full text-sm bg-white text-[#0D588F]
                               font-semibold shadow hover:bg-opacity-90 transition">
                        Daftar Anggota
                    </a>
                </div>
            </div>

            <!-- MOBILE BUTTON -->
            <button id="menuBtn"
                class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <nav class="flex flex-col gap-3 mt-4 text-sm text-white">

                <hr class="border-white/30 my-2">

                <a href="/pendaftaran"
                    class="bg-white text-[#0D588F] px-4 py-2 rounded-full text-center font-semibold">
                    Daftar Seminar
                </a>

                <a href="/pendaftaran/anggota"
                    class="border border-white px-4 py-2 rounded-full text-center">
                    Daftar Anggota
                </a>
            </nav>
        </div>
    </div>
</header>
<script>
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');
const header = document.getElementById('mainHeader');
const navInner = document.getElementById('navInner');
const logo = document.querySelector('.logo');

menuBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
    menuBtn.innerHTML = mobileMenu.classList.contains('hidden')
        ? '<i class="fa-solid fa-bars"></i>'
        : '<i class="fa-solid fa-xmark"></i>';
});

window.addEventListener('scroll', () => {
    if (window.scrollY > 60) {
        navInner.classList.remove('h-20');
        navInner.classList.add('h-16');

        logo.classList.remove('h-16');
        logo.classList.add('h-10');

        header.classList.add('shadow-xl');
    } else {
        navInner.classList.remove('h-16');
        navInner.classList.add('h-20');

        logo.classList.remove('h-10');
        logo.classList.add('h-16');

        header.classList.remove('shadow-xl');
    }
});
</script>

<footer class="mt-auto border-t border-gray-200 bg-white/70 backdrop-blur
               px-6 py-4 flex items-center justify-between text-sm text-gray-500">

    <span>
        © <?= date('Y') ?>
        <span class="font-semibold text-gray-700">Admin Panel</span>
        — CI4 Native
    </span>

    <span class="text-xs">
        Built with ❤️ by <span class="font-medium text-gray-700">hmjti</span>
    </span>
</footer>
<script>
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const header  = document.getElementById('header');
    const toggleBtn  = document.getElementById('toggleSidebar');
    const toggleIcon = document.getElementById('toggleIcon');

    let isOpen = true;

    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        if (!isOpen) {
            // CLOSE
            sidebar.classList.add('-translate-x-full');
            content.classList.remove('ml-64');
            content.classList.add('ml-0');

            header.classList.remove('pl-72');
            header.classList.add('pl-6');

            toggleIcon.classList.replace('fa-bars', 'fa-xmark');
        } else {
            // OPEN
            sidebar.classList.remove('-translate-x-full');
            content.classList.add('ml-64');
            content.classList.remove('ml-0');

            header.classList.add('pl-72');
            header.classList.remove('pl-6');

            toggleIcon.classList.replace('fa-xmark', 'fa-bars');
        }
    });
</script>

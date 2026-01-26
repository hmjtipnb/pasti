<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Admin Panel' ?></title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Optional: custom style -->
    <!-- <link rel="stylesheet" href="<?= base_url('css/admin.css') ?>"> -->
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <?= $this->include('admin/layout/sidebar') ?>

    <!-- MAIN CONTENT -->
    <div id="content" class="flex-1 ml-64 flex flex-col pt-16">

        <!-- HEADER -->
        <?= $this->include('admin/layout/header') ?>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-6">
            <?= $this->renderSection('content') ?>
        </main>

        <!-- FOOTER -->
        <?= $this->include('admin/layout/footer') ?>

    </div>
</div>


<script>
    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    const header = document.getElementById('header');
    const toggleBtn = document.getElementById('toggleSidebar');
    const toggleIcon = document.getElementById('toggleIcon');
    const content = document.querySelector('main');

    let isOpen = true;

    toggleBtn.addEventListener('click', () => {
        isOpen = !isOpen;

        if (!isOpen) {
            sidebar.classList.add('-translate-x-full');
            content.classList.remove('ml-64');
            header.classList.remove('pl-72');
            header.classList.add('pl-6');
            toggleIcon.classList.replace('fa-bars', 'fa-xmark');
        } else {
            sidebar.classList.remove('-translate-x-full');
            content.classList.add('ml-64');
            header.classList.add('pl-72');
            header.classList.remove('pl-6');
            toggleIcon.classList.replace('fa-xmark', 'fa-bars');
        }
    });

    // Profile dropdown
    const profileBtn = document.getElementById('profileButton');
    const dropdown = document.getElementById('profileDropdown');
    const logoutBtn = document.getElementById('logoutButton');

    profileBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', () => {
        dropdown.classList.add('hidden');
    });

    // Logout confirm
    logoutBtn.addEventListener('click', () => {
        if (confirm('Yakin ingin logout?')) {
            document.getElementById('logoutForm').submit();
        }
    });
</script>

</body>
</html>

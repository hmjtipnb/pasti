<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">

<!-- BACKGROUND GRID -->
<div class="absolute inset-0 opacity-[0.04]
            bg-[linear-gradient(to_right,#fff_1px,transparent_1px),
                linear-gradient(to_bottom,#fff_1px,transparent_1px)]
            bg-[size:40px_40px]"></div>

<div class="relative w-full max-w-md p-8 rounded-2xl
            bg-white/5 backdrop-blur-xl
            border border-white/10
            shadow-xl animate-fadeIn">

    <!-- HEADER -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-semibold text-white tracking-wide">
            Admin Login
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Secure Administration Panel
        </p>
    </div>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="bg-red-500/15 text-red-300 px-4 py-2 rounded-lg
                    mb-4 text-sm border border-red-500/30">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/authenticate') ?>" method="post" class="space-y-4">
        <?= csrf_field() ?>

        <!-- EMAIL -->
        <div>
            <label class="text-xs text-gray-400 uppercase tracking-wide">
                Email
            </label>
            <input type="email" name="email" required
                class="mt-1 w-full px-4 py-3 rounded-xl
                       bg-black/30 text-white
                       border border-white/10
                       placeholder-gray-500
                       focus:ring-2 focus:ring-blue-500
                       focus:border-transparent outline-none transition"
                placeholder="admin@email.com">
        </div>

        <!-- PASSWORD -->
        <div>
            <label class="text-xs text-gray-400 uppercase tracking-wide">
                Password
            </label>
            <div class="relative mt-1">
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 pr-11 rounded-xl
                           bg-black/30 text-white
                           border border-white/10
                           placeholder-gray-500
                           focus:ring-2 focus:ring-blue-500
                           focus:border-transparent outline-none transition"
                    placeholder="••••••••">

                <button type="button" onclick="togglePassword()"
                    class="absolute inset-y-0 right-3 flex items-center
                           text-gray-400 hover:text-blue-400 transition">
                    <svg id="eyeOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-width="2"
                              d="M2.458 12C3.732 7.943 7.523 5 12 5
                                 c4.478 0 8.268 2.943 9.542 7
                                 -1.274 4.057-5.064 7-9.542 7
                                 -4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>

                    <svg id="eyeClosed" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" d="M3 3l18 18"/>
                        <path stroke-width="2"
                              d="M10.584 10.587a2 2 0 002.828 2.83"/>
                        <path stroke-width="2"
                              d="M9.878 5.878A9.95 9.95 0 0112 5
                                 c4.478 0 8.268 2.943 9.543 7
                                 a9.97 9.97 0 01-4.132 5.411"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- BUTTON -->
        <button type="submit"
            class="w-full mt-2 py-3 rounded-xl
                   bg-blue-600 hover:bg-blue-700
                   text-white font-medium
                   shadow-lg shadow-blue-600/20
                   transition-all">
            Sign In
        </button>
    </form>

    <p class="mt-6 text-center text-xs text-gray-500">
        © <?= date('Y') ?> Pasti • Admin System
    </p>
</div>

<script>
function togglePassword() {
    const pwd = document.getElementById('password');
    document.getElementById('eyeOpen').classList.toggle('hidden');
    document.getElementById('eyeClosed').classList.toggle('hidden');
    pwd.type = pwd.type === 'password' ? 'text' : 'password';
}
</script>

<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
    animation: fadeIn .4s ease-out;
}
</style>

</body>
</html>

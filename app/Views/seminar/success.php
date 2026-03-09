<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Berhasil</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4C1qD2C2z8x8Z5xX3Kp7k0dKg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="min-h-screen flex items-center justify-center bg-slate-50 px-6">

    <div class="bg-white max-w-md w-full rounded-3xl p-10 shadow-xl text-center">

        <!-- Success Icon -->
        <div class="w-20 h-20 mx-auto mb-4 flex items-center justify-center
                    rounded-full bg-green-100 text-green-600 text-4xl">
             🎉
        </div>

        <h1 class="text-2xl font-bold text-[#0D588F] mb-3">
            Pendaftaran Berhasil
        </h1>

        <p class="text-slate-600 mb-6">
            Terima kasih sudah mendaftar program <strong>PASTI</strong>.
            Informasi selanjutnya akan dibagikan melalui grup WhatsApp.
        </p>

        <!-- WhatsApp Button -->
        <a href="https://chat.whatsapp.com/ISI_LINK_GRUP"
           target="_blank"
           class="flex items-center justify-center gap-2 w-full py-3
                  rounded-full text-white font-bold
                  bg-green-500 hover:bg-green-600 transition">
            <i class="fa-brands fa-whatsapp text-xl"></i>
            Gabung Grup WhatsApp
        </a>

        <!-- Back Home -->
        <a href="/"
           class="inline-flex items-center gap-2 mt-5
                  text-sm text-slate-500 hover:text-[#0D588F] transition">
            <i class="fa-solid fa-house"></i>
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>

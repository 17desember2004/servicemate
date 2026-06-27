<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard — ServiceMate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">⚙️ ServiceMate Admin</h1>
        <div class="flex gap-4 items-center">
            <span>Halo, {{ auth()->user()->name }}</span>
            <form action="/logout" method="POST">
                @csrf
                <button class="bg-red-500 px-3 py-1 rounded text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto mt-10 px-4">
        <h2 class="text-2xl font-bold mb-6">Dashboard Admin</h2>

        <!-- Menu Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="/admin/landing" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <div class="text-4xl mb-3">🖊️</div>
                <h3 class="text-lg font-bold">Edit Landing Page</h3>
                <p class="text-gray-500 text-sm mt-1">Ubah teks hero, subtitle, dan badge landing page</p>
            </a>

            <a href="/dashboard" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">
                <div class="text-4xl mb-3">📊</div>
                <h3 class="text-lg font-bold">Lihat Aplikasi</h3>
                <p class="text-gray-500 text-sm mt-1">Buka dashboard utama ServiceMate</p>
            </a>
        </div>

        @if(session('success'))
            <div class="mt-6 bg-green-100 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif
    </div>

</body>
</html>


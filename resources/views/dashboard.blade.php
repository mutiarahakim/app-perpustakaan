<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Aplikasi Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Perpustakaan Digital Kampus</h1>
            <div class="flex items-center space-x-4">
                <span>Halo, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 text-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-700">Dashboard Utama</h2>
        <p class="text-gray-600 mb-6">Selamat datang di Sistem Informasi Perpustakaan. Silakan pilih menu di bawah ini:</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('categories.index') }}" class="p-4 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition">
                    <h3 class="font-bold text-blue-700">Kelola Kategori</h3>
                    <p class="text-sm text-gray-500">Tambah, edit, dan hapus kategori buku (Khusus Admin)</p>
                </a>
            @endif

            <a href="{{ route('books.index') }}" class="p-4 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 transition">
                <h3 class="font-bold text-green-700">Kelola Buku</h3>
                <p class="text-sm text-gray-500">Daftar dan manajemen data buku perpustakaan</p>
            </a>

            <a href="{{ route('members.index') }}" class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg hover:bg-yellow-100 transition">
                <h3 class="font-bold text-yellow-700">Kelola Anggota</h3>
                <p class="text-sm text-gray-500">Manajemen data anggota perpustakaan</p>
            </a>
        </div>
    </div>
</body>
</html>
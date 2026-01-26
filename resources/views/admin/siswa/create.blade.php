<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-blue-600 px-6 py-4 flex justify-between items-center text-white">
    <h1 class="text-lg font-semibold">Tambah Siswa</h1>

    <a href="{{ route('admin.dashboard') }}"
       class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded text-sm">
        Kembali
    </a>
</nav>

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow min-h-screen">
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                Menu Utama
            </a>

            <a href="{{ route('admin.siswa.create') }}"
               class="block px-4 py-2 rounded bg-blue-100 text-blue-700 font-medium">
                Tambah Siswa
            </a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6">
        <div class="max-w-lg bg-white rounded shadow p-6">

            <h2 class="text-lg font-semibold mb-4">Form Tambah Siswa</h2>

            <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" name="nama"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium">NIS</label>
                    <input type="text" name="nis"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Kelas</label>
                    <input type="text" name="kelas"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </form>

        </div>
    </main>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Aspirasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Aspirasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
<div class="bg-white w-full max-w-5xl rounded-lg shadow p-6">

    <h1 class="text-2xl font-bold text-center mb-6">
        Form Aspirasi Siswa
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- KOLOM KIRI : FORM ASPIRASI -->
        <div>
            @if(session('success'))
                <div class="mb-4 p-3 rounded bg-green-100 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('aspirasi.store') }}" method="POST" class="space-y-4">
                @csrf

                <input name="nis" class="w-full border p-2 rounded" placeholder="NIS" required>

                <input name="nama" class="w-full border p-2 rounded" placeholder="Nama" required>

                <input name="kelas" class="w-full border p-2 rounded" placeholder="Kelas" required>

                <input name="lokasi" class="w-full border p-2 rounded" placeholder="Lokasi (contoh: Ruang 7)" required>

                <select name="kategori_id" class="w-full border p-2 rounded" required>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">
                            {{ $kategori->ket_kategori }}
                        </option>
                    @endforeach
                </select>

                <textarea name="feedback" class="w-full border p-2 rounded" placeholder="Isi aspirasi" required></textarea>

                <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Kirim Aspirasi
                </button>
            </form>
        </div>

        <!-- KOLOM KANAN : SEARCH STATUS -->
        <div class="border rounded-lg p-4 bg-gray-50">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">
                Cek Status Aspirasi
            </h2>

            @include('aspirasi.search')
        </div>

    </div>
</div>

</body>
</html>

</body>
</html>

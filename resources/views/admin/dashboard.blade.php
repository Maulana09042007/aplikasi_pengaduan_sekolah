<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Saran Sekolah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<nav class="bg-blue-600 px-6 py-4 flex justify-between items-center text-white">
    <h1 class="text-lg font-semibold">Dashboard Admin</h1>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded text-sm">Logout</button>
    </form>
</nav>

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow min-h-screen">
        <div class="p-6 border-b">
            <h2 class="text-lg font-bold text-gray-700">Menu</h2>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded bg-blue-100 text-blue-700 font-medium">Menu Utama</a>
            <a href="{{ route('admin.siswa.create') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Tambah Siswa</a>
            <a href="{{ route('admin.status.index') }}" class="block px-4 py-2 rounded hover:bg-gray-100 text-gray-700">Status</a>
        </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-6">

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-5">
                <p class="text-sm text-gray-500">Total Aspirasi</p>
                <h2 class="text-3xl font-bold text-gray-800">{{ $total }}</h2>
            </div>
            <div class="bg-yellow-100 rounded-lg shadow p-5">
                <p class="text-sm text-yellow-700">Menunggu</p>
                <h2 class="text-3xl font-bold text-yellow-800">{{ $menunggu }}</h2>
            </div>
            <div class="bg-blue-100 rounded-lg shadow p-5">
                <p class="text-sm text-blue-700">Diproses</p>
                <h2 class="text-3xl font-bold text-blue-800">{{ $diproses }}</h2>
            </div>
            <div class="bg-green-100 rounded-lg shadow p-5">
                <p class="text-sm text-green-700">Selesai</p>
                <h2 class="text-3xl font-bold text-green-800">{{ $selesai }}</h2>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-4 flex flex-wrap gap-2 items-end">
            <input type="date" id="filter-date" class="border rounded p-2" placeholder="Tanggal">
            <input type="text" id="filter-nis" class="border rounded p-2" placeholder="NIS">
            <input type="text" id="filter-nama" class="border rounded p-2" placeholder="Nama Siswa">
            <input type="text" id="filter-kategori" class="border rounded p-2" placeholder="Kategori">
            <button onclick="applyFilter()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
            <button onclick="resetFilter()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Reset</button>
        </div>

        <!-- Tabel Aspirasi Terbaru -->
        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table id="aspirasi-table" class="min-w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">NIS</th>
                        <th class="px-4 py-3 text-left">Nama Siswa</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Lokasi</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($aspirasiTerbaru as $row)
                    <tr>
                        <td class="px-4 py-3">{{ $row->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-3">{{ $row->siswa->nis ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row->siswa->nama ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row->kategori->ket_kategori ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $row->lokasi }}</td>
                        <td class="px-4 py-3 capitalize">{{ $row->status }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('admin.siswa.update', $row->id) }}" class="p-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600" title="Ubah">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                                </svg>
                            </a>
                            <button onclick="openCard({{ $row->id }})" class="p-2 rounded bg-gray-100 hover:bg-gray-200 text-gray-600" title="Detail">Detail</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
</div>

<!-- Include Detail Card -->
@foreach ($aspirasiTerbaru as $row)
    @include('admin.siswa.detail-aspirasi', ['aspirasi' => $row])
@endforeach

<script >function openCard(id) {
    const card = document.getElementById('detail-' + id);
    if(!card) return;
    card.classList.remove('hidden');
    const content = card.querySelector('.card-content');
    if(content) content.classList.remove('opacity-0','scale-95');
}

function closeCard() {
    document.querySelectorAll('.detail-card').forEach(card => {
        const content = card.querySelector('.card-content');
        if(content){
            content.classList.add('opacity-0','scale-95');
            setTimeout(() => card.classList.add('hidden'), 200);
        } else {
            card.classList.add('hidden');
        }
    });
}

function sendFeedback(event, id) {
    event.preventDefault();
    const feedback = document.getElementById('feedback-' + id).value;
    fetch('/admin/aspirasi/' + id + '/feedback', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ feedback })
    }).then(() => {
        alert('Feedback berhasil dikirim!');
        location.reload();
    }).catch(() => alert('Gagal mengirim feedback.'));
}

function applyFilter() {
    const date = document.getElementById('filter-date').value.toLowerCase();
    const nis = document.getElementById('filter-nis').value.toLowerCase();
    const nama = document.getElementById('filter-nama').value.toLowerCase();
    const kategori = document.getElementById('filter-kategori').value.toLowerCase();

    document.querySelectorAll('#aspirasi-table tbody tr').forEach(row => {
        const tglText = row.cells[0].textContent.toLowerCase();
        const nisText = row.cells[1].textContent.toLowerCase();
        const namaText = row.cells[2].textContent.toLowerCase();
        const katText = row.cells[3].textContent.toLowerCase();

        if(
            (!date || tglText.includes(date)) &&
            (!nis || nisText.includes(nis)) &&
            (!nama || namaText.includes(nama)) &&
            (!kategori || katText.includes(kategori))
        ) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function resetFilter() {
    document.getElementById('filter-date').value = '';
    document.getElementById('filter-nis').value = '';
    document.getElementById('filter-nama').value = '';
    document.getElementById('filter-kategori').value = '';
    applyFilter();
}
</script>

</body>
</html>

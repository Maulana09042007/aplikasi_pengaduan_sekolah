<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Saran Sekolah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom animations for modal and general */
        .card-content {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .opacity-0 {
            opacity: 0;
        }
        .scale-95 {
            transform: scale(0.95);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }
        @keyframes slideInLeft {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        /* Animated background gradient */
        body {
            background: linear-gradient(-45deg, #f9fafb, #f3f4f6, #e5e7eb, #d1d5db);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        /* Responsive adjustments for background */
        @media (max-width: 768px) {
            body {
                background-size: 200% 200%;
                animation-duration: 10s;
            }
        }
        @media (max-width: 480px) {
            body {
                background-size: 150% 150%;
                animation-duration: 8s;
            }
        }
    </style>
</head>
<body class="min-h-screen font-sans">

    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-4 flex justify-between items-center text-white shadow-lg sticky top-0 z-50">
        <div class="flex items-center">
            <button id="sidebar-toggle" class="md:hidden mr-4 p-2 rounded-lg hover:bg-blue-500 transition duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h1 class="text-xl font-bold tracking-wide">Dashboard Admin</h1>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
            @csrf
            <button class="bg-blue-500 hover:bg-blue-400 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 shadow-md transform hover:scale-105">Logout</button>
        </form>
    </nav>

    <div class="flex relative">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-xl min-h-screen border-r border-gray-200 fixed md:relative md:translate-x-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-40 md:z-auto">
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Menu Navigasi</h2>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition duration-200 shadow-sm transform hover:scale-105">🏠 Menu Utama</a>
                <!-- <a href="{{ route('admin.siswa.create') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-gray-900 transition duration-200 transform hover:translate-x-1">📜 Riwayat</a> -->
                <!-- <a href="{{ route('admin.status.index') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-gray-900 transition duration-200 transform hover:translate-x-1">📊 Status</a> -->
            </nav>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden" onclick="closeSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 space-y-6 fade-in">

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 border-l-4 border-gray-400 hover:shadow-xl transition duration-300 transform hover:scale-105 fade-in">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Total Aspirasi</p>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-1">{{ $total }}</h2>
                        </div>
                        <div class="text-gray-400 text-3xl md:text-4xl">📋</div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl shadow-lg p-4 md:p-6 border-l-4 border-yellow-400 hover:shadow-xl transition duration-300 transform hover:scale-105 fade-in" style="animation-delay: 0.1s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-yellow-700 font-medium">Menunggu</p>
                            <h2 class="text-2xl md:text-3xl font-bold text-yellow-800 mt-1">{{ $menunggu }}</h2>
                        </div>
                        <div class="text-yellow-500 text-3xl md:text-4xl">⏳</div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-lg p-4 md:p-6 border-l-4 border-blue-400 hover:shadow-xl transition duration-300 transform hover:scale-105 fade-in" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-700 font-medium">Diproses</p>
                            <h2 class="text-2xl md:text-3xl font-bold text-blue-800 mt-1">{{ $diproses }}</h2>
                        </div>
                        <div class="text-blue-500 text-3xl md:text-4xl">🔄</div>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-lg p-4 md:p-6 border-l-4 border-green-400 hover:shadow-xl transition duration-300 transform hover:scale-105 fade-in" style="animation-delay: 0.3s;">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-700 font-medium">Selesai</p>
                            <h2 class="text-2xl md:text-3xl font-bold text-green-800 mt-1">{{ $selesai }}</h2>
                        </div>
                        <div class="text-green-500 text-3xl md:text-4xl">✅</div>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 fade-in" style="animation-delay: 0.4s;">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Aspirasi</h3>
                <div class="grid grid-cols-5 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" id="filter-date" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 transform focus:scale-105">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                        <input type="text" id="filter-nis" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 transform focus:scale-105" placeholder="Masukkan NIS">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Siswa</label>
                        <input type="text" id="filter-nama" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 transform focus:scale-105" placeholder="Masukkan Nama">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <input type="text" id="filter-kategori" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 transform focus:scale-105" placeholder="Masukkan Kategori">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <input type="text" id="filter-status" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 transform focus:scale-105" placeholder="Masukkan Kategori">
                    </div>
                    <div class="flex gap-2 flex-col sm:flex-row">
                        <button onclick="applyFilter()" class="px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 shadow-md font-medium transform hover:scale-105">Filter</button>
                        <button onclick="resetFilter()" class="px-4 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200 shadow-md font-medium transform hover:scale-105">Reset</button>
                    </div>
                </div>
            </div>

            <!-- Aspirasi Table -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden fade-in" style="animation-delay: 0.5s;">
                <div class="px-4 md:px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Aspirasi Terbaru</h3>
                </div>
                <div class="overflow-x-auto">
                    <table id="aspirasi-table" class="min-w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">NIS</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Siswa</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Lokasi</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-4 md:px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($aspirasiTerbaru as $row)
                            <tr class="hover:bg-gray-50 transition duration-200 transform hover:scale-[1.01]">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-gray-900">{{ $row->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-gray-900">{{ $row->siswa->nis ?? '-' }}</td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-gray-900">{{ $row->siswa->nama ?? '-' }}</td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-gray-900">{{ $row->kategori->ket_kategori ?? '-' }}</td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-gray-900">{{ $row->lokasi }}</td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap capitalize">
                                    <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                                        @if($row->status == 'menunggu') bg-yellow-100 text-yellow-800
                                        @elseif($row->status == 'proses' || $row->status == 'diproses') bg-blue-100 text-blue-800
                                        @elseif($row->status == 'selesai') bg-green-100 text-green-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ $row->status }}
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <button onclick="openCard({{ $row->id }})" class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 transition duration-200 shadow-sm transform hover:scale-105" title="Detail">
                                        👁️ Detail
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- Detail Cards -->
    @foreach ($aspirasiTerbaru as $row)
        @include('admin.siswa.detail-aspirasi', ['aspirasi' => $row])
    @endforeach

    <script>
        // Sidebar toggle functions
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }

        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar.classList.contains('-translate-x-full')) {
                openSidebar();
            } else {
                closeSidebar();
            }
        });

        // Modal functions
        function openCard(id) {
            const card = document.getElementById('detail-' + id);
            if (!card) return;
            card.classList.remove('hidden');
            const content = card.querySelector('.card-content');
            if (content) {
                content.classList.remove('opacity-0', 'scale-95');
            }
        }

        function closeCard() {
            document.querySelectorAll('.detail-card').forEach(card => {
                const content = card.querySelector('.card-content');
                if (content) {
                    content.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => card.classList.add('hidden'), 300);
                } else {
                    card.classList.add('hidden');
                }
            });
        }

        // Feedback function
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

        // Filter functions
        function applyFilter() {
            const date = document.getElementById('filter-date').value.toLowerCase();
            const nis = document.getElementById('filter-nis').value.toLowerCase();
            const nama = document.getElementById('filter-nama').value.toLowerCase();
            const kategori = document.getElementById('filter-kategori').value.toLowerCase();
            const status = document.getElementById('filter-status').value.toLowerCase();

            document.querySelectorAll('#aspirasi-table tbody tr').forEach(row => {
                const tglText = row.cells[0].textContent.toLowerCase();
                const nisText = row.cells[1].textContent.toLowerCase();
                const namaText = row.cells[2].textContent.toLowerCase();
                const katText = row.cells[3].textContent.toLowerCase();
                const staText = row.cells[5].textContent.toLowerCase();

                if (
                    (!date || tglText.includes(date)) &&
                    (!nis || nisText.includes(nis)) &&
                    (!nama || namaText.includes(nama)) &&
                    (!kategori || katText.includes(kategori))&&
                    (!status || staText.includes(status))
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
            document.getElementById('filter-status').value = '';
            applyFilter();
        }
    </script>

</body>
</html>

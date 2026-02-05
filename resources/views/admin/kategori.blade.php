<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori | Tambah Kategori</title>
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
   @include('admin.components.navbar')

    <div class="flex relative">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-xl min-h-screen border-r border-gray-200 fixed md:relative md:translate-x-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-40 md:z-auto">
            <div class="p-6 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-800">Menu Navigasi</h2>
            </div>
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition duration-200 shadow-sm transform hover:scale-105">🏠 Menu Utama</a>
                <a href="{{ route('admin.kategori') }}" class="block px-4 py-3 rounded-lg bg-blue-100 text-blue-700 font-medium hover:bg-blue-200 transition duration-200 shadow-sm transform hover:scale-105">➕ Tambah Kategori</a>
                <!-- <a href="{{ route('admin.siswa.create') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-gray-900 transition duration-200 transform hover:translate-x-1">📜 Riwayat</a> -->
                <!-- <a href="{{ route('admin.status.index') }}" class="block px-4 py-3 rounded-lg hover:bg-gray-100 text-gray-700 hover:text-gray-900 transition duration-200 transform hover:translate-x-1">📊 Status</a> -->
            </nav>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden" onclick="closeSidebar()"></div>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6 space-y-6 fade-in">

        </main>
    </div>

  
</body>
</html>

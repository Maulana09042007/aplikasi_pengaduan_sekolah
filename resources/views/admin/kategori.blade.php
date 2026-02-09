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
    @include('admin.components.sidebar')

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden" onclick="closeSidebar()"></div>

        <!-- Main Content -->
           <div class="max-w-lg bg-white rounded shadow p-6">

            <h2 class="text-lg font-semibold mb-4">Form Tambah Siswa</h2>

            <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Nama Kategori</label>
                    <input type="text" name="kategori"
                           class="w-full border rounded px-3 py-2"
                           required>
                </div>

              
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                    Simpan
                </button>
            </form>

        </div>
    </div>

  
</body>
</html>

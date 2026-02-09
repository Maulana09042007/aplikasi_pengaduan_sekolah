<aside id="sidebar"
    class="w-64 bg-white shadow-xl min-h-screen border-r border-gray-200 fixed md:relative md:translate-x-0 transform -translate-x-full transition-transform duration-300 ease-in-out z-40 md:z-auto">

    <div class="p-6 border-b border-gray-200 bg-gray-50">
        <h2 class="text-lg font-semibold text-gray-800">Menu Navigasi</h2>
    </div>

    <nav class="p-4 space-y-2">

        <!-- Menu Utama -->
        <a href="{{ route('admin.dashboard') }}"
           class="block px-4 py-3 rounded-lg font-medium transition duration-200 shadow-sm
           {{ request()->routeIs('admin.dashboard')
                ? 'bg-blue-100 text-blue-700'
                : 'bg-white text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            🏠 Menu Utama
        </a>

        <!-- Tambah Kategori -->
        <a href="{{ route('admin.kategori') }}"
           class="block px-4 py-3 rounded-lg font-medium transition duration-200 shadow-sm
           {{ request()->routeIs('admin.kategori*')
                ? 'bg-blue-100 text-blue-700'
                : 'bg-white text-gray-700 hover:bg-gray-100 hover:text-gray-900' }}">
            ➕ Tambah Kategori
        </a>

    </nav>
</aside>

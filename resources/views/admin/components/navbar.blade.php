 <nav class="bg-gradient-to-r from-blue-600 to-blue-700 px-4 py-4 flex justify-between items-center text-white shadow-lg sticky top-0 z-50">
        <div class="flex items-center">
            <button id="sidebar-toggle" class="md:hidden mr-4 p-2 rounded-lg hover:bg-blue-500 transition duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h1 class="text-xl font-bold tracking-wide">{{Auth::user()->username}}</h1>
        </div>
        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
            @csrf
            <button class="bg-blue-500 hover:bg-blue-400 px-4 py-2 rounded-lg text-sm font-medium transition duration-200 shadow-md transform hover:scale-105">Logout</button>
        </form>
    </nav>
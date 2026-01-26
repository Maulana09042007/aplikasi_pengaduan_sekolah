<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

<div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-center">Admin Login</h2>

    @if ($errors->any())
        <div class="mt-4 bg-red-100 text-red-700 text-sm p-3 rounded-lg">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login') }}" class="mt-6 space-y-4">
        @csrf

        <div>
            <label class="block text-sm mb-1">Username</label>
            <input type="text" name="username"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div>
            <label class="block text-sm mb-1">Password</label>
            <input type="password" name="password"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
            Login
        </button>
    </form>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/login.css'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="{{ asset('image/web_icon.png') }}" type="image/png">
</head>
<body class="text-white">
    <main class="flex items-center justify-center">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full  max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            
            @if ($errors->any())
                <div class="bg-red-600 text-white p-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-600 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif


            <form action="/login" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium mb-2">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full p-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-primary transition-colors">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium mb-2">Password:</label>
                        <input type="password" id="password" name="password" required class="w-full p-2 bg-gray-700 border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-primary transition-colors">
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-semibold py-2 px-4 rounded transition-colors duration-300">Login</button>
                    
                    <div class="mt-4 text-center">
                        <p class="text-gray-400">Belum punya akun? 
                            <a href="/register" class="text-primary hover:text-secondary font-medium">Daftar di sini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
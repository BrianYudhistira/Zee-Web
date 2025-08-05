<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ZeeScraper Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css"/>
</head>
<body class="bg-gray-100 text-gray-900">
    @include('partials.sidebar')
    <main class="ml-64 min-h-screen overflow-y-auto">
        <div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                <p class="text-gray-600 mt-2">@yield('page-description', 'Welcome to ZeeScraper Dashboard')</p>
            </div>
            
            <!-- Content -->
            @yield('content')
        </div>
    </main>
</body>
</html>
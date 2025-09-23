<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ZeeScraper Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css"/>
    <link rel="icon" href="{{ asset('image/web_icon.png') }}" type="image/png">
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Mobile menu overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>
    
    @include('partials.sidebar')
    
    <main class="lg:ml-64 min-h-screen overflow-y-auto">
        <!-- Mobile header dengan hamburger menu -->
        <div class="lg:hidden bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
            <div class="flex items-center justify-between p-4">
                <h1 class="text-lg font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                <button 
                    id="mobile-menu-btn" 
                    class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    aria-label="Toggle menu"
                >
                    <i class="ri-menu-line text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="p-4 lg:p-6">
            <!-- Page Header - Hidden on mobile (sudah ada di mobile header) -->
            <div class="mb-6 hidden lg:block">
                <h1 class="text-3xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                <p class="text-gray-600 mt-2">@yield('page-description', 'Welcome to ZeeScraper Dashboard')</p>
            </div>
            
            <!-- Page Description - Tetap tampil di mobile -->
            <div class="mb-6 lg:hidden">
                <p class="text-gray-600 text-sm">@yield('page-description', 'Welcome to ZeeScraper Dashboard')</p>
            </div>
            
            <!-- Content -->
            @yield('content')
        </div>
    </main>

    <!-- JavaScript untuk toggle mobile menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobile-overlay');
            
            if (mobileMenuBtn && sidebar && overlay) {
                // Toggle mobile menu
                mobileMenuBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                });
                
                // Close menu when clicking overlay
                overlay.addEventListener('click', function() {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
                
                // Close menu when clicking sidebar links (optional)
                const sidebarLinks = sidebar.querySelectorAll('a');
                sidebarLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth < 1024) { // Only on mobile
                            sidebar.classList.add('-translate-x-full');
                            overlay.classList.add('hidden');
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zee Scraper</title>
    
    <!-- Heroicons for icons -->
    <script src="https://unpkg.com/heroicons@2.0.18/24/outline/index.js" type="module"></script>

    @vite(['resources/css/zeescraper.css'])
    
</head>
<body>
    <div class="min-h-screen bg-gradient-to-br from-gray-900 to-gray-700 flex justify-center items-center">
        <div class="text-center p-8 max-w-md mx-auto">
            <!-- Icon -->
            <div class="mb-6">
                <svg class="w-16 h-16 mx-auto text-red-500 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            
            <!-- Main Title -->
            <h1 class="text-4xl md:text-5xl font-bold text-red-500 mb-4 drop-shadow-lg">Coming Soon!</h1>
            
            <!-- Subtitle -->
            <h2 class="text-xl md:text-2xl font-semibold text-white mb-2">Zee Scraper</h2>
            <p class="text-gray-300 mb-6 text-sm md:text-base">Game Information Scraper - Dapatkan build gbame terbaru</p>
            
            <!-- Progress Bar -->
            <div class="w-full bg-gray-600 rounded-full h-2 mb-4">
                <div class="bg-red-500 h-2 rounded-full animate-pulse" style="width: 5%"></div>
            </div>
            <p class="text-gray-400 text-sm mb-6">Progress: 5%</p>
            
            <!-- Back to Portfolio -->
            <a href="{{ url('/menu') }}" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Menu
            </a>
        </div>
    </div>
    
</body>
</html>
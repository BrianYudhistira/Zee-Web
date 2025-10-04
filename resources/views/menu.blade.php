<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/menu.css'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zee-Hub</title>
    <link rel="icon" href="{{ asset('image/web_icon.png') }}" type="image/png">
</head>
<body class="text-white min-h-screen overflow-x-hidden">
    <!-- Animated Stars Background -->
    <div class="stars">
        <!-- Small stars -->
        <div class="star small" style="top: 20%; left: 10%;"></div>
        <div class="star small" style="top: 15%; left: 80%;"></div>
        <div class="star small" style="top: 35%; left: 25%;"></div>
        <div class="star small" style="top: 45%; left: 70%;"></div>
        <div class="star small" style="top: 60%; left: 15%;"></div>
        <div class="star small" style="top: 75%; left: 80%;"></div>
        <div class="star small" style="top: 85%; left: 45%;"></div>
        <div class="star small" style="top: 25%; left: 60%;"></div>
        
        <!-- Medium stars -->
        <div class="star medium" style="top: 30%; left: 85%;"></div>
        <div class="star medium" style="top: 50%; left: 5%;"></div>
        <div class="star medium" style="top: 70%; left: 30%;"></div>
        <div class="star medium" style="top: 10%; left: 50%;"></div>
        <div class="star medium" style="top: 80%; left: 75%;"></div>
        
        <!-- Large stars -->
        <div class="star large" style="top: 40%; left: 90%;"></div>
        <div class="star large" style="top: 65%; left: 10%;"></div>
        <div class="star large" style="top: 20%; left: 35%;"></div>
        
        <!-- Shooting stars -->
        <div class="shooting-star" style="top: 20%; left: -100px; width: 100px; animation-delay: 2s;"></div>
        <div class="shooting-star" style="top: 60%; left: -100px; width: 80px; animation-delay: 8s;"></div>
    </div>

    <main class="min-h-screen bg-gradient-to-br from-gray-900 via-indigo-900 to-black flex items-center justify-center relative py-4 md:py-8 px-4 overflow-hidden">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div id="success-notification" class="notification fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                {{ session('success') }}
                <button onclick="closeNotification('success-notification')" class="ml-3 text-white hover:text-gray-200 font-bold">&times;</button>
            </div>
        @endif
        
        @if (session('error'))
            <div id="error-notification" class="notification fixed top-4 right-4 bg-red-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                {{ session('error') }}
                <button onclick="closeNotification('error-notification')" class="ml-3 text-white hover:text-gray-200 font-bold">&times;</button>
            </div>
        @endif

        <!-- Floating particles effect -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-blue-400 rounded-full opacity-30 animate-ping"></div>
            <div class="absolute top-3/4 right-1/4 w-1 h-1 bg-purple-400 rounded-full opacity-40 animate-pulse"></div>
            <div class="absolute top-1/2 left-1/3 w-1 h-1 bg-white rounded-full opacity-50 animate-bounce"></div>
        </div>

        <div class="max-w-2xl w-full px-4 text-center relative z-10">
            <!-- Logo Section -->
            <div class="mb-8 md:mb-12">
                <!-- Large Logo with Effects -->
                <div class="relative group mb-4 md:mb-6">
                    <!-- Optimized Glow effects -->
                    <div class="logo-glow absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-full blur-3xl scale-150 group-hover:scale-175 transition-all duration-1000"></div>
                    <div class="logo-glow absolute inset-0 bg-gradient-to-r from-cyan-400/10 to-blue-500/10 rounded-full blur-2xl scale-125 group-hover:scale-150 transition-all duration-700"></div>
                    
                    <!-- Logo container -->
                    <div class="relative inline-flex items-center justify-center w-32 h-32 sm:w-40 sm:h-40 md:w-44 md:h-44 lg:w-48 lg:h-48 bg-gradient-to-br from-gray-800/50 to-gray-900/70 backdrop-blur-sm rounded-full shadow-2xl transform group-hover:scale-105 transition-all duration-500 border border-white/5">
                        <!-- Inner rings -->
                        <div class="absolute inset-3 sm:inset-4 rounded-full border border-blue-400/20 animate-pulse"></div>
                        <div class="absolute inset-5 sm:inset-6 md:inset-7 lg:inset-8 rounded-full border border-purple-400/15 animate-pulse" style="animation-delay: 1s;"></div>
                        
                        <!-- Main logo -->
                        <img src="{{ asset('image/web_icon.png') }}" alt="Zee-Hub Logo" class="relative h-20 w-20 sm:h-24 sm:w-24 md:h-28 md:w-28 lg:h-32 lg:w-32 object-contain filter drop-shadow-2xl transform group-hover:scale-110 transition-transform duration-300" loading="lazy">
                        
                        <!-- Simplified orbiting elements -->
                        <div class="absolute inset-0 animate-spin" style="animation-duration: 20s;">
                            <div class="absolute top-2 left-1/2 w-2 h-2 bg-blue-400 rounded-full opacity-60"></div>
                            <div class="absolute bottom-2 left-1/2 w-1 h-1 bg-purple-400 rounded-full opacity-50"></div>
                        </div>
                        <div class="absolute inset-0 animate-spin" style="animation-duration: 15s; animation-direction: reverse;">
                            <div class="absolute top-1/2 right-2 w-1 h-1 bg-cyan-400 rounded-full opacity-70"></div>
                            <div class="absolute top-1/2 left-2 w-1 h-1 bg-white rounded-full opacity-60"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Title and subtitle -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-3 sm:mb-4 md:mb-6 text-white bg-gradient-to-r from-blue-400 via-purple-400 to-cyan-400 bg-clip-text text-transparent drop-shadow-lg">Zee-Hub</h1>
                <p class="text-gray-300 text-base sm:text-lg md:text-xl mb-4 sm:mb-6 md:mb-8">Your Gateway to Digital Excellence</p>
                <div class="w-20 sm:w-24 md:w-28 lg:w-32 h-1 bg-gradient-to-r from-blue-500 via-purple-500 to-cyan-500 rounded-full mx-auto shadow-lg"></div>
            </div>
            
            <!-- Buttons Section -->
            <div class="flex flex-col space-y-4 sm:space-y-6 md:space-y-8 max-w-lg mx-auto">
                <!-- Portfolio Button -->
                <a href="/portfolio" class="btn-interactive group relative overflow-hidden bg-gradient-to-r from-indigo-700/80 via-indigo-800/90 to-blue-900/80 hover:from-indigo-600/90 hover:via-indigo-700/90 hover:to-blue-800/90 text-white font-semibold py-4 sm:py-5 md:py-6 px-6 sm:px-8 md:px-10 rounded-3xl transition-all duration-300 text-center shadow-2xl hover:shadow-indigo-500/30 transform hover:-translate-y-2 hover:scale-105 backdrop-blur-sm border border-indigo-400/30">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-400/20 to-blue-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative flex items-center justify-center space-x-3 md:space-x-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 transition-transform group-hover:scale-125 group-hover:rotate-12" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-base sm:text-lg md:text-xl font-medium">Portfolio</span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform group-hover:translate-x-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>
                
                <!-- ZeeScraper Button -->
                <a href="/zenless" class="btn-interactive group relative overflow-hidden bg-gradient-to-r from-purple-800/80 via-purple-900/90 to-indigo-900/80 hover:from-purple-700/90 hover:via-purple-800/90 hover:to-indigo-800/90 text-white font-semibold py-4 sm:py-5 md:py-6 px-6 sm:px-8 md:px-10 rounded-3xl transition-all duration-300 text-center shadow-2xl hover:shadow-purple-500/30 transform hover:-translate-y-2 hover:scale-105 backdrop-blur-sm border border-purple-400/30">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-400/20 to-indigo-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative flex items-center justify-center space-x-3 md:space-x-4">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 transition-transform group-hover:scale-125 group-hover:rotate-12" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-base sm:text-lg md:text-xl font-medium">ZeeScraper</span>
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform group-hover:translate-x-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </a>

                @auth->role
                    <!-- Dashboard Button (Only when logged in) -->
                    <a href="/dashboard/profile/index" class="btn-interactive group relative overflow-hidden bg-gradient-to-r from-emerald-700/80 via-emerald-800/90 to-green-900/80 hover:from-emerald-600/90 hover:via-emerald-700/90 hover:to-green-800/90 text-white font-semibold py-4 sm:py-5 md:py-6 px-6 sm:px-8 md:px-10 rounded-3xl transition-all duration-300 text-center shadow-2xl hover:shadow-emerald-500/30 transform hover:-translate-y-2 hover:scale-105 backdrop-blur-sm border border-emerald-400/30">
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-400/20 to-green-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative flex items-center justify-center space-x-3 md:space-x-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 transition-transform group-hover:scale-125 group-hover:rotate-12" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            </svg>
                            <span class="text-base sm:text-lg md:text-xl font-medium">Dashboard</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform group-hover:translate-x-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </a>
                @endauth

                @guest
                    <!-- Login Button (Only when not logged in) -->
                    <a href="/login" class="btn-interactive group relative overflow-hidden bg-gradient-to-r from-cyan-700/80 via-cyan-800/90 to-blue-900/80 hover:from-cyan-600/90 hover:via-cyan-700/90 hover:to-blue-800/90 text-white font-semibold py-4 sm:py-5 md:py-6 px-6 sm:px-8 md:px-10 rounded-3xl transition-all duration-300 text-center shadow-2xl hover:shadow-cyan-500/30 transform hover:-translate-y-2 hover:scale-105 backdrop-blur-sm border border-cyan-400/30">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/20 to-blue-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative flex items-center justify-center space-x-3 md:space-x-4">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 transition-transform group-hover:scale-125 group-hover:rotate-12" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-base sm:text-lg md:text-xl font-medium">Login</span>
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform group-hover:translate-x-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </a>
                @else
                    <!-- Logout Button (Only when logged in) -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="btn-interactive group relative overflow-hidden bg-gradient-to-r from-red-700/80 via-red-800/90 to-pink-900/80 hover:from-red-600/90 hover:via-red-700/90 hover:to-pink-800/90 text-white font-semibold py-4 sm:py-5 md:py-6 px-6 sm:px-8 md:px-10 rounded-3xl transition-all duration-300 text-center shadow-2xl hover:shadow-red-500/30 transform hover:-translate-y-2 hover:scale-105 backdrop-blur-sm border border-red-400/30 w-full">
                            <div class="absolute inset-0 bg-gradient-to-r from-red-400/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="relative flex items-center justify-center space-x-3 md:space-x-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7 transition-transform group-hover:scale-125 group-hover:rotate-12" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-base sm:text-lg md:text-xl font-medium">Logout</span>
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6 transition-transform group-hover:translate-x-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </form>
                @endguest
            </div>
            
            <!-- Footer Text -->
            <div class="text-center mt-8 sm:mt-8 md:mt-10">
                <p class="text-gray-400 text-sm sm:text-base md:text-lg opacity-80">Navigate through the stars to your destination</p>
            </div>
        </div>

    </main>

    <script>
        // Auto-hide notifications after 10 seconds
        function autoHideNotifications() {
            const notifications = document.querySelectorAll('.notification');
            
            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.classList.add('fade-out');
                    
                    // Remove element after fade animation completes
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 500); // Wait for fade-out transition to complete
                }, 10000); // 10 seconds
            });
        }

        // Manual close notification function
        function closeNotification(notificationId) {
            const notification = document.getElementById(notificationId);
            if (notification) {
                notification.classList.add('fade-out');
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 500);
            }
        }

        // Initialize auto-hide when page loads
        document.addEventListener('DOMContentLoaded', function() {
            autoHideNotifications();
        });
    </script>
</body>
</html>
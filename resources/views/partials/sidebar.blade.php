<aside id="sidebar" class="fixed left-0 top-0 w-64 bg-gray-900 text-white h-screen shadow-xl overflow-y-auto z-10">
    <!-- Logo/Brand -->
    <div class="p-6 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">Z</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">ZeeScraper</h2>
                <p class="text-xs text-gray-400">Data Scraping Tool</p>
            </div>
        </div>
    </div>
    
    <!-- User Info -->
    <div class="p-4 border-b border-gray-700">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gray-700 rounded-full flex items-center justify-center">
                <span class="text-white font-medium">
                    {{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'G' }}
                </span>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-white">
                    {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                </p>
                <p class="text-xs text-gray-400">
                    {{ Auth::check() ? Auth::user()->email : 'Not logged in' }}
                </p>
            </div>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="mt-6 px-4 space-y-2">
        <a href="/profile" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 group {{ request()->is('profile') ? 'bg-blue-600 text-white' : '' }}">
            <i class="ri-user-line"></i>
            <span class="font-medium">Profile</span>
        </a>

        <a href="/manage" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 group {{ request()->is('manage') ? 'bg-blue-600 text-white' : '' }}">
            <i class="ri-user-settings-line"></i>
            <span class="font-medium">Manage User</span>
        </a>

        <a href="/data_scraper" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 group {{ request()->is('data_scraper') ? 'bg-blue-600 text-white' : '' }}">
            <i class="ri-database-2-line"></i>
            <span class="font-medium">Database Scraper</span>
        </a>
        
        <a href="/settings" class="flex items-center space-x-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200 group {{ request()->is('settings') ? 'bg-blue-600 text-white' : '' }}">
            <i class="ri-settings-3-line"></i>
            <span class="font-medium">Settings</span>
        </a>
    </nav>
    
    <!-- Bottom Section -->
    @if(Auth::check() == true)
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700 bg-gray-900">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200 group">
                <i class="ri-logout-box-line"></i>
                <span class="font-medium">Logout</span>
            </button>
        </form>
    </div>
    @else
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700 bg-gray-900">
        <a href="/login" class="w-full flex items-center space-x-3 px-4 py-3 text-gray-300 hover:text-white hover:bg-blue-600 rounded-lg transition-all duration-200 group">
            <i class="ri-login-box-line"></i>
            <span class="font-medium">Login</span>
        </a>
    </div>
    @endif
</aside>

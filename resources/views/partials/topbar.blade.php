<aside id="topbar" class= "w-full z-50 fixed top-0">
    <nav class=" bg-gray-900 z-50 border-b-2 border-red-500 text-white">
        <div class="container mx-auto flex justify-between items-center px-3 md:px-6 py-2 md:py-3">
            <div class="flex flex-shrink-0 items-center space-x-3">
                <a href="/menu">
                    <img src="{{ asset('image/web_icon.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                </a>
                <h1 class="text-lg md:text-xl font-bold text-red-500">Zee-Hub</h1>
            </div>
            <ul class="hidden md:flex space-x-6">
                <li><a href="{{ route('zzzScraper') }}" class="hover:text-red-500 transition-colors duration-300">ZZZScraper</a></li>
                <li><a href="#" class="hover:text-red-500 transition-colors duration-300">Movie</a></li>
            </ul>
            <button
              class="flex items-center md:hidden w-8 h-8 justify-center text-white hover:text-primary transition-colors duration-300"
              id="mobile-menu-btn"
            >
              <i class="ri-menu-line text-xl"></i>
            </button>
        </div>
    </nav>
    <ul class="hidden md:hidden bg-gray-900 bg-opacity-95 text-white px-6 py-3" id="mobile-menu">
        <li><a href="#" id="scraper-link" class="block hover:text-red-500 transition-colors duration-300">ZZZScraper</a></li>
        <li><a href="#" id="scraper-link" class="block hover:text-red-500 transition-colors duration-300">Movie</a></li>
    </ul>
</aside>

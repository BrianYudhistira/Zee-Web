@extends('layouts.appscraper')
@section('title', 'ZZZ Characters - Collection')
@push('styles')
    @vite('resources/css/zzzscraper.css')
@endpush

@section('content')    
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen overflow-y-auto relative text-white">
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-red-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto p-6 ">
            <h1 class="text-4xl md:text-5xl font-bold text-white text-left mb-2">Zenless Zone Zero</h1>
            <p class="text-lg md:text-xl text-gray-300 text-left mb-6">Database
                <span class="text-red-500 font-semibold">Zenless Zone Zero</span>
                Characters Collection & Builds
            </p>

            <div class="flex flex-col md:flex-row gap-4 mb-6">
                <div class="search-container flex-1">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Search characters..."
                            class="search-input w-full px-4 py-3 pl-12 rounded-2xl bg-gray-800 border border-red-500/50 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent shadow-lg transition-all duration-300"
                            oninput="searchCharacters()"
                        >
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="flex justify-center md:justify-end mb-4">
                    <div class="flex bg-gray-800 rounded-2xl p-1 shadow-lg border border-red-500/40">
                        <button class="filter-btn group flex-1 bg-transparent hover:bg-red-500 text-white px-4 py-3 rounded-xl transition-all duration-300" onclick="FilterByElement('all')" data-element="all">
                            <span class="text-xs font-semibold">ALL</span>
                        </button>
                        <button class="filter-btn group flex-1 bg-transparent hover:bg-red-500 text-white px-3 py-3 rounded-xl transition-all duration-300" onclick="FilterByElement('Physical')" data-element="Physical">
                            <img src="{{ asset('image/zzz_logo/Pysical.png') }}" alt="Physical" class="w-6 h-6 opacity-70 group-hover:opacity-100 mx-auto">
                        </button>
                        <button class="filter-btn group flex-1 bg-transparent hover:bg-red-500 text-white px-3 py-3 rounded-xl transition-all duration-300" onclick="FilterByElement('Electric')" data-element="Electric">
                            <img src="{{ asset('image/zzz_logo/Electric.png') }}" alt="Electric" class="w-6 h-6 opacity-70 group-hover:opacity-100 mx-auto">
                        </button>
                        <button class="filter-btn group flex-1 bg-transparent hover:bg-red-500 text-white px-3 py-3 rounded-xl transition-all duration-300" onclick="FilterByElement('Fire')" data-element="Fire">
                            <img src="{{ asset('image/zzz_logo/Fire.png') }}" alt="Fire" class="w-6 h-6 opacity-70 group-hover:opacity-100 mx-auto">
                        </button>
                        <button class="filter-btn group flex-1 bg-transparent hover:bg-red-500 text-white px-3 py-3 rounded-xl transition-all duration-300" onclick="FilterByElement('Ice')" data-element="Ice">
                            <img src="{{ asset('image/zzz_logo/Ice.png') }}" alt="Ice" class="w-6 h-6 opacity-70 group-hover:opacity-100 mx-auto">
                        </button>
                        <button class="filter-btn group flex-1 bg-transparent hover:bg-red-500 text-white px-3 py-3 rounded-xl transition-all duration-300" onclick="FilterByElement('Ether')" data-element="Ether">
                            <img src="{{ asset('image/zzz_logo/Ether.png') }}" alt="Ether" class="w-6 h-6 opacity-70 group-hover:opacity-100 mx-auto">
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @if($zzzChar)
                    @foreach($zzzChar as $char)
                        <a href="{{ route('zzz.character.detail', $char->id) }}" class="character-card bg-gray-800 border border-red-500/30 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 overflow-hidden block group" data-element="{{ $char->element }}">
                            <div class="relative">
                                <img src="{{ $char->image }}" alt="{{ $char->name }}" class="w-full h-64 object-cover" style="object-position: center 30%;" loading="lazy">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <div class="flex flex-row justify-between items-center absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                                    <div class="flex-1 pr-3">
                                        <h3 class="text-white font-semibold text-sm md:text-lg leading-tight">{{ $char->name }}</h3>
                                        <p class="text-gray-300 text-xs md:text-sm capitalize">{{ $char->element ?? 'Unknown' }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <img src="{{ $char->element_picture }}" alt="{{ $char->element }}" class="w-6 h-6 object-contain">
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-400 text-lg">No characters found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <script>
        function FilterByElement(element) {
            const cards = document.querySelectorAll('.character-card');
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(btn => {
                if (btn.dataset.element === element) {
                    btn.classList.add('bg-red-500/50', 'shadow-md', 'scale-105');
                    btn.classList.remove('bg-transparent');
                } else {
                    btn.classList.remove('bg-red-500/50', 'shadow-md', 'scale-105');
                    btn.classList.add('bg-transparent');
                }
            });
        
            cards.forEach(card => {
                card.style.animation = 'none'; // reset animasi dulu
                card.offsetHeight;
                if (element === 'all' || card.dataset.element === element) {
                    card.style.animation = 'fadeIn 0.3s ease-in-out';
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
            
            // Update URL parameter for bookmarking
            const url = new URL(window.location);
            if (element === 'all') {
                url.searchParams.delete('filter');
            } else {
                url.searchParams.set('filter', element);
            }
            window.history.replaceState({}, '', url);
        }
        
        // Search function
        function searchCharacters() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.character-card');
            
            cards.forEach(card => {
                const characterName = card.querySelector('h3').textContent.toLowerCase();
                const characterElement = card.querySelector('p').textContent.toLowerCase();
                
                if (characterName.includes(searchTerm) || characterElement.includes(searchTerm)) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }
        
        // Initialize filter on page load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const filterParam = urlParams.get('filter') || 'all';
            FilterByElement(filterParam);
        });
    </script>
@endsection
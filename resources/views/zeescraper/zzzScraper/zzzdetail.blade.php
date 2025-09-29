@extends('layouts.appscraper')
@section('title', 'ZZZ Characters - Detail')
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
            <a href="{{ route('zzzScraper') }}" class="inline-block mb-4 text-red-500 hover:underline">&larr; Back to Characters</a>
            @if($char)
                <div class="bg-gray-800 border border-red-500/30 rounded-xl shadow-xl p-6 flex flex-col md:flex-row gap-6">
                    <img src="{{ $char->image }}" alt="{{ $char->name }}" class="w-full md:w-1/3 h-auto rounded-lg object-cover" loading="lazy">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold mb-2">{{ $char->name }}</h1>
                        <p class="text-gray-300 mb-4">{{ $char->description }}</p>
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Element</h2>
                            <p class="text-gray-300">{{ $char->element }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Role</h2>
                            <p class="text-gray-300">{{ $char->role }}</p>
                        </div>
                        <div class="mb-4">
                            <h2 class="text-xl font-semibold mb-2">Rarity</h2>
                            <p class="text-gray-300">{{ $char->rarity }}★</p>
                        </div>
                        <!-- Add more character details as needed -->
                    </div>
                </div>
            @else
                <p class="text-red-500">Character not found.</p>
            @endif
        </div>
    </div> 
@endsection
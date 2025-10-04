@extends('layouts.appscraper')
@push('styles')
    @vite('resources/css/zzz_detail.css')
@endpush
@section('title', 'ZZZ Characters - Detail')

@section('content')    
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-black min-h-screen overflow-y-auto relative text-white">
        <div class="container mx-auto p-6">
            <a href="{{ route('zzzScraper') }}" class="inline-block mb-6 text-red-500 hover:text-red-400 transition-colors duration-300 font-semibold">&larr; Back to Characters</a>
            
            @if($char)
                <div class="card-container p-6">
                    <div class="card-corner top-left"></div>
                    <div class="card-corner top-right"></div>
                    <div class="card-corner bottom-left"></div>
                    <div class="card-corner bottom-right"></div>
                    
                    <div class="flex flex-col sm:flex-row gap-6 mb-6 justify-center items-center lg:items-start">
                        <div class="w-2/3 sm:w-1/3">
                            <div class="character-image-frame p-2">
                                <img src="{{ asset($char->image) }}" 
                                     alt="{{ $char->name }}" 
                                     class="w-full h-auto object-cover  rounded-lg {{ $char->tier == 'S' ? 'bg-amber-500/95' : 'bg-violet-900' }}" 
                                     loading="lazy">
                            </div>
                        </div>
                        
                        <div class="flex-1 w-full space-y-6">
                            <div class="data-section">
                                <h1 class="text-3xl md:text-4xl text-center md:text-start font-bold text-red-500">{{ $char->name }}</h1>
                            </div>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                <div class="data-section flex flex-col items-center">
                                    <div class="stat-label">Element</div>
                                    <img src="{{ asset('image/zzz_logo//' . ($char->element) . '.png') }}" alt="{{ $char->element }}" class=" w-8 h-8 object-cover">
                                </div>
                                
                                <div class="data-section flex flex-col items-center">
                                    <div class="stat-label">Role</div>
                                    <div class="stat-value">{{ $char->type }}</div>
                                </div>
                                
                                <div class="data-section flex flex-col items-center">
                                    <div class="stat-label">Rarity</div>
                                    <div class="stat-value">{{ $char->tier }}</div>
                                </div>
                            </div>

                            <div class="data-section">
                                @if($char->zzz_wengine && count($char->zzz_wengine) > 0)
                                    <div class="stat-label">About</div>
                                    <div class="stat-value">{{ $char->description ?? 'This is a About' }}</div>
                                @else
                                    <div class="stat-label">Status</div>
                                    <div class="flex justify-center items-center">
                                        <p class="text-2xl md:text-3xl text-center md:text-start font-bold text-red-500">Coming Soon!</p>
                                    </div>
                                @endif
                            
                            </div>
                        </div>
                    </div>
                    
                    @if($char->zzz_wengine && count($char->zzz_wengine) > 0)
                        <div>
                            <div class="section-title">Best W-Engine Options</div>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                                @foreach($char->zzz_wengine as $wengine)
                                    <div class="wengine-card">
                                        <div class="flex items-start gap-3">
                                            <img src="{{ asset($wengine->w_engine_picture) }}" 
                                                 alt="{{ $wengine->build_name }}" 
                                                 class="w-14 h-14 object-cover rounded-lg border-2 border-red-500/30 flex-shrink-0">
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 mb-1 flex-wrap">
                                                    <p class="text-gray-200 font-semibold text-sm">{{ $wengine->build_name }}</p>
                                                    <span class="text-red-500 font-bold text-xs px-2 py-0.5 bg-red-500/10 rounded">{{ $wengine->build_s }}</span>
                                                </div>
                                                <p class="text-gray-400 text-xs leading-relaxed">{{ $wengine->detail }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($char->zzz_diskdrive && count($char->zzz_diskdrive) > 0)
                        <div class="mb-6">
                            <div class="section-title">Best Disk Drive Sets</div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($char->zzz_diskdrive as $diskdrive)
                                    <div class="diskdrive-card">
                                        <div class="diskdrive-title">{{ $diskdrive->name }}</div>
                                        
                                        <div class="diskdrive-bonus">
                                            <div class="bonus-label">2-Piece Bonus</div>
                                            <p class="bonus-text">{{ $diskdrive->detail_2pc }}</p>
                                        </div>
                                        
                                        <div class="diskdrive-bonus">
                                            <div class="bonus-label">4-Piece Bonus</div>
                                            <p class="bonus-text">{{ $diskdrive->detail_4pc }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Section Divider -->
                        <div class="section-divider"></div>
                    @endif
                </div>
            @else
                <div class="card-container p-8 text-center">
                    <p class="text-red-500 text-xl">Character not found.</p>
                </div>
            @endif
        </div>
    </div> 
@endsection
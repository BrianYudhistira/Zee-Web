@extends('layouts.app')

@section('title', 'Data Scraper - ZeeScraper')
@section('page-title', 'Data Scraper Overview')
@section('page-description', 'Monitoring and managing your data scraping activities.')

@section('content')
    <div class="grid grid-cols-1 gap-6">
        <!-- Main Content Area -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Scraping Activity</h3>
                <p class="text-sm text-gray-600 mt-1">Your latest data scraping activities</p>
            </div>
            <div class="p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-6">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900">Zenless Zone Zero</h1>
                        <p class="text-sm text-gray-600 mt-1">Comprehensive game data management</p>
                    </div>
                </div>

                <!-- Enhanced Tab Navigation -->
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8 overflow-x-auto" role="tablist">
                        <button id="tab-characters" 
                                class="tab-button active py-4 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600 whitespace-nowrap"
                                onclick="switchTab('characters')" role="tab">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                                Characters
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $zzzchar->total() ?? 0 }}</span>
                            </div>
                        </button>
                        
                        <button id="tab-diskdrives" 
                                class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap"
                                onclick="switchTab('diskdrives')" role="tab">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                                Disk Drives
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">{{ $zzzdiskdrive->total() ?? 0 }}</span>
                            </div>
                        </button>
                        
                        <button id="tab-wengines" 
                                class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap"
                                onclick="switchTab('wengines')" role="tab">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                W-Engines
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">{{ $zzzwengine->total() ?? 0 }}</span>
                            </div>
                        </button>

                        <button id="tab-stats" 
                                class="tab-button py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap"
                                onclick="switchTab('stats')" role="tab">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 bg-orange-500 rounded-full"></span>
                                Statistics
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">📊</span>
                            </div>
                        </button>
                    </nav>
                </div>

                <!-- Tab Content: Characters -->
                <div id="content-characters" class="tab-content">
                    <div class="flex justify-center sm:justify-start mb-4">
                        <h2 class="text-lg font-medium text-center sm:text-left text-gray-900">Characters Data</h2>
                    </div>
                @if($zzzchar->isEmpty())
                    <p class="text-sm text-gray-600 mb-4">No data available.</p>
                @else
                    <!-- Desktop Table View -->
                    <div class="hidden lg:block overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse border border-gray-300 mb-6">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">ID</th>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Name</th>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Link</th>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Image</th>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Element</th>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Element Image</th>
                                    <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Tier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($zzzchar as $char)
                                <tr class="hover:bg-gray-50">
                                    <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-900">{{ $char->id }}</td>
                                    <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-900">{{ $char->name }}</td>
                                    <td class="border border-gray-300 px-3 py-3 text-sm text-center">
                                        @if($char->link)
                                            <a href="{{ $char->link }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline" title="{{ $char->link }}">
                                                {{ Str::limit($char->link, 25) }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-3 py-3 text-sm text-center">
                                        @if($char->image)
                                            <a href="{{ $char->image }}" target="_blank" class="text-blue-600 underline hover:text-blue-800" title="{{ $char->image }}">
                                                {{ Str::limit($char->image, 25) }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-700">{{ $char->element ?? '-' }}</td>
                                    <td class="border border-gray-300 px-3 py-3 text-sm text-center">
                                        @if($char->element_picture)
                                            <a href="{{ $char->element_picture }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline" title="{{ $char->element_picture }}">
                                                {{ Str::limit($char->element_picture, 25) }}
                                            </a>
                                        @else
                                            <span class="text-gray-500">-</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-3 py-3 text-center">
                                        @if($char->tier == 'S')
                                            <span class="inline-flex justify-center items-center w-8 h-8 px-2 py-1 bg-yellow-500 text-gray-800 text-sm font-medium rounded-full">S</span>
                                        @elseif($char->tier == 'A')
                                            <span class="inline-flex justify-center items-center w-8 h-8 px-2 py-1 bg-purple-600 text-gray-800 text-sm font-medium rounded-full">A</span>
                                        @else
                                            <span class="inline-flex justify-center items-center w-8 h-8 px-2 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">{{ substr($char->tier, 0, 1) }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile/Tablet Card View -->
                    <div class="lg:hidden space-y-4">
                        @foreach($zzzchar as $char)
                            <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900">{{ $char->name }}</h4>
                                        <p class="text-sm text-gray-500">ID: {{ $char->id }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        @if($char->tier == 'S-Tier')
                                            <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">S-Tier</span>
                                        @elseif($char->tier == 'A-Tier')
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-sm font-medium rounded-full">A-Tier</span>
                                        @elseif($char->tier == 'B-Tier')
                                            <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-medium rounded-full">B-Tier</span>
                                        @elseif($char->tier == 'C-Tier')
                                            <span class="inline-block px-3 py-1 bg-red-100 text-red-800 text-sm font-medium rounded-full">C-Tier</span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-gray-100 text-gray-800 text-sm font-medium rounded-full">{{ $char->tier }}</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-3">
                                    @if($char->element)
                                        <div class="flex justify-between">
                                            <span class="text-sm font-medium text-gray-600">Element:</span>
                                            <span class="text-sm text-gray-900">{{ $char->element }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($char->link)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-600">Link:</span>
                                            <a href="{{ $char->link }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm break-all">
                                                Visit Link
                                            </a>
                                        </div>
                                    @endif
                                    
                                    @if($char->image)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-600">Image:</span>
                                            <a href="{{ $char->image }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm">
                                                View Image
                                            </a>
                                        </div>
                                    @endif
                                    
                                    @if($char->element_image)
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm font-medium text-gray-600">Element Image:</span>
                                            <a href="{{ $char->element_image }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm">
                                                View Element
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($zzzchar->hasPages())
                        <div class="mt-6 flex justify-center">
                            <nav class="flex items-center space-x-1 sm:space-x-2 overflow-x-auto max-w-full">
                                @if ($zzzchar->onFirstPage())
                                    <span class="px-2 py-2 sm:px-3 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm">Prev</span>
                                @else
                                    <a href="{{ $zzzchar->appends(['tab' => 'characters'] + request()->except(['char_page']))->previousPageUrl() }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">Prev</a>
                                @endif
                                
                                @php
                                    $currentPage = $zzzchar->currentPage();
                                    $lastPage = $zzzchar->lastPage();

                                    // Responsive pagination - show fewer pages on mobile
                                    $isMobile = true; // You can detect this with JavaScript if needed
                                    $maxPages = $isMobile ? 3 : 5;
                                    
                                    if ($currentPage <= 2) {
                                        $startPage = 1;
                                        $endPage = min($maxPages, $lastPage);
                                    }
                                    else{
                                        $startPage = max(1, $currentPage - 1);
                                        $endPage = min($currentPage + 1, $lastPage);
                                    }
                                @endphp

                                <!-- Show first page and dots only on larger screens -->
                                @if($startPage > 1)
                                    <a href="{{ $zzzchar->appends(['tab' => 'characters'] + request()->except(['char_page']))->url(1) }}" class="hidden sm:inline-block px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">1</a>
                                    <span class="hidden sm:inline-block px-2 py-2 text-gray-400 text-sm">...</span>
                                @endif
                                
                                @for($page = $startPage; $page <= $endPage; $page++)
                                    @if ($page == $currentPage)
                                        <span class="px-2 py-2 sm:px-3 text-white bg-blue-600 rounded-lg font-medium text-sm">{{ $page }}</span>
                                    @else
                                        <a href="{{ $zzzchar->appends(['tab' => 'characters'] + request()->except(['char_page']))->url($page) }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">{{ $page }}</a>
                                    @endif
                                @endfor
                                
                                <!-- Show last page and dots only on larger screens -->
                                @if(($endPage + 1) < $lastPage)
                                    <span class="hidden sm:inline-block px-2 py-2 text-gray-400 text-sm">...</span>
                                    <a href="{{ $zzzchar->appends(['tab' => 'characters'] + request()->except(['char_page']))->url($lastPage) }}" class="hidden sm:inline-block px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">{{ $lastPage }}</a>
                                @endif
                                
                                {{-- Next Page Link --}}
                                @if ($zzzchar->hasMorePages())
                                    <a href="{{ $zzzchar->appends(['tab' => 'characters'] + request()->except(['char_page']))->nextPageUrl() }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">Next</a>
                                @else
                                    <span class="px-2 py-2 sm:px-3 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm">Next</span>
                                @endif
                            </nav>
                        </div>
                        
                        <!-- Pagination Info -->
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600">
                                Showing {{ $zzzchar->firstItem() }} to {{ $zzzchar->lastItem() }} of {{ $zzzchar->total() }} results
                            </p>
                        </div>
                    @endif
                @endif
                </div>

                <!-- Tab Content: Disk Drives -->
                <div id="content-diskdrives" class="tab-content hidden">
                    <div class="flex justify-center sm:justify-start mb-4">
                        <h2 class="text-lg font-medium text-center sm:text-left text-gray-900">Disk Drives Data</h2>
                    </div>
                    
                    @if($zzzdiskdrive->isEmpty())
                        <div class="bg-purple-50 rounded-lg p-8 text-center">
                            <div class="text-purple-600 text-4xl mb-4">💿</div>
                            <p class="text-purple-800 text-lg font-medium mb-2">No Disk Drives Data</p>
                            <p class="text-purple-600 text-sm">Disk drives data will be displayed here when available.</p>
                        </div>
                    @else
                        <!-- Desktop Table View -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full table-auto border-collapse border border-gray-300 mb-6">
                                <thead class="bg-purple-50">
                                    <tr>
                                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">ID</th>
                                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Character</th>
                                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">Disk Drive Name</th>
                                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">2-Piece Set</th>
                                        <th class="border border-gray-300 px-3 py-3 text-center text-sm font-medium text-gray-700">4-Piece Set</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($zzzdiskdrive as $diskdrive)
                                    <tr class="hover:bg-purple-25 diskdrive-row" data-char-id="{{ $diskdrive->zzz_char_id ?? '' }}">
                                        <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-900">{{ $diskdrive->id }}</td>
                                        <td class="border border-gray-300 px-3 py-3 text-sm text-center">
                                            @if($diskdrive->zzzChar)
                                                <div class="flex items-center justify-center gap-2">
                                                    <span class="text-gray-900 font-medium">{{ $diskdrive->zzzChar->name }}</span>
                                                    @if($diskdrive->zzzChar->tier)
                                                        <span class="px-2 py-1 text-xs rounded-full 
                                                            {{ $diskdrive->zzzChar->tier == 'S' ? 'bg-yellow-100 text-yellow-800' : 
                                                               ($diskdrive->zzzChar->tier == 'A' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                                            {{ $diskdrive->zzzChar->tier }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-900">
                                            {{ $diskdrive->name ?? 'Unknown Disk Drive' }}
                                        </td>
                                        <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-700">
                                            {{ $diskdrive->detail_2pc ?? '-' }}
                                        </td>
                                        <td class="border border-gray-300 px-3 py-3 text-sm text-center text-gray-700">
                                            {{ $diskdrive->detail_4pc ?? '-' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile/Tablet Card View -->
                        <div class="lg:hidden space-y-4">
                            @foreach($zzzdiskdrive as $diskdrive)
                                <div class="bg-purple-50 rounded-lg border border-purple-200 p-4 diskdrive-card" data-char-id="{{ $diskdrive->zzz_char_id ?? '' }}">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">{{ $diskdrive->name ?? 'Unknown Disk Drive' }}</h4>
                                            <p class="text-sm text-gray-500">ID: {{ $diskdrive->id }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 gap-3">
                                        @if($diskdrive->zzzChar)
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-600">Character:</span>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm text-gray-900 font-medium">{{ $diskdrive->zzzChar->name }}</span>
                                                    @if($diskdrive->zzzChar->tier)
                                                        <span class="px-2 py-1 text-xs rounded-full 
                                                            {{ $diskdrive->zzzChar->tier == 'S' ? 'bg-yellow-100 text-yellow-800' : 
                                                               ($diskdrive->zzzChar->tier == 'A' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                                            {{ $diskdrive->zzzChar->tier }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($diskdrive->detail_2pc)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-600">2-Piece Set:</span>
                                                <span class="text-sm text-gray-900 text-right max-w-xs">{{ $diskdrive->detail_2pc }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($diskdrive->detail_4pc)
                                            <div class="flex justify-between">
                                                <span class="text-sm font-medium text-gray-600">4-Piece Set:</span>
                                                <span class="text-sm text-gray-900 text-right max-w-xs">{{ $diskdrive->detail_4pc }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination for Disk Drives -->
                        @if($zzzdiskdrive->hasPages())
                            <div class="mt-6 flex justify-center">
                                <nav class="flex items-center space-x-1 sm:space-x-2 overflow-x-auto max-w-full">
                                    @if ($zzzdiskdrive->onFirstPage())
                                        <span class="px-2 py-2 sm:px-3 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm">Prev</span>
                                    @else
                                        <a href="{{ $zzzdiskdrive->appends(['tab' => 'diskdrives'] + request()->except(['diskdrive_page']))->previousPageUrl() }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">Prev</a>
                                    @endif
                                    
                                    @php
                                        $currentPage = $zzzdiskdrive->currentPage();
                                        $lastPage = $zzzdiskdrive->lastPage();

                                        // Responsive pagination for disk drives
                                        if ($currentPage <= 2) {
                                            $startPage = 1;
                                            $endPage = min(3, $lastPage);
                                        }
                                        else{
                                            $startPage = max(1, $currentPage - 1);
                                            $endPage = min($currentPage + 1, $lastPage);
                                        }
                                    @endphp

                                    @if($startPage > 1)
                                        <a href="{{ $zzzdiskdrive->appends(['tab' => 'diskdrives'] + request()->except(['diskdrive_page']))->url(1) }}" class="hidden sm:inline-block px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">1</a>
                                        <span class="hidden sm:inline-block px-2 py-2 text-gray-400 text-sm">...</span>
                                    @endif

                                    @for($page = $startPage; $page <= $endPage; $page++)
                                        @if ($page == $currentPage)
                                            <span class="px-2 py-2 sm:px-3 text-white bg-purple-600 rounded-lg font-medium text-sm">{{ $page }}</span>
                                        @else
                                            <a href="{{ $zzzdiskdrive->appends(['tab' => 'diskdrives'] + request()->except(['diskdrive_page']))->url($page) }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">{{ $page }}</a>
                                        @endif
                                    @endfor
                                    
                                    @if(($endPage + 1) < $lastPage)
                                        <span class="hidden sm:inline-block px-2 py-2 text-gray-400 text-sm">...</span>
                                        <a href="{{ $zzzdiskdrive->appends(['tab' => 'diskdrives'] + request()->except(['diskdrive_page']))->url($lastPage) }}" class="hidden sm:inline-block px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">{{ $lastPage }}</a>
                                    @endif
                                    
                                    @if ($zzzdiskdrive->hasMorePages())
                                        <a href="{{ $zzzdiskdrive->appends(['tab' => 'diskdrives'] + request()->except(['diskdrive_page']))->nextPageUrl() }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">Next</a>
                                    @else
                                        <span class="px-2 py-2 sm:px-3 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm">Next</span>
                                    @endif
                                </nav>
                            </div>
                            
                            <!-- Pagination Info -->
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">
                                    Showing {{ $zzzdiskdrive->firstItem() }} to {{ $zzzdiskdrive->lastItem() }} of {{ $zzzdiskdrive->total() }} disk drives
                                </p>
                            </div>
                        @endif
                    @endif
                </div>

                <!-- Tab Content: W-Engines -->
                <div id="content-wengines" class="tab-content hidden">
                    @if(isset($zzzwengine) && $zzzwengine->count() > 0)

                        <!-- Desktop Table View -->
                        <div class="hidden lg:block overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Character</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">W-Engine</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($zzzwengine as $wengine)
                                    <tr class="hover:bg-gray-50 wengine-row">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($wengine->zzzChar && $wengine->zzzChar->image)
                                                    <img class="h-10 w-10 rounded-full object-cover mr-3" 
                                                         src="{{ $wengine->zzzChar->image }}" 
                                                         alt="{{ $wengine->zzzChar->name ?? 'Unknown' }}"
                                                         loading="lazy">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center mr-3">
                                                        <span class="text-xs text-gray-600">?</span>
                                                    </div>
                                                @endif
                                                <span class="text-sm font-medium text-gray-900">
                                                    {{ $wengine->zzzChar->name ?? '-'  }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                            <span class="text-gray-900">
                                                {{ $wengine->build_name ?? '-' }}
                                            </span>
                                            <span class="text-red-600">
                                                {{ $wengine->build_s ?? '(S?)' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($wengine->w_engine_picture)
                                                    <img class="h-8 w-8 rounded mr-2 object-cover" 
                                                         src="{{ $wengine->w_engine_picture }}" 
                                                         alt="W-Engine"
                                                         loading="lazy">
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                            <div class="truncate">{{ $wengine->detail ?? 'No details available' }}</div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            No W-Engines found.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="lg:hidden space-y-4">
                            @forelse($zzzwengine as $wengine)
                            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 wengine-row">
                                <div class="flex items-start space-x-3">
                                    @if($wengine->zzzChar && $wengine->zzzChar->image)
                                        <img class="h-12 w-12 rounded-full object-cover flex-shrink-0" 
                                             src="{{ $wengine->zzzChar->image }}" 
                                             alt="{{ $wengine->zzzChar->name ?? 'Unknown' }}"
                                             loading="lazy">
                                    @else
                                        <div class="h-12 w-12 rounded-full bg-gray-300 flex items-center justify-center flex-shrink-0">
                                            <span class="text-sm text-gray-600">?</span>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-sm font-medium text-gray-900 truncate">
                                                {{ $wengine->zzzChar->name ?? 'Unknown Character' }}
                                            </h3>
                                        </div>
                                        <div class="flex items-center mt-1">
                                            @if($wengine->w_engine_picture)
                                                <img class="h-6 w-6 rounded mr-2 object-cover" 
                                                     src="{{ $wengine->w_engine_picture}}" 
                                                     alt="W-Engine" loading="lazy">
                                            @endif
                                            <span class="text-sm text-gray-600">{{ $wengine->build_name ?? 'No Build Name' }}</span>
                                        </div>
                                        @if($wengine->detail)
                                        <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ $wengine->detail }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-8">
                                <p class="text-gray-500">No W-Engines found.</p>
                            </div>
                            @endforelse
                        </div>

                        <!-- Pagination for W-Engines -->
                        @if($zzzwengine->hasPages())
                            <div class="mt-6 flex justify-center">
                                <nav class="flex items-center space-x-1 sm:space-x-2 overflow-x-auto max-w-full">
                                    @if ($zzzwengine->onFirstPage())
                                        <span class="px-2 py-2 sm:px-3 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm">Prev</span>
                                    @else
                                        <a href="{{ $zzzwengine->appends(['tab' => 'wengines'] + request()->except(['wengine_page']))->previousPageUrl() }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">Prev</a>
                                    @endif
                                    
                                    @php
                                        $currentPage = $zzzwengine->currentPage();
                                        $lastPage = $zzzwengine->lastPage();

                                        // Responsive pagination for W-engines
                                        if ($currentPage <= 2) {
                                            $startPage = 1;
                                            $endPage = min(3, $lastPage);
                                        }
                                        else{
                                            $startPage = max(1, $currentPage - 1);
                                            $endPage = min($currentPage + 1, $lastPage);
                                        }
                                    @endphp

                                    @if($startPage > 1)
                                        <a href="{{ $zzzwengine->appends(['tab' => 'wengines'] + request()->except(['wengine_page']))->url(1) }}" class="hidden sm:inline-block px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">1</a>
                                        <span class="hidden sm:inline-block px-2 py-2 text-gray-400 text-sm">...</span>
                                    @endif

                                    @for($page = $startPage; $page <= $endPage; $page++)
                                        @if ($page == $currentPage)
                                            <span class="px-2 py-2 sm:px-3 text-white bg-green-600 rounded-lg font-medium text-sm">{{ $page }}</span>
                                        @else
                                            <a href="{{ $zzzwengine->appends(['tab' => 'wengines'] + request()->except(['wengine_page']))->url($page) }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">{{ $page }}</a>
                                        @endif
                                    @endfor
                                    
                                    @if(($endPage + 1) < $lastPage)
                                        <span class="hidden sm:inline-block px-2 py-2 text-gray-400 text-sm">...</span>
                                        <a href="{{ $zzzwengine->appends(['tab' => 'wengines'] + request()->except(['wengine_page']))->url($lastPage) }}" class="hidden sm:inline-block px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">{{ $lastPage }}</a>
                                    @endif
                                    
                                    @if ($zzzwengine->hasMorePages())
                                        <a href="{{ $zzzwengine->appends(['tab' => 'wengines'] + request()->except(['wengine_page']))->nextPageUrl() }}" class="px-2 py-2 sm:px-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 text-sm">Next</a>
                                    @else
                                        <span class="px-2 py-2 sm:px-3 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed text-sm">Next</span>
                                    @endif
                                </nav>
                            </div>
                            
                            <!-- Pagination Info -->
                            <div class="mt-4 text-center">
                                <p class="text-sm text-gray-600">
                                    Showing {{ $zzzwengine->firstItem() }} to {{ $zzzwengine->lastItem() }} of {{ $zzzwengine->total() }} W-engines
                                </p>
                            </div>
                        @endif
                    @else
                        <div class="bg-green-50 rounded-lg p-4 mb-4">
                            <p class="text-green-800 text-sm">
                                ⚡ No W-Engines data available. Import data first.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Tab Content: Statistics -->
                @if(session('status'))
                    <div id="status-message" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-sm">
                        {{ session('status') }}
                    </div>
                @endif
                <div id="content-stats" class="tab-content hidden">
                    <div class="flex flex-col sm:flex-row justify-between items-center sm:items-center mb-4 gap-3">
                        <h2 class="text-lg font-medium text-gray-900 text-center sm:text-left">Data Statistics</h2>
                        <a href="{{ route('admin.scraper.run') }}" 
                            class="px-3 py-1 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition-colors duration-200 inline-flex items-center gap-2 mx-auto sm:mx-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Refresh Data
                            </a>
                    </div>
                    
                    <!-- Statistics Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-500 rounded-lg">
                                    <span class="text-white text-lg">👥</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-900">Total Characters</p>
                                    <p class="text-2xl font-bold text-blue-700">{{ $zzzchar->total() ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-500 rounded-lg">
                                    <span class="text-white text-lg">💿</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-purple-900">Total Disk Drives</p>
                                    <p class="text-2xl font-bold text-purple-700">{{ $zzzdiskdrive->total() ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-500 rounded-lg">
                                    <span class="text-white text-lg">⚡</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-900">Total W-Engines</p>
                                    <p class="text-2xl font-bold text-green-700">{{ $zzzwengine->total() ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-500 rounded-lg">
                                    <span class="text-white text-lg">📊</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-orange-900">Last Updated</p>
                                    <p class="text-sm font-bold text-orange-700">
                                        @php
                                            $firstChar = \App\Models\zzz_char::orderBy('created_at', 'asc')->first();
                                        @endphp
                                        {{ $firstChar ? $firstChar->created_at->format('M d, Y') : 'No data available' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Switching -->
    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });
            
            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-blue-500', 'text-blue-600', 'border-purple-500', 'text-purple-600', 'border-green-500', 'text-green-600', 'border-orange-500', 'text-orange-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });
            
            // Show selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');
            
            // Add active class to selected tab with appropriate color
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.remove('border-transparent', 'text-gray-500');
            
            if (tabName === 'characters') {
                activeTab.classList.add('active', 'border-blue-500', 'text-blue-600');
            } else if (tabName === 'diskdrives') {
                activeTab.classList.add('active', 'border-purple-500', 'text-purple-600');
            } else if (tabName === 'wengines') {
                activeTab.classList.add('active', 'border-green-500', 'text-green-600');
            } else if (tabName === 'stats') {
                activeTab.classList.add('active', 'border-orange-500', 'text-orange-600');
            }
            
            // Update URL without page reload (optional)
            const url = new URL(window.location);
            url.searchParams.set('tab', tabName);
            window.history.pushState({}, '', url);
        }
                
        // Handle browser back/forward
        window.addEventListener('popstate', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab') || 'characters';
            switchTab(tab);
        });
        
        // Initialize tab from URL on page load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab') || 'characters';
            switchTab(tab);

            // Auto-hide status message after 5 seconds
            setTimeout(() => {
                // Use specific ID for session status message
                const statusMessage = document.getElementById('status-message');
                if (statusMessage) {
                    statusMessage.style.transition = 'opacity 0.5s ease-out';
                    statusMessage.style.opacity = '0';
                    setTimeout(() => {
                        statusMessage.remove();
                    }, 500); // Remove from DOM after fade out
                }
            }, 5000);
        });
    </script>
@endsection
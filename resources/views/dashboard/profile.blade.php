@extends('layouts.app')

@section('title', 'Dashboard - ZeeScraper')
@section('page-title', 'Profile')
@section('page-description', 'Change Portfolio Information')

@section('content')
    <section id="profile-data">
        <!-- Profile Information Preview -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                <button onclick="toggleSection('Profile-Edit')" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="ri-edit-line mr-1"></i>Edit
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Picture & Basic Info -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'John+Doe') }}&background=3b82f6&color=ffffff&size=80" 
                             alt="Profile Picture" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-lg font-medium text-gray-900 mb-1">{{ Auth::user()->name ?? 'John Doe' }}</h4>
                        <p class="text-gray-600 text-sm mb-2">{{ Auth::user()->description ?? 'Web Developer & Enthusiast' }}</p>
                        <p class="text-gray-500 text-xs">{{ Auth::user()->email ?? 'john.doe@example.com' }}</p>
                    </div>
                </div>
                
                <!-- Social Media Links -->
                <div class="space-y-2">
                    <h5 class="font-medium text-gray-900 text-sm">Social Media</h5>
                    <div class="space-y-1">
                        <div class="flex items-center text-sm">
                            <i class="ri-github-fill text-gray-800 w-4 h-4 mr-2"></i>
                            <span class="text-gray-600">{{ Auth::user()->github_link ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i class="ri-instagram-fill text-pink-500 w-4 h-4 mr-2"></i>
                            <span class="text-gray-600">{{ Auth::user()->insta_link ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i class="ri-linkedin-fill text-blue-600 w-4 h-4 mr-2"></i>
                            <span class="text-gray-600">{{ Auth::user()->linkedin_link ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Skills & Expertise</h3>
                <button onclick="toggleSection('Skills-Section')" class="text-green-600 hover:text-green-800 text-sm font-medium">
                    <i class="ri-add-line mr-1"></i>Add/Edit
                </button>
            </div>
            
            @php
                // Dummy skills data - replace with actual data from database
                $skills = [
                    ['id' => 1, 'name' => 'Laravel', 'icon' => 'ri-code-s-slash-line'],
                    ['id' => 2, 'name' => 'PHP', 'icon' => 'ri-file-code-line'],
                    ['id' => 3, 'name' => 'JavaScript', 'icon' => 'ri-javascript-line'],
                    ['id' => 4, 'name' => 'MySQL', 'icon' => 'ri-database-2-line'],
                    ['id' => 5, 'name' => 'Tailwind CSS', 'icon' => 'ri-css3-line'],
                    ['id' => 6, 'name' => 'Vue.js', 'icon' => 'ri-vuejs-line']
                ];
            @endphp
            
            @if(count($skills) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($skills as $skill)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border hover:bg-gray-100 transition duration-200">
                            <div class="flex items-center">
                                <i class="{{ $skill['icon'] }} text-blue-600 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700">{{ $skill['name'] }}</span>
                            </div>
                            <form action="" method="POST" class="inline-block delete-form" 
                                  data-item-name="{{ $skill['name'] }}" data-item-type="skill">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="flex items-center justify-center w-6 h-6 text-red-500 hover:text-red-700 transition duration-200 rounded hover:bg-red-50"
                                        title="Delete skill">
                                    <i class="ri-delete-bin-line text-xs"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <i class="ri-lightbulb-line text-3xl mb-2"></i>
                    <p class="text-sm">No skills added yet</p>
                </div>
            @endif
        </div>

        <!-- Projects Section -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Project Portfolio</h3>
                <button onclick="toggleSection('project_portfolio')" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                    <i class="ri-add-line mr-1"></i>Add Project
                </button>
            </div>
          
            @php
                // Dummy projects data - replace with actual data from database
                $projects = [
                    [
                        'id' => 1,
                        'name' => 'E-Commerce Website',
                        'description' => 'Full-stack e-commerce platform with payment integration',
                        'link' => 'https://github.com/username/ecommerce',
                        'image' => 'https://via.placeholder.com/300x200/3b82f6/ffffff?text=E-Commerce',
                        'tech_stack' => ['devicon-vuejs-plain', 'devicon-tailwindcss-plain']
                    ],
                    [
                        'id' => 2,
                        'name' => 'Task Management App',
                        'description' => 'React-based task management application with real-time updates',
                        'link' => 'https://github.com/username/taskmanager',
                        'image' => 'https://via.placeholder.com/300x200/10b981/ffffff?text=Task+Manager',
                        'tech_stack' => ['devicon-react-original', 'devicon-nodejs-plain']
                    ],
                    [
                        'id' => 3,
                        'name' => 'Weather Dashboard',
                        'description' => 'Weather forecast dashboard using external APIs forecast dashboard using external APIs',
                        'link' => 'https://github.com/username/weather',
                        'image' => 'https://via.placeholder.com/300x200/f59e0b/ffffff?text=Weather+App',
                        'tech_stack' => ['devicon-kotlin-plain', 'devicon-laravel-plain', 'devicon-vuejs-plain', 'devicon-tailwindcss-plain']
                    ]
                ];
            @endphp

            @if(count($projects) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($projects as $project)
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition duration-200 relative flex flex-col">
                            <img src="{{ $project['image'] }}" alt="{{ $project['name'] }}" class="w-full h-32 object-cover">
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $project['name'] }}</h4>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2 flex-grow">{{ $project['description'] }}</p>
                                <div class="flex justify-between items-center mt-auto">
                                    <a href="{{ $project['link'] }}" target="_blank" 
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="ri-external-link-line mr-1"></i>
                                        View Project
                                    </a>
                                    <form action="" method="POST" class="inline-block delete-form" 
                                        data-item-name="{{ $project['name'] }}" data-item-type="project">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center justify-center w-6 h-6 text-red-500 hover:text-red-700 transition duration-200 rounded hover:bg-red-50"
                                                title="Delete project">
                                            <i class="ri-delete-bin-line text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                                @if(isset($project['tech_stack']) && count($project['tech_stack']) > 0)
                                    <div class="mt-2 flex flex-wrap gap-1">
                                        @foreach($project['tech_stack'] as $tech)
                                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full">
                                                <i class="{{ $tech }}"></i>
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <i class="ri-folder-line text-3xl mb-2"></i>
                    <p class="text-sm">No projects added yet</p>
                </div>
            @endif
        </div>
    </section>
    
    <section id="Profile-Edit" class="hidden">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
            <div class="mb-4">
                <button onclick="toggleSection('Profile-Edit')" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200">
                    <i class="ri-arrow-left-line mr-2"></i>
                    <span class="text-sm font-medium">Back to Profile</span>
                </button>
            </div>
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Profile Information</h2>
                <p class="text-gray-600">Update your personal details and social media links</p>
            </div>
            
            <form id="profile-form" action="" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Name and Description Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="name">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Full Name
                            </span>
                        </label>
                        <input type="text" id="name" name="name" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                            placeholder="Enter your full name">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="desc">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Description
                            </span>
                        </label>
                        <input type="text" id="desc" name="desc" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                            placeholder="Brief description about yourself">
                    </div>
                </div>
                
                <!-- Profile Image Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="image_profile">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Profile Image
                        </span>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image_profile" class="relative flex flex-col items-center justify-center w-full min-h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200 overflow-hidden">
                            <div id="profile_upload_area" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 2MB)</p>
                            </div>
                            <img id="profile_preview" class="hidden absolute inset-0 w-full h-full object-contain bg-white rounded-lg" alt="Profile preview">
                            <input type="file" accept="image/jpeg,image/png,image/jpg" id="image_profile" name="image_profile" class="hidden">
                        </label>
                    </div>
                    <div id="profile_preview_info" class="hidden">
                        <div class="flex items-center justify-between p-2 bg-blue-50 rounded-lg border">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="profile_file_name" class="text-sm text-blue-700 font-medium"></span>
                            </div>
                            <button type="button" onclick="clearProfilePreview()" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900 border-b border-gray-200 pb-2">Social Media Links</h3>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <!-- Instagram -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="insta_link">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-pink-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                    Instagram
                                </span>
                            </label>
                            <input type="url" id="insta_link" name="insta_link" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-pink-500 focus:border-pink-500 hover:border-gray-400"
                                placeholder="https://instagram.com/username">
                        </div>
                        
                        <!-- GitHub -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="github_link">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-800" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                    GitHub
                                </span>
                            </label>
                            <input type="url" id="github_link" name="github_link" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-gray-500 focus:border-gray-500 hover:border-gray-400"
                                placeholder="https://github.com/username">
                        </div>
                        
                        <!-- LinkedIn -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="linkedin_link">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                    LinkedIn
                                </span>
                            </label>
                            <input type="url" id="linkedin_link" name="linkedin_link" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                                placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section id="Skills-Section" class="hidden">
        <div class="bg-white p-8 mt-8 rounded-xl shadow-lg border border-gray-100">
            <div class="mb-4">
                <button onclick="toggleSection('Skills-Section')" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200">
                    <i class="ri-arrow-left-line mr-2"></i>
                    <span class="text-sm font-medium">Back to Profile</span>
                </button>
            </div>
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Skills & Expertise</h2>
                <p class="text-gray-600">Add your technical skills and expertise</p>
            </div>
            
            <form id="skills-form" action="" method="post" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="skills">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Skills
                            </span>
                        </label>
                        <input type="text" id="skills" name="skills" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-green-500 focus:border-green-500 hover:border-gray-400"
                            placeholder="e.g. Python, JavaScript, React, Node.js">
                        <p class="text-xs text-gray-500 mt-1">Separate multiple skills with commas</p>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="icon_skills">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Skill Icons
                            </span>
                        </label>
                        <input type="text" id="icon_skills" name="icon_skills" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-green-500 focus:border-green-500 hover:border-gray-400"
                            placeholder="e.g. devicon-python-plain, devicon-javascript-plain">
                        <p class="text-xs text-gray-500 mt-1">Use DevIcon class names for skill icons</p>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update Skills
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section id="project_portfolio" class="hidden">
        <div class="bg-white p-8 mt-8 rounded-xl shadow-lg border border-gray-100">
            <div class="mb-4">
                <button onclick="toggleSection('project_portfolio')" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200">
                    <i class="ri-arrow-left-line mr-2"></i>
                    <span class="text-sm font-medium">Back to Profile</span>
                </button>
            </div>
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Project Portfolio</h2>
                <p class="text-gray-600">Showcase your amazing projects and work</p>
            </div>
            
            <form id="project_form" action="" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="project_name">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Project Name
                            </span>
                        </label>
                        <input type="text" id="project_name" name="project_name" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
                            placeholder="e.g. E-commerce Website">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="project_link">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Project Link
                            </span>
                        </label>
                        <input type="url" id="project_link" name="project_link" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
                            placeholder="https://github.com/username/project">
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="project_desc">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Project Description
                        </span>
                    </label>
                    <textarea id="project_desc" name="project_desc" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400 resize-none"
                            placeholder="Describe your project, technologies used, features, and what makes it special..."></textarea>
                </div>
                
                <!-- Project Image Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="project_image">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Project Image
                        </span>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="project_image" class="relative flex flex-col items-center justify-center w-full min-h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200 overflow-hidden">
                            <div id="project_upload_area" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload project image</span></p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG or GIF (MAX. 5MB)</p>
                                <p class="text-xs text-gray-400 mt-1">Recommended: 800x600px for best display</p>
                            </div>
                            <img id="project_preview" class="hidden absolute inset-0 w-full h-full object-contain bg-white rounded-lg" alt="Project preview">
                            <input type="file" id="project_image" name="project_image" 
                                accept="image/png,image/jpg,image/jpeg,image/gif" class="hidden">
                        </label>
                    </div>
                    <div id="project_preview_info" class="hidden">
                        <div class="flex items-center justify-between p-2 bg-purple-50 rounded-lg border">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="project_file_name" class="text-sm text-purple-700 font-medium"></span>
                            </div>
                            <button type="button" onclick="clearProjectPreview()" class="text-red-500 hover:text-red-700 text-sm font-medium">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="flex justify-end pt-6 border-t border-gray-200">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg shadow-md transition duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Project
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Profile Image Preview
    const profileInput = document.getElementById('image_profile');
    const profilePreview = document.getElementById('profile_preview');
    const profileUploadArea = document.getElementById('profile_upload_area');
    const profilePreviewInfo = document.getElementById('profile_preview_info');
    const profileFileName = document.getElementById('profile_file_name');

    // Project Image Preview
    const projectInput = document.getElementById('project_image');
    const projectPreview = document.getElementById('project_preview');
    const projectUploadArea = document.getElementById('project_upload_area');
    const projectPreviewInfo = document.getElementById('project_preview_info');
    const projectFileName = document.getElementById('project_file_name');

    if (profileInput) {
        profileInput.addEventListener('change', function(e) {
            handleImagePreview(e.target, profilePreview, profileUploadArea, profilePreviewInfo, profileFileName);
        });
    }

    if (projectInput) {
        projectInput.addEventListener('change', function(e) {
            handleImagePreview(e.target, projectPreview, projectUploadArea, projectPreviewInfo, projectFileName);
        });
    }

    function handleImagePreview(input, preview, uploadArea, previewInfo, fileName) {
        const file = input.files[0];
        
        if (file) {
            // Validate file type
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Please select a valid image file (JPEG, JPG, PNG, or GIF)');
                input.value = '';
                return;
            }

            // Validate file size (5MB for project, 2MB for profile)
            const maxSize = input.id === 'project_image' ? 5 * 1024 * 1024 : 2 * 1024 * 1024;
            if (file.size > maxSize) {
                const maxSizeMB = input.id === 'project_image' ? '5MB' : '2MB';
                alert(`File size must be less than ${maxSizeMB}`);
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                
                // Create a temporary image to get dimensions
                const tempImg = new Image();
                tempImg.onload = function() {
                    const aspectRatio = this.height / this.width;
                    const containerWidth = preview.parentElement.offsetWidth;
                    
                    // Calculate height based on aspect ratio with min/max constraints
                    let newHeight;
                    if (input.id === 'project_image') {
                        newHeight = Math.max(160, Math.min(400, containerWidth * aspectRatio));
                    } else {
                        newHeight = Math.max(128, Math.min(300, containerWidth * aspectRatio));
                    }
                    
                    // Apply the calculated height to the container
                    preview.parentElement.style.height = newHeight + 'px';
                    preview.parentElement.classList.remove('min-h-32', 'min-h-40');
                };
                tempImg.src = e.target.result;
                
                preview.classList.remove('hidden');
                uploadArea.classList.add('hidden');
                previewInfo.classList.remove('hidden');
                fileName.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    }
});

function clearProfilePreview() {
    const profileInput = document.getElementById('image_profile');
    const profilePreview = document.getElementById('profile_preview');
    const profileUploadArea = document.getElementById('profile_upload_area');
    const profilePreviewInfo = document.getElementById('profile_preview_info');

    profileInput.value = '';
    profilePreview.src = '';
    profilePreview.classList.add('hidden');
    profileUploadArea.classList.remove('hidden');
    profilePreviewInfo.classList.add('hidden');
    
    // Reset container height
    profilePreview.parentElement.style.height = '';
    profilePreview.parentElement.classList.add('min-h-32');
}

function clearProjectPreview() {
    const projectInput = document.getElementById('project_image');
    const projectPreview = document.getElementById('project_preview');
    const projectUploadArea = document.getElementById('project_upload_area');
    const projectPreviewInfo = document.getElementById('project_preview_info');

    projectInput.value = '';
    projectPreview.src = '';
    projectPreview.classList.add('hidden');
    projectUploadArea.classList.remove('hidden');
    projectPreviewInfo.classList.add('hidden');
    
    // Reset container height
    projectPreview.parentElement.style.height = '';
    projectPreview.parentElement.classList.add('min-h-40');
}

// Toggle Section Visibility
function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    const profileData = document.getElementById('profile-data');
    
    if (section) {
        if (section.classList.contains('hidden')) {
            // Hide profile data and show selected section
            profileData.classList.add('hidden');
            section.classList.remove('hidden');
        } else {
            // Hide selected section and show profile data
            section.classList.add('hidden');
            profileData.classList.remove('hidden');
        }
    }
}

// Add event listeners for delete forms
document.addEventListener('DOMContentLoaded', function() {
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const itemName = this.getAttribute('data-item-name');
            const itemType = this.getAttribute('data-item-type');
            
            const confirmMessage = `Are you sure you want to delete the ${itemType} "${itemName}"? This action cannot be undone.`;
            
            if (confirm(confirmMessage)) {
                // If user confirms, submit the form
                this.submit();
            }
        });
    });
});
</script>
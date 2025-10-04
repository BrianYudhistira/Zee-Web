@extends('layouts.app')

@section('title', 'Dashboard - ZeeScraper')
@section('page-title', 'Profile')
@section('page-description', 'Change Portfolio Information')

@section('content')
@if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-medium">Please fix the following errors:</span>
            </div>
            <ul class="list-disc list-inside ml-7">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section id="Profile-Edit">
        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
            <div class="mb-4">
                <a href="{{ route('profile') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200">
                    <i class="ri-arrow-left-line mr-2"></i>
                    <span class="text-sm font-medium">Back to Profile</span>
                </a>
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
            
            <form id="profile-form" action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
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
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                            placeholder="Enter your full name">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="bio">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Bio
                            </span>
                        </label>
                        <input type="text" id="bio" name="bio"  value="{{ old('bio', $user->bio) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                            placeholder="Brief description about yourself">
                    </div>
                </div>
                
                <!-- Profile Image Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="profile_image">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Profile Image
                        </span>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="profile_image" class="relative flex flex-col items-center justify-center w-full min-h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200 overflow-hidden">
                            <div id="profile_upload_area" class="flex flex-col items-center justify-center pt-5 pb-6{{ $user->profile_image ? ' hidden' : '' }}">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PNG, JPG or JPEG (MAX. 5MB)</p>
                            </div>
                            <img id="profile_preview" src="{{ $user->profile_image ? $user->profile_image_url : '' }}" class="{{ $user->profile_image ? '' : 'hidden' }} absolute inset-0 w-full h-full object-contain bg-white rounded-lg" alt="Profile preview">
                            <input type="file" accept="image/jpeg,image/png,image/jpg" id="profile_image" name="profile_image" class="hidden">
                        </label>
                    </div>
                    <div id="profile_preview_info" class="{{ $user->profile_image ? '' : 'hidden' }}">
                        <div class="flex items-center justify-between p-2 bg-blue-50 rounded-lg border">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span id="profile_file_name" class="text-sm text-blue-700 font-medium">{{ $user->profile_image ? basename($user->profile_image) : '' }}</span>
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
                            <input type="url" id="insta_link" name="insta_link" value="{{ old('insta_link', $user->insta_link) }}"
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
                            <input type="url" id="github_link" name="github_link" value="{{ old('github_link', $user->git_link) }}"
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
                            <input type="url" id="linkedin_link" name="linkedin_link" value="{{ old('linkedin_link', $user->linkedin_link) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                                placeholder="https://linkedin.com/in/username">
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-14">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="email">
                                <i class="ri-mail-line"></i>
                                Email Address
                            </label>
                            <div class="flex items-center space-x-4">
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                                    placeholder="Enter your email address">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700" for="api_token">
                                <i class="fas fa-key"></i>
                                API Token
                            </label>
                            <div class="flex items-center space-x-4">
                                <input type="text" id="api_token" name="api_token" value="{{ old('api_token', $user->api_token) }}"
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-400"
                                    placeholder="Enter your API token">
                            </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Profile Image Preview
    const profileInput = document.getElementById('profile_image');
    const profilePreview = document.getElementById('profile_preview');
    const profileUploadArea = document.getElementById('profile_upload_area');
    const profilePreviewInfo = document.getElementById('profile_preview_info');
    const profileFileName = document.getElementById('profile_file_name');

    profileInput.addEventListener('change', function(e) {
        handleProfileImagePreview();
    });

    function handleProfileImagePreview() {
        const file = profileInput.files[0];
        
        if (file) {
            // Validate file type
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Please select a valid image file (JPEG, JPG, PNG, or GIF)');
                profileInput.value = '';
                return;
            }

            // Validate file size (5MB)
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) {
                alert('File size must be less than 5MB');
                profileInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                profilePreview.src = e.target.result;
                
                // Create a temporary image to get dimensions
                const tempImg = new Image();
                tempImg.onload = function() {
                    const aspectRatio = this.height / this.width;
                    const containerWidth = profilePreview.parentElement.offsetWidth;
                    
                    // Calculate height based on aspect ratio with min/max constraints
                    const newHeight = Math.max(128, Math.min(300, containerWidth * aspectRatio));
                    
                    // Apply the calculated height to the container
                    profilePreview.parentElement.style.height = newHeight + 'px';
                    profilePreview.parentElement.classList.remove('min-h-32', 'min-h-40');
                };
                tempImg.src = e.target.result;
                
                profilePreview.classList.remove('hidden');
                profileUploadArea.classList.add('hidden');
                profilePreviewInfo.classList.remove('hidden');
                profileFileName.textContent = file.name;
            };
            reader.readAsDataURL(file);
        }
    }
});

function clearProfilePreview() {
    const profileInput = document.getElementById('profile_image');
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
</script>

@endsection
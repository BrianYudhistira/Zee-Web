@extends('layouts.app')

@section('title', 'Dashboard - ZeeScraper')
@section('page-title', 'Profile')
@section('page-description', 'Change Portfolio Information')

@section('content')
    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Error Message -->
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

    <section id="profile-data">
        <!-- Profile Information Preview -->
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                <a href="{{ route('profile.form') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    <i class="ri-edit-line mr-1"></i>Edit
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Profile Picture & Basic Info -->
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        @if(Auth::user()->profile_image)
                        <img src="{{ asset(Auth::user()->profile_image) }}" 
                             alt="Profile Picture" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                        @else
                            <div class="w-20 h-20 rounded-full border-2 border-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">No Image</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-lg font-medium text-gray-900 mb-1">{{ Auth::user()->name ?? 'John Doe' }}</h4>
                        <p class="text-gray-600 text-sm mb-2">{{ Auth::user()->description ?? 'Web Developer & Enthusiast' }}</p>
                        <p class="text-gray-500 text-xs">{{ Auth::user()->email ?? 'john.doe@example.com' }}</p>
                        <div class="flex items-center text-gray-500 text-xs mt-1">
                            <span class="mr-2">API Token:</span>
                            <span class="font-mono mr-2" id="api-token-display">
                                @if(Auth::user()->api_token)
                                    <span id="token-hidden">{{ str_repeat('•', 20) }}</span>
                                    <span id="token-visible" style="display: none;">{{ Auth::user()->api_token }}</span>
                                @else
                                    Not set 
                                @endif
                            </span>
                            @if(Auth::user()->api_token)
                                <button type="button" id="toggle-token" class="text-gray-400 hover:text-gray-600 transition-colors duration-200" title="Show/Hide Token">
                                    <i id="eye-icon" class="ri-eye-line text-sm"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Social Media Links -->
                <div class="space-y-2">
                    <h5 class="font-medium text-gray-900 text-sm">Social Media</h5>
                    <div class="space-y-1">
                        <div class="flex items-center text-sm">
                            <i class="ri-github-fill text-gray-800 w-4 h-4 mr-2"></i>
                            <span class="text-gray-600">{{ Auth::user()->git_link ?? 'Not set' }}</span>
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
                <a href="{{ route('skills.form') }}" class="text-green-600 hover:text-green-800 text-sm font-medium">
                    <i class="ri-add-line mr-1"></i>Add
                </a>
            </div>
            
            @if(count($skills) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($skills as $skill)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border hover:bg-gray-100 transition duration-200">
                            <div class="flex items-center">
                                <i class="{{ $skill->icon }} text-blue-600 mr-2"></i>
                                <span class="text-sm font-medium text-gray-700">{{ $skill->name }}</span>
                            </div>
                            <div class="items-center">
                                <a href="{{ route('skills.form', $skill->id) }}" 
                                   class="inline-flex items-center justify-center w-8 h-8 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-md transition-all duration-200"
                                   title="Edit project">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="inline-block delete-form" 
                                      data-item-name="{{ $skill->name }}" data-item-type="skill">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="inline-flex items-center justify-center w-8 h-8 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md transition-all duration-200"
                                            title="Delete project">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
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
                <a href="{{ route('project.form') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                    <i class="ri-add-line mr-1"></i>Add Project
                </a>
            </div>

            @if(count($projects) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($projects as $project)
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition duration-200 relative flex flex-col">
                            <img src="{{ asset($project->image) }}" alt="{{ $project->name }}" class="w-full h-32 object-cover">
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="font-medium text-gray-900 mb-2">{{ $project->name }}</h4>
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2 flex-grow">{{ $project->description }}</p>
                                <div class="flex justify-between items-center mt-auto">
                                    <a href="{{ $project->link }}" target="_blank" 
                                    class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        <i class="ri-external-link-line mr-1"></i>
                                        View Project
                                    </a>
                                    <div class="flex mt-2 gap-1">
                                        <!-- Edit Button -->
                                        <a href="{{ route('project.form', $project->id) }}" 
                                           class="inline-flex items-center justify-center w-8 h-8 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded-md transition-all duration-200"
                                           title="Edit project">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        
                                        <!-- Delete Button -->
                                        <form action="{{ route('project.destroy', $project->id) }}" method="POST" class="inline-flex delete-form" 
                                            data-item-name="{{ $project->name }}" data-item-type="project">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center justify-center w-8 h-8 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-md transition-all duration-200"
                                                    title="Delete project">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
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

<script>
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

    // API Token toggle functionality
    const toggleButton = document.getElementById('toggle-token');
    const eyeIcon = document.getElementById('eye-icon');
    const tokenHidden = document.getElementById('token-hidden');
    const tokenVisible = document.getElementById('token-visible');
    
    if (toggleButton && tokenHidden && tokenVisible) {
        toggleButton.addEventListener('click', function() {
            if (tokenHidden.style.display === 'none') {
                // Show hidden, hide visible
                tokenHidden.style.display = 'inline';
                tokenVisible.style.display = 'none';
                eyeIcon.className = 'ri-eye-line text-sm';
                toggleButton.title = 'Show Token';
            } else {
                // Show visible, hide hidden
                tokenHidden.style.display = 'none';
                tokenVisible.style.display = 'inline';
                eyeIcon.className = 'ri-eye-off-line text-sm';
                toggleButton.title = 'Hide Token';
            }
        });
    }

    // Auto-hide success/error messages after 5 seconds
    setTimeout(function() {
        const successAlert = document.querySelector('.bg-green-100');
        const errorAlert = document.querySelector('.bg-red-100');
        
        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s ease-out';
            successAlert.style.opacity = '0';
            setTimeout(() => successAlert.remove(), 500);
        }
        
        if (errorAlert) {
            errorAlert.style.transition = 'opacity 0.5s ease-out';
            errorAlert.style.opacity = '0';
            setTimeout(() => errorAlert.remove(), 500);
        }
    }, 5000);
});
</script>
@endsection
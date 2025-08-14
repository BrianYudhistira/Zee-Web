@extends('layouts.app')

@section('title', 'Dashboard - ZeeScraper')
@section('page-title', 'Profile')
@section('page-description', 'Change Portfolio Information')

@section('content')

<section id="project_portfolio" >
        <div class="bg-white p-8 mt-8 rounded-xl shadow-lg border border-gray-100">
            <div class="mb-4">
                <a href="{{ route('profile') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200">
                    <i class="ri-arrow-left-line mr-2"></i>
                    <span class="text-sm font-medium">Back to Profile</span>
                </a>
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

            <form id="project_form" action="{{isset($project) ? route('project.update', $project) : route('project.store')}}" method="post" enctype="multipart/form-data" class="space-y-6">
                @csrf

                @if(isset($project))
                    @method('PUT')
                @endif
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="name">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Project Name
                            </span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $project->name ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
                            placeholder="e.g. E-commerce Website">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="link">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Project Link
                            </span>
                        </label>
                        <input type="url" id="link" name="link" value="{{ old('link', $project->link ?? '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
                            placeholder="https://github.com/username/project">
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="description">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                            </svg>
                            Project Description
                        </span>
                    </label>
                    <textarea id="description" name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400 resize-none"
                            placeholder="Describe your project, technologies used, features, and what makes it special...">{{ old('description', $project->description ?? '') }}</textarea>
                </div>
                
                <!-- Project Image Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="image">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Project Image
                        </span>
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="image" class="relative flex flex-col items-center justify-center w-full min-h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200 overflow-hidden">
                            <div id="project_upload_area" class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload project image</span></p>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG or GIF (MAX. 5MB)</p>
                                <p class="text-xs text-gray-400 mt-1">Recommended: 800x600px for best display</p>
                            </div>
                            <img id="project_preview" class="hidden absolute inset-0 w-full h-full object-contain bg-white rounded-lg" alt="Project preview">
                            <input type="file" id="image" name="image" 
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
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700" for="tech_stack">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Tech Stack
                        </span>
                    </label>
                    
                    <!-- Container for tech stack inputs -->
                    <div id="tech-stack-container" class="space-y-2">
                        @if(isset($project) && $project->tech_stack)
                            @foreach($project->tech_stack as $index => $tech)
                                <div class="flex items-center gap-2 tech-stack-item">
                                    <input type="text" name="tech_stack[]" value="{{ old('tech_stack.'.$index, $tech) }}"
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
                                           placeholder="e.g. devicon-php-plain">
                                    <button type="button" onclick="removeTechStack(this)" 
                                            class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center gap-2 tech-stack-item">
                                <input type="text" name="tech_stack[]" value="{{ old('tech_stack.0') }}"
                                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
                                       placeholder="e.g. devicon-php-plain">
                                <button type="button" onclick="removeTechStack(this)" 
                                        class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    </button>
                                </div>
                        @endif
                    </div>
                    
                    <!-- Add new tech stack button -->
                    <button type="button" onclick="addTechStack()" 
                            class="inline-flex items-center px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Tech Stack
                    </button>
                    
                    <!-- Help text -->
                    <p class="text-xs text-gray-500 mt-1">
                        Add DevIcon class names (e.g., devicon-react-original, devicon-nodejs-plain)
                    </p>
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
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Project Image Preview
    const projectInput = document.getElementById('image');
    const projectPreview = document.getElementById('project_preview');
    const projectUploadArea = document.getElementById('project_upload_area');
    const projectPreviewInfo = document.getElementById('project_preview_info');
    const projectFileName = document.getElementById('project_file_name');

    projectInput.addEventListener('change', function(e) {
        handleImagePreview(e.target, projectPreview, projectUploadArea, projectPreviewInfo, projectFileName);
    });

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

// Tech Stack Functions
function addTechStack() {
    const container = document.getElementById('tech-stack-container');
    const newItem = document.createElement('div');
    newItem.className = 'flex items-center gap-2 tech-stack-item';
    newItem.innerHTML = `
        <input type="text" name="tech_stack[]" value=""
               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-purple-500 focus:border-purple-500 hover:border-gray-400"
               placeholder="e.g. devicon-php-plain">
        <button type="button" onclick="removeTechStack(this)" 
                class="px-3 py-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </button>
    `;
    container.appendChild(newItem);
}

function removeTechStack(button) {
    const container = document.getElementById('tech-stack-container');
    const items = container.querySelectorAll('.tech-stack-item');
    
    // Don't remove if it's the last item
    if (items.length > 1) {
        button.closest('.tech-stack-item').remove();
    } else {
        // Clear the input instead
        const input = button.closest('.tech-stack-item').querySelector('input');
        input.value = '';
    }
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
</script>

@endsection
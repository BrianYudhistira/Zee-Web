@extends('layouts.app')

@section('title', 'Dashboard - ZeeScraper')
@section('page-title', 'Profile')
@section('page-description', 'Change Portfolio Information')

@section('content')

<section id="Skills-Section" >
        <div class="bg-white p-8 mt-8 rounded-xl shadow-lg border border-gray-100">
            <div class="mb-4">
                <a href="{{ route('profile') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition duration-200">
                    <i class="ri-arrow-left-line mr-2"></i>
                    <span class="text-sm font-medium">Back to Profile</span>
                </a>
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

            <form id="skills-form" action="{{isset($skills) ? route('skills.update', $skills->id) : route('skills.store')}}" method="post" class="space-y-6">
                @csrf
                @if(isset($skills))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="name">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Skills
                            </span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', isset($skills) ? $skills->name : '') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm transition duration-200 ease-in-out focus:ring-2 focus:ring-green-500 focus:border-green-500 hover:border-gray-400"
                            placeholder="e.g. Python, JavaScript, React, Node.js">
                        <p class="text-xs text-gray-500 mt-1">Add Skills</p>
                    </div>
                    
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700" for="icon">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Skill Icons
                            </span>
                        </label>
                        <input type="text" id="icon" name="icon" value="{{ old('icon', isset($skills) ? $skills->icon : '') }}"
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
    @endsection
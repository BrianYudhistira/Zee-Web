<?php

namespace App\Http\Controllers\DashboardsController;

use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        // Load current user with projects & skills
        $user = User::find(Auth::id());
        $projects = Project::all();
        $skills = Skill::all();

        return view('dashboard/Profile/profile', compact('user', 'projects', 'skills'));
    }

    public function profileForm(){
        $user = Auth::user();
        return view('dashboard/Profile/profile_form', compact('user'));
    }

    public function storeProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'bio' => 'nullable|string|max:500',
            'insta_link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            'email' => 'required|email|max:255',
            'api_token' => 'required|string|max:255|min:10',
        ]);

        $user = Auth::user();
        
        // Prepare update data
        $updateData = [
            'name' => $request->name,
            'description' => $request->desc,
            'bio' => $request->bio,
            'insta_link' => $request->insta_link,
            'git_link' => $request->github_link,
            'linkedin_link' => $request->linkedin_link,
            'email' => $request->email,
            'api_token' => $request->api_token,
        ];

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image){
                Storage::delete($user->profile_image);
            }

            $image      = $request->file('profile_image');
            $imageName  = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
            $path       = $image->storeAs('image/profile_image', $imageName, 'public');

            $updateData['profile_image'] = $path;

        } else {
            Storage::delete($user->profile_image);
            $updateData['profile_image'] = null;
        }
        // Update user profile
        $user->update($updateData);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }


}
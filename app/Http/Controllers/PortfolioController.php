<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    /**
     * Display portfolio of the authenticated user.
     */
    public function index()
    {
        // Get owner (admin) with projects & skills directly
        $user = User::find(1);
        $projects= Project::all();
        $skills = Skill::all();

        return view('portfolio/portfolio', compact('user', 'projects', 'skills'));
    }

    public function profile(){
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

    public function project_form(Project $project = null){
        if($project){
            return view('dashboard/Profile/project_form', compact('project'));
        }
        return view('dashboard/Profile/project_form');
    }

    public function skills_form(Skill $skill = null){
        if($skill){
            return view('dashboard/Profile/skills_form', compact('skill'));
        }
        return view('dashboard/Profile/skills_form');
    }

    /**
     * Store/Update user profile.
     */
    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'nullable|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string|max:500',
            'insta_link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
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
        ];

        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if (!empty($user->profile_image)) {
                $oldImagePath = public_path($user->profile_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/profile_image'), $imageName);
            $updateData['profile_image'] = 'image/profile_image/' . $imageName;
        }

        // Update user profile
        User::where('id', $user->id)->update($updateData);

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
    /**
     * Store a new project.
     */
    public function storeProject(Request $request, Project $project = null)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|array',
        ]);

        $imagePath = null;
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/projects'), $imageName);
            $imagePath = 'image/projects/' . $imageName;
        }
        
        Project::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'link' => $request->link,
            'tech_stack' => $request->tech_stack,
        ]);
        return redirect()->route('profile')->with('success', 'Project added successfully!');
    }

    public function updateProject(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|array',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'tech_stack' => $request->tech_stack,
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                File::delete(public_path($project->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/projects'), $imageName);
            $data['image'] = 'image/projects/' . $imageName;
        }

        // Update project
        $project->update($data);

        return redirect()->route('profile')->with('success', 'Project updated successfully!');
    }

    /**
     * Store a new skill.
     */
    public function storeSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

            // Create new skill
        Skill::create([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('profile')->with('success', 'Skill added successfully!');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        // Update skill
        $skill->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->back()->with('success', 'Skill updated successfully!');
    }

    /**
     * Delete a project.
     */
    public function destroyProject(Project $project)
    {
        $project->delete();
        return redirect()->route('profile')->with('success', 'Project deleted successfully!');
    }

    /**
     * Delete a skill.
     */
    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('profile')->with('success', 'Skill deleted successfully!');
    }

    /**
     * Show portfolio form for adding projects and skills.
     */
    public function manage()
    {
        $user = Auth::user();
        $portfolio = Portfolio::with(['projects', 'skills'])
                              ->where('user_id', $user->id)
                              ->first();
        
        return view('portfolio.manage', compact('user', 'portfolio'));
    }
}

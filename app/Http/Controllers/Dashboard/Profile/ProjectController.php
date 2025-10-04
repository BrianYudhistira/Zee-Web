<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function indexform(Project $project = null){
        if($project){
            return view('dashboard/Profile/project_form', compact('project'));
        }
        return view('dashboard/Profile/project_form');
    }

    public function storeProject(Request $request, Project $project = null){
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|array',
        ]);

        $path = null;
        
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'project_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('image/projects', $imageName, 'public');
        }
        
        Project::create([
            'name' => $request->name,
            'image' => $path ?? null,
            'description' => $request->description,
            'link' => $request->link,
            'tech_stack' => $request->tech_stack,
        ]);
        return redirect()->route('profile')->with('success', 'Project added successfully!');
    }

    public function updateProject(Request $request, Project $project){
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
                File::delete(storage_path($project->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('image/projects'), $imageName);
            $data['image'] = 'public/image/projects/' . $imageName;
        }

        // Update project
        $project->update($data);

        return redirect()->route('profile')->with('success', 'Project updated successfully!');
    }
    
    public function destroyProject(Project $project)
    {
        $project->delete();
        return redirect()->route('profile')->with('success', 'Project deleted successfully!');
    }
}
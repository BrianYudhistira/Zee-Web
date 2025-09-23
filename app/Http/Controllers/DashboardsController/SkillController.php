<?php

namespace App\Http\Controllers\DashboardsController;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function indexform(Skill $skill = null){
        if($skill){
            return view('dashboard/Profile/skills_form', compact('skill'));
        }
        return view('dashboard/Profile/skills_form');
    }

    public function storeSkill(Request $request){
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

    public function updateSkill(Request $request, Skill $skill){
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        // Update skill
        $skill->update([
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('profile')->with('success', 'Skill updated successfully!');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('profile')->with('success', 'Skill deleted successfully!');
    }


}
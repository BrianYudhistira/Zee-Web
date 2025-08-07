<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display portfolio of the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user ? $user->id : 1; 
        $portfolio = Portfolio::with(['projects', 'skills'])
                              ->where('user_id', $userId)
                              ->first();

        return view('portfolio/portfolio', compact('user', 'portfolio'));
    }

    /**
     * Show the form for creating/editing portfolio.
     */
    public function create()
    {
        $user = Auth::user();
        $portfolio = Portfolio::where('user_id', $user->id)->first();
        
        return view('portfolio.create', compact('portfolio'));
    }

    /**
     * Store or update portfolio data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_image' => 'nullable|string',
            'insta_link' => 'nullable|url',
            'git_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
        ]);

        $portfolioData = [
            'user_id' => Auth::id(),
            'name' => $request->name,
            'profile_image' => $request->profile_image,
            'insta_link' => $request->insta_link,
            'git_link' => $request->git_link,
            'linkedin_link' => $request->linkedin_link,
        ];

        Portfolio::updateOrCreate(
            ['user_id' => Auth::id()],
            $portfolioData
        );

        return redirect()->route('portfolio.index')->with('success', 'Portfolio saved successfully!');
    }

    /**
     * Store a new project.
     */
    public function storeProject(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'tech_stack' => 'nullable|array',
        ]);

        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        
        if (!$portfolio) {
            return redirect()->back()->with('error', 'Please create your portfolio first!');
        }

        Project::create([
            'portfolio_id' => $portfolio->id,
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->link,
            'tech_stack' => $request->tech_stack,
        ]);

        return redirect()->route('portfolio.index')->with('success', 'Project added successfully!');
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

        $portfolio = Portfolio::where('user_id', Auth::id())->first();
        
        if (!$portfolio) {
            return redirect()->back()->with('error', 'Please create your portfolio first!');
        }

        Skill::create([
            'portfolio_id' => $portfolio->id,
            'name' => $request->name,
            'icon' => $request->icon,
        ]);

        return redirect()->route('portfolio.index')->with('success', 'Skill added successfully!');
    }

    /**
     * Delete a project.
     */
    public function destroyProject(Project $project)
    {
        // Check if project belongs to authenticated user
        if ($project->portfolio->user_id !== Auth::id() || Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        $project->delete();
        return redirect()->route('portfolio.index')->with('success', 'Project deleted successfully!');
    }

    /**
     * Delete a skill.
     */
    public function destroySkill(Skill $skill)
    {
        // Check if skill belongs to authenticated user
        if ($skill->portfolio->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        $skill->delete();
        return redirect()->route('portfolio.index')->with('success', 'Skill deleted successfully!');
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

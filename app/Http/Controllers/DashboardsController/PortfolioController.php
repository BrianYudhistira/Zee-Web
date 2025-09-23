<?php
namespace App\Http\Controllers\DashboardsController;

use App\Models\User;
use App\Models\Project;
use App\Models\Skill;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function index(){
        $user = User::find(1);
        $projects = Project::all();
        $skills = Skill::all();

        return view('portfolio/portfolio', compact('user', 'projects', 'skills'));
    }
}
        
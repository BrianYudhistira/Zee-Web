<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\zzz_char;
use App\Models\zzz_diskdrive;
use App\Models\zzz_wengine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {
        return redirect('/menu');
    }

    public function portfolio()
    {
        return view('portfolio/portfolio');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/menu')->with('success', 'Login successful!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function login()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/menu')->with('success', 'Registration successful! Welcome to our website.');
    }

    public function data_scraper()
    {
        // Get characters with pagination - ordered by ID ascending
        $zzzchar = zzz_char::with(['zzz_diskdrive', 'zzz_wengine'])
                          ->orderBy('id', 'asc')
                          ->paginate(10, ['*'], 'char_page');
        
        // Get disk drives with their related characters - ordered by character ID
        $zzzdiskdrive = zzz_diskdrive::with('zzzChar')
                                   ->orderBy('zzz_char_id', 'asc')
                                   ->paginate(10, ['*'], 'diskdrive_page');
        
        // Get W-engines with their related characters - ordered by character ID
        $zzzwengine = zzz_wengine::with('zzzChar')
                                ->orderBy('zzz_char_id', 'asc')
                                ->paginate(10, ['*'], 'wengine_page');
        
        return view('dashboard/data_scraper', compact('zzzchar', 'zzzdiskdrive', 'zzzwengine'));
    }
}
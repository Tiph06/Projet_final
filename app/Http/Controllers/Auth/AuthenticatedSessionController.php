<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Post;
use App\Models\PostTemoignage;
use App\Models\Suivi;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Identifiants invalides.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->is_admin) {
            // Données admin
            $userCount = User::count();
            $postCount = Post::count();
            $temoignageCount = PostTemoignage::count();
            $lastActivity = $user->updated_at?->diffForHumans();

            return view('profile.dashboard', compact('userCount', 'postCount', 'temoignageCount', 'lastActivity'));
        } else {
            // Données utilisatrice
            $suiviEtats = Suivi::where('user_id', $user->id)->latest()->take(5)->get();

            return view('profile.dashboard', compact('suiviEtats'));
        }
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

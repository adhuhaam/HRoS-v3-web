<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect based on user role
        if ($user->hasRole('super admin')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('hr manager')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('hr staff')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('manager')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('supervisor')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('employee')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('reception')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('agent')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('clients')) {
            return redirect()->route('dashboard');
        } elseif ($user->hasRole('guest')) {
            return redirect()->route('dashboard');
        }

        // Fallback if no valid role is found
        return redirect()->route('dashboard');
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

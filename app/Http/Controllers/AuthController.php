<?php

// Author: Emily Cardona Castañeda 

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        $viewData = [];
        $viewData['title'] = __('auth.login_title');

        return view('auth.login', ['viewData' => $viewData]);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->route('home.index')
                ->with('success', __('auth.login_success'));
        }

        return back()
            ->withErrors(['email' => __('auth.failed')])
            ->withInput($request->only('email', 'remember'));
    }

    public function showRegister(): View
    {
        $viewData = [];
        $viewData['title'] = __('auth.register_title');

        return view('auth.register', ['viewData' => $viewData]);
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => User::ROLE_USER,
        ]);

        Auth::login($user);

        return redirect()->route('home.index')
            ->with('success', __('auth.register_success'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', __('auth.logout_success'));
    }
}

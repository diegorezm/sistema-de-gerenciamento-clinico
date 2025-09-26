<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Show login page
     */
    public function showLogin(): \Inertia\Response
    {
        return Inertia::render('Auth/Login');
    }

    /**
     * Handle login form submission
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if ($this->authService->login($request->validated())) {
            return redirect()
                ->route('dashboard')
                ->with('success', 'Bem-vindo de volta!');
        }

        return back()->withErrors([
            'email' => 'As credenciais estão incorretas.',
        ]);
    }

    /**
     * Show registration page
     */
    public function showRegister(): \Inertia\Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle registration form submission
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $validatedRequest = $request->validated();
        $user = $this->authService->register($validatedRequest);
        $this->authService->login(["email" => $user->email, "password" => $validatedRequest['password']]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Conta criada com sucesso!');
    }

    /**
     * Logout user
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->authService->logout($request);

        return redirect()
            ->route('login')
            ->with('success', 'Você saiu da sua conta.');
    }
}

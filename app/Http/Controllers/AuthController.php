<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('panel');
        }
        return view('login');
    }

    /**
     * Procesa el inicio de sesión convencional.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('panel'))->with('success', '¡Sesión iniciada con éxito! Bienvenido al Resort.');
        }

        return back()->withErrors([
            'email' => 'Las credenciales introducidas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Permite cambiar de usuario al instante para facilitar las pruebas del simulador.
     */
    public function simulate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        Auth::login($user);
        $request->session()->regenerate();

        return back()->with('success', "Has iniciado sesión como: {$user->name} ({$user->age} años, " . ($user->is_admin ? 'Admin' : 'Cliente') . ')');
    }

    /**
     * Muestra el formulario de registro de nuevos huéspedes.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('panel');
        }
        return view('register');
    }

    /**
     * Registra un nuevo usuario con edad y rol.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'age' => 'required|integer|min:1|max:120',
            'is_admin' => 'nullable|boolean',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'age' => (int) $validated['age'],
            'is_admin' => $request->boolean('is_admin'),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('panel')->with('success', '¡Cuenta creada con éxito! Bienvenido a tu habitación.');
    }

    /**
     * Cierra la sesión activa.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Has cerrado sesión correctamente.');
    }
}


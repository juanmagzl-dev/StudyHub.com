<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

/**
 * Controlador que maneja todos los procesos relacionados con la autenticación:
 * registro, inicio de sesión y cierre de sesión
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de registro de usuario
     * 
     * @return \Illuminate\View\View Vista del formulario de registro
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Procesa la solicitud de registro de un nuevo usuario
     * 
     * @param Request $request Contiene los datos del formulario de registro
     * @return \Illuminate\Http\RedirectResponse Redirección después del registro
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Muestra el formulario de inicio de sesión
     * 
     * @return \Illuminate\View\View Vista del formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa la solicitud de inicio de sesión
     * 
     * @param Request $request Contiene las credenciales de inicio de sesión
     * @return \Illuminate\Http\RedirectResponse Redirección después del login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput();
    }

    /**
     * Cierra la sesión del usuario actual
     * 
     * @param Request $request La solicitud HTTP
     * @return \Illuminate\Http\RedirectResponse Redirección a la página principal
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
} 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

  
    public function login(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

  
        $credentials = $request->only('username', 'password');

  
        if (Auth::attempt($credentials)) {
        
            $request->session()->regenerate();

        
            return redirect()->intended(route('dashboard.index'));
        }


        return back()->withErrors([
            'username' => 'Las credenciales proporcionadas no coinciden.',
        ]);
    }


    public function logout(Request $request)
    {
     
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


 public function showRegister(){
        return view('auth.register');
 }


 public function register(Request $request){

    $request->validate([
        'username' => 'required|string|unique:usuarios',
        'password' => 'required|string',
        'confirm_password' => 'required|same:password',
        'nombre' => 'required|string',
        'apellidos' => 'required|string',
        'correo' => 'required|email|unique:usuarios',
        'rol' => 'required|in:administrador,recepcionista,cliente'
    ]);

    $user = User::create([
        'username' => $request->username,
        'password' => bcrypt($request->password),
        'nombre' => $request->nombre,
        'apellidos' => $request->apellidos,
        'correo' => $request->correo,
        'rol' => $request->rol
    ]);

    Auth::login($user);

return redirect()->route('dashboard')->with('success', 'Usuario registrado correctamente');


 }
}

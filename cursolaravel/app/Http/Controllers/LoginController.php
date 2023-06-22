<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request) {

        $credencias = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'O email não é válido',
            'password.required' => 'O campo senha é obrigatório!',
        ]);

            if(Auth::attempt($credencias, $request->remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard');
            }else{
                return redirect()->back()->with('erro', 'Usuário ou senha inválido. ');
            }
        
    }


    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('site.index'));

    }

    public function create() {
       return view('login.create'); 
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->get('admin_authenticated')) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (
            $request->username === env('ADMIN_USER') &&
            $request->password === env('ADMIN_PASSWORD')
        ) {
            session()->put('admin_authenticated', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['credentials' => 'Credenciales incorrectas.']);
    }

    public function logout()
    {
        session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }
}

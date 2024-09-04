<?php

namespace App\Http\Controllers;

use App\Helpers\AuthCommon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        $auth = AuthCommon::user();
        if (isset($auth->username)) {
            return redirect('inventory/dashboard');
        }
        return view("auth.login");
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('username', 'password');

        if (AuthCommon::check_credential($credential)) {
            $user = AuthCommon::getUser();
            AuthCommon::setUser($user);
            $role = $user->role->slug;
            app('session')->put('role_permit', $role);
            return redirect('/inventory/dashboard');

            AuthCommon::logout();
        }


        return redirect('/login')
            ->withInput()
            ->withErrors(['login_failed' => 'Username atau password anda salah.']);
    }

    public function logout()
    {
        AuthCommon::logout();
        return redirect('/');
    }
}

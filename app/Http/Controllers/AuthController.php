<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        $findAdmin = DB::table('admin')->where('username', $credentials['username'])->first();

        if ($findAdmin) {
            $checkPassword = Hash::check($credentials['password'], $findAdmin->password);
            if ($checkPassword) {
                //session admin
                $request->session()->put('admin', $findAdmin);

                return redirect()->route('admin.index');
            }
            else{
                return redirect()->back()->with('password', 'Username atau password salah')->with('username', 'Username atau password salah');
            }
        }else{
            return redirect()->back()->with('username', 'Username atau password salah')->with('password', 'Username atau password salah');
        }

    }
    public function logout(Request $request)
    {
        $request->session()->forget('admin');
        return redirect()->route('login');
    }
}

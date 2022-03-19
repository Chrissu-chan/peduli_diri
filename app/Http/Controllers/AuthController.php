<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check()) {
            return redirect()->back();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'no_telepon' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'no_telepon' => $request->no_telepon,
            'password' => $request->password,
        ];

        $fieldType = filter_var($request->no_telepon, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_telepon';


        if (Auth::guard('admin')->check()) {
            return redirect()->back();
        }
        else if (Auth::guard('admin')->attempt(array($fieldType => $data['no_telepon'], 'password' => $data['password']))){
            return redirect()->intended('dashboard');
        } else if (Auth::attempt(array($fieldType => $data['no_telepon'], 'password' => $data['password']))){
            return redirect()->intended('home');
        } else {
            return redirect()->route('login')->with('error', 'email atau password salah!!');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('users')->check()) {
            Auth::guard('users')->logout();
        }
        // Auth::logout();
        return redirect()->route('login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|min:8|max:20',
            'nik'      => 'required|unique:users|min:16|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'no_telepon' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/', 'unique:users'],
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus berupa email',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username tidak boleh kosong',
            'username.min' => 'Username minimal 8 karakter',
            'username.max' => 'Username maksimal 20 karakter',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK sudah terdaftar',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.min' => 'NIK harus 16 digit',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'no_telepon.required' => 'No Telepon tidak kosong',
            'no_telepon.regex' => 'No Telepon tidak valid',
        ]);

        $user = User::create([
            'username' => $request->username ,
            'nik' => $request->nik,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'password' => bcrypt($request->password),
            'level' => 'user',
        ]);
        if($user) {
            return redirect()->route('login')->with('success', 'Kamu Berhasil Membuat Akun');
            // session()->flash('success', 'Kamu Berhasil Membuat Akun');
        } else {
            session()->flash('errors','Register gagal! Silahkan ulangi beberapa saat lagi');
            return redirect()->route('register');
        }
    }
}

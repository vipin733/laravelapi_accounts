<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function home(Request $request)
    {
        if (!Auth::check()) {
            return view("login");
        }

        $query = $request->search;
        $users = User::latest();
        if ($query) {
            $users = $users->where(function($q)  use($query) {
                $q->where('email','like',"%{$query}%")->orWhere('contact_no','like',"%{$query}%")->orWhere('first_name', 'like', "%{$query}%")->orWhere('last_name', 'like', "%{$query}%");
            });
        }
        $users = $users->where("is_admin", false)->paginate(10)->withQueryString();
        $users =  UserResource::collection($users);

        return view("dashboard", compact("users", "query"));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|min:6',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $request->username)->orWhere('username', $request->username)->first();

        if ($user &&  Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => __('messages.invalid_credential'),
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function create(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|regex:/^[\pL\s]+$/u',
            'last_name'    => 'required|regex:/^[\pL\s]+$/u',
            'email'        => 'required|unique:users|email:rfc,dns',
            'username'     => 'required|unique:users|min:6',
            'contact_no'   => 'required|digits_between:10,15|unique:users',
            'password'     => 'required|min:6',
        ]);

        $userData = [
            "first_name"        => $request->first_name,
            "last_name"         => $request->last_name,
            "email"             => $request->email,
            "username"          => $request->username,
            "contact_no"        => $request->contact_no,
            "password"          => bcrypt($request->password),
            "email_verified_at" => now()
        ];

        User::create($userData);
        return redirect()->intended('/');
    }
}

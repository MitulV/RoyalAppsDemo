<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    // UserController.php
public function index()
{
    if (auth()->check()) {
        return redirect('/dashboard');
    } else {
        return view('login');
    }
}

public function login(Request $request)
{

    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $email = $request->input('email');
    $password = $request->input('password');

    $response = Http::post('https://candidate-testing.api.royal-apps.io/api/v2/token', [
        'email' => $email,
        'password' => $password,
    ]);


    if ($response->successful()) {
        $data = $response->json();
        $user = $data['user'];

        $userInDB = User::where('email', $email)->first();

        if ($userInDB) {
            $userInDB->update([
                'token_key' => $data['token_key'],
                'refresh_token_key' => $data['refresh_token_key'],
            ]);

            auth()->login($userInDB);
        } else {
            $userCreated = User::create([
                'user_id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'gender' => $user['gender'],
                'active' => $user['active'],
                'email_confirmed' => $user['email_confirmed'],
                'token_key' => $data['token_key'],
                'refresh_token_key' => $data['refresh_token_key'],
            ]);

            auth()->login($userCreated);
        }

        return redirect('/dashboard');
    } else {
        if ($response->status() === 401) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password',
            ])->redirectTo('/login');
        }
    }
           
    
}

public function logout()
{
    Auth::logout();
    return redirect('/');
}

public function showProfile()
    {
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }

}

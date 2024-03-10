<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function create(Request $request)
    {
            $validated = $request->validate([
                'login' => 'required|string|unique:users|min:4|max:16',
                'password' => 'required|string|alpha_dash|min:6|max:24',
            ]);
            $validated['password'] = Hash::make($validated['password']);
//            $validated['image'] = Storage::put('/images', $validated['image']);
            return response(User::create($validated), 201);
    }

    public function authorization(Request $request)
    {
        $validated = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return 'correct';
        } else {
            return 'incorrect';
        }
    }

    public function addImage(Request $request)
    {
        $image = Storage::put('/images', $request->image);
        return response(User::where('id', Auth::id())->update(['image' => $image]), 202);
    }
    public function logout()
    {
        return Auth::logout();
    }
}

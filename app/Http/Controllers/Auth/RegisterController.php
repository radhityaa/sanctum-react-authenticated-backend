<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $attributes = $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|string|email|unique:users',
            'password'  => 'required|string|min:8|confirmed',
        ]);

        $attributes['password'] = bcrypt($request->password);
        User::create($attributes);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['message' => 'Success'], 201);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Login Failed'], 401);
        }

        $isValidPassword = Hash::check($request->password, $user->password);
        if (!$isValidPassword) {
            return response()->json(['message' => 'Login Failed'], 401);
        }

        $user->update([
            'token' => bin2hex(random_bytes(40))
        ]);
        return response()->json($user);
    }
}

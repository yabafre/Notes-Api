<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Trouver l'utilisateur par email
        $user = User::where('email', $email)->first();

        if ($user) {
            // Vérifier si le mot de passe correspond
            if (Hash::check($password, $user->password)) {
                $token = $user->createToken('authToken')->plainTextToken;
                return response()->json([
                    'token' => $token,
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Invalid password'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'Invalid email'
            ], 401);
        }
    }


    public function register(UserRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $setData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ];
        $user = new User($setData);
        $user->save();

        return response()->json($user, 201);
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($request->user());
    }

    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}


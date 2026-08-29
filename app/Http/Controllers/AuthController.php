<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register(UserRequest $request)
    {
        try {
            //code...
            $data             = $request->validated();
            $data['password'] = Hash::make($request->password);

            $user  = $this->user->create($data);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status'       => 'Success',
                'data'         => $user,
                'message'      => 'User successfully created!',
                'access_token' => $token,
                'token_type'   => 'Bearer',
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->errorInfo ?: 'Something went wrong!',
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            # code...
            $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            $user = $this->user->where('email', $request->email)->first();

            if (! $user || !Hash::check($request->password, $user->password)) {
                # code...
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status'       => 'Success',
                'data'         => $user->load('role'),
                'message'      => "Login successfully!",
                'access_token' => $token,
                'token_type'   => 'Bearer',
            ]);
        } catch (\Throwable $e) {
            # code...
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage() ?: 'Something went wrong!',
            ], 403);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'Success',
            'message' => "Logged out successfully!",
        ]);
    }
}

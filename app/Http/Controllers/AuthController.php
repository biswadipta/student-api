<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || $admin->password !== $request->password) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => 'admin-token-123'
        ]);
    }

    public function logout()
    {
        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
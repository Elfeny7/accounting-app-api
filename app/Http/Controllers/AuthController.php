<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\Auth\AuthServiceInterface;

class AuthController extends Controller
{
    private AuthServiceInterface $authServiceInterface;

    public function __construct(AuthServiceInterface $authServiceInterface)
    {
        $this->authServiceInterface = $authServiceInterface;
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:6',
        ]);

        $data = $this->authServiceInterface->register($validated);
        return response()->json($data);
    }
}
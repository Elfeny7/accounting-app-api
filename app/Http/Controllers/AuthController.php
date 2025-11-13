<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Interfaces\Auth\AuthServiceInterface;

class AuthController extends Controller
{
    private AuthServiceInterface $authServiceInterface;

    public function __construct(AuthServiceInterface $authServiceInterface)
    {
        $this->authServiceInterface = $authServiceInterface;
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $this->authServiceInterface->register($request->getRegisterPayload());
        return response()->json($data);
    }
}
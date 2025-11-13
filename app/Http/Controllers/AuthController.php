<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Interfaces\Auth\AuthServiceInterface;
use App\Helper\ApiResponse;

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
        return ApiResponse::success($data, 'Register Successful', 201);
    }
}
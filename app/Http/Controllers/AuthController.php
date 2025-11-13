<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterUserRequest;
use App\Interfaces\Auth\AuthServiceInterface;
use App\Helper\ApiResponse;
use App\Http\Resources\UserResource;

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
        $responseData = [
            'user' => new UserResource($data['user']),
            'token' => $data['token']
        ];
        return ApiResponse::success($responseData, 'Register Successful', 201);
    }
}
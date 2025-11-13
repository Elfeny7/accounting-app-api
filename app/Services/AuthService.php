<?php

namespace App\Services;

use App\Interfaces\Auth\AuthServiceInterface;
use App\Interfaces\Auth\TokenServiceInterface;
use App\Interfaces\User\UserServiceInterface;

class AuthService implements AuthServiceInterface
{
    private TokenServiceInterface $tokenServiceInterface;
    private UserServiceInterface $userServiceInterface;

    public function __construct(TokenServiceInterface $tokenServiceInterface, UserServiceInterface $userServiceInterface)
    {
        $this->tokenServiceInterface = $tokenServiceInterface;
        $this->userServiceInterface = $userServiceInterface;
    }

    public function register(array $payload){
        $user = $this->userServiceInterface->createUser($payload);
        $token = $this->tokenServiceInterface->generate($user);
        return compact('user', 'token');
    }
}
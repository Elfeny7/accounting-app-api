<?php

namespace App\Services;

use App\Interfaces\Auth\AuthServiceInterface;
use App\Interfaces\Auth\TokenServiceInterface;
use App\Interfaces\User\UserServiceInterface;
use App\Exceptions\InvalidCredentialsException;

class AuthService implements AuthServiceInterface
{
    private TokenServiceInterface $tokenServiceInterface;
    private UserServiceInterface $userServiceInterface;

    public function __construct(TokenServiceInterface $tokenServiceInterface, UserServiceInterface $userServiceInterface)
    {
        $this->tokenServiceInterface = $tokenServiceInterface;
        $this->userServiceInterface = $userServiceInterface;
    }

    public function register(array $payload)
    {
        $user = $this->userServiceInterface->createUser($payload);
        $token = $this->tokenServiceInterface->generate($user);
        return compact('user', 'token');
    }

    public function login(array $credentials)
    {
        $token = $this->tokenServiceInterface->attempt($credentials);
        if (!$token) throw new InvalidCredentialsException();
        $user = $this->getUser();

        return [
            'user' => $user,
            'token' => $token,
            'expires_in' => $this->tokenServiceInterface->getTTL(),
        ];
    }

    public function getUser()
    {
        $user = $this->tokenServiceInterface->getUser();
        return $user;
    }

    public function logout()
    {
        $this->tokenServiceInterface->invalidate();
    }
}
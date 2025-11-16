<?php

namespace App\Services;

use App\Interfaces\Auth\TokenServiceInterface;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenService implements TokenServiceInterface
{
    public function generate(User $user): string
    {
        return JWTAuth::fromUser($user);
    }

    public function attempt(array $credentials): ?string
    {
        if (!$token = JWTAuth::attempt($credentials)) return null;
        return $token;
    }

    public function getUser(): ?User
    {
        return JWTAuth::user();
    }

    public function getTTL(): int
    {
        return JWTAuth::factory()->getTTL() * 60;
    }

    public function invalidate(): void
    {
        JWTAuth::invalidate(JWTAuth::getToken());
    }

    public function authenticate(): void
    {
        JWTAuth::parseToken()->authenticate();
    }
}
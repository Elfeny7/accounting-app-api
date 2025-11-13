<?php

namespace App\Services;

use App\Interfaces\Auth\TokenServiceInterface;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class TokenService implements TokenServiceInterface
{
    public function generate(User $user): string {
        return JWTAuth::fromUser($user);
    }
}
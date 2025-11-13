<?php

namespace App\Interfaces\Auth;

interface AuthServiceInterface
{
    public function register(array $payload);
}

<?php

namespace App\Interfaces\Auth;

interface AuthServiceInterface
{
    public function register(array $payload);
    public function login(array $credentials);
    public function getUser();
    public function logout();
}

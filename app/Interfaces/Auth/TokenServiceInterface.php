<?php

namespace App\Interfaces\Auth;

use App\Models\User;

interface TokenServiceInterface
{
    public function generate(User $user): string;
    public function attempt(array $credentials): ?string;
    public function getUser(): ?User;
    public function getTTL(): int;
    public function invalidate(): void;
}

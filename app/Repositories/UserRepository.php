<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create($data);
    }
}

<?php

namespace App\Services;

use App\Interfaces\User\UserServiceInterface;
use App\Interfaces\User\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function createUser($payload)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepositoryInterface->create($payload);
            DB::commit();
            return $user;
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
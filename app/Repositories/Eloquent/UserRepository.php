<?php


namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\EloquentBaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    protected function model(): string
    {
        return User::class;
    }
}

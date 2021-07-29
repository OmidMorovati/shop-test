<?php


namespace App\Repositories\Eloquent;


use App\Models\User;
use App\Repositories\Contracts\EloquentBaseRepository;

class UserRepository extends EloquentBaseRepository
{
    protected function model(): string
    {
        return User::class;
    }
}

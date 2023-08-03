<?php

namespace App\Services\Models;
use App\Contracts\Services\UserContract;
use App\Repositories\UserRepository;

class UserService extends Service implements UserContract
{
    protected $repository = UserRepository::class;
}
<?php

namespace App\Facades\Contracts;

use App\Contracts\Services\RoleContract;
use Illuminate\Support\Facades\Facade;

class RoleFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RoleContract::class;
    }
}
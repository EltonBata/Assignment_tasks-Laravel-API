<?php

namespace App\Facades\Contracts;

use App\Contracts\Services\SupervisaoContract;
use Illuminate\Support\Facades\Facade;

class SupervisaoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SupervisaoContract::class;
    }

}
<?php

namespace App\Facades\Contracts;

use App\Contracts\Services\FuncionarioContract;
use Illuminate\Support\Facades\Facade;

class FuncionarioFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FuncionarioContract::class;
    }

}
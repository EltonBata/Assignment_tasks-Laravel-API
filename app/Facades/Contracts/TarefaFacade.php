<?php

namespace App\Facades\Contracts;

use App\Contracts\Services\TarefaContract;
use Illuminate\Support\Facades\Facade;

class TarefaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return TarefaContract::class;
    }

}
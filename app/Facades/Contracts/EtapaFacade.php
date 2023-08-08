<?php

namespace App\Facades\Contracts;

use App\Contracts\Services\EtapaContract;
use Illuminate\Support\Facades\Facade;

class EtapaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return EtapaContract::class;
    }

}
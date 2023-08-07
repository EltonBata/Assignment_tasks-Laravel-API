<?php

namespace App\Services\Models;

use App\Contracts\Services\EtapaContract;
use App\Repositories\EtapaRepository;

class EtapaService extends Service implements EtapaContract
{
    protected $repository = EtapaRepository::class;
}
<?php

namespace App\Services\Models;

use App\Contracts\Services\SupervisaoContract;
use App\Repositories\SupervisaoRepository;

class SupervisaoService extends Service implements SupervisaoContract
{
    protected $repository = SupervisaoRepository::class;
}
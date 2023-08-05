<?php

namespace App\Services\Models;

use App\Contracts\Services\TarefaContract;
use App\Repositories\TarefaRepository;

class TarefaService extends Service implements TarefaContract
{
    protected $repository = TarefaRepository::class;
}
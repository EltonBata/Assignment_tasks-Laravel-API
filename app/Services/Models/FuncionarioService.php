<?php

namespace App\Services\Models;

use App\Contracts\Services\FuncionarioContract;
use App\Repositories\FuncionarioRepository;

class FuncionarioService extends Service implements FuncionarioContract
{
    protected $repository = FuncionarioRepository::class;

    
}
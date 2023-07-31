<?php

namespace App\Services\Models;

use App\Contracts\Services\AdministradorContract;
use App\Repositories\AdministradorRepository;

class AdministradorService extends Service implements AdministradorContract
{

    protected $repository = AdministradorRepository::class;

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

}
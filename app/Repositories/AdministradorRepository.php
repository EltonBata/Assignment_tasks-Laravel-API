<?php

namespace App\Repositories;

use App\Models\Administrador;

class AdministradorRepository extends Repository
{

    protected $model = Administrador::class;

    public function create(array $data)
    {
        $create = $this->model::create($data);

        return $create;
    }
}
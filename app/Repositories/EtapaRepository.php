<?php

namespace App\Repositories;

use App\Models\Etapa;

class EtapaRepository extends Repository
{
    protected $model = Etapa::class;

    public function create(array $etapa)
    {
        $etapa['funcionario_id'] = auth()->user()->id;
   
        $createEtapa = $this->model->create($etapa);

        return $createEtapa;
    }

    public function update(array $data, $etapa)
    {
        $data['funcionario_id'] = auth()->user()->id;

        $etapa->update($data);

        return $etapa;
    }
}
<?php

namespace App\Repositories;

use App\Models\Tarefa;
use Illuminate\Support\Facades\DB;

class TarefaRepository extends Repository
{
    protected $model = Tarefa::class;

    public function create(array $tarefa)
    {
        return DB::transaction(function () use ($tarefa) {

            $tarefa['administrador_id'] = auth()->user()->id;

            $CreateTarefa = $this->model->create($tarefa);

            $funcs = $CreateTarefa->funcionarios();

            $funcs->sync($tarefa['func_id']);

            return $CreateTarefa;

        });
    }

    public function update(array $data, $tarefa)
    {
        return DB::transaction(function () use ($data, $tarefa) {

            $tarefa->update($data);

            $funcs = $tarefa->funcionarios();

            if (request()->user()->isAdmin()) {
                $funcs->sync($data['func_id']);
            }

            return $tarefa;

        });
    }
}
<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

abstract class Repository
{

    protected $model;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function all(int $page_size)
    {
        return $this->model::paginate($page_size);
    }

    public function delete($model)
    {
        return $model->delete();
    }


    public function create(array $data)
    {
        $create = $this->model::create($data);

        return $create;
    }

    public function update(array $data, $model)
    {

        return DB::transaction(function () use ($data, $model) {


            $user = User::find($model->user_id);

            $user->update([
                'email' => $data['email']
            ]);

            $roles = $user->roles();

            $roles->sync($data['role_id']);

            $model->update([
                'nome' => $data['nome'],
                'apelido' => $data['apelido'],
                'data_nascimento' => $data['data_nascimento'],
                'endereco' => $data['endereco'],
                'telefone' => $data['telefone'],
                'email' => $data['email'],
            ]);

            return $model;

        });

    }
}
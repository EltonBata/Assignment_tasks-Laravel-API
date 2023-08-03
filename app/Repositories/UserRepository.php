<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\FuncionarioRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    protected $model = User::class;

    public function create(array $user)
    {
        return DB::transaction(function () use ($user) {

            $createdUser = $this->model->create($user);

            $roles = $createdUser->roles();

            $roles->sync($user['role_id']);

            $func = app(FuncionarioRepository::class);

            $user['user_id'] = $createdUser->id;

            return $func->create($user);

        });

    }

    public function update(array $data, $user)
    {

        return DB::transaction(function () use ($data, $user) {

            $func = $user->funcionario();

            $roles = $user->roles();

            $roles->sync($data['role_id']);

            $func->update([
                'nome' => $data['nome'],
                'apelido' => $data['apelido'],
                'data_nascimento' => $data['data_nascimento'],
                'endereco' => $data['endereco'],
                'telefone' => $data['telefone'],
                'email' => $data['email'],
                'user_id' => $user->id,
            ]);

            return $user;
        });

    }
}
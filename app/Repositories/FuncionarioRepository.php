<?php

namespace App\Repositories;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FuncionarioRepository extends Repository
{
 
    protected $model = Funcionario::class;

    public function update(array $data, $func)
    {

        return DB::transaction(function () use ($data, $func) {


            $user = User::find($func->user_id);

            $user->update([
                'email' => $data['email']
            ]);

            $roles = $user->roles();

            $roles->sync($data['role_id']);

            $func->update([
                'nome' => $data['nome'],
                'apelido' => $data['apelido'],
                'data_nascimento' => $data['data_nascimento'],
                'endereco' => $data['endereco'],
                'telefone' => $data['telefone'],
                'email' => $data['email'],
            ]);

            return $func;

        });

    }
    
}
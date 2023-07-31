<?php

namespace App\Models;

use App\Models\User;
use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'apelido',
        'data_nascimento',
        'endereco',
        'email',
        'telefone',
        'genero',
    ];

    //Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarefas()
    {
        return $this->belongsToMany(Tarefa::class, 'funcionario_tarefa', 'funcionario_id', 'tarefa_id');
    }

    public function tarefasSupervisionadas()
    {
        return $this->hasMany(Tarefa::class, 'supervisor_id', 'id');
    }

    public function etapas()
    {
        return $this->hasMany(Etapa::class);
    }
}
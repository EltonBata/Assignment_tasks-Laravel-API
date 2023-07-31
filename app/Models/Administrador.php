<?php

namespace App\Models;

use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $table = 'administradores';

    protected $fillable = [
        'user_id',
        'nome',
        'apelido',
        'data_nascimento',
        'endereco',
        'email',
        'telefone',
    ];

    //Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class, 'administrador_id');
    }
}
<?php

namespace App\Models;

use App\Models\Etapa;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'supervisor_id',
        'administrador_id',
        'designacao',
        'descricao',
        'inicio',
        'fim',
        'local',
        'estado',
        'classificacao',
        'progresso'
    ];

    //Relacionamentos
    public function funcionarios()
    {
        return $this->belongsToMany(Funcionario::class, 'funcionario_tarefa', 'tarefa_id', 'funcionario_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Funcionario::class, 'supervisor_id');
    }

    public function administrador()
    {
        return $this->belongsTo(Funcionario::class, 'administrador_id');
    }

    public function etapas(){
        return $this->hasMany(Etapa::class);
    }
}
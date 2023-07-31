<?php

namespace App\Models;

use App\Models\Funcionario;
use App\Models\Tarefa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etapa extends Model
{
    use HasFactory;

    protected $fillable = [
        'designacao',
        'descricao'
    ];

    //Relacionamentos

    public function tarefa()
    {
        return $this->belongsTo(Tarefa::class);
    }

    public function funcionario ()
    {
        return $this->belongsTo(Funcionario::class);
    }
}

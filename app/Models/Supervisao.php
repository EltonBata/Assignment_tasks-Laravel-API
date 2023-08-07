<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisao extends Model
{
    use HasFactory;

    protected $table = 'supervisoes';

    protected $fillable = [
        'tarefa_id',
        'avaliacao'
    ];
}
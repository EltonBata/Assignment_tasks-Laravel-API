<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao'
    ];

    //Relacionamento
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}
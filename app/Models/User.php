<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Funcionario;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function isAdmin()
    {
        $isAdmin = false;
        $roles = $this->roles;

        foreach ($roles as $role) {
            if ($role->nome == 'administrador') {
                $isAdmin = true;
            }
        }

        return $isAdmin;
    }

    public function isSupervisor($id){
        
        $tarefa = Tarefa::find($id);

        $user = $this->funcionario->id;

        if($user === $tarefa->supervisor_id){
            return true;
        }

        return false;
    }

    //Relacionamentos
    public function funcionario()
    {
        return $this->hasOne(Funcionario::class);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Administrador;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Role::factory(5)->create();

        // Administrador::factory()
        //     ->for(User::factory()
        //         ->hasRoles(1, [
        //             'nome' => 'admin',
        //             'descricao' => 'Este e um admin',
        //         ], '')
        //         ->create([
        //             'email' => 'eltonbata@gmail.com',
        //             'password' => bcrypt(12345678),
        //         ]))
        //     ->create(
        //         [
        //             'nome' => 'Elton Vagner',
        //             'apelido' => 'Bata',
        //             'data_nascimento' => '2002-12-14',
        //             'email' => 'elton@gmail.com',
        //             'endereco' => 'Maputo, Cidade da Matola, Intaka',
        //             'telefone' => '879030182'
        //         ]
        //     );
    }
}

<?php

namespace App\Actions\Fortify;

use App\Contracts\Services\AdministradorContract;
use App\Contracts\Services\FuncionarioContract;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Validate and create a newly registered user.
     *
     * @param  mixed<string, string>  $input
     */
    public function create(array $input)
    {

        return DB::transaction(function () use ($input) {

            $admin = app(AdministradorContract::class);
            $func = app(FuncionarioContract::class);

            $user = User::create([
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            $user->roles()->sync($input['role_id']);

            $input['user_id'] = $user->id;

            if ($user->isAdmin()) {
                $admin->create($input);

            } else {
               $func->create($input);
            }


        });

    }
}
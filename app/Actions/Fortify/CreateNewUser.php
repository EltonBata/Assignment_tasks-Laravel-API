<?php

namespace App\Actions\Fortify;

use App\Contracts\Services\UserContract;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('create-resource', User::class);

        $user = app(UserContract::class);

        $user->createToken('myToken')->plainTextToken;

        return $user->create($input);
       
    }
}
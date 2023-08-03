<?php

namespace App\Actions\Fortify;

use App\Contracts\Services\UserContract;

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

        $user = app(UserContract::class);

        return $user->create($input);
       
    }
}
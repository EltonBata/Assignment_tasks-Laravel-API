<?php

namespace App\Actions\Fortify;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {

            DB::transaction(function () use($user, $input) {

                if ($user->isAdmin()) {
                    $admin = $user->administrador();

                    $admin->update($input);
                } else {
                    $func = $user->funcionario();
                    
                    $func->update($input);
                }

                $user->forceFill([
                    'email' => $input['email'],
                ])->save();
            });

        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {


        DB::transaction(function () use ($user, $input) {


            if ($user->isAdmin()) {
                $admin = $user->administrador();

                $admin->update($input);
            }else{
                $func = $user->funcionario();

                $func->update($input);
            }

            $user->forceFill([
                'email' => $input['email'],
                'email_verified_at' => null,
            ])->save();

            $user->sendEmailVerificationNotification();
        });


    }
}
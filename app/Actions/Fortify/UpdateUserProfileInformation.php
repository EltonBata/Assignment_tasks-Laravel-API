<?php

namespace App\Actions\Fortify;

use App\Contracts\Services\UserContract;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
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

            DB::transaction(function () use ($user, $input) {

                $user->forceFill([
                    'email' => $input['email'],
                ])->save();

                $userService = app(UserContract::class);

                $user = $userService->update($input, $user);

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

            $user->forceFill([
                'email' => $input['email'],
            ])->save();

            $userService = app(UserContract::class);

            $user = $userService->update($input, $user);

            $user->sendEmailVerificationNotification();

        });

    }
}
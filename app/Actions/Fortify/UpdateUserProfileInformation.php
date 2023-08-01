<?php

namespace App\Actions\Fortify;


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

                if ($user->isAdmin()) {
                    $admin = $user->administrador();

                    $roles = $user->roles();

                    $roles->sync((array)$input['role_id']);

                    $admin->update([
                        'nome' => $input['nome'],
                        'apelido' => $input['apelido'],
                        'data_nascimento' => $input['data_nascimento'],
                        'endereco' => $input['endereco'],
                        'telefone' => $input['telefone'],
                        'email' => $input['email'],
                        'user_id' => $user->id,
                    ]);
                } else {
                    $func = $user->funcionario();

                    $roles = $user->roles();

                    $roles->sync((array)$input['role_id']);

                    $func->update([
                        'nome' => $input['nome'],
                        'apelido' => $input['apelido'],
                        'data_nascimento' => $input['data_nascimento'],
                        'endereco' => $input['endereco'],
                        'telefone' => $input['telefone'],
                        'email' => $input['email'],
                        'user_id' => $user->id,
                    ]);
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

                $roles = $user->roles();

                $roles->sync((array)$input['role_id']);

                $admin->update([
                    'nome' => $input['nome'],
                    'apelido' => $input['apelido'],
                    'data_nascimento' => $input['data_nascimento'],
                    'endereco' => $input['endereco'],
                    'telefone' => $input['telefone'],
                    'email' => $input['email'],
                    'user_id' => $user->id,
                ]);
            } else {
                $func = $user->funcionario();

                $roles = $user->roles();

                $roles->sync((array)$input['role_id']);

                $func->update([
                    'nome' => $input['nome'],
                    'apelido' => $input['apelido'],
                    'data_nascimento' => $input['data_nascimento'],
                    'endereco' => $input['endereco'],
                    'telefone' => $input['telefone'],
                    'email' => $input['email'],
                    'user_id' => $user->id,
                ]);
            }

            $user->forceFill([
                'email' => $input['email'],
            ])->save();

            $user->sendEmailVerificationNotification();
        });


    }
}
<?php

namespace Laravel\Fortify\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class ProfileInformationController extends Controller
{
    /**
     * Actualizacao do Perfil do Usuario
     * 
     * @bodyParam nome string required Nome do Usuario. Example: Elton Vagner
     * @bodyParam apelido string required Apelido do Usuario. Example: Bata
     * @bodyParam endereco string required Endereco do Usuario. Example: Maputo, Zimpeto
     * @bodyParam telefone string required Numero de telefone do Usuario. Deve conter no minimo 9 caracteres. Example: 878473645
     * @bodyParam data_nascimento date required Data de nascimento do Usuario. Example: 2002/12/14
     * @bodyParam email string required Email do Usuario. Example: elton@gmail.com
     * @bodyParam role_id array required Array contendo os IDs dos roles do Usuario. Example: '[1,3]'
     * @bodyParam password string required Password do Usuario. Deve conter no minimo 8 caracteres. Example: 1a2g3h4j5
     *
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse
     */
    public function update(StoreUpdateUserRequest $request,
                           UpdatesUserProfileInformation $updater)
    {
        $updater->update($request->user(), $request->validated());

        return app(ProfileInformationUpdatedResponse::class);
    }
}

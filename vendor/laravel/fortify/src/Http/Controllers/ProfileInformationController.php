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
     * Update the user's profile information.
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
<?php

namespace App\Http\Controllers\Api;

use App\Facades\Contracts\FuncionarioFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\Funcionario;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Gate;

class FuncionarioController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_size = request('page_size') ?? 10;

        $funcs = FuncionarioFacade::all($page_size);

        return response()->json($funcs);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Funcionario $func)
    {
        return response()->json($func);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUserRequest $request, Funcionario $func)
    {
        Gate::authorize('update-func', $func);

        $email = $func->user->email;

        $updated = FuncionarioFacade::update($request->validated(), $func);

        $user = $updated->user;
        
        if (
            $email !== $request['email'] &&
            $user instanceof MustVerifyEmail
        ) {
            $user->sendEmailVerificationNotification();
        }

        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $func)
    {
        Gate::authorize('delete-func', $func);

        $user = $func->user();

        FuncionarioFacade::delete($user);

        return response()->json([], 204);
    }
}
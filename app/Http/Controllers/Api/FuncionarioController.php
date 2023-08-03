<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\FuncionarioContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\Funcionario;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FuncionarioController extends Controller
{

    public function __construct(
        protected FuncionarioContract $funcService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_size = request('page_size') ?? 10;

        $funcs = $this->funcService->all($page_size);

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

        $updated = $this->funcService->update($request->validated(), $func);

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

        $this->funcService->delete($user);

        return response()->json([], 204);
    }
}
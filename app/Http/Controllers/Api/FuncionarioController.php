<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\FuncionarioContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FuncionarioController extends Controller
{

    public function __construct(
        protected FuncionarioContract $func
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUserRequest $request, Funcionario $func)
    {
        Gate::authorize('update-func', $func);

        $updated = $this->func->update($request->validated(), $func);

        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $func)
    {
        Gate::authorize('delete-func', $func);

        $user = $func->user();

        $this->func->delete($user);

        return response()->json([], 204);
    }
}
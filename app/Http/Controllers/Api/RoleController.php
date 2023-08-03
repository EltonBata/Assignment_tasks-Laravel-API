<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\RoleContract;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function __construct(
        protected RoleContract $roleService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_size = request('page_size') ?? 10;

        $roles = $this->roleService->all($page_size);

        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create-role', Role::class);

        Validator::make($request->all(), [
            'nome' => ['string', 'required', 'max:255'],
            'descricao' => ['string', 'required', 'max:512']
        ])->validate();

        $created = $this->roleService->create($request->all());

        return response()->json($created);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {

        Gate::authorize('update-role', Role::class);

        Validator::make($request->all(), [
            'nome' => ['string', 'required', 'max:255'],
            'descricao' => ['string', 'required', 'max:512']
        ])->validate();

        $updated = $this->roleService->update($request->all(), $role);

        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        Gate::authorize('delete-role', Role::class);

        $this->roleService->delete($role);

        return response()->json([], 204);
    }
}
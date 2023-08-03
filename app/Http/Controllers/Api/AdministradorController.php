<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Services\Models\AdministradorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdministradorController extends Controller
{

    public function __construct(
        protected AdministradorService $admin
    ) {
       
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_size = request('page_size') ?? 5;

        return response()->json($this->admin->all($page_size));
    }



    /**
     * Display the specified resource.
     */
    public function show(Administrador $admin)
    {
        return response()->json($admin);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $admin)
    {
        Gate::authorize('delete-admin', $admin);

        $user = $admin->user();

        $this->admin->delete($user);

        return response()->json([], 204);
    }
}
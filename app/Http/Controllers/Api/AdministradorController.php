<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Models\Administrador;
use App\Models\User;
use App\Services\Models\AdministradorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $page_size = request('page_size') ??  5;

        return response()->json($this->admin->all($page_size));

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreUpdateUserRequest $request)
    // {
    //     return DB::transaction(function () use ($request, $admin) {
            
    //         $user = User::create([
    //             'email' => $request['email'],
    //             'password' => Hash::make($request['password']),
    //         ]);

    //         $user->roles()->attach($request['role_id']);

    //         $request['user_id'] = $user->id;

    //         $admin->create($request);

    //         return $user;
    //     });
    // }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        return response()->json($administrador);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\SupervisaoContract;
use App\Facades\Contracts\SupervisaoFacade;
use App\Http\Requests\StoreUpdateSupervisaoRequest;
use App\Models\Supervisao;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;

class SupervisaoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupervisaoRequest $request)
    {

        Gate::authorize('supervisao', $request->tarefa_id);

        $created = SupervisaoFacade::create($request->validated());

        return response()->json($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisao $superviso)
    {
        return response()->json($superviso);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupervisaoRequest $request, Supervisao $superviso)
    {
        Gate::authorize('supervisao', $request->tarefa_id);

        $updated = SupervisaoFacade::update($request->validated(), $superviso);

        return response()->json($updated);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervisao $superviso)
    {
        Gate::authorize('supervisao', $superviso->tarefa_id);

        SupervisaoFacade::delete($superviso);

        return response()->json([], 204);
    }
}
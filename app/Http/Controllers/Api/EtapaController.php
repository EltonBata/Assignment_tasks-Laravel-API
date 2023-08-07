<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\EtapaContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEtapaRequest;
use App\Models\Etapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EtapaController extends Controller
{

    public function __construct(
        protected EtapaContract $etapaService
    ) {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEtapaRequest $request)
    {
        Gate::authorize('etapa', $request->tarefa_id);

        $createdEtapa = $this->etapaService->create($request->validated());

        return response()->json($createdEtapa);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateEtapaRequest $request, Etapa $etapa)
    {
        Gate::authorize('etapa', $request->tarefa_id);

        $updated = $this->etapaService->update($request->validated(), $etapa);

        return response()->json($updated);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etapa $etapa)
    {
        Gate::authorize('etapa', $etapa->tarefa_id);

        $this->etapaService->delete($etapa);

        return response()->json([], 204);

    }
}
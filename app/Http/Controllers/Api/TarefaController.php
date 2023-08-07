<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\TarefaContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTarefaRequest;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TarefaController extends Controller
{

    public function __construct(
        protected TarefaContract $tarefaService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_size = request('page_size') ?? 10;

        $tarefas = $this->tarefaService->all($page_size);

        return response()->json($tarefas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateTarefaRequest $request)
    {
        Gate::authorize('create-resource', Tarefa::class);

        $created = $this->tarefaService->create($request->validated());

        return response()->json($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $task)
    {
        Gate::authorize('show_task', $task);

        return response()->json([
            'tarefa' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateTarefaRequest $request, Tarefa $task)
    {
        Gate::authorize('update_task', $task);
        
        if(request()->user()->isAdmin()){
            $data = $request->validated();
        }else{
            $data = $request->only(['estado', 'progresso']);
        }

        $updatedTarefa = $this->tarefaService->update($data, $task);

        return response()->json($updatedTarefa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $task)
    {
        Gate::authorize('delete_task', $task);

        $this->tarefaService->delete($task);

        return response()->json([], 204);
    }
}
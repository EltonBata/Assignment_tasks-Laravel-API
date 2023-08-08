<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\TarefaContract;
use App\Facades\Contracts\TarefaFacade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTarefaRequest;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TarefaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_size = request('page_size') ?? 10;

        $tarefas = TarefaFacade::all($page_size);

        return response()->json($tarefas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateTarefaRequest $request)
    {
        Gate::authorize('create-resource', Tarefa::class);

        $created = TarefaFacade::create($request->validated());

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

        $updatedTarefa = TarefaFacade::update($data, $task);

        return response()->json($updatedTarefa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $task)
    {
        Gate::authorize('delete_task', $task);

        TarefaFacade::delete($task);

        return response()->json([], 204);
    }
}
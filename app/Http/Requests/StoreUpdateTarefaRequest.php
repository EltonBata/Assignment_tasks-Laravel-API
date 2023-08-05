<?php

namespace App\Http\Requests;

use App\Models\Funcionario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateTarefaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'supervisor_id' => ['required', Rule::exists(Funcionario::class, 'id')],
            'designacao' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:255'],
            'local' => ['nullable', 'string', 'max:255'],
            'classificacao' => ['nullable', 'string', 'max:255'],
            'inicio' => ['required', 'date'],
            'fim' => ['required', 'date'],
            'func_id' => ['array', 'required', Rule::exists(Funcionario::class, 'id')]
        ];

        if ($this->method() === 'PUT') {
            $rules['estado'] = ['required', 'string', 'max:255'];
            $rules['progresso'] = ['required', 'numeric', 'max:100', 'min:0'];
        }

        return $rules;
    }
}
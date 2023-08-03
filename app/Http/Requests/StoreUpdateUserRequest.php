<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Api\FuncionarioController;
use App\Models\Funcionario;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Rules\Password;



class StoreUpdateUserRequest extends FormRequest
{
    use PasswordValidationRules;
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
     * @bodyParam nome string required. Nome do Usuario. Example: Elton Vagner
     * @bodyParam apelido string required. Nome do Usuario. Example: Bata
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        $rules = [
            'nome' => ['required', 'max:255', 'string'],
            'apelido' => ['required', 'max:255', 'string'],
            'data_nascimento' => ['required', 'date'],
            'endereco' => ['required', 'max:512', 'string'],
            'telefone' => ['min:9', 'required', 'string'],
            'role_id' => ['required', 'array', Rule::exists(Role::class, 'id')],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ];

        if ($this->method() === 'PUT') {

            if (Route::current()->getControllerClass() === FuncionarioController::class) {
                $user_id = Route::current()->parameter('func')->user_id;
            } else {
                $user_id = $this->user()->id;
            }

            $rules['email'] = [
                'required',
                'string',
                'email',
                Rule::unique(User::class, 'email')->ignore($user_id, 'id'),
            ];

            $rules['password'] = ['nullable'];
        }

        return $rules;
    }
    
}
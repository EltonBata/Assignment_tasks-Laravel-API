<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::check()) {
            return response()->json([
                'message' => 'Usuário já está logado.',
            ], 400); // Retorna um status code 400 para indicar solicitação inválida
        }

        $credenciais = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);


        if (Auth::attempt($credenciais)) {

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'message' => 'Usuario logado',
                'token' => $user->createToken($request->email)->plainTextToken,
            ]);
        }

        return response()->json([
            'message' => 'Credenciais inválidas',
        ], 401);

    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Usuario saiu'
        ]);
    }
}
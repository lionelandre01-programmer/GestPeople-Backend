<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Desempenho;

class UserService
{

    public function create($dados){

        return User::create($dados);
    }

    public function view(){

        return User::with('departamento', 'funcao')->get();
    }

    public function login($request)
    {
        if (!Auth::attempt($request->only('email', 'password'))){

            return response()->json(['messege' => 'Credenciais Inválidas']);

        } else {

            $user = Auth::user();
            return $user->load('departamento', 'funcao');
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return 'Logout realizado com sucesso';
    }

    public function update($data)
    {
        $user = Auth::user();
        $user->update($data);
        return $user->load('departamento', 'funcao');
    }

    public function getAuth()
    {
        if (Auth::check()){

            return Auth::user();
        
        }else{

            return null;

        }
    }

    public function bestUser()
    {

        return Desempenho::with('user')
        ->orderByDesc('nivel')
        ->first();

    }

    public function userSuspended()
    {
        return User::where('efectividade', 'Suspenso')->count();
    }

    public function activeUsers()
    {
       return User::where('efectividade', 'Activo')->count(); 
    }

    public function depAllUser(){

        if (Auth::user()->funcao->denominacao === 'Gest' || Auth::user()->funcao->denominacao === 'Admin'){

            if (Auth::user()->funcao->denominacao === 'Admin'){

                return User::with('departamento','funcao')->get();

            }else{

                return User::with('departamento','funcao')->where('id', '!=', Auth::user()->id)->where('id', '!=', 1)->get();
            
            }   

        }else{

            return "Não tem permissão para tal";

        }

    }

}
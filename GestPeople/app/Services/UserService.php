<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Suspensao;
use App\Models\Desempenho;

class UserService
{

    public function create($dados){

        $user = User::create($dados);

        Suspensao::create(['user_id' => $user->id,]);

        return $user;
    }

    public function view(){

        return User::with('departamento', 'funcao', 'ultSuspensao')->get();
    }

    public function login($request)
    {
        if (Auth::check()){

            Auth::user()->tokens()->delete();

        }

        if (!Auth::attempt($request->only('email', 'password'))){

            return response()->json(['messege' => 'Credenciais Inválidas']);

        } else {

            $user = Auth::user();
            return $user->load('departamento', 'funcao', 'ultSuspensao');
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
        return $user->load('departamento', 'funcao', 'ultSuspensao');
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
        return User::with('ultSuspensao')->get();
    }

    public function activeUsers()
    {
       return User::with('ultSuspensao'); 
    }

    public function depAllUser(){

        if (Auth::user()->funcao->denominacao === 'Gest' || Auth::user()->funcao->denominacao === 'Admin'){

            if (Auth::user()->funcao->denominacao === 'Admin'){

                return User::with('departamento','funcao', 'ultSuspensao')->get();

            }else{

                return User::with('departamento','funcao', 'ultSuspensao')->where('id', '!=', Auth::user()->id)->where('id', '!=', 1)->get();
            
            }   

        }else{

            return "Não tem permissão para tal";

        }

    }

}
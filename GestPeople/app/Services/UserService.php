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
        ->take(3)
        ->get()
        ->map(function ($item) {
            return [
                'name' => $item->user->first_name . ' ' . $item->user->last_name,
                'score' => $item->nivel
            ];
        });
    }

    public function userSuspended()
    {
        return User::where('efectividade', 'Suspenso')->count();
    }

    public function activeUsers()
    {
       return User::where('efectividade', 'Activo')->count(); 
    }

}
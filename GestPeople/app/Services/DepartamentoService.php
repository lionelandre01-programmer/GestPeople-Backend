<?php

namespace App\Services;

use App\Models\Departamento;
use App\Models\Desempenho;
use App\Models\User;

class DepartamentoService
{

    public function create($dados){

        return Departamento::create($dados);
    }

    public function show(){

        return Departamento::all();
    }

    public function usersCount()
    {
        $members = (object) [];

        $departamentos = Departamento::all();

        foreach($departamentos as $departamento){

            $members->{$departamento->denominacao} = User::where('departamento_id', $departamento->id)->count();
        }

        $total = Departamento::count();

        $userCount = (object) [
            'total' => $total,
            'members' => $members
        ];

        return $userCount;

    }

    public function eachDep($id)
    {

        $dep = Departamento::find($id);

        if (User::with('ultDesempenho')->where('departamento_id', $id)->exists()){

            $users = User::with('ultDesempenho', 'funcao', 'ultSuspensao')->where('departamento_id', $id)->get();
        
        }else{

            $users = User::where('departamento_id', $id)->get();

        }
        
        $members = User::where('departamento_id', $id)->count();
        $bestUser = Desempenho::whereHas('user', function($query) use ($id){
            $query->where('departamento_id', $id);
        })->orderBy('created_at', 'desc')->first();

        return [
            'dep' => $dep,
            'users' => $users,
            'members' => $members,
            'best' => $bestUser ? $bestUser->load('user') : null
        ];
    }

}
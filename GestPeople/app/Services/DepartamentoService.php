<?php

namespace App\Services;

use App\Models\Departamento;
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

}
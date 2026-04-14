<?php

namespace App\Services;

use App\Models\Funcao;
use App\Models\User;

class FuncaoService
{

    public function create($dados){

        return Funcao::create($dados);
    }

    public function show(){

        return Funcao::all();
    }

    public function usersCount()
    {
        $roles = (object) [];
        $funcaos = Funcao::all();

        foreach($funcaos as $funcao){

            $roles->{$funcao->denominacao} = User::where('funcao_id', $funcao->id)->count();
        }

        return $roles;
    }

    public function countFun()
    {
        return User::where('funcao_id', 2)->count();
    }

}
<?php

namespace App\Services;

use App\Models\Presenca;
use App\Models\User;

class PresencaService
{

    public function index(){
    
        $user = User::withCount([
            'presenca as presencas_total' => function ($query){
                $query->where('presente', true);
            }, 
            'presenca as faltas_total' => function ($query){
                $query->where('presente', false);
            }, 
            'presenca as justificadas' => function ($query){
                $query->where('justificada', true)->where('presente', false);
            }, 
            'presenca as nao_justificadas' => function ($query){
                $query->where('justificada', false)->where('presente', false);
            }
        ])->get();

        return $user->load('departamento', 'funcao');

    }

    public function show($id){

        $user = User::find($id);
        $faltas = Presenca::where('user_id', $user->id)->where('presente', false)->get();

        return [
            'user' => $user->load('presenca'),
            'faltas' => $faltas
        ];

    }

    public function create($validatedData){

        Presenca::create($validatedData);

        return 'Presença Cadastrada Com Sucesso!';

    }

}
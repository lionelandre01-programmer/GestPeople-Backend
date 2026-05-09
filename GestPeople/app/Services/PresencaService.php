<?php

namespace App\Services;

use App\Models\Presenca;
use App\Models\User;

class PresencaService
{

    public function index(){
    
        $user = User::withCount([
            'presenca as presencas_total' => function ($query){
                $query->where('status', 'presente');
            }, 
            'presenca as faltas_total' => function ($query){
                $query->where('status', 'ausente');
            }, 
            'presenca as justificadas' => function ($query){
                $query->where('justificada', true)->where('status', 'ausente');
            }, 
            'presenca as nao_justificadas' => function ($query){
                $query->where('justificada', false)->where('status', 'ausente');
            }
        ])->get();

        return $user->load('departamento', 'funcao', 'ultSuspensao');

    }

    public function show($id){

        $user = User::find($id);
        $faltas = Presenca::where('user_id', $user->id)->where('status', 'ausente')->get();

        return [
            'user' => $user->load('presenca','ultSuspensao'),
            'faltas' => $faltas
        ];

    }

    public function create($validatedData){

        Presenca::create($validatedData);

        return 'Presença Cadastrada Com Sucesso!';

    }

}
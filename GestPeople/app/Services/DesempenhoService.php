<?php

namespace App\Services;

use App\Models\Desempenho;
use App\Models\User;

class DesempenhoService{

    public function index()
    {
        return User::with('ultDesempenho', 'departamento', 'funcao', 'ultSuspensao')->get()->sortByDesc(function($user){
            return $user->ultDesempenho->nivel ?? 0;
        })->values();
    }

    public function create($request)
    {
        if ($request->action === '+'){

            if (Desempenho::where('user_id', $request->user_id)->exists()){

                $recent = Desempenho::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->first();

                $desempenho = new Desempenho;
                $desempenho->user_id = $request->user_id;
                $desempenho->nivel = $recent->nivel + 10;
                $desempenho->save();

            }else{

                $desempenho = new Desempenho;
                $desempenho->user_id = $request->user_id;
                $desempenho->nivel = 10;
                $desempenho->save();

            }

            return 'Nível de desempenho adicionado!';

        }else{

            if (Desempenho::where('user_id', $request->user_id)->exists()){

                $recent = Desempenho::where('user_id', $request->user_id)->orderBy('created_at', 'desc')->first();

                if ($recent->nivel === 0){

                    return 'Não pode mais baixar o nível de desempenho';

                }else{

                    $desempenho = new Desempenho;
                    $desempenho->user_id = $request->user_id;
                    $desempenho->nivel = $recent->nivel - 10;
                    $desempenho->save();

                    return 'Nível de desempenho reduzido!';

                }

            }else{

                return 'Não pode baixar o nível de desempenho!';

            }

        }
    }

}
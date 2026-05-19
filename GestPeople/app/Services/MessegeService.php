<?php

namespace App\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Messege;

class MessegeService
{

    /*
    Função responsável por listar as mensagens do usuário logado,
    ordenando da mais recente para a mais antiga
    */
    public function index()
    {
        $message = Messege::where(function ($query) {
                    $query->where('from_user_id', Auth::id())
                        ->orWhere('to_user_id', Auth::id());
                })
                ->latest()
                ->get()
                ->groupBy(function ($message) {

                    return $message->from_user_id == Auth::id()
                        ? $message->to_user_id
                        : $message->from_user_id;
                })
                ->map(function ($group) {
                    return $group->first();
                })->values();

        return [
            'eachUser' => $message->load(['fromUser','toUser']),
            'allMessege' => Messege::with(['fromUser','toUser'])->where('from_user_id', Auth::id())
                ->orWhere('to_user_id', Auth::id())->get()
        ];

    }

    public function store($dados)
    {
        Messege::create($dados);

        return "Mensagem Enviada";

    }

}
<?php

namespace App\Http\Controllers;

use App\Models\Messege;
use Illuminate\Http\Request;
use App\Services\MessegeService;
use App\Http\Requests\StoreMessegeRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MessegeController extends Controller
{
    use AuthorizesRequests;
    protected $messegeService;

    public function __construct(MessegeService $messegeService)
    {
        $this->messegeService = $messegeService;
    }

    /*
    Função responsável por listar as mensagens do usuário logado, 
    ordenando da mais recente para a mais antiga
     */
    public function index()
    {
        $this->authorize('viewAny', Messege::class);

        return response()->json($this->messegeService->index());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /*
        Função que cadastra a mensagem enviada
     */
    public function store(StoreMessegeRequest $request)
    {
        $this->authorize('viewAny', Messege::class);

        $validatedData = $request->validated();

        return response()->json($this->messegeService->store($validatedData));

    }

    /**
     * Display the specified resource.
     */
    public function show(Messege $messege)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Messege $messege)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Messege $messege)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Messege $messege)
    {
        //
    }
}

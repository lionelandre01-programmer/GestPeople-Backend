<?php

namespace App\Http\Controllers;

use App\Models\Funcao;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\FuncaoService;
use App\Http\Requests\StoreFuncaoRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FuncaoController extends Controller
{
    use AuthorizesRequests;
    protected $funcaoService;

    public function __construct(FuncaoService $funcaoService)
    {
        $this->funcaoService = $funcaoService;
    }

    /*
    Função responsável por trazer os cargos e os usuários para 
    saber o número de usuários que desempenham uma função
    */
    public function index()
    {
        $this->authorize('viewAny', Funcao::class);

        $dados = $this->funcaoService->index();

        return response()->json([
            'funcao' => $dados['funcao'],
            'members' => $dados['members']
        ]);
    }

    //Função responsável por cadastrar funções ou cargos
    public function store(StoreFuncaoRequest $request)
    {

        $this->authorize('create', Funcao::class);
            
        $validatedData = $request->validated();

        $departamento = $this->funcaoService->create($validatedData);

        return response()->json(['message' => 'Função cadastrada com sucesso']);

    }

    /*
    Função que traz todos os cargos
     */
    public function show()
    {
        $this->authorize('viewAny', Funcao::class);

        $funcao = $this->funcaoService->show();

        return response()->json($funcao);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcao $funcao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcao $funcao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcao $funcao)
    {
        //
    }

    /*
    Função responsável por trazer os cargos 
    e o número de membros que as desempenham
    */
    public function usersCount()
    {
        $this->authorize('viewAny', Funcao::class);

        $users = $this->funcaoService->usersCount();

        return response()->json($users);
    }

    /*
    Função responsável por trazer o total de cargos 
    */
    public function countFun()
    {
        $this->authorize('viewAny', Funcao::class);

        $count = $this->funcaoService->countFun();

        return response()->json(['count' => $count]);
    }
}

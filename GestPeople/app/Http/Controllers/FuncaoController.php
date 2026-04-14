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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFuncaoRequest $request)
    {
        if (Funcao::where('denominacao', $request->denominacao)->exists()){

            return response()->json(['message' => 'A Função já existe!']);
            
        } else {

            if (User::count() != 0){

                $this->authorize('create', Funcao::class);
            }
            
            $validatedData = $request->validated();

            $departamento = $this->funcaoService->create($validatedData);

            return response()->json(['message' => 'Função cadastrada com sucesso']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
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

    public function usersCount()
    {
        $this->authorize('viewAny', Funcao::class);

        $users = $this->funcaoService->usersCount();

        return response()->json($users);
    }

    public function countFun()
    {
        $this->authorize('viewAny', Funcao::class);

        $count = $this->funcaoService->countFun();

        return response()->json(['count' => $count]);
    }
}

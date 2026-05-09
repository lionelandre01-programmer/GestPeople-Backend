<?php

namespace App\Http\Controllers;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartamentoRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\DepartamentoService;
use Illuminate\Support\Facades\Auth;

class DepartamentoController extends Controller
{
    use AuthorizesRequests;
    protected $departamentoService;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function __construct(DepartamentoService $departamentoService)
    {
        $this->departamentoService = $departamentoService;
    }

    /*
    Função para cadastrar departamentos
     */
    public function store(StoreDepartamentoRequest $request)
    {
        if (Departamento::where('denominacao', $request->denominacao)->exists()){

            return response()->json(['message' => 'O Departamento já existe!']);
            
        } else {

                if (User::count() != 0){

                $this->authorize('create', Departamento::class);
            }
            
            $validatedData = $request->validated();

            $departamento = $this->departamentoService->create($validatedData);

            return response()->json(['message' => 'Departamento criado com sucesso']);
        }

    }

    /*
    Função que retorna todos os departamentos
     */
    public function show()
    {

        $departamento = $this->departamentoService->show();

        return response()->json($departamento);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departamento $departamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        //
    }

    /*
    Função que retorna o número de usuários por departamento
    */
    public function usersCount()
    {
        $this->authorize('view', Departamento::class);

        $countUsers = $this->departamentoService->usersCount();

        return response()->json($countUsers);
    }

    /*
    Função que retorna um departamento específico e suas informações
    */
    public function eachDep($id)
    {
        $this->authorize('view', Departamento::class);

        $dados = $this->departamentoService->eachDep($id);

        return response()->json([
            'members' => $dados['members'],
            'dep' => $dados['dep'],
            'users' => $dados['users'],
            'bestUser' => $dados['best']
        ]);
    }
}

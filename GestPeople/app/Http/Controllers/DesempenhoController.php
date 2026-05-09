<?php

namespace App\Http\Controllers;

use App\Models\Desempenho;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDesempenhoRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\DesempenhoService;

class DesempenhoController extends Controller
{

    use AuthorizesRequests;
    protected $desempenhoService;

    public function __construct(DesempenhoService $desempenhoService)
    {
        $this->desempenhoService = $desempenhoService;
    }
    /*
    Função que traz todos os usuários e seus desempenhos
     */
    public function index()
    {
        $this->authorize('viewAny', Desempenho::class);

        $users = $this->desempenhoService->index();

        return response()->json($users);
    }

    /*
    Função para registrar desempenho de um usuário
     */
    public function create(Request $request)
    {
        $this->authorize('viewAny', Desempenho::class);

        return response()->json($this->desempenhoService->create($request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Desempenho $desempenho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desempenho $desempenho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desempenho $desempenho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desempenho $desempenho)
    {
        //
    }
}

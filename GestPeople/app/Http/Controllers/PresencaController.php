<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use Illuminate\Http\Request;
use App\Http\Requests\StorePresencaRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\PresencaService;

class PresencaController extends Controller
{
    use AuthorizesRequests;
    protected $userService;

    public function __construct(PresencaService $presencaService)
    {
        $this->presencaService = $presencaService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Presenca::class);

        return response()->json(['user' => $this->presencaService->index()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresencaRequest $request)
    {

        $this->authorize('viewAny', Presenca::class);

        $validatedData = $request->validated();

        return response()->json($this->presencaService->create($validatedData));
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->authorize('viewAny', Presenca::class);

        $dados = $this->presencaService->show($id);

        return response()->json([
            'user' => $dados['user'],
            'falta' => $dados['faltas']
            ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Presenca $presenca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Presenca $presenca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presenca $presenca)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSalaryRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\SalaryService;

class SalaryController extends Controller
{

    use AuthorizesRequests;
    protected $salaryService;

    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Salary::class);

        return response()->json($this->salaryService->index());
    }

    /*
    Função responsável por cadastrar os salários
     */
    public function store(StoreSalaryRequest $request)
    {
        $this->authorize('viewAny', Salary::class);

        $validatedData = $request->validated();

        return response()->json($this->salaryService->create($validatedData));

    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        //
    }
}

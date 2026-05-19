<?php

namespace App\Services;

use App\Models\Salary;
use App\Models\User;
use App\Models\Desconto;
use App\Models\Presenca;
use App\Models\Desempenho;

class SalaryService
{

    //Função que traz todos os salários cadastrados
    public function index()
    {
        return Salary::all();
    }

    //Função que cadastra os salários
    public function create($dados)
    {
        Salary::create($dados);

        return "Salário Cadastrado com sucesso!";
    }

    public function show($id)
    {

        $user = User::with('funcao','departamento')->find($id);

        $salary = Salary::find($user->funcao->salary_id);

        $desconto = Desconto::find(1);

        $numFaltas = Presenca::where('user_id', $id)->where('status', 'ausente')->where('justificada', false)->where('liquidado', false)->count();
        $numAtrasos = Presenca::where('user_id', $id)->where('status', 'atrasado')->where('liquidado', false)->count();
        $numJustificadas = Presenca::where('user_id', $id)->where('status', 'ausente')->where('justificada', true)->where('liquidado', false)->count();
        $numDesemp = 1;//Desempenho::where('user_id', $id)->where('nivel', '<=', 30)->where('liquidado', false)->count();

        $salaryTotal = (($salary->salario + 
        ($salary->salario * (($salary->transporte + $salary->alimentacao + $salary->desempenho + $salary->presenca) / 100))) - 
        ($salary->salario * (($desconto->faltas * $numFaltas + $desconto->atrasos * $numAtrasos + $desconto->justificadas * $numJustificadas + $desconto->desempenho * $numDesemp) / 100)));

        return [
            'user' => $user,
            'salario' => $salary,
            'desconto' => $desconto,
            'faltas' => $numFaltas,
            'atrasos' => $numAtrasos,
            'justificadas' => $numJustificadas,
            'desempenhos' => $numDesemp,
            'salaryTotal' => $salaryTotal
        ];

    }

}
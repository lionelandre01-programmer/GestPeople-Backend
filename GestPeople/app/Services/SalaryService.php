<?php

namespace App\Services;

use App\Models\Salary;
use App\Models\User;

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

}
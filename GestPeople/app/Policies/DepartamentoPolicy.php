<?php

namespace App\Policies;

use App\Models\Departamento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class DepartamentoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        $user = Auth::user();

        return $user 
            && $user->funcao 
            && $user->funcao->denominacao === 'Admin' 
            || $user->funcao->denominacao === 'Gest';
    }

    /**
     * Determine whether the user can create models.
     * Podendo retornar Auth()->user()->role === 'admin'
     */
    public function create(): bool
    {
        return Auth::user()->Funcao()->denominacao == "Admin" || Auth::user()->Funcao()->denominacao == "Gestor";
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Departamento $departamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Departamento $departamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Departamento $departamento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Departamento $departamento): bool
    {
        return false;
    }
}

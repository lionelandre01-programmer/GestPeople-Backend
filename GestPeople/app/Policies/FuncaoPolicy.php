<?php

namespace App\Policies;

use App\Models\Funcao;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class FuncaoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        $user = Auth::user();

        return $user 
            && $user->funcao 
            && $user->funcao->denominacao === 'Admin' 
            || $user->funcao->denominacao === 'Gest';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        $user = Auth::user();

        return $user 
            && $user->funcao 
            && $user->funcao->denominacao === 'Admin' 
            || $user->funcao->denominacao === 'Gest';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Funcao $funcao): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Funcao $funcao): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Funcao $funcao): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Funcao $funcao): bool
    {
        return false;
    }
}

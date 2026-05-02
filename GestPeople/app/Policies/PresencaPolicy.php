<?php

namespace App\Policies;

use App\Models\Presenca;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;

class PresencaPolicy
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
    public function view(User $user, Presenca $presenca): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Presenca $presenca): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Presenca $presenca): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Presenca $presenca): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Presenca $presenca): bool
    {
        return false;
    }
}

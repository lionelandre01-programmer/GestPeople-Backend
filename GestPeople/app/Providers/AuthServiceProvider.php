<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Departamento;
use App\Policies\DepartamentoPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
    *O mapeamento do policy
    */

    protected $policies = [
        Departamento::class => DepartamentoPolicy::class,
    ];


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

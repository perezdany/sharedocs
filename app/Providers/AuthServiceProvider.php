<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define("admin", function(User $user){
            
            return $user->hasGroupe("Admin");
            
        });

        Gate::define("honneur", function(User $user){
           
            return $user->hasGroupe("Membre d'honneur");
            
        });

        Gate::define("direction", function(User $user){
           
            return $user->hasGroupe("Direction");
            
        });
        Gate::define("member", function(User $user){
           
            return $user->hasGroupe("Membre");
            
        });

        //GATE POUR SUPPRIMER
        Gate::define("delete", function(Utilisateur $user){
            return $user->hasPermission("Suppression");
        });

        Gate::define("edit", function(Utilisateur $user){
            return $user->hasPermission("Ecriture");
        });

        Gate::define("procuration", function(Utilisateur $user){
            return $user->hasPermission("Procuration");
        });
    }
}

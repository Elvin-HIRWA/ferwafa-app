<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('is-admin', function ($user) {
            $arrayOfUsersAndTheirPermissions = DB::selectOne(
                "SELECT u.email as userEmail, p.name as `permissionName`
                FROM users AS u 
                INNER JOIN KeyPermission AS k  
                ON u.keyID = k.id 
                INNER JOIN Permission AS p 
                ON k.PermissionID = p.id
                WHERE u.id = ?",
                [$user->id]
            );

            if ($arrayOfUsersAndTheirPermissions) {
                if ($arrayOfUsersAndTheirPermissions->permissionName == 'admin') {
                    return true;
                }
            }
        });

        Gate::define('is-competition-manager', function ($user) {
            $arrayOfUsersAndTheirPermissions = DB::selectOne(
                "SELECT u.email as userEmail, p.name as `permissionName`
                FROM users AS u 
                INNER JOIN KeyPermission AS k  
                ON u.keyID = k.id 
                INNER JOIN Permission AS p 
                ON k.PermissionID = p.id
                WHERE u.id = ?",
                [$user->id]
            );

            if ($arrayOfUsersAndTheirPermissions) {
                if ($arrayOfUsersAndTheirPermissions->permissionName == 'competition-manager') {
                    return true;
                }
            }
        });

        Gate::define('is-dcm', function ($user) {
            $arrayOfUsersAndTheirPermissions = DB::selectOne(
                "SELECT u.email as userEmail, p.name as `permissionName`
                FROM users AS u 
                INNER JOIN KeyPermission AS k  
                ON u.keyID = k.id 
                INNER JOIN Permission AS p 
                ON k.PermissionID = p.id
                WHERE u.id = ?",
                [$user->id]
            );

            if ($arrayOfUsersAndTheirPermissions) {
                if ($arrayOfUsersAndTheirPermissions->permissionName == 'dcm') {
                    return true;
                }
            }
        });

        Gate::define('is-hr', function ($user) {
            $arrayOfUsersAndTheirPermissions = DB::selectOne(
                "SELECT u.email as userEmail, p.name as `permissionName`
                FROM users AS u 
                INNER JOIN KeyPermission AS k  
                ON u.keyID = k.id 
                INNER JOIN Permission AS p 
                ON k.PermissionID = p.id
                WHERE u.id = ?",
                [$user->id]
            );

            if ($arrayOfUsersAndTheirPermissions) {
                if ($arrayOfUsersAndTheirPermissions->permissionName == 'hr') {
                    return true;
                }
            }
        });
    }
}

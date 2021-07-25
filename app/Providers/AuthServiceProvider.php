<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        try {
            $this->registerUserGates();
        } catch (Exception $e) {}
    }

    /**
     * @throws Exception
     */
    private function registerUserGates()
    {
        if (!Schema::hasTable('permissions')) {
            return;
        }

        /** @var Permission[]|Collection $permissions */
        $permissions = cache()->remember('all_permissions', now()->addHour(), function () {
            return Permission::all();
        });

        $permissions->map(function(Permission $permission) {
            Gate::define($permission->name, function(User $user) use ($permission) {
                return $user
                    ->role()
                    ->where('active', true)
                    ->whereHas('permissions', function (Builder $builder) use ($permission) {
                        $builder->where('permissions.id', $permission->id);
                    })
                    ->exists();
            });
        });
    }
}

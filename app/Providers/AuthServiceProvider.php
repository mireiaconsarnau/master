<?php

namespace App\Providers;

use App\Task;
use App\TrainUpload;
use App\Policies\TaskPolicy;
use App\Policies\TrainPolicy;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        TrainUpload::class => TrainPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        //

        $gate->define('see-admin-menu', function ($user) {
            if ($user->type==1) {
                return true;
            }
            return false;
        });
    }
}

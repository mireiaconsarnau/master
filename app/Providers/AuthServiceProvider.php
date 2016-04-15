<?php

namespace App\Providers;

use App\Task;
use App\User;
use App\TrainUpload;
use App\TestUpload;
use App\TestUploadAdmin;
use App\Policies\TaskPolicy;
use App\Policies\TrainPolicy;
use App\Policies\TestPolicy;
use App\Policies\TestAdminPolicy;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
        Task::class => TaskPolicy::class,
        TrainUpload::class => TrainPolicy::class,
        TestUpload::class => TestPolicy::class,
        TestUploadAdmin::class => TestAdminPolicy::class,
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
        $gate->define('see-user-menu', function ($user) {
            if ($user->type==2) {
                return true;
            }
            return false;
        });
    }
}

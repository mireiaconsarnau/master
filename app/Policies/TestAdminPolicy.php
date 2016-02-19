<?php

namespace App\Policies;


use App\User;
use App\TestUploadAdmin;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestAdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given train.
     *
     * @param  User  $user
     * @param  Test  $test
     * @return bool
     */
    public function destroy(User $user, TestUploadAdmin $testadmin)
    {
        return $user->id === $testadmin->user_id;
    }

    public function update(User $user, TestUploadAdmin $testadmin)
    {
        return $user->id === $testadmin->user_id;
    }
}

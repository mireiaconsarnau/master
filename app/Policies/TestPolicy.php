<?php

namespace App\Policies;


use App\User;
use App\TestUpload;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given train.
     *
     * @param  User  $user
     * @param  Test  $test
     * @return bool
     */
    public function destroy(User $user, TestUpload $test)
    {
        return $user->id === $test->user_id;
    }

    public function update(User $user, TestUpload $test)
    {
        return $user->id === $test->user_id;
    }
}

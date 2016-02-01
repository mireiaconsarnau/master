<?php

namespace App\Policies;


use App\User;
use App\TrainUpload;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given train.
     *
     * @param  User  $user
     * @param  Task  $train
     * @return bool
     */
    public function destroy(User $user, TrainUpload $train)
    {
        return $user->id === $train->user_id;
    }
}

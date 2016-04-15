<?php

namespace App\Policies;


use App\User;
use App\Task;
use App\TestUpload;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        //return $user->id === $task->user_id;
    }

    public function update(User $user, Task $task)
    {
        //return $user->id === $task->user_id;
    }


}

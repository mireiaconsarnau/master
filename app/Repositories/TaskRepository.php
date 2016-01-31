<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/01/16
 * Time: 16:28
 */

namespace App\Repositories;

use App\User;
use App\Task;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return Task::where('id_user', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
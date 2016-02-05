<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/01/16
 * Time: 16:28
 */

namespace App\Repositories;

use App\User;
use App\TestUpload;
use App\Task;

class TestRepository
{
    /**
     * Get all of the tests for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return TestUpload::where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->paginate(10);
    }
}
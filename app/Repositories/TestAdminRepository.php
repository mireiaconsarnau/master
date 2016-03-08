<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/01/16
 * Time: 16:28
 */

namespace App\Repositories;

use App\User;
use App\TestUploadAdmin;
use App\Task;

class TestAdminRepository
{
    /**
     * Get all of the tests for all users.
     *

     * @return Collection
     */
    public function forUser()
    {
        return TestUploadAdmin::orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31/01/16
 * Time: 16:28
 */

namespace App\Repositories;

use App\User;
use App\TrainUpload;

class TrainRepository
{
    /**
     * Get all of the trains for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return TrainUpload::where('user_id', $user->id)
            ->groupBy('associated_user_id')
            ->orderBy('associated_user_id', 'asc')
            ->paginate(5);
    }

}
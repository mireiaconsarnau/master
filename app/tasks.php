<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_task', 'available'];
}

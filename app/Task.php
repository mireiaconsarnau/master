<?php

namespace App;

use App\User;
use App\TestUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;



class Task extends Model
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
    protected $fillable = ['name_task','available'];


    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the tests for the task.
     */
    public function tests()
    {
        return $this->hasMany(TestUpload::class);
    }


    /**
     * Scope a query to only include available tasks.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('available', 'On');
    }
}

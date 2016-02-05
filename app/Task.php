<?php

namespace App;

use App\User;
use App\TestUpload;
use Illuminate\Database\Eloquent\Model;

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
     * Get all of the available tasks
     *
     *
     * @return Collection
     */
    public function allAvailableTasks()
    {
        return Task::where('available=on')
            ->orderBy('created_at', 'asc')
            ->get();
    }
}

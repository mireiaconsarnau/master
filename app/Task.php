<?php

namespace App;

use App\User;
use App\TestUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


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
    public function scopeAvailable($query,$user)
    {


        $select2= DB::table('tasks')
            ->join('test_uploads','tasks.id','=','test_uploads.task_id')
            ->select('tasks.id')
            ->where('test_uploads.user_id', '=',$user->id);

        $numbers=$select2->get();
        $seq[]=0;
        foreach ($numbers as $number) {
            $seq[]=$number->id;
        }

        $select1= DB::table('tasks')
            ->select('tasks.*')
            ->where('available', 'On' )
            ->whereNotIn('id',$seq);
            //->toSql();

       // dd($select1);

        return $select1;


    }

    public function scopeTasques($query)
    {


        $select1= DB::table('tasks')
            ->select('tasks.*')
            ->orderBy('created_at', 'asc')
            ->paginate(1);
        return $select1;


    }




}

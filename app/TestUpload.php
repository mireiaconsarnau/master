<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TrainUpload;
use App\Task;
use Illuminate\Support\Facades\DB;

class TestUpload extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'test_uploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_test','name_test','task_id','ip','countryCode','countryName','cityName'];

    /**
     * Get the user that owns the test.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    /**
     * Get the task that owns the test.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function scopeNTests($query)
    {


        $select1= DB::table('test_uploads')
            ->select('test_uploads.*')
            ->orderBy('created_at', 'asc');
        return $select1;


    }
    public function scopeLastTests($query)
    {


        $select1= "SELECT * FROM test_uploads ORDER BY created_at DESC LIMIT 4";
        return DB::select($select1);


    }

}

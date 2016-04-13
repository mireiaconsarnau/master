<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\TrainUpload;
use App\Task;
use Illuminate\Support\Facades\DB;

class TestUploadAdmin extends Model
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
    public function scopeTestsfortask($query,$task_id)
    {



        $select1= DB::table('test_uploads')
            ->select('test_uploads.*')
            ->where('task_id', $task_id );
        //->toSql();

        // dd($select1);

        return $select1;


    }


}

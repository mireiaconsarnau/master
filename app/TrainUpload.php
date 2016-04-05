<?php

namespace App;

use App\User;
use App\TestUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrainUpload extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'train_uploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_train','name_train','associated_user_id'];

    /**
     * Get the user that owns the test.
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
    public function scopeTrainfiles($query,$user)
    {


        $select1= DB::table('train_uploads')
            ->select('train_uploads.*');


        //->toSql();

        // dd($select1);

        return $select1;


    }
    public function scopeTrainid($query,$associated_user_id)
    {


      /* $select1= DB::table('train_uploads')
            ->select('train_uploads.*')
            ->whereAssociated_user_id($associated_user_id)


        ->toSql();*/
        //echo $select1;
        // dd($select1);

        return $query->whereAssociated_user_id($associated_user_id);


    }

    public function scopeTrainsforassociateduser($query,$associated_user_id)
    {



        $select1= DB::table('train_uploads')
            ->select('train_uploads.*')
            ->where('associated_user_id', $associated_user_id );
        //->toSql();

        // dd($select1);

        return $select1;


    }
}

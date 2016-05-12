<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use App\TrainUpload;
use App\TestUpload;
use App\Task;


class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get all of the tasks for the user.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get all of the trains for the user.
     */
    public function trains()
    {
        return $this->hasMany(TrainUpload::class);
    }
    /**
     * Get all of the trains for the user.
     */
    public function trains2()
    {
        return $this->hasMany(TrainUpload::class,'associated_user_id');
    }

    /**
     * Get all of the tests for the user.
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



        /*$select2= DB::table('users')
            ->join('train_uploads','users.id','=','train_uploads.associated_user_id')
            ->select('users.id');
            //->where('train_uploads.associated_user_id', '=',$user->id);

        $numbers=$select2->get();
        $seq[]=0;
        foreach ($numbers as $number) {
            $seq[]=$number->id;
        }*/

        $select1= DB::table('users')
            ->select('users.*')
            ->where('type', 2 );
            //->whereNotIn('id',$seq);
        //->toSql();

        // dd($select1);

        return $select1;


    }
    public function scopeUsersNoAdmin($query)
    {


        $select1= DB::table('users')
            ->select('users.*')
            ->where('type', 2 );
        return $select1;


    }

    public function scopeNUsersStandard($query)
    {


        $select1= DB::table('users')
            ->select('users.*')
            ->where('type', 2 )
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        return $select1;


    }
    public function scopeNUsersAdmin($query)
    {


        $select1= DB::table('users')
            ->select('users.*')
            ->where('type', 1 )
        ->orderBy('created_at', 'asc');
        return $select1;


    }

}

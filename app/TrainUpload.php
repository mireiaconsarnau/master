<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

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
    protected $fillable = ['file_train','name_train'];

    /**
     * Get the user that owns the train.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

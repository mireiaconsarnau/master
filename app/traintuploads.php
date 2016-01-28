<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class traintuploads extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'traintuploads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['file_train', 'name_train'];
}

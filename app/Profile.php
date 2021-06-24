<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    public $table = 'profiles';



    protected $fillable = [
        'name',
        'email',
        'image',

    ];
}

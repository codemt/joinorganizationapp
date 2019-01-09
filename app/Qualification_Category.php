<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification_Category extends Model
{
    protected $table = 'qualification_category';

    protected $fillable = [
        'name'
    ];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brochure extends Model
{
    use SoftDeletes;

    protected $fillable = [
    	'title',
    	'description',
    	'thumbnail',
    	'file',
    ];
}

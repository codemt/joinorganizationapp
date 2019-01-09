<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Samiti extends Model
{

	protected $table = 'samiti';

    protected $fillable = [
    	'name','samiti_year','valid_till','members','regions','admin_id'
    ];
}

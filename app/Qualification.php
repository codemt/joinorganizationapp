<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = 'qualification';

    protected $fillable = [
        'name','type','category'
    ];

     public function qualification_category()
    {
        return $this->belongsTo(Qualification_Category::class, 'category');
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Member;

class Family extends Model
{

    protected $table = 'family';

    protected $fillable = [
    	'member_id','relation_name','relation_member_id','relation_member_name','dob','approval_status_regional','approval_status_super_admin','dom','blood_group','qualification'
    ];

     public function members()
    {
        return $this->belongsTo(Member::class, 'relation_member_id');
    }

}

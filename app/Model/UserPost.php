<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    Protected $fillable = ['description','created_by','status'];

    public function user()
    {
    	return $this->hasOne(User::class,'id','created_by');
    }
}

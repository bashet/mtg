<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}

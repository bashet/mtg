<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['name', 'active'];
    protected $fillable = ['name', 'active'];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function abilities() {
        return $this->hasMany('App\RoleAbility');
    }
}

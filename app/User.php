<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use CausesActivity;

    protected $dates = ['deleted_at', 'last_login'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verify_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function scopeArchived($query){
        return $query->where('active', 0)->get();
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }

    public function abilities()
    {
        return $this->hasMany('App\UserAbility');
    }

    public function hasRole($name){
        foreach ($this->roles as $role){
            if($role->name == $name){
                return true;
            }
        }
        return false;
    }

    public function isAllowed( $to_do_this_task ) {
        $allow = false;
        if($this->hasRole('admin')){
            return true; // if the user role is administrator, grant permission
        }else{
            // check ability for this role
            $roles = $this->roles;
            foreach ($roles as $role){
                $roleAbilities = $role->abilities;
                foreach ($roleAbilities as $ability){
                    if($ability->ability == $to_do_this_task){
                        if($ability->allow){
                            $allow = true;
                        }
                        break;
                    }
                }
            }
        }
        // override ability according to user specific, if there is any
        $userAbility = $this->abilities->where('ability', $to_do_this_task)->first();
        if($userAbility){
            if($userAbility->allow){
                $allow = true;
            }else{
                $allow = false;
            }
        }
        return $allow;
    }

    public function roleAll(){
        $data = collect([]);
        foreach ($this->roles as $role){
            $data->push($role->name);
        }
        return $data;
    }

}

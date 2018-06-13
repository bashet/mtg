<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class RoleAbility extends Model
{
    use LogsActivity;
    protected static $logAttributes = ['role_id', 'ability', 'allow'];
    protected $fillable = ['role_id', 'ability', 'allow'];
}

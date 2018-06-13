<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class UserAbility extends Model
{
    Use LogsActivity;

    protected static $logAttributes = ['user_id', 'ability', 'allow'];
    protected $fillable = ['user_id', 'ability', 'allow'];
}

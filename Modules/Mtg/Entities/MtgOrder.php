<?php

namespace Modules\Mtg\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;

class MtgOrder extends Model
{

    use Notifiable, LogsActivity;

    protected $fillable = [];

    public function statuses(){
        return $this->hasMany('Modules\Mtg\Entities\MtgOrderStatus');
    }

    public function items(){
        return $this->hasMany('Modules\Mtg\Entities\MtgOrderDetails');
    }
}

<?php

namespace Modules\Mtg\Entities;

use Illuminate\Database\Eloquent\Model;

class MtgOrderStatus extends Model
{
    protected $fillable = ['order_id', 'status_id'];
}

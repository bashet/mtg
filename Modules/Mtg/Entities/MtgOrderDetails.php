<?php

namespace Modules\Mtg\Entities;

use Illuminate\Database\Eloquent\Model;

class MtgOrderDetails extends Model
{
    protected $fillable = [];

    public function card(){
        return $this->belongsTo('Modules\Mtg\Entities\MtgCard', 'card_id');
    }
}

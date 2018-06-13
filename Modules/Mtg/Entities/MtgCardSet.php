<?php

namespace Modules\Mtg\Entities;

use Illuminate\Database\Eloquent\Model;

class MtgCardSet extends Model
{
    protected $fillable = [];

    public function cards(){
        return $this->hasMany('Modules\Mtg\Entities\MtgCard', 'cardSet', 'code');
    }

}

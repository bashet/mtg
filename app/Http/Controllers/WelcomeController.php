<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Mtg\Entities\MtgCardSet;

class WelcomeController extends Controller
{
    public function index(){
        $data = array();
        $sets = MtgCardSet::select('block', 'name', 'code', 'cardcount')
            ->where('block', '!=', '')
            ->where('onlineOnly', 0)
            ->orderBy('block', 'asc')
            ->orderBy('name')
            ->get();

        $data['sets'] = $sets;

        $first_set = $sets->first();
        $cards = $first_set->cards;
        $data['cards'] = $cards;

        return view('welcome', $data);
    }
}

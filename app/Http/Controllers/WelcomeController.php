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
        return view('welcome', $data);
    }
}

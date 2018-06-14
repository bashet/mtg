<?php

namespace Modules\Mtg\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Mtg\Entities\MtgCard;
use Modules\Mtg\Entities\MtgCardSet;

class MtgController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
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
        $data['first_set'] = $first_set;
        $cards = $first_set->cards;
        $data['cards'] = $cards;

        return view('mtg::index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('mtg::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('mtg::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('mtg::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function get_card_set_by_code($code){
        $set = MtgCardSet::where('code', '=', $code)->get()->first();
        $cards = $set->cards;

        return [
            'carousel' => view('mtg::carousel', ['cards' => $cards])->render(),
            'icon' => strtolower($set->code),
            'available_cards' => $cards->sum('qty'),
            'total_cards' => $cards->count()
        ];
    }

    public function add_to_cart(Request $request){
        return ['error' => false];
    }
}

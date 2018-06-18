<?php

Route::group(['middleware' => 'web', 'prefix' => 'mtg', 'namespace' => 'Modules\Mtg\Http\Controllers'], function()
{
    Route::get('/', 'MtgController@index');
    Route::get('get-card-set/{code}', 'MtgController@get_card_set_by_code');
    Route::post('add-to-cart', 'MtgController@add_to_cart');

    Route::get('show-cart', 'MtgController@show_cart');
});

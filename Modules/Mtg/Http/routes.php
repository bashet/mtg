<?php

Route::group(['middleware' => 'web', 'prefix' => 'mtg', 'namespace' => 'Modules\Mtg\Http\Controllers'], function()
{
    Route::get('/', 'MtgController@index');
    Route::get('get-card-set/{code}', 'MtgController@get_card_set_by_code');
});

<?php

Route::group(['middleware' => 'web', 'prefix' => 'mtg', 'namespace' => 'Modules\Mtg\Http\Controllers'], function()
{
    Route::get('/', 'MtgController@index');
});

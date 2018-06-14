<?php

Route::group(['middleware' => 'web', 'prefix' => 'user', 'namespace' => 'Modules\User\Http\Controllers'], function()
{
    Route::get('/', 'UserController@index');
    Route::get('view/{id?}', 'UserController@show');
    Route::get('edit/{id?}', 'UserController@edit_user');
    Route::post('edit/{id?}', 'UserController@update_user');
    Route::post('change-status', 'UserController@change_status');
    Route::get('delete/{id?}', 'UserController@delete');
    Route::get('add-new/{role?}', 'UserController@add_new_user');
    Route::post('add-new', 'UserController@insert_new_user');
    Route::post('change-password', 'UserController@change_password');
    Route::post('get-all-ajax', 'UserController@get_all_user_ajax');
    //Route::post('get-one-ajax', 'UserController@get_user_ajax');
    //Route::get('notifications', 'UserController@show_notifications');
    //Route::post('update-notification', 'UserController@update_notification_status');
    //Route::post('delete-notification', 'UserController@delete_notification');
    Route::get('get-all/{key?}/{term?}', 'UserController@get_all_user_for_type_ahead');
    Route::post('get_for_select2', 'UserController@get_for_select2');
});

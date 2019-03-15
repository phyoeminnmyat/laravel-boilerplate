<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Email\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('email/get', 'EmailTableController')->name('email.get');
            /*
             * User CRUD
             */
            Route::resource('email', 'EmailController');
});
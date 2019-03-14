<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\AppSetting\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('appsetting/get', 'AppSettingTableController')->name('appsetting.get');
            Route::post('appsetting/restore', 'AppSettingTableController@restore')->name('appsetting.restore');
            Route::post('appsetting/store', 'AppSettingController@storeAppSetting')->name('appsetting.appstore');

            /*
             * User CRUD
             */
            Route::resource('appsetting', 'AppSettingController');
});
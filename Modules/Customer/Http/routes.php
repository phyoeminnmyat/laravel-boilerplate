<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Customer\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('customer/get', 'CustomerTableController')->name('customer.get');
            Route::get('customer/deactivated', 'CustomerController@getDeactivated')->name('customer.deactivated');
            Route::get('customer/deleted', 'CustomerController@getDeleted')->name('customer.deleted');

            Route::get('customer/delete', 'CustomerController@permanentlyDelete')->name('customer.delete-permanently');
            Route::get('restore', 'CustomerController@restore')->name('customer.restore');




            /*
             * User CRUD
             */
            Route::resource('customer', 'CustomerController');
});
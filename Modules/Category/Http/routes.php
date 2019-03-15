<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('category/get', 'CategoryTableController')->name('category.get');
            /*
             * User CRUD
             */
            Route::resource('category', 'CategoryController');
});
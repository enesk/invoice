<?php
    /**
     * Frontend Controllers
     */
    Route::get('/', 'FrontendController@index')->name('frontend.index');
    Route::get('macros', 'FrontendController@macros')->name('frontend.macros');
    /**
     * These frontend controllers require the user to be logged in
     */
    Route::group(['middleware' => 'auth'], function () {
        Route::group(['namespace' => 'User'], function () {
            Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
            Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
            Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
            Route::patch('profile/settings/update',
                'DashboardController@saveSettings')->name('frontend.user.profile.settings.update');
        });
        Route::group(['namespace' => 'Ebay'], function () {
            Route::get('/ebay', [
                'as'   => 'ebay',
                'uses' => '\App\Http\Controllers\Frontend\eBay\TradingsController@index',
            ]);
            Route::get('/ebay/save', [
                'as'   => 'ebay.save',
                'uses' => '\App\Http\Controllers\Frontend\eBay\TradingsController@save',
            ]);
            Route::get('/ebay/invoice/download/{id}', [
                'as'   => 'invoice.download',
                'uses' => '\App\Http\Controllers\Frontend\InvoicesController@download',
            ]);
            Route::patch('/ebay/invoice/update', [
                'as'   => 'invoice.update',
                'uses' => '\App\Http\Controllers\Frontend\InvoicesController@update',
            ]);
            Route::get('/ebay/invoice/edit/{id}', [
                'as'   => 'invoice.edit',
                'uses' => '\App\Http\Controllers\Frontend\InvoicesController@edit',
            ]);
        });
    });




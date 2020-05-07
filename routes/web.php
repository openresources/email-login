<?php

Route::middleware('web')->group(
    function () {
        Route::namespace('Openresources\EmailLogin\Http\Controllers')
            ->prefix('/email-login')->name('email-login.')
            ->group(
                function () {
                    Route::get('/', 'Auth\LoginController@create')->name('create');
                    Route::post('/', 'Auth\LoginController@login')->name('login');
                    Route::get('/{token}', 'Auth\LoginController@authenticate')->name('authenticate');
                    Route::get('/status', 'StatusController@index')->name('status');
                    
                    Route::middleware('auth')->group(
                        function () {
                            Route::get('/password/reset', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
                            Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
                        }
                    );
                }
            );
    }
);

<?php

Route::middleware('web')->group(
    function () {
        Route::namespace('Openresources\EmailLogin\Http\Controllers')->group(
            function () {
                Route::name('email-login.')->group(function () {
                    Route::view('email-login', 'email-login::auth.email_login')
                        ->name('home');
                });
            }
        );
    }
);

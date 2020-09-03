<?php

Route::prefix('accounts')->group(function () {
    Route::get('{account}', 'AccountController@show')->name('accounts.show');
    Route::post('{account}/transactions', 'TransactionController@store')->name('transactions.store');
});

<?php

Route::prefix('accounts')->group(function () {
    Route::get('{account}', 'AccountController@show')->name('accounts.show');
    Route::post('{account}/transactions', 'TransactionController@store')->name('transactions.store');
    Route::get('{account}/transactions', 'TransactionController@show')->name('transactions.show');
});

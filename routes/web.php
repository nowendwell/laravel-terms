<?php

Route::namespace('\Nowendwell\LaravelTerms\Http\Controllers')->middleware('web')->prefix('terms')->name('terms.')->group(function () {
    Route::get('/latest', 'TermsController@show')->name('show');
    Route::post('/agree', 'TermsController@store')->name('store');
});

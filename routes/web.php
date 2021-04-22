<?php

Route::namespace('\Nowendwell\LaravelTerms\Http\Controllers')->middleware('web')->prefix('terms')->name('terms.')->group(function () {
    Route::get(config('terms.paths.latest_path'), 'TermsController@show')->name('show');
    Route::post(config('terms.paths.agree_path'), 'TermsController@store')->name('store');
});

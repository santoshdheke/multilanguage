<?php

use Illuminate\Support\Facades\Route;

$arr = [
    'prefix' => 'ssgroup-language',
    'as' => 'ssgroup-language.',
    'namespace' => 'Ssgroup\\Language\\Controllers',
];

if (config('languagesetup.middleware')) {
    $arr['middleware'] = config('languagesetup.middleware');
}

Route::group($arr, function () {
    Route::group(['prefix' => "admin"],function(){
        Route::resource('language', 'LanguageController');
    });
    Route::post('backup', 'LanguageApiController@public')->name("language.backup");
    Route::post('public', 'LanguageApiController@public');
    Route::apiResource('language', 'LanguageApiController')->except(['show']);
});

<?php

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth.role:3',
    'as' => 'admin.',
    'namespace' => 'App\Modules\Banners\Controllers'], function() {
    
    Route::group(['prefix' => 'banners', 'as' => 'banners.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'BannerController@index']);
        Route::get('{banner}/detalhes', ['as' => 'details', 'uses' => 'BannerController@details']);
        Route::get('criar', ['as' => 'create', 'uses' => 'BannerController@create']);
        Route::post('salvar', ['as' => 'store', 'uses' => 'BannerController@store']);
        Route::get('{banner}/editar', ['as' => 'edit', 'uses' => 'BannerController@edit']);
        Route::post('atualizar', ['as' => 'update', 'uses' => 'BannerController@update']);
        Route::get('{banner}/status', ['as' => 'status', 'uses' => 'BannerController@status']);
        Route::get('{banner}/excluir', ['as' => 'remove', 'middleware' => 'auth.role:2', 'uses' => 'BannerController@remove']);
    });
    
});


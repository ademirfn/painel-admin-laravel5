<?php

Route::group([
    'prefix' => 'admin', 
    'middleware' => 'auth.role:3', 
    'as' => 'admin.', 
    'namespace'=>'App\Modules\Blog\Controllers'], function(){

    //ROTAS DE POSTS
    Route::group(['prefix' => 'artigos', 'as' => 'posts.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'PostsController@index']);
        Route::get('{post}/detalhes', ['as' => 'details', 'uses' => 'PostsController@details']);
        Route::get('criar', ['as' => 'create', 'uses' => 'PostsController@create']);
        Route::post('salvar', ['as' => 'store', 'uses' => 'PostsController@store']);
        Route::get('{post}/editar', ['as' => 'edit', 'uses' => 'PostsController@edit']);
        Route::post('atualizar', ['as' => 'update', 'uses' => 'PostsController@update']);
        Route::get('{post}/status', ['as' => 'status', 'uses' => 'PostsController@status']);
        Route::get('{post}/excluir', ['as' => 'remove', 'middleware' => 'auth.role:2', 'uses' => 'PostsController@remove']);
    });

    //ROTAS DE COMENTÁRIOS
    Route::group(['prefix' => 'comentarios', 'as' => 'comments.'], function () {
        Route::get('', ['as' => 'index', 'uses' => 'CommentsController@index']);
        Route::get('{comment}/detalhes', ['as' => 'details', 'uses' => 'CommentsController@details']);
        Route::get('criar', ['as' => 'create', 'uses' => 'CommentsController@create']);
        Route::post('salvar', ['as' => 'store', 'uses' => 'CommentsController@store']);
        Route::get('{comment}/editar', ['as' => 'edit', 'uses' => 'CommentsController@edit']);
        Route::post('atualizar', ['as' => 'update', 'uses' => 'CommentsController@update']);
        Route::get('{comment}/status', ['as' => 'status', 'uses' => 'CommentsController@status']);
        Route::get('{comment}/excluir', ['as' => 'remove', 'middleware' => 'auth.role:2', 'uses' => 'CommentsController@remove']);
    });

});
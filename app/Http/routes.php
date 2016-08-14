<?php

//ROTAS DE AUTENTIÇÃO
Route::get('gerenciar', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@getLogout']);

//ROTAS DE PASSWORD
Route::get('password/email', ['as' => 'password.email', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\PasswordController@postEmail']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@postReset']);

//PREFIX ROOT
Route::group(['prefix' => 'root', 'middleware' => 'auth.role:1', 'as' => 'root.'], function () {

    //ROTAS DE USUÁRIOS
    Route::group(['prefix' => 'usuarios', 'middleware' => 'auth.role:2', 'as' => 'users.'], function () {

        Route::get('', ['as' => 'index', 'uses' => 'UsersController@index']);
        Route::get('{user}/detalhes', ['as' => 'details', 'uses' => 'UsersController@details']);
        Route::get('criar', ['as' => 'create', 'uses' => 'UsersController@create']);
        Route::post('salvar', ['as' => 'store', 'uses' => 'UsersController@store']);
        Route::get('{user}/editar', ['as' => 'edit', 'uses' => 'UsersController@edit']);
        Route::post('atualizar', ['as' => 'update', 'uses' => 'UsersController@update']);
        Route::get('{user}/status', ['as' => 'status', 'uses' => 'UsersController@status']);
        Route::get('{user}/excluir', ['as' => 'remove', 'uses' => 'UsersController@remove']);
    });

});

//PREFIXO ADMIN
Route::group(['prefix' => 'admin', 'middleware' => 'auth.role:3', 'as' => 'admin.'], function () {


    //ROTAS DE DASHBOARD
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

    //ROTAS DE PERFIL
    Route::get('perfil', ['as' => 'profile', 'uses' => 'ProfileController@edit']);
    Route::post('perfil/atualizar', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

    //ROTAS DE NEWSLETTER
    Route::group(['prefix' => 'emails', 'as' => 'newsletter.'], function () {

        Route::get('', ['as' => 'index', 'uses' => 'NewsletterController@index']);
        Route::get('{newsletter}/status', ['as' => 'status', 'uses' => 'NewsletterController@status']);
    });
   
});

Route::get('/', function (){
    return view('site.home.index');
});


<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function()
{
    Route::get('/', function () {
        return view('welcome');
    });
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    //product routes
    Route::resource('articles', 'ArticlesController');
    /*-------------------------------------------------------------------------------------*/
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
        //Welcome Route
        Route::get('/', 'WelcomeController@index')->name('welcome');
        Route::get('review/{id}/{res}', 'ArticlesController@review')->name('reviewarticle');
        //user routes
        Route::resource('users', 'UsersController')->except(['show']);
        Route::resource('roles', 'RoleController')->except(['show']);
    });//end of dashboard routes

});


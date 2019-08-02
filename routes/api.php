<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function() {
    Route::prefix('auth')->group(function(){
        //---Public routes
        Route::post('register', 'Authcontroller@register');
        Route::post('login', 'AuthController@login');
        Route::get('refresh', 'Authcontroller@tokenUpdate');
        //---End public routes

        Route::middleware('auth:api')->group( function () {
            Route::get('user', 'AuthController@currentUser');
            Route::post('logout', 'AuthController@logout');
            Route::get('allMovies/{page?}', function ($page = 1) {
                $popularClient = new \App\Http\Clients\PopularRequest();
                if ($popularClient->isSucessfull()) {
                    $response = $popularClient->getResponse(true);
                } else {
                    $response = $popularClient->getError();
                }

                return $response;
            });
            Route::resource('movies', 'MovieController');
            Route::resource('favs', 'FavouriteController');
        });
    });

});

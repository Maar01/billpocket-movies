<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route to handle page reload in Vue except for api routes
Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');

/*Route::get('/test', function () {
    $popularClient = new \App\Http\Clients\PopularRequest();
    $response = "";
    if ($popularClient->isSucessfull()) {
         $response = $popularClient->getResponse();
    }
    else {
        $response = $popularClient->getError();
    }

    dd($response);
});*/

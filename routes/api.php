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

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::prefix('v2')->group(function () {
	Route::get('/get-all-makes', 'HomeController@getAllMakes')->name('getallmakes');
	Route::get('/get-all-years', 'HomeController@getAllYears')->name('getallyears');
	Route::get('/get-all-models', 'HomeController@getAllModels')->name('getallmodels');
	Route::get('/get-models-by-make/{make?}', 'HomeController@getModelsByMake')->name('getmodelsbymake');
	Route::get('/get-makes-by-type/{type?}', 'HomeController@getMakesByType')->name('getmakesbytype');
	Route::get('/get-all-prices', 'HomeController@getAllPrices')->name('getallprices');
	Route::get('/get-all-mileages', 'HomeController@getAllMileages')->name('getallmileages');
	Route::get('/get-all-bodystyles', 'HomeController@getAllBodyStyles')->name('getallbodystyles');
	Route::get('/get-all-suvproducts', 'HomeController@getAllSuvProducts')->name('getallsuvproducts');
	Route::get('/get-all-sedanproducts', 'HomeController@getAllSedanProducts')->name('getallsedanproducts');
	Route::get('/get-all-truckproducts', 'HomeController@getAllTruckProducts')->name('getalltruckproducts');
	Route::get('/get-all-popular-products', 'HomeController@getAllPopularProducts')->name('getallpopularproducts');
	Route::get('/search-products', 'HomeController@SearchProducts')->name('searchproducts');
	Route::get('/search-dealer', 'HomeController@searchDealer')->name('searchdealer');
    Route::get('/get-car-detail/{vin}', 'HomeController@getCarDetail')->name('getcardetail');

	Route::post('/send-message', 'HomeController@sendMessage')->name('sendmessage');
	Route::post('/migrate_esdb', 'HomeController@migrateESDB')->name('migrateesdb');
});

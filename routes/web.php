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

Route::get('/', function () {
    return view('home');
})->where('any', '.*')->name('home');
Route::get('/search', function () {
    return view('home');
})->where('any', '.*');
Route::get('/find-dealers', function () {
    return view('home');
})->where('any', '.*');
Route::get('/car-detail/{any}', function () {
    return view('home');
})->where('any', '.*');
Route::get('/privacy', function () {
    return view('home');
})->where('any', '.*');
Route::get('/terms-of-service', function () {
    return view('home');
})->where('any', '.*');
Route::get('/about-us', function () {
    return view('home');
})->where('any', '.*');
Route::get('/contact-us', function () {
    return view('home');
})->where('any', '.*');
Route::get('/advertise', function () {
    return view('home');
})->where('any', '.*');


Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'AdminController@index');

    //dealer
    Route::any('/dealers', 'DealerController@index')->name('dealers');
    Route::get('/adddealerform', 'DealerController@create')->name('adddealerform');
    Route::post('/adddealer', 'DealerController@store')->name('adddealer');
    Route::get('/edit-dealer/{id}', 'DealerController@edit')->name('editdealerform');
    Route::post('/edit-dealer', 'DealerController@update')->name('editdealer');
    Route::get('/delete-dealer/{id}', 'DealerController@destroy')->name('deletedealer');
    Route::get('/adddealerthroughapi', 'DealerController@addDealerThroughApi');

    //inventory
    Route::get('/inventories', 'InventoryController@index')->name('inventories');
    Route::any('/import-csv', 'InventoryController@csvImport')->name('import-csv');
    Route::post('/ajaxfilecheck', 'InventoryController@ajaxFileCheck')->name('ajaxfilecheck');
    Route::get('/product-data', 'InventoryController@getInventory')->name('datatables.data');
    Route::get('/dealer-details/{id}', 'InventoryController@dealerDetails')->name('dealer-details');
    Route::post('/getmorecontent', 'InventoryController@getMoreContent')->name('getmorecontent');
    Route::get('/feactured-image', 'InventoryController@feacturedImage')->name('feactured-image');
    Route::get('/marketcheck-import', 'InventoryController@marketCheckImport')->name('marketcheck-import');
    Route::post('/import-inventory', 'InventoryController@marketImportInventory')->name('import-inventory');
    Route::post('/process-inventory', 'InventoryController@processInventory')->name('process-inventory');
    Route::get('/site-settings', 'InventoryController@siteSettings')->name('site-settings');
    Route::post('/save-settings', 'InventoryController@saveSiteSettings')->name('save-settings');
    Route::post('/upload-feactured-image', 'InventoryController@uploadFeacturedImage')->name('upload-feactured-image');
});

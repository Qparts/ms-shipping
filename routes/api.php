<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CourierController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ShipmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::controller(OrderController::class)->group(function () {
    // Torod Endpoints
    Route::post('order/torod', 'store')->name('store');
    Route::get('order/list', 'orderList')->name('list-order');
    Route::get('order/ship/process', 'orderShipProcess')->name('ship-process');

    //Oneet Endpoints
    Route::post('order/oneet', 'storeOneet')->name('store-oneet');


});

Route::controller(AddressController::class)->group(function () {
    Route::get('address/countries', 'countries')->name('countries');
    Route::get('address/regions/{country_id?}', 'regions')->name('regions');
    Route::get('address/cities/{region_id?}', 'cities')->name('cities');
    Route::post('address/create', 'createAddress')->name('create-address');
    Route::get('address/list', 'listAddress')->name('list');
    Route::post('get-address-details', 'details')->name('details');
    Route::post('address/update/{address_id}', 'updateAddress')->name('update-address');
    Route::post('get-latlong-details', 'getLatLongDetails')->name('latlong-address');
});

Route::controller(CourierController::class)->group(function () {
    Route::get('courier/partner/list', 'getCourierPartners')->name('courier-partners');
    Route::post('courier/partners', 'orderCourierPartner')->name('order-courier-partners');
    Route::post('courier/partners/list','CourierList')->name('courier-partners');
});

Route::controller(ShipmentController::class)->group(function () {
    Route::get('shipments/list', 'shipmentList')->name('shipment-list');
    Route::post('shipments/order/track', 'trackOrder')->name('order-track');
    Route::post('shipments/order/cancel', 'cancelOrder')->name('order-cancel');
});




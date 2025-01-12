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
    Route::post('order/torod', 'createTorodOrder')->name('store');
    Route::get('order/list', 'orderList')->name('list-order');
    Route::get('order/ship/process', 'orderShipProcess')->name('ship-process');

    //Oneet Endpoints
    Route::post('order/oneet', 'storeOneet')->name('store-oneet');
    Route::get('order/oneet/get/{id}', 'trackOrderOneet')->name('track-order-oneet');
    Route::get('order/all', 'getAllOrders')->name('get-all-order-oneet');


});

Route::controller(AddressController::class)->group(function () {
    // torod address endpoints
    Route::get('address/countries', 'countries')->name('countries');
    Route::get('address/regions/{country_id?}', 'regions')->name('regions');
    Route::get('address/cities/{region_id?}', 'cities')->name('cities');
    Route::post('address/create', 'createAddress')->name('create-address');
    Route::get('address/list', 'listAddress')->name('list');
    Route::post('get-address-details', 'details')->name('details');
    Route::post('address/update/{address_id}', 'updateAddress')->name('update-address');
    Route::post('get-latlong-details', 'getLatLongDetails')->name('latlong-address');

    // Oneet address endpoints
    Route::get('oneet/addresses', 'listOneetAddresses')->name('list-oneet-Addresses');
    Route::post('oneet/address/create', 'createOneetAddress')->name('create-oneet-address');
    Route::get('oneet/cities/list', 'listOneetCities')->name('list-oneet-cities');
    Route::get('oneet/districts/list', 'listOneetDistricts')->name('list-oneet-districts');
    Route::patch('oneet/store/addresses/{id}', 'updateOneetAddress')->name('update-oneet-address');
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

    // torod order notification
    Route::post('order/status/notify','getOrderStatus')->name('order-status');
});




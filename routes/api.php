<?php

use App\Http\Controllers\API\AmadeusEnterpriseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FlightsController;
use App\Http\Controllers\API\Hotels\HotelbedsController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(FlightsController::class)->group(function(){
    Route::get('flights_airports', 'flights_airports');
});

/*
|--------------------------------------------------------------------------
| AmadeusEnterprise API ROUTES
|--------------------------------------------------------------------------
| These routes handle integration with the Amadeus Enterprise API.
|
*/

Route::controller(AmadeusEnterpriseController::class)->group(function(){
    Route::post('amadeus_enterprise/flight_search', 'flight_search');
});
Route::controller(AmadeusEnterpriseController::class)->group(function(){
    Route::post('amadeus_enterprise/booking', 'booking');
});
Route::controller(AmadeusEnterpriseController::class)->group(function(){
    Route::post('amadeus_enterprise/get_fare_calendar', 'get_fare_calendar');
});


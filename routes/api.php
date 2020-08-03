<?php

use App\Carrier;
use App\City;
use App\Citycode;
use App\User;
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

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::post('signup', 'SignUpController');

    Route::get('me', 'MeController');
    Route::get('read-notification/{id}', function ($id) {
        $notification = auth()->user()->unreadNotifications->find($id);
          $notification->markAsRead();
        return $notification;
    });
});
/* Route::group(['middleware' => 'auth:api'], function () { */
Route::get('get-carrier', 'CarrierController@show');
Route::post('add-carrier', 'CarrierController@store');
Route::get('edit-carrier/{id}', 'CarrierController@edit');
Route::post('update-carrier/{id}', 'CarrierController@update');

Route::get('get-accessories', 'AccessoryController@index');
Route::get('get-accessory/{carrierId}', 'AccessoryController@show');
Route::get('edit-accessory/{accessoryId}/{carrierId}', 'AccessoryController@edit');
Route::post('add-accessory/{id}', 'AccessoryController@store');
Route::post('update-accessory/{accessoryId}/{carrierId}', 'AccessoryController@update');
Route::delete('delete-accessory/{accessoryId}/{carrierId}', 'AccessoryController@destroy');

Route::post('add-rate/{id}', 'RateController@store');
Route::get('get-rate/{id}', 'RateController@show');
Route::get('edit-rate/{id}', 'RateController@edit');
Route::post('update-rate/{id}', 'RateController@update');
Route::delete('delete-rate/{rateId}', 'RateController@destroy');

//admin
Route::get('admin/country', 'admin\AdminCountryController@index');
Route::post('admin/country/store', 'admin\AdminCountryController@store');
Route::post('admin/country/update', 'admin\AdminCountryController@update');
Route::delete('admin/country/delete/{id}', 'admin\AdminCountryController@destroy');

Route::get('admin/state', 'admin\AdminStateController@index');
Route::post('admin/state/store', 'admin\AdminStateController@store');
Route::post('admin/state/update', 'admin\AdminStateController@update');
Route::delete('admin/state/delete/{id}', 'admin\AdminStateController@destroy');

Route::get('admin/city', 'admin\AdminCityController@index');
Route::post('admin/city/store', 'admin\AdminCityController@store');
Route::post('admin/city/update', 'admin\AdminCityController@update');
Route::delete('admin/city/delete/{id}', 'admin\AdminCityController@destroy');
/* }); */
Route::get('search-city', 'OrderController@search');

Route::get('countries', 'CountryController@index');
Route::get('states/{id}', 'StateController@show');
Route::get('cities/{id}', 'CityController@show');
Route::get('citycodes/{id}', 'CitycodeController@show');

Route::get('citycodes', 'CitycodeController@index');

Route::get('location-type', 'OrderController@locationType');
Route::get('pick-services', 'OrderController@pickServices');
Route::get('delivery-services', 'OrderController@deliveryServices');
Route::get('pick-date', 'OrderController@pickDate');
Route::get('item-type', 'OrderController@itemType');
Route::get('item-condition', 'OrderController@itemCondition');

Route::post('calculate-item-dw', 'ItemController@calculator');
Route::post('calculate-rate', 'CalculatorController@calculator');

Route::post('add-shipment', 'ShipperController@store');

Route::get('test', 'CalculatorController@test');

Route::get('job-status', 'jobController@jobStatus');
Route::get('jobs/{carrierId}', 'jobController@index');
Route::get('job-details/{jobId}', 'jobController@show');
Route::post('update-job/{jobId}', 'jobController@update');
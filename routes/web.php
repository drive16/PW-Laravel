<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['lang']], function() {
    Route::get('/', ['as' => 'home', 'uses' => 'FrontController@getHome']);
    Route::get('/lang/{lang}', ['as' => 'setLang', 'uses' => 'LangController@changeLanguage']);
    Route::get('/home', 'FrontController@getHome')->name('home');
    //Payment
    Route::post('/payment', ['as' => 'payment', 'uses' => 'PaymentController@payWithpaypal']);
    Route::get('/payment/status', ['as' => 'status', 'uses' => 'PaymentController@getPaymentStatus']);
    Auth::routes();
});

Route::group(['middleware' => ['auth', 'lang']], function() {
    Route::resource('router', 'RouterController');
    Route::get('/routerCards', ['as' => 'router.list', 'uses' => 'RouterController@list']);
    Route::get('/router/{serialNumber}/destroy', ['as' => 'router.destroy', 'uses' => 'RouterController@destroy']);
    Route::get('/router/{serialNumber}/destroy/confirm', ['as' => 'router.destroy.confirm', 'uses' => 'RouterController@confirmDestroy']);
    Route::post('/router/{serialNumber}/update', ['as' => 'router.update', 'uses' => 'RouterController@update']);
    Route::post('/router/search', ['as' => 'router.keyword', 'uses' => 'RouterController@search']);
    Route::get('/router/{serialNumber}/configuration', ['as' => 'router.config', 'uses' => 'ConfigurationController@showRouter']);
    Route::get('/router/{serialNumber}/deleteConfiguration/confirm', ['as' => 'router.delete.configuration', 'uses' => 'RouterController@deleteConfigurationConfirm']);
    Route::get('/router/{serialNumber}/deleteConfiguration', ['as' => 'router.deleteConfiguration', 'uses' => 'RouterController@deleteConfiguration']);
    Route::get('/routerInterfaces/{serialNumber}', 'ConfigurationController@getRouterInterfaces');

    Route::resource('switch', 'SwitchController');
    Route::get('/switchCards', ['as' => 'switch.list', 'uses' => 'SwitchController@list']);
    Route::get('/switch/{serialNumber}/destroy', ['as' => 'switch.destroy', 'uses' => 'SwitchController@destroy']);
    Route::get('/switch/{serialNumber}/destroy/confirm', ['as' => 'switch.destroy.confirm', 'uses' => 'SwitchController@confirmDestroy']);
    Route::post('/switch/{serialNumber}/update', ['as' => 'switch.update', 'uses' => 'SwitchController@update']);
    Route::post('/switch/search', ['as' => 'switch.keyword', 'uses' => 'SwitchController@search']);
    Route::get('/switch/{serialNumber}/configuration', ['as' => 'switch.config', 'uses' => 'ConfigurationController@showSwitch']);
    Route::get('/switch/{serialNumber}/deleteConfiguration/confirm', ['as' => 'switch.delete.configuration', 'uses' => 'SwitchController@deleteConfigurationConfirm']);
    Route::get('/switch/{serialNumber}/deleteConfiguration', ['as' => 'switch.deleteConfiguration', 'uses' => 'SwitchController@deleteConfiguration']);
});

Route::group(['middleware' => ['lang']], function() {
    Route::resource('switchConfiguration', 'QuickSwitchConfigurationController');
    Route::resource('routerConfiguration', 'QuickRouterConfigurationController');
    Route::get('/switchInterfaces/{ports}', 'QuickSwitchConfigurationController@getSwitchInterfaces');
    Route::get('/routerInterface/{ports}', 'QuickRouterConfigurationController@getRouterInterface');
});

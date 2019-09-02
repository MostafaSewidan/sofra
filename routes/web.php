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


Route::get('/hash' , function(){return \Illuminate\Support\Facades\Hash::make('11111111');});

Route::group(['middleware' =>'auth'] , function (){
    Route::group(['middleware'=>'language'],function (){

        Route::group(['namespace' => 'AdminControllers'], function (){

            Route::get('/', 'HomeController@index');
            Route::get('/language', function () {

                if(session()->get('language') == 'en')
                {
                    session()->put('language' , 'ar') ;
                    return back();
                }elseif(session()->get('language') == 'ar')
                {
                    session()->put('language' , 'en');
                    return back();
                }else
                {
                    session()->put('language' , 'en');
                    return back();
                }

            });


            /******************************(( City Module))************************/

            Route::resource('/cities' , 'CityController');

            /************************************************************************/

            /******************************(( district Module))************************/

            Route::resource('/districts' , 'DistrictController');

            /************************************************************************/

            /******************************(( categories Module))************************/

            Route::resource('/categories' , 'CategoryController');

            /************************************************************************/

            /******************************(( Offers Module))************************/

            Route::resource('/offers' , 'OfferController');

            /************************************************************************/

            /******************************(( Offers Module))************************/

            Route::resource('/contacts' , 'ContactController');

            /************************************************************************/


            /******************************(( app settings Module))************************/

            Route::resource('/app-settings' , 'AppSettingController');

            /************************************************************************/

            /******************************(( clients Module))************************/

            Route::resource('/clients' , 'ClientController');

            /************************************************************************/

            /******************************(( orders Module))************************/

            Route::resource('/orders' , 'OrderController');

            /************************************************************************/

            /******************************(( payments Module))************************/

            Route::resource('/payments' , 'PaymentController');

            /************************************************************************/

            /******************************(( Restaurants Module))************************/

            Route::resource('/restaurants' , 'RestaurantController');

            /************************************************************************/

        });

    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

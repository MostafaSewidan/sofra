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

Route::group(['namespace'=>'ApiControllers','prefix'=>'v1'],function(){


    /*******************( selectors data )*******************************/

    Route::get('/categories/{id?}' , 'sellectorController@categories');
    Route::get('/cities/{id?}' , 'sellectorController@cities');
    Route::get('/destricts/{id?}' , 'sellectorController@destricts');
    Route::get('/settings' , 'sellectorController@settings');


    /*********************************************************************/

    /*******************( client auth )*******************************/

    Route::post('/client_register' , 'clientAuthController@client_register');
    Route::post('/client_login' , 'clientAuthController@client_login');
    Route::post('/client_send_pinCode' , 'clientAuthController@send_pinCode');
    Route::post('/client_reset_password' , 'clientAuthController@reset_password');


    Route::group(['middleware'=>'auth:client'],function (){

        Route::post('/client_update_profile' , 'clientAuthController@update_profile');

        // tokens cycle
        Route::post('/add_client_token' , 'TokensController@add_client_token');
        Route::post('/remove_client_token' , 'TokensController@remove_client_token');
        /////////////////////////////////

        /************************(client add contact)***********************************/

        Route::post('/client-add-contact' , 'contactsController@client_add_contact');

        /***************************************************************/

    });
    /*********************************************************************/

    /*******************( resturant auth )*******************************/

    Route::post('/resturant_register' , 'resturantAuthController@register');
    Route::post('/resturant_login' , 'resturantAuthController@login');
    Route::post('/resturant_send_pinCode' , 'resturantAuthController@send_pinCode');
    Route::post('/resturant_reset_password' , 'resturantAuthController@reset_password');


    Route::group(['middleware'=>'auth:resturent'],function (){

        //tokens cycle
        Route::post('/add_restaurant_token' , 'TokensController@add_restaurant_token');
        Route::post('/remove_restaurant_token' , 'TokensController@remove_restaurant_token');
        //////////////////////////////////////////////////////////

        /*******************( resturant update profile )*******************************/

        Route::post('/resturant_update_profile' , 'resturantAuthController@update_profile');

        /*********************************************************************/

        /*******************( resturant food Cycle )*******************************/

        Route::post('/store_product' , 'resturantFoodController@store_product');
        Route::post('/update_product' , 'resturantFoodController@update_product');
        Route::get('/show_products' , 'resturantFoodController@show_products');
        Route::post('/delete_product' , 'resturantFoodController@delete_product');

        /*********************************************************************/

        /*******************( resturant offers Cycle )*******************************/

        Route::post('/store_offer' , 'resturantOffersController@store_offer');
        Route::post('/update_offer' , 'resturantOffersController@update_offer');
        Route::get('/show_offers' , 'resturantOffersController@show_offers');
        Route::post('/delete_offer' , 'resturantOffersController@delete_offer');

        /*********************************************************************/

/*******************( restaurant order Cycle )*******************************/

        Route::post('/new-orders' , 'RestaurantOrderCycleController@new_orders');
        Route::post('/accept-order' , 'RestaurantOrderCycleController@accept_order');
        Route::post('/reject-order' , 'RestaurantOrderCycleController@reject_order');
        Route::post('/Current-orders' , 'RestaurantOrderCycleController@Current_orders');
        Route::post('/previous-orders' , 'RestaurantOrderCycleController@previous_orders');
        Route::post('/restaurant-confirm-deliver-orders' , 'RestaurantOrderCycleController@restaurant_confirm_deliver');
        Route::post('/restaurant-order-details' , 'RestaurantOrderCycleController@order_details');
        Route::post('/restaurant-notifications' , 'RestaurantOrderCycleController@notifications');
        Route::post('/restaurant-notification-details' , 'RestaurantOrderCycleController@notification_details');

        /*********************************************************************/


        /************************(client add contact)***********************************/

        Route::post('/restaurant-add-contact' , 'contactsController@restaurant_add_contact');

        /***************************************************************/

    });

    /*******************( client order Cycle )*******************************/

    Route::post('/filter' , 'ClientOrderCycleController@filter');
    Route::post('/restaurant-product' , 'ClientOrderCycleController@restaurant_product');
    Route::post('/restaurant-comments' , 'ClientOrderCycleController@restaurant_comments');
    Route::post('/restaurant-date' , 'ClientOrderCycleController@restaurant_date');
    Route::post('/product-date' , 'ClientOrderCycleController@product_date');

    Route::group(['middleware'=>'auth:client'],function (){

        Route::post('/add-comment' , 'ClientOrderCycleController@add_comment');
        Route::post('/add-order-date' , 'ClientOrderCycleController@add_order_date');
        Route::post('/client-current-orders' , 'ClientOrderCycleController@client_current_orders');
        Route::post('/client-confirm-deliver-orders' , 'ClientOrderCycleController@client_confirm_deliver');
        Route::post('/client-declined-deliver-orders' , 'ClientOrderCycleController@client_declined_deliver');
        Route::post('/client-Previous-requests' , 'ClientOrderCycleController@Previous_request');
        Route::post('/client-order-details' , 'ClientOrderCycleController@order_details');
        Route::post('/client-notifications' , 'ClientOrderCycleController@notifications');
        Route::post('/client-notification-details' , 'ClientOrderCycleController@notification_details');

    });

    /*********************************************************************/
});
<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Resturant;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokensController extends Controller
{
    public function responseJson($status, $massage, $data = null)
    {

        $response =
            [
                'status' => $status,
                'massage' => $massage,
                'data' => $data
            ];
        return response()->json($response);

    }

    ////////////////////////////////////////////////////////////////

    /***********************(Add tokens Cycle)***********************************/

    // add restaurant tokens
    public function add_restaurant_token(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'token' => 'required',

            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }


        $restaurant = Resturant::find($request->user()->id);

        if($restaurant)
        {
            $restaurant->token()->create(['token'=> $request->token]);

            return $this->responsejson(false, 'تمت الاضافه بنجاح');
        }
        else {

            return $this->responsejson(false, 'restaurant not found');
        }
    }
    /////////////////////////////////////////////

    // add Client tokens
    public function add_client_token(Request $request)
    {

        $validator = validator()->make($request->all(),
            [
                'token' => 'required',

            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::find($request->user()->id);

        if($client)
        {
            $client->token()->create(['token'=> $request->token]);

            return $this->responsejson(false, 'تمت الاضافه بنجاح');

        }else{

            return $this->responsejson(false, 'client not found');
        }
    }
    ////////////////////////////////////////////

    /*****************************************************************************/

    /***********************(Remove tokens Cycle)***********************************/

    // Remove restaurant tokens
    public function remove_restaurant_token(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'token' => 'required',

            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }


        $restaurant = Resturant::find($request->user()->id);

        if($restaurant)
        {
            $restaurant->token()->where('token' , $request->token )->delete();

            return $this->responsejson(false, 'تم الحذف بنجاح');

        }else{

            return $this->responsejson(false, 'restaurant not found');
        }
    }
    /////////////////////////////////////////////

    // Remove Client tokens
    public function remove_client_token(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'token' => 'required',

            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }


        $client = Client::find($request->user()->id);

        if($client)
        {
            $client->token()->where('token' , $request->token )->delete();

            return $this->responsejson(false, 'تم الحذف بنجاح');

        }else{

            return $this->responsejson(false, 'client not found');
        }
    }
    /////////////////////////////////////////////
    ///
    /*****************************************************************************/
}

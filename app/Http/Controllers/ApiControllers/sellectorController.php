<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\App_setting;
use App\Models\Category;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class sellectorController extends Controller
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

    public function categories($id = null)
    {
        if($id == null)
        {
            $categories = Category::all();
            return $this->responseJson(true , 'all categories' , $categories);
        }else{
            $categories = Category::find($id)->get();
            return $this->responseJson(true , 'all categories' , $categories);
        }

    }

    public function cities($id = null)
    {
        if($id == null)
        {
            $cities = City::all();
            return $this->responseJson(true , 'all cities' , $cities);
        }else{
            $cities = City::find($id)->get();
            return $this->responseJson(true , 'all cities' , $cities);
        }

    }

    public function destricts($id = null)
    {
        if($id != null)
        {
            $destricts = District::find($id);
            return $this->responseJson(true , 'destricts' , $destricts);
        }else{
            $destricts = District::all();
            return $this->responseJson(true , 'all destricts' , $destricts);
        }

    }

    public function settings()
    {

            $settings = App_setting::all();
            return $this->responseJson(true , 'all settings' , $settings);

    }

}

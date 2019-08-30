<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Client;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class contactsController extends Controller
{
    //////////////////////////////////////////////////////////////////////
    ///
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

    ///////////////////////////////////////////////////////////////
    ///

    public function client_add_contact(Request $request)
    {

        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'sms_body' => 'required',
                'type' => 'required|in:Complaint,Suggestion,Enquiry',
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::find($request->user()->id);

        if($client)
        {

            $contact = $client->contacts()->create($request->all());

            return $this->responseJson(true,'تمت العملية بنجاح' , $contact);
        }else{
            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }

    }


    ///////////////////////////////////////////////////////////////
    ///

    public function restaurant_add_contact(Request $request)
    {

        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'sms_body' => 'required',
                'type' => 'required|in:Complaint,Suggestion,Enquiry',
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurant = Resturant::find($request->user()->id);

        if($restaurant)
        {

            $contact = $restaurant->contacts()->create($request->all());

            return $this->responseJson(true,'تمت العملية بنجاح',$contact);
        }else{
            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }

    }
}

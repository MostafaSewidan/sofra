<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Offer;
use App\Models\Image;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class resturantOffersController extends Controller

{

    public function responsejson($status, $massage, $data = null)
    {

        $response =
            [
                'status' => $status,
                'massage' => $massage,
                'data' => $data
            ];
        return response()->json($response);

    }

    //////////////////////////////////////////////////

    public function store_offer(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'details' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'photo'=>'required|image|mimes:jpg,png,jpeg'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }


        $resturant = Resturant::find($request->user()->id);

        if($resturant)
        {
           $offer =  $resturant->offers()->create(
                [
                    'name' => $request->name,
                    'details' => $request->details,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date
                ]);

            $photo = $request->file('photo');
            $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('/offerPhotos/'),$name);

            $offer->image()->create(['name'=>'/offerPhotos/'.$name]);


            return $this->responsejson(true, 'تم الاضافة بنجاح', [
                'offer data ' => $offer
            ]);
        }else
        {
            return $this->responsejson(false, 'restaurant not found');
        }



    }

    public function update_offer(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'offer_id' => 'required',
                'name' => 'required',
                'details' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'photo'=>'required|image|mimes:jpg,png'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }



        $offer = $request->user()->offers()->find($request->offer_id);

        if($offer)
        {
            $offer->update(
                [
                    'name' => $request->name,
                    'details' => $request->details,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]
            );

            $name = public_path($offer->image->name);
            File::delete($name);

            $photo = $request->file('photo');
            $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('/offerPhotos/'),$name);

            $offer->image()->update(['name'=>'/offerPhotos/'.$name]);

            return $this->responsejson(true, 'تم التعديل بنجاح', [
                'Offer data ' => $offer
            ]);
        }else{
            return $this->responsejson(true,'لم يتم علي هذه الوجبه');
        }



    }

    public function show_offers()
    {
        $offers = Resturant::find(auth()->user()->id)->offers()->get();

        if(count($offers))
        {
            return $this->responsejson(true, 'كل العروض ', [
                'Offer data ' => $offers
            ]);
        }else{
            return $this->responsejson(true, 'لا يوجد عروض');
        }

    }

    public function delete_offer(Request $request)
    {

        $validator = validator()->make($request->all(),
            [
                'offer_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $offer = $request->user()->offers()->find($request->offer_id);

        if($offer)
        {
            $name = public_path($offer->image->name);
            File::delete($name);
            $offer->image->delete();
            $offer->delete();

            return $this->responsejson(true, 'تم الحذف بنجاح');

        }else{
            return $this->responsejson(true, 'لم يتم العثور علي العرض');
        }

    }
}

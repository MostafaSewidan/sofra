<?php

namespace App\Http\Controllers\ApiControllers;

use Illuminate\Support\Facades\File;
use App\Models\Image;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class resturantFoodController extends Controller
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

    public function store_product(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'offer_price' => 'required',
                'details' => 'required',
                'prepare_time' => 'required',
                'photo'=>'required|image|mimes:jpg,png,jpeg'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }



        $product = Product::create($request->all());
        $product->resturant_id = auth()->user()->id;
        $product->save();

        $photo = $request->file('photo');
        $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/productPhotos/'),$name);

        $product->image()->create(['name'=>'/productPhotos/'.$name]);


        return $this->responsejson(true, 'تم الاضافة بنجاح', [
            'proudect data ' => $product
        ]);
    }

    public function update_product(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'product_id' => 'required',
                'name' => 'required',
                'price' => 'required',
                'offer_price' => 'required',
                'details' => 'required',
                'prepare_time' => 'required',
                'photo'=>'required|image|mimes:jpg,png'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }



        $product = $request->user()->products()->find($request->product_id);


        if($product)
        {
            $product->update
            (
                [
                    'name' => $request->name,
                    'price' => $request->price,
                    'offer_price' => $request->offer_price,
                    'details' => $request->details,
                    'prepare_time' => $request->prepare_time,
                ]
            );


            $name = public_path($product->image->name);
            File::delete($name);

            $photo = $request->file('photo');
            $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('/productPhotos/'),$name);

            $product->image()->update(['name'=>'/productPhotos/'.$name]);


            return $this->responsejson(true, 'تم التعديل بنجاح', [
                'proudect data ' => $product
            ]);
        }else{
            return $this->responsejson(true,'لم يتم علي هذه الوجبه');
        }



    }

    public function show_products()
    {
        $products = Resturant::find(auth()->user()->id)->products()->get();

        if(count($products))
        {
            return $this->responsejson(true, 'كل الوجبات ', [
                'proudect data ' => $products
            ]);
        }else{
            return $this->responsejson(true, 'لا يوجد وجبات');
        }

    }

    public function delete_product(Request $request)
    {

        $validator = validator()->make($request->all(),
            [
                'product_id' => 'required'
            ]
        );

        if ($validator->fails()) {
            return $this->responsejson(false, $validator->errors()->first(), $validator->errors());
        }

        $product = $request->user()->products()->find($request->product_id);


        if($product)
        {
            $name = public_path($product->image->name);
            File::delete($name);
            $product->image->delete();
            $product->delete();
            return $this->responsejson(true, 'تم الحذف بنجاح');

        }else{
            return $this->responsejson(true, 'لم يتم العثور علي الوجبه');
        }

    }
}

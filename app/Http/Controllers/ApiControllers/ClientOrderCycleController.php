<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientOrderCycleController extends Controller
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


    function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
    {

        $registrationIDs = $tokens;

        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );

        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
            'notification' => $fcmMsg,
            'data' => $data
        );
        $headers = array(
            'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    ///
    //////////////////////////////////////////////////////////////////////


    public function filter(Request $request)
    {
        $filter =[];

        if($request->has('restaurant'))
        {
            $filter['restaurant'] = $request->restaurant;
        }else{
            $filter['restaurant'] = null;
        }
        if($request->has('city_id') && $request->city_id != 0)
        {
            $filter['city_id'] = $request->city_id;
        }else{
            $filter['city_id'] = null;
        }
        if($filter['restaurant'] == null && $filter['city_id'] == null )
        {
            $restaurants = Resturant::with('image')->latest()->paginate(10);

            if($restaurants)
            {
                return $this->responseJson(true,'كل المطاعم', $restaurants);
            }else{
                return $this->responseJson(false,'لا يوجد مطاعم');
            }

        }

        $restaurants = Resturant::where(function ($q) use($filter)
                                                    {
                                                        if($filter['city_id'] != null)
                                                        {
                                                            $q->whereHas('district',function($q) use ($filter)
                                                            {
                                                                $q->where('city_id' , $filter['city_id']);
                                                            });
                                                        }
                                                        if($filter['restaurant'] != null)
                                                        {
                                                            $q->where('name', 'like' , '%'.$filter['restaurant'].'%');
                                                        }
                                                    })->with('image')->paginate(10);
        if(count($restaurants))
        {
            return $this->responseJson(true,' المطاعم', $restaurants);
        }else{
            return $this->responseJson(false,'لا يوجد مطاعم');
        }
    }

    public function restaurant_product(Request $request)
    {
        if( $request->has('restaurant_id') || $request->restaurant_id != 0 )
        {
            $restaurant = Resturant::find($request->restaurant_id)->products()->with('image')->paginate(10);

            if(count($restaurant))
            {
                return $this->responseJson(true,' الوجبات', $restaurant);
            }else{
                return $this->responseJson(false,' لا يوجد وجبات');
            }


        }
    }

    public function restaurant_comments(Request $request)
    {
        if( $request->has('restaurant_id') || $request->restaurant_id != 0 )
        {
            $restaurant = Resturant::find($request->restaurant_id)->reviews()->with('client')->paginate(10);

            if(count($restaurant))
            {
                return $this->responseJson(true,' التعليقات', $restaurant);
            }else{
                return $this->responseJson(true,' لا يوجد تعليقات');
            }


        }
    }

    public function add_comment(Request $request)
    {

       $validator = validator()->make($request->all(),
           [
               'comment' => 'required',
               'rate' => 'required|min:1|max:5',
               'restaurant_id' => 'required'
           ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        //check if this client add comment and rate or not

        $comment = Resturant::find($request->restaurant_id)->reviews()->where('client_id', auth()->user()->id)->get();



        if(count($comment))
        {

            //if client add => update his comment

            $comment = Resturant::find($request->restaurant_id)->reviews()->where('client_id' , auth()->user()->id)->update(
                [
                    'comment'=> $request->comment,
                    'rate'=> $request->rate
                ]);

            //  update rate of restaurant

            $rate_avg =  Resturant::find($request->restaurant_id)->reviews()->avg('rate');
            Resturant::find($request->restaurant_id)->update(['rate' => $rate_avg]);

            return $this->responseJson(true,'تم حفظ التعليق', $comment);


        }else{

            //if client don`t have a comment  => add new comment and rate

            $comment = Resturant::find($request->restaurant_id)->clients()->attach(auth()->user()->id,
                [
                    'comment'=> $request->comment,
                    'rate'=> $request->rate
                ]);

            //update rate to this restaurant

            $rate_avg =  Resturant::find($request->restaurant_id)->reviews()->avg('rate');
            Resturant::find($request->restaurant_id)->update(['rate' => $rate_avg]);

            return $this->responseJson(true,'تم حفظ التعليق', $comment);
        }



    }

    public function restaurant_date(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'restaurant_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurant = Resturant::find($request->restaurant_id);

        if($restaurant)
        {
            $restaurant = $restaurant->with( 'image' , 'district' )->first();

            return $this->responseJson(true,'تم حفظ التعليق', ['stat' => $restaurant->state ,'resturant data' => $restaurant] );
        }else{

            return $this->responseJson(false,'لا يوجد متعم بهذا الاسم');
        }
    }

    public function product_date(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'restaurant_id' => 'required',
                'product_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurant = Resturant::find($request->restaurant_id);

        if($restaurant)
        {
            $product = $restaurant->products()->where('id' , $request->product_id)->first();

            if($product)
            {
                return $this->responseJson(true,'تم حفظ التعليق', $product );
            }else
            {
                return $this->responseJson(false,'لا يوجد وجبات');
            }

        }else{

            return $this->responseJson(false,'لا يوجد متعم بهذا الاسم');
        }
    }

    public function add_order_date(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'restaurant_id' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'special_notes' => 'required',
                'order_note' => 'required',
                'address' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        // select the restaurant
        $restaurant = Resturant::find($request->restaurant_id);

        $total_price = 0;
        $price = [];
        $i = 0;

        // calculate the price and total of price to the order products
        foreach ($request->product_id as $product_id)
        {
            $product = Product::find($product_id);

            // check if the order is Existing or not
            if ($product) {

                $total_price = $total_price + ($product->price * $request->quantity[$i]);
                $price[$i] = $product->price;
                $i++;

            } else {

                return $this->responseJson(false, 'لا يوجد وجبة بهذا الاسم');
            }
        }

        DB::beginTransaction();

        // check if the restaurant is Existing or not
        if($restaurant)
        {

            $total_price = $restaurant->deliver_cost + $total_price;

            //crate the order in this restaurant
           $order = $restaurant->orders()->create(
            [
                'client_id' => $request->user()->id,
                'order_notes' => $request->order_note,
                'address' => $request->address,
                'price' => $total_price,
                'state' => 'pending'
            ]);

        }else{

            return $this->responseJson(false,'لا يوجد متعم بهذا الاسم');
        }


        $i = 0;                 //counter for foreach

        foreach($request->product_id as $product)
        {
            //create the products of order

            $order_product = $order->products()->attach($product ,
                [
                    'quantity' => $request->quantity[$i] ,
                    'special_notes' => $request->special_notes[$i] ,
                    'price' => $price[$i]
                ]);

//            if(!$order_product)
//            {
//                DB::rollBack();
//                return $this->responseJson(false,'حدثت مشكله حاول مره اخري');
//            }
            $i++;               //increment  the counter $i
        }

        DB::commit();


       $notification = $restaurant->notifications()->create(        // create notification for restaurant
            [
                'order_id' => $order->id,
                'title' => 'order request',
                'body'  => '
                client name : ' . auth()->user()->name. ' 
                order ID : ' . $order->id . '
                Address : '. $order->address .'
                total price :'. $total_price ,
                'is_read' => 'false'
            ]);

        $tokens = $restaurant->token();         //select restaurant tokens

        //check if the restaurant has tokens to get notifications or not
        if($tokens)
        {
            $tokens = $tokens->pluck('token')->toArray();

            $data =
                [
                    'order_id' => $order->id
                ];

            //send notification for restaurant tokens

            $this->notifyByFirebase($notification->title , $notification->body , $tokens , $data );

        }

        return $this->responseJson(true,'تم حفظ order', $order );
    }

    //////////////////////////////////////
    ///
    /// client Current orders
    public function client_current_orders(Request $request)
    {
        $client = Client::find($request->user()->id);

        //check if teh restaurant is existing
        if($client)
        {
            $current_orders = $client->orders()->where('state' , 'accepted')->orderBy('updated_at','desc')->with('resturant')->get();

            if(count($current_orders))
            {
                return $this->responseJson(true,' الطلبات حالية', $current_orders);
            }else{

                return $this->responseJson(false,'لا يوجد طلبات حالية');
            }
        }else{

            return $this->responseJson(false,'لا يوجد مستخدم بهذا الاسم');
        }

    }

    //////////////////////////////////////
    ///
    ///
    public function client_confirm_deliver(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'order_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::find($request->user()->id);

        //check if teh restaurant is existing
        if($client)
        {
            //select the order
            $order = $client->orders()->find($request->order_id);

            //check if the order is existing
            if($order)
            {
                if($order->state != 'accepted')
                {
                    if($order->state == 'delivered')
                    {
                        return $this->responseJson(false,' هذا الطلب تم تاكيده بالفعل من قبل المطعم');
                    }
                    return $this->responseJson(false,'لا يمكن تاكيد استلام هذا الطلب');
                }


                $order->update(['state' => 'delivered']);

                $restaurant = Resturant::find($order->resturant_id);

                //check if teh restaurant is existing
                if($restaurant)
                {
                    $notification = $restaurant->notifications()->create(        // create notification for client
                        [
                            'order_id' => $order->id,
                            'title' => 'order delivered',
                            'body'  => '
                Client name : ' . auth()->user()->name. ' 
                order ID : ' . $order->id,
                            'is_read' => 'false'
                        ]);

                    $tokens = $restaurant->token();         //select client tokens

                    //check if the restaurant has tokens to get notifications or not
                    if($tokens)
                    {
                        $tokens = $tokens->pluck('token')->toArray();

                        $data =
                            [
                                'order_id' => $order->id
                            ];

                        //send notification for restaurant tokens

                        $this->notifyByFirebase($notification->title , $notification->body , $tokens , $data );

                    }

                }else{
                    return $this->responseJson(false,'لم يتم العثور علي المتعم');
                }


                return $this->responseJson(true,'تمت تاكيد استلام  الطلب ' , $order);

            }else{

                return $this->responseJson(false,'لم يتم العثور علي  الطلب');
            }
        }else{

            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }

    }

    //////////////////////////////////////
    ///
    ///
    public function client_declined_deliver(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'order_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::find($request->user()->id);

        //check if teh restaurant is existing
        if($client)
        {
            //select the order
            $order = $client->orders()->find($request->order_id);

            //check if the order is existing
            if($order)
            {
                if($order->state != 'accepted')
                {
                    if($order->state == 'delivered')
                    {
                        return $this->responseJson(false,' هذا الطلب تم تاكيده بالفعل من قبل المطعم');
                    }else {
                        return $this->responseJson(false, 'لا يمكن تاكيد استلام هذا الطلب');
                    }
                }


                $order->update(['state' => 'declined']);

                $restaurant = Resturant::find($order->resturant_id);

                //check if teh restaurant is existing
                if($restaurant)
                {
                    $notification = $restaurant->notifications()->create(        // create notification for client
                        [
                            'order_id' => $order->id,
                            'title' => 'order declined',
                            'body'  => '
                Client name : ' . auth()->user()->name. ' 
                order ID : ' . $order->id,
                            'is_read' => 'false'
                        ]);

                    $tokens = $restaurant->token();         //select client tokens

                    //check if the restaurant has tokens to get notifications or not
                    if($tokens)
                    {
                        $tokens = $tokens->pluck('token')->toArray();

                        $data =
                            [
                                'order_id' => $order->id
                            ];

                        //send notification for restaurant tokens

                        $this->notifyByFirebase($notification->title , $notification->body , $tokens , $data );

                    }

                }else{
                    return $this->responseJson(false,'لم يتم العثور علي المتعم');
                }


                return $this->responseJson(true,'تمت تاكيد استلام  الطلب ' , $order);

            }else{

                return $this->responseJson(false,'لم يتم العثور علي  الطلب');
            }
        }else{

            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }

    }

    public function Previous_request(Request $request)
    {
        $client = Client::find($request->user()->id);

        if($client)
        {
            $Previous_request = $client->orders()->where('state' , 'delivered')->orderBy('updated_at','desc')->get();

            return $this->responseJson(true,'الطلبات السابقة' , $Previous_request);

        }else{
            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }
    }

    /////////////////////
    /// order details
    public function order_details(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'order_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::find($request->user()->id);

        if($client)
        {
            $order_details = $client->orders()->find($request->order_id);



            if($order_details)
            {
                $order_details->notifications()->where('notifiable_type' , 'App\Models\Client')->update(['is_read'=>'true']);

                return $this->responseJson(true,'تفاصيل الطلب' , $order_details->load('products'));
            }else{
                return $this->responseJson(false,'لا يوجد طلب بهذا الاسم');
            }
        }else{
            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }
    }

    /////////////////////
    /// client notifications
    public function notifications(Request $request)
    {


        $client = Client::find($request->user()->id);

        if($client)
        {
            $notifications = $client->notifications()->latest();



            if($notifications)
            {

                return $this->responseJson(true,'الاشعارات' , $notifications->paginate(10));
            }else{
                return $this->responseJson(false,'لا يوجد اشعارات بهذا الاسم');
            }
        }else{
            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }
    }

    /////////////////////
    /// client notification details
    public function notification_details(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'notification_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::find($request->user()->id);

        if($client)
        {
            $notification = $client->notifications()->find($request->notification_id);

            $notification->update(['is_read'=>'ture']);

            if($notification)
            {

                return $this->responseJson(true,'الاشعار' , $notification->load('order.products'));
            }else{
                return $this->responseJson(false,'لا يوجد اشعار بهذا الاسم');
            }
        }else{
            return $this->responseJson(false,'لا يوجد عميل بهذا الاسم');
        }
    }
}

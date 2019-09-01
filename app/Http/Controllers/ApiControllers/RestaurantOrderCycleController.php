<?php

namespace App\Http\Controllers\ApiControllers;

use App\Models\Commission;
use App\Models\Order;
use App\Models\Resturant;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantOrderCycleController extends Controller
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


    function notifyByFirebase($title,$body,$tokens,$data = [])        // parameter 5 =>>>> $type
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

    //show new orders
    public function new_orders(Request $request)
    {
        $restaurent = Resturant::find($request->user()->id);

        //check if teh restaurant is existing
        if($restaurent)
        {
            //select restaurant orders in pending
            $new_orders = $restaurent->orders()->where('state' , 'pending');

            //check if the restaurant has new orders
            if($new_orders)
            {
                //make a notification is read
                $restaurent->notifications()->update(['is_read' => 'true']);

                return $this->responseJson(true,'الطبات الجديده' , $new_orders->get());

            }else{

                return $this->responseJson(false,'لا يوجد طلبات جديده');
            }
        }else{

            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }
    }

    //accept order
    public function accept_order(Request $request)
    {


        $validator = validator()->make($request->all(),
            [
                'order_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurent = Resturant::find($request->user()->id);

        //check if teh restaurant is existing
        if($restaurent)
        {

            //select the order
            $order = $restaurent->orders()->find($request->order_id);

            //check if the order is existing
            if($order)
            {
                if($order->state != 'pending')
                {
                    return $this->responseJson(false,'تم قبول الطلب بالفعل');
                }

                //check commission
                $comission = Commission::where('resturant_id' , $restaurent->id)->first();

                if($comission->remain_amount >= 1000)
                {
                    $restaurant_sales_price = 0;
                    $previous_orders = $restaurent->orders()->where('state' , 'delivered')->get();

                    foreach ($previous_orders as $previous_order)
                    {
                        $restaurant_sales_price = $restaurant_sales_price + $previous_order->price;
                    }

                    $commission = $restaurant_sales_price / 10 ;
                    $commission_paid = $commission - $comission->remain_amount;
                    $remain_amount = $comission->remain_amount;
                    return $this->responseJson(false,'العموله' ,
                        [
                            'مبيعات المتعم'=> $restaurant_sales_price,
                            'عمولتة التتبيق'=> $commission,
                            'ما تم سداده'=> $commission_paid,
                            'المتبقي'=> $remain_amount,
                        ]);
                }

                $order->update(['state' => 'accepted']);


                $client = Client::find($order->client_id);

                //check if teh client is existing
                if($client)
                {
                    $notification = $client->notifications()->create(        // create notification for client
                        [
                            'order_id' => $order->id,
                            'title' => 'order accepted',
                            'body'  => '
                restaurant name : ' . auth()->user()->name. ' 
                order ID : ' . $order->id . '
                total price :'. $order->price ,
                            'is_read' => 'false'
                        ]);

                    $tokens = $client->token();         //select client tokens

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
                    return $this->responseJson(false,'لم يتم العثور علي العميل');
                }


                return $this->responseJson(true,'تمت الموافقة علي الطب ' , $order);

            }else{

                return $this->responseJson(false,'لم يتم العثور علي  الطلب');
            }
        }else{

            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }

    }


    //reject order
    public function reject_order(Request $request)
    {

        $validator = validator()->make($request->all(),
            [
                'order_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurent = Resturant::find($request->user()->id);

        //check if teh restaurant is existing
        if($restaurent)
        {
            //select the order
            $order = $restaurent->orders()->find($request->order_id);

            //check if the order is existing
            if($order)
            {
                if($order->state != 'pending')
                {
                    return $this->responseJson(false,'لا يمكنك رفض هذا الطلب');
                }

                //check commission
                $comission = Commission::where('resturant_id' , $restaurent->id)->first();

                if($comission->remain_amount >= 1000 && $restaurent->payment_activate != 'active')
                {
                    $restaurant_sales_price = 0;
                    $previous_orders = $restaurent->orders()->where('state' , 'delivered')->get();

                    foreach ($previous_orders as $previous_order)
                    {
                        $restaurant_sales_price = $restaurant_sales_price + $previous_order->price;
                    }

                    $commission = $restaurant_sales_price / 10 ;
                    $commission_paid = $commission - $comission->remain_amount;
                    $remain_amount = $comission->remain_amount;
                    return $this->responseJson(false,'العموله' ,
                        [
                            'مبيعات المتعم'=> $restaurant_sales_price,
                            'عمولتة التتبيق'=> $commission,
                            'ما تم سداده'=> $commission_paid,
                            'المتبقي'=> $remain_amount,
                        ]);
                }


                $order->update(['state' => 'rejected']);

                $client = Client::find($order->client_id);

                //check if teh client is existing
                if($client)
                {
                    $notification = $client->notifications()->create(        // create notification for client
                        [
                            'order_id' => $order->id,
                            'title' => 'order rejected',
                            'body'  => '
                restaurant name : ' . auth()->user()->name. ' 
                order ID : ' . $order->id,
                            'is_read' => 'false'
                        ]);

                    $tokens = $client->token();         //select client tokens

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
                    return $this->responseJson(false,'لم يتم العثور علي العميل');
                }


                return $this->responseJson(true,'تمت رفض  الطلب ' , $order);

            }else{

                return $this->responseJson(false,'لم يتم العثور علي  الطلب');
            }
        }else{

            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }

    }

    //////////////////////////////////////
    ///
    /// Current orders
    public function Current_orders(Request $request)
    {
        $restaurent = Resturant::find($request->user()->id);

        //check if teh restaurant is existing
        if($restaurent)
        {
           $current_orders = $restaurent->orders()->where('state' , 'accepted')->orderBy('updated_at','desc')->get();

           if(count($current_orders))
           {
               return $this->responseJson(true,' الطلبات حالية', $current_orders);
           }else{

               return $this->responseJson(false,'لا يوجد طلبات حالية');
           }
        }else{

            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }

    }

    //////////////////////////////////////
    ///
    /// Previous orders
    public function previous_orders(Request $request)
    {
        $restaurent = Resturant::find($request->user()->id);

        //check if teh restaurant is existing
        if($restaurent)
        {
           $previous_orders = $restaurent->orders()->where('state' , 'declined')->orWhere('state' , 'delivered')->orderBy('updated_at','desc')->get();

           if(count($previous_orders))
           {
               return $this->responseJson(true,' الطلبات السابقة', $previous_orders );
           }else{

               return $this->responseJson(false,'لا يوجد طلبات حالية');
           }
        }else{

            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }

    }
    /////////////////////////////////////
    ///
    /// confirm deliver
    public function restaurant_confirm_deliver(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'order_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurent = Resturant::find($request->user()->id);

        //check if teh restaurant is existing
        if($restaurent)
        {
            //select the order
            $order = $restaurent->orders()->find($request->order_id);

            //check if the order is existing
            if($order)
            {
                if($order->state != 'accepted')
                {
                    if($order->state == 'delivered')
                    {
                        return $this->responseJson(false,' هذا الطلب تم تاكيده بالفعل من قبل العميل');
                    }elseif ($order->state == 'declined')
                    {

                        return $this->responseJson(false,' هذا رفض تم تاكيده  من قبل العميل');
                    }else{

                        return $this->responseJson(false,'لا يمكن تاكيد استلام هذا الطلب');
                    }
                }


                $order->update(['state' => 'delivered']);

                $commission = $restaurent->commission;
                $commission->update(['remain_amount' => ( $order->price / 10 ) + $commission->remain_amount ]);

                $client = Client::find($order->client_id);

                //check if teh client is existing
                if($client)
                {
                    $notification = $client->notifications()->create(        // create notification for client
                        [
                            'order_id' => $order->id,
                            'title' => 'order delivered',
                            'body'  => '
                restaurant name : ' . auth()->user()->name. ' 
                order ID : ' . $order->id,
                            'is_read' => 'false'
                        ]);

                    $tokens = $client->token();         //select client tokens

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
                    return $this->responseJson(false,'لم يتم العثور علي العميل');
                }


                return $this->responseJson(true,'تمت تاكيد استلام  الطلب ' , $order);

            }else{

                return $this->responseJson(false,'لم يتم العثور علي  الطلب');
            }
        }else{

            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
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

        $restaurant = Resturant::find($request->user()->id);

        if($restaurant)
        {
            $order_details = $restaurant->orders()->find($request->order_id);



            if($order_details)
            {
                $order_details->notifications()->where('notifiable_type' , 'App\Models\Resturant')->update(['is_read'=>'true']);

                return $this->responseJson(true,'تفاصيل الطلب' , $order_details->load('products'));
            }else{
                return $this->responseJson(false,'لا يوجد طلب بهذا الاسم');
            }
        }else{
            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }
    }


    /////////////////////
    /// restaurant notifications
    public function notifications(Request $request)
    {


        $restaurant = Resturant::find($request->user()->id);

        if($restaurant)
        {
            $notifications = $restaurant->notifications()->latest();



            if($notifications)
            {

                return $this->responseJson(true,'الاشعارات' , $notifications->paginate(10));
            }else{
                return $this->responseJson(false,'لا يوجد اشعارات بهذا الاسم');
            }
        }else{
            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }
    }

    /////////////////////
    /// restaurant notification details
    public function notification_details(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'notification_id' => 'required'
            ]);

        if ($validator->fails()) {
            return $this->responseJson(false, $validator->errors()->first(), $validator->errors());
        }

        $restaurant = Resturant::find($request->user()->id);

        if($restaurant)
        {
            $notification = $restaurant->notifications()->find($request->notification_id);


            $notification->update(['is_read'=>'ture']);

            if($notification)
            {

                return $this->responseJson(true,'الاشعار' , $notification->load('order.products'));
            }else{
                return $this->responseJson(false,'لا يوجد اشعار بهذا الاسم');
            }
        }else{
            return $this->responseJson(false,'لا يوجد مطعم بهذا الاسم');
        }
    }


}











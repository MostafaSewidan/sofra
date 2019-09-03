<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Commission;
use App\Models\Payment;
use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = validator()->make($request->all(),
            [
                'payment'=>'required|numeric',
                'restaurant_id'=>'required',
            ]);
        if($data->fails())
        {
            return redirect('/payments')->withInput()->withErrors($data->errors());
        }

        $restaurant  = Resturant::find($request->restaurant_id);

        if($restaurant)
        {
            $commission = Commission::where('resturant_id' , $restaurant->id)->first()->remain_amount;

            if( $commission == 0 )
            {
                session()->flash('fail' , __('sofra.zero_payment_error  '));
                return redirect('/payments');

            }elseif( $commission < $request->payment )
            {
                session()->flash('fail' , __('sofra.<_payment_error  '));
                return redirect('/payments');
            }

            $restaurant->payments()->create(
                [
                    'payment' => $request->payment,
                    'remain_amount' => $commission - $request->payment
                ]);

            Commission::where('resturant_id' , $restaurant->id)->update(['remain_amount' => $commission - $request->payment]);
        }else{

            session()->flash('fail' , __('sofra.restaurant_not_found'));
            return redirect('/payments');
        }
        session()->flash('success' , __('sofra.adding_success'));
        return redirect('/payments');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);

        if($payment)
        {

            return view('AdminDashBord.payments.edit', compact('payment'));
        }else{

            session()->flash('fail' , __('sofra.payment_not_found'));
            return redirect('/payments');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = validator()->make($request->all(),['payment'=>'required' ]);

        if($data->fails())
        {
            return redirect('/payments/'.$id.'/edit')->withInput()->withErrors($data->errors());
        }

        $payment = Payment::find($id);

        if($payment)
        {
            $commission = Commission::where('resturant_id' , $payment->resturant_id)->first()->remain_amount;

            if($payment->payment < $request->payment)
            {
               $payment2 =  $request->payment - $payment->payment;

                Commission::where('resturant_id' , $payment->resturant_id)->update(['remain_amount' => $commission - $request->payment]);
                $payment->update(
                    [
                        'payment' => $request->payment,
                        'remain_amount' => $commission - $request->payment
                    ]);

            }elseif($payment->payment > $request->payment)
            {

            }

            if( $commission == 0 )
            {
                session()->flash('fail' , __('sofra.zero_payment_error  '));
                return redirect('/payments');

            }elseif( $commission < $request->payment )
            {
                session()->flash('fail' , __('sofra.<_payment_error  '));
                return redirect('/payments');
            }

            $payment->update(
                [
                    'payment' => $request->payment,
                    'remain_amount' => $commission - $request->payment
                ]);
        }






        session()->flash('success' , __('sofra.update_success'));
        return redirect('/payments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $payment = Payment::find($id);

        if($payment)
        {
            $payment->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/payments');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/payments');
        }
    }
}

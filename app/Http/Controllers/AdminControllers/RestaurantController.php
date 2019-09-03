<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Resturant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.restaurants.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant =  Resturant::find($id);

        return view('AdminDashBord.restaurants.show' , compact('restaurant'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        if( $request->activation_type == 'report' || $request->activation_type == 'payment' )
        {

            $restaurant= Resturant::find($id);

            if($restaurant)
            {
                if( $request->activation_type == 'report' )
                {
                    if($restaurant->activation_report == 'active')
                    {
                        $restaurant->update(['activation_report'=> 'not_active']);

                    }
                    elseif ($restaurant->activation_report == 'not_active')
                    {
                        $restaurant->update(['activation_report'=> 'active']);
                    }

                    session()->flash('success' , __('sofra.update_success'));
                    return back();

                }

                if( $request->activation_type == 'payment' )
                {
                    if($restaurant->payment_activate == 'active')
                    {
                        $restaurant->update(['payment_activate'=> 'not_active']);

                    }
                    elseif ($restaurant->payment_activate == 'not_active')
                    {
                        $restaurant->update(['payment_activate'=> 'active']);
                    }

                    session()->flash('success' , __('sofra.update_success'));
                    return back();
                }

            }else{

                session()->flash('fail' , __('sofra.update_fail'));
                return back();
            }

        }else{

            session()->flash('fail' , __('sofra.update_fail'));
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $restaurant= Resturant::find($id);

        if($restaurant)
        {
            $name = public_path($restaurant->image->name);
            File::delete($name);
            $restaurant->image->delete();

            $restaurant->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/restaurants');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/restaurants');
        }
    }
}

<?php

namespace App\Http\Controllers\AdminControllers;

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
        return view('AdminDashBord.cities.index');
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
        $data = validator()->make($request->all(),['name'=>'required' ]);
        if($data->fails())
        {
            return redirect('/cities')->withInput()->withErrors($data->errors());
        }

        City::create(request()->all());
        session()->flash('success' , __('sofra.adding_success'));
        return redirect('/cities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $districts =  City::find($id)->districts()->get();

        return view('AdminDashBord.districts.index' , compact('districts'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);

        if($city)
        {

            return view('AdminDashBord.cities.edit', compact('city'));
        }else{

            session()->flash('fail' , __('sofra.city_not_found'));
            return redirect('/cities');
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
        $data = validator()->make($request->all(),['name'=>'required' ]);

        if($data->fails())
        {
            return redirect('/cities/'.$id.'/edit')->withInput()->withErrors($data->errors());
        }

        City::find($id)->update(['name' => $request->name]);

        session()->flash('success' , __('sofra.update_success'));
        return redirect('/cities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $city = City::find($id);

        if($city)
        {
            $city->districts()->delete();
            $city->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/cities');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/cities');
        }
    }
}

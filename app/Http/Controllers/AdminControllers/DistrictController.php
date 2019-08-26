<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.districts.index');
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
                'name'=>'required',
                'city_id'=>'required'
            ]);
        if($data->fails())
        {
            return redirect('/districts')->withInput()->withErrors($data->errors());
        }

        $city = City::find($request->city_id);

        if($city)
        {
            District::create(request()->all());
            session()->flash('success' , __('sofra.adding_success'));
            return redirect('/districts');
        }else{
            session()->flash('fail' , __('sofra.city_not_found'));
            return redirect('/districts');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::find($id);
        $selected_city = $district->city()->first();

        if($district)
        {

            return view('AdminDashBord.districts.edit', compact('district' , 'selected_city'));
        }else{

            session()->flash('fail' , __('sofra.district_not_found'));
            return redirect('/districts');
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
        $data = validator()->make($request->all(),
            [
                'name'=>'required',
                'city_id'=>'required',
            ]);

        if($data->fails())
        {
            return redirect('/districts/'.$id.'/edit')->withInput()->withErrors($data->errors());
        }

        $city = City::find($request->city_id);

        if($city)
        {
            District::find($id)->update($request->all());
            session()->flash('success' , __('sofra.update_success'));
            return redirect('/districts');
        }else{
            session()->flash('fail' , __('sofra.city_not_found'));
            return redirect('/districts');
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


        $district = District::find($id);

        if($district)
        {
            $district->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/districts');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/districts');
        }
    }
}

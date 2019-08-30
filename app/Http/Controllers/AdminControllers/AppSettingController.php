<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\App_setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app_settings = App_setting::first();
        return view('AdminDashBord.appSettings.index' , compact('app_settings'));
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
        $data = validator()->make($request->all(),
            [
                'about_app'=>'required',
                'commission_sms'=>'required',
                'alahle_account'=>'required',
                'alraghe_account'=>'required',
            ]);

        if($data->fails())
        {
            return redirect('/app-settings')->withInput()->withErrors($data->errors());
        }

         $app_setting = App_setting::find($id);

         if($app_setting)
         {
             $app_setting->update($request->all());

             session()->flash('success' , __('sofra.update_success'));
             return redirect('/app-settings');
         }else{

             session()->flash('fail' , __('sofra.update_fail'));
             return redirect('/app-settings');
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
        //
    }
}

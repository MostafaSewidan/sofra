<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.clients.index');
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
            return redirect('/clients')->withInput()->withErrors($data->errors());
        }

        City::create(request()->all());
        session()->flash('success' , __('sofra.adding_success'));
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client =  Client::find($id);

        return view('AdminDashBord.clients.show' , compact('client'));

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
        $client= Client::find($id);

        if($client)
        {
            if($client->activation_report == 'active')
            {
                $client->update(['activation_report'=> 'not_active']);

            }
            elseif ($client->activation_report == 'not_active')
            {
                $client->update(['activation_report'=> 'active']);
            }

            session()->flash('success' , __('sofra.update_success'));
            return back();
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


        $client= Client::find($id);

        if($client)
        {
            $client->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/clients');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/clients');
        }
    }
}

<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.roles.index');
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
                'name'=>'required|unique:roles',
                'display_name'=>'required',
                'description'=>'required',
                'permission_list'=>'required',

            ]);
        if($data->fails())
        {
            return redirect('/roles')->withInput()->withErrors($data->errors());
        }

        $record = Role::create(request()->all());
        $record->permissions()->attach($request->permission_list);
        session()->flash('success' , __('sofra.adding_success'));
        return redirect('/roles');
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
        $role = Role::find($id);

        if($role)
        {

            return view('AdminDashBord.roles.edit', compact('role'));
        }else{

            session()->flash('fail' , __('sofra.role_not_found'));
            return redirect('/roles');
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
        $record = Role::find($id);
        $data = validator()->make($request->all(),
            [
                'name'=>'required|unique:roles,name,'.$record->id.'',
                'display_name'=>'required',
                'description'=>'required',
                'permission_list'=>'required',

            ]);

        if($data->fails())
        {
            return redirect('/roles/'.$id.'/edit')->withInput()->withErrors($data->errors());
        }

        $record ->update($request->all());
        $record->permissions()->sync($request->permission_list);

        session()->flash('success' , __('sofra.update_success'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $record = Role::find($id);

        if($record)
        {
            $record->permissions()->detach();
            $record->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/roles');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/roles');
        }
    }
}
<?php

namespace App\Http\Controllers\AdminControllers;

use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.users.index');
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
                'name'=>'required|unique:users',
                'email'=>'required|unique:users',
                'img'=>'required|image|mimes:jpg,png',
                'password'=>'required|confirmed',
                'roles_list'=>'required',

            ]);
        if($data->fails())
        {
            return redirect('/users')->withInput()->withErrors($data->errors());
        }

        $user = User::create(request()->all());

        $photo = $request->file('img');
        $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/UserPhotos/'),$name);

        $user->update(['img'=> '/UserPhotos/'.$name]);
        $user->update(['password'=> Hash::make($request->password)]);

        $user->roles()->attach($request->roles_list);
        session()->flash('success' , __('sofra.adding_success'));
        return redirect('/users');
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
        $user = User::find($id);

        if($user)
        {

            return view('AdminDashBord.users.edit', compact('user'));
        }else{

            session()->flash('fail' , __('sofra.role_not_found'));
            return redirect('/users');
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
        $record = User::find($id);
        $data = validator()->make($request->all(),
            [
                'name'=>'required|unique:users,name,'.$record->id.'',
                'email'=>'required|unique:users,email,'.$record->id.'',
                'img'=>'required|image|mimes:jpg,png',
                'password'=>'required|confirmed',
                'roles_list'=>'required',

            ]);

        if($data->fails())
        {
            return redirect('/users/'.$id.'/edit')->withInput()->withErrors($data->errors());
        }


        $name = public_path($record->img);
        File::delete($name);


        $record ->update($request->all());

        $photo = $request->file('img');
        $name = str_random(20) . '.' . $photo->getClientOriginalExtension();
        $photo->move(public_path('/UserPhotos/'),$name);

        $record->update(['img'=> '/UserPhotos/'.$name]);
        $record->update(['password'=> Hash::make($request->password)]);

        $record->roles()->sync($request->roles_list);

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


        $user = User::find($id);

        if($user)
        {
            $name = public_path($user->img);
            File::delete($name);

            $user->roles()->detach();
            $user->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/users');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/users');
        }
    }
}

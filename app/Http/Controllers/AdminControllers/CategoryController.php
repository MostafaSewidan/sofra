<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AdminDashBord.categories.index');
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
            return redirect('/categories')->withInput()->withErrors($data->errors());
        }

        Category::create(request()->all());
        session()->flash('success' , __('sofra.adding_success'));
        return redirect('/categories');
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
        $category = Category::find($id);

        if($category)
        {

            return view('AdminDashBord.categories.edit', compact('category'));
        }else{

            session()->flash('fail' , __('sofra.category_not_found'));
            return redirect('/categories');
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
            return redirect('/categories/'.$id.'/edit')->withInput()->withErrors($data->errors());
        }

        Category::find($id)->update(['name' => $request->name]);

        session()->flash('success' , __('sofra.update_success'));
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $category = Category::find($id);

        if($category)
        {
            $category->delete();

            session()->flash('success' , __('sofra.Delete_success'));
            return redirect('/categories');
        }else
        {
            session()->flash('fail' , __('sofra.Delete_fail'));
            return redirect('/categories');
        }
    }
}

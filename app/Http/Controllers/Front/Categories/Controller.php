<?php

namespace App\Http\Controllers\Front\Categories;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Categories;

class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db=Categories::latest()->get();
        return view('Front.Categories.index',compact('db'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('Front.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $request->validate([
            'name'=>'required',
            'shifr'=>'required',

        ]);
      

        $db=New Categories([
          'name'=>$request->name,
          'shifr'=>$request->shifr
        ]);
        $db->save();
        if ($db){
            return back()->with('success', 'Saqlandi');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        return view('Front.Categories.update',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categories $categories)
    {
        $categories=Categories::findOrFail($request->id);
           $categories->update([
               'shifr'=>$request->shifr,
               'name'=>$request->name
           ]);
       return redirect()->route('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        File::delete($categories->image);
        $categories->delete();
        return back()->with('success','delete');
    }
}

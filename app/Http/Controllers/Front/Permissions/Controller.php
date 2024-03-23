<?php

namespace App\Http\Controllers\Front\Permissions;

use App\Http\Controllers\Controller as B;
use Illuminate\Http\Request;
use App\Models\Permissions;

class Controller extends B
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  $permissions=Permissions::latest()->get();
        return view('Front.Security.permission',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Front.Security.permission_create');
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
        ]);
        $db=New Permissions([
          'name'=>$request->name,
          'guard_name'=>'web',
        ]);
           $db->save();
            return redirect()->route('permission')->with('success', 'Saqlandi');
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
    public function edit(Permissions $permissions)
    {  
        return view('Front.Security.permission_edit',compact('permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user=Permissions::findOrFail($request->id);
       
        $user->update([
         'name'=>$request->name,
        ]);
    return redirect()->route('permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permissions $permissions)
    {
        $permissions->delete();
        return back()->with('success','delete');
    }
}

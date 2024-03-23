<?php

namespace App\Http\Controllers\Front\Roles;

use App\Http\Controllers\Controller as B;
use App\Models\Roles;
use Illuminate\Http\Request;

class Controller extends B
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles=Roles::latest()->get();
        return view('Front.Security.role',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Front.Security.role_create');
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
        $db=New Roles([
          'name'=>$request->name,
          'guard_name'=>'web',
        ]);
           $db->save();
            return redirect()->route('roles')->with('success', 'Saqlandi');
        
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
    public function edit(Roles $roles)
    {     
        return view('Front.Security.role_edit',compact('roles'));
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
        $user=Roles::findOrFail($request->id);
       
           $user->update([
            'name'=>$request->name,
           ]);
       return redirect()->route('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        $roles->delete();
        return back()->with('success','delete');
    }
}

<?php

namespace App\Http\Controllers\Front\RoleHas;

use App\Http\Controllers\Controller as B;
use Illuminate\Http\Request;
use App\Models\ModelHasRoles;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Controller extends B
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $db = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('users.id as user_id','users.name as username','roles.id as role_id','roles.name as rolename')
        ->get();
        
        return view('Front.Security.role_has',compact('db'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $users=User::latest()->get();
        $roles=Roles::latest()->get();
        return view('Front.Security.role_has_create',compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
         
         $user=User::find($request->user_id);
         $role=Roles::findOrfail($request->role_id);
         ModelHasRoles::create([
            'model_id'=>$user->id,
            'model_type'=>'web',
            'role_id'=>$role->id,
         ]);
         return redirect()->route('rolehas');
     
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
    public function edit($role_id,User $user)
    {    
         $roles=Roles::latest()->get();
      return view('Front.Security.role_has_edit',compact('user','roles','role_id'));
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
        

        $ModelHasRoles=ModelHasRoles::where('role_id',$request->has_id)->where('model_id',$request->user_id)->get();

        $ModelHasRoles[0]->delete();
        $user=User::findOrfail($request->user_id);   
        $role=Roles::findOrfail($request->role_id);   
        $user->assignRole($role->name);
        return redirect()->route('rolehas')->with('success','Ozgardi');
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

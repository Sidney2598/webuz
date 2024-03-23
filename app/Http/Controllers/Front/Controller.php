<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use App\Models\ModelHasRoles;
use App\Models\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   //Role::create(['name' => 'superadmin']);
        //Role::create(['name' => 'admin']);
        //Role::create(['name' => 'user']);
        //$permission = Permission::create(['name' => 'moderator']);
        //   $user=User::find(17);
        //  $user->assignRole('admin2');
     
        //$user=User::find(17);
        // // $user->assignRole('superadmin');
        // $user->givePermissionTo('moderator');

        $id=Auth()->id();
        $user = User::with('roles')->where('login','!=','superadmin')->where('login','!=','moderator')->find($id);
        
        $user2 = User::with('permissions')->find(1);
        if($user!==null){
            if($user->roles[0]->name=='member'){
                $user->update([
                    'status'=>'1',
                ]);
            }
        }
       
        return view('Front.index');
    }
    public function status(){
        User::where('status', '1')->update(['status' => '0']);
        return back();
    }
    public function login()
    {
        return view('Front.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        //
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

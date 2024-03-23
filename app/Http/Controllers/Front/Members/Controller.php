<?php

namespace App\Http\Controllers\Front\Members;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Calclus;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\ModelHasRoles;
use App\Models\Roles;


class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $db=User::latest()->with('category')->get();
        return view('Front.Members.index',compact('db'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categories=Categories::latest()->get();
        return view('Front.Members.create',compact('categories'));
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
            'degre_id'=>'required',
            'category_id'=>'required',
            'login'=>'required',
            'password'=>'required',
            'ilmiy_daraja'=>'required',
        ]);
         $random=time();
         $default_email=$random.rand().'a1@gmail.com';
        $db=New User([
          'name'=>$request->name,
          'degre_id'=>$request->degre_id,
          'category_id'=>$request->category_id,
          'email'=>$default_email,
          'login'=>$request->login,
          'admin'=>1,
          'ilmiy_daraja'=>$request->ilmiy_daraja,
          'password'=>Hash::make($request->password)
        ]);
        $db->save();
        if ($db){
                
                $db->assignRole('member');
                
    
           $db2=new Calclus([
            'name'=>$request->name,
            'degre_id'=>0,
            'category_id'=>$request->category_id,
           ]);
           $db2->save();
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
    public function degre($degre_id,$id)
    {
        $user=User::findOrFail($id);
           $user->update([
               'degre_id'=>$degre_id
           ]);
           return redirect()->route('members');
    }
    public function degre2($degre_id,$id)
    {  
         if($degre_id==0){
            $user=Calclus::findOrFail($id);
            $user->update([
                'degre_id'=>0
            ]);
         }
         else{
            $user=Calclus::findOrFail($id);
            $user->update([
                'degre_id'=>$degre_id
            ]);
         }
        return back()->with('success','Yuklandi'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   $categories=Categories::latest()->get();
        return view('Front.Members.update',compact('user','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user=User::findOrFail($request->id);
        $random=time();
        $default_email=$random.rand().'a1@gmail.com';
           $user->update([
            'name'=>$request->name,
            'degre_id'=>$request->degre_id,
            'category_id'=>$request->category_id,
            'email'=>$default_email,
            'login'=>$request->login,
            'admin'=>1,
            'password'=>Hash::make($request->password)
           ]);
       return redirect()->route('members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        $cal = Calclus::where('name','LIKE',"%{$user->name}%")->get();
        
        $user->delete();
        $cal[0]->delete();
        return back()->with('success','delete');
    }
}

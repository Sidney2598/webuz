<?php

namespace App\Http\Controllers\Front\Vote;

use App\Http\Controllers\Controller as BaseController;
use App\Models\Categories;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Calclus;
use App\Models\VotesMembers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use PhpOffice\PhpWord\Style\Table;

class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $votes2=Vote::where('status','1')->get();
        $plus=[];
        $usercount=User::count()-2;
        foreach($votes2 as $model){
            $count2=VotesMembers::where('vote_id',$model->id)->count();
            array_push($plus,$count2);
        }
        $votes=Vote::latest()->get();
        return view('Front.Vote.index',compact('votes','plus','votes2','usercount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $categories=Categories::all();
        return view('Front.Vote.create',compact('categories'));
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
            'theme'=>'required',
            'username'=>'required',
            'category_id'=>'required',
            'date'=>'required',
            'shifr'=>'required',
            'number'=>'required',
            'file'=>"required|mimes:pdf|max:5120"

        ]);
        $file=($request->hasFile('file'))? $request->file('file')->store('Uploads'): '';
        $db=New Vote([
            'theme'=>$request->theme,
            'username'=>$request->username,
            'category_id'=>$request->category_id,
            'date'=>$request->date,
            'shifr'=>$request->shifr,
            'number'=>$request->number,
            'status'=>'0',
            'file'=>$file,
        ]);
        $db->save();
        if ($db){
            return  back()->with('success', 'Saqlandi');
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
    public function edit(Vote $vote)
    {    $shifr=$vote->category->shifr;
         $user_yonalish= DB::table('users')
         ->leftJoin('categories', 'users.category_id', '=', 'categories.id')
         ->where('categories.shifr',$shifr)
         ->select('users.name','users.status')
         ->get();
         $user_yonalish;   
         $users=User::where('login','!=','admin')->where('login','!=','superadmin')->get();
         $active=User::where('status','1')->count();
         $inactive=User::where('status','0')->count()-2;
        return view('Front.Vote.select',compact('vote','users','active','inactive','user_yonalish'));
    }
    
    public function editend2(Vote $vote)
    {
       $users=Calclus::where('name','!=','admin')->where('name','!=','superadmin')->latest()->get(); 
       return view('Front.Vote.select2',compact('users','vote'));
        
    }
    public function editend3(Vote $vote)
    {  
       $vote=Vote::where('id',$vote->id)->update([
        'status'=>'1',
       ]); 
       
       return redirect()->route('vote');
    }
    public function yakunlash($id){
        $vote=Vote::where('id',$id)->update([
            'status'=>'2',
           ]);
        return redirect()->route('vote');   
    }
    public function yakunlash2($id){
           $votes=Vote::where('id',$id)->update([
            'status'=>'2',
           ]);

        //    $votes23=Vote::where('status','1')->get();
        //    $votes=Vote::where('status','0')->latest()->get();
        //    $plus=[];
        //    $usercount=User::count()-2;
        //    foreach($votes23 as $model){
        //        $count2=VotesMembers::where('vote_id',$model->id)->count();
        //        array_push($plus,$count2);
        //    }
        //    $user=User::where('id',Auth::id())->get();
        //    $k_rais=Calclus::where('degre_id',2)->where('name',$user[0]->name)->get();
        //    $votes2=Vote::where('status','1')->latest()->get(); 

        return redirect()->route('vote.kuntartibi',compact('votes'));   
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
    public function destroy(Vote $vote)
    {
       
       $vote->delete();
       File::delete($vote->file);
       return back()->with('success', 'Saqlandi');
    }
   
}

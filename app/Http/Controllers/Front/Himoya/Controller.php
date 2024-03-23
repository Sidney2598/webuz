<?php

namespace App\Http\Controllers\Front\Himoya;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Vote;
use App\Models\User;
use App\Models\VotesMembers;
use App\Models\Calclus;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\File;
class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $NewArray=[];
        $user_id=Auth::id();

        $db=Vote::where('status','1')->latest()->get(); 
         foreach($db as $item){
            $VoteM=$userCount = DB::table('votes_members')->where('vote_id', $item->id)->where('user_id',$user_id)->count();
            if($VoteM>0){

            }
            else{
                array_push($NewArray,$item);
            }

         }   
         $votes=$NewArray;
       
              
        return view('Front.Vote.himoya',compact('votes'));
    }
    public function kuntartibi(){
        $votes23=Vote::where('status','1')->get();
        $votes=Vote::where('status','0')->latest()->get();
        $plus=[];
        $usercount=User::count()-2;
        foreach($votes23 as $model){
            $count2=VotesMembers::where('vote_id',$model->id)->count();
            array_push($plus,$count2);
        }
        
        $user=User::where('id',Auth::id())->get();
       
        $k_rais=Calclus::where('degre_id',2)->where('name',$user[0]->name)->get();
        $votes2=Vote::where('status','1')->latest()->get();  

        return view('Front.Vote.kuntartibi',compact('k_rais','votes','votes2','plus','usercount'));
    }
    public function yakunlash($id){
        $vote=Vote::where('id',$id)->update([
            'status'=>'2',
           ]);
        return redirect()->route('vote');   
    }
    public function himoya2(Request $request){
        $vote=$request->vote;
        $status=$request->status;
        $id=Auth::id();
        if($vote!=null and $status!=null){
        $ovoz=new VotesMembers([
            'vote_id'=>$vote,
            'user_id'=>$id,
            'status'=>$status
        ]);
        $ovoz->save();
    }
        
        return redirect()->route('himoya');
    }
    public function destroy(Vote $vote){
        File::delete($vote->file);
        $vote->delete();
        return redirect()->route('vote')->with('success', 'Saqlandi');  
    }
    public function wordexport(Vote $vote){
        $values1=User::with('category')->where('login','!=','admin')->where('login','!=','superadmin')->latest()->get();
        $vote=Vote::with('category')->where('id',$vote->id)->get();  
        
        $soni=count($values1);
        $plus=VotesMembers::where('vote_id',$vote[0]->id)->where('status','2')->count(); 
        $minus=VotesMembers::where('vote_id',$vote[0]->id)->where('status','1')->count(); 
        $betaraf=VotesMembers::where('vote_id',$vote[0]->id)->where('status','0')->count(); 
        $q_soni= $plus+$minus+$betaraf;
        $qatnashmaganlar=$soni-$q_soni;
        $shifr_id=$vote[0]->category->id;
        $iqtisoslik_azolar=User::where('category_id',$shifr_id)->count();
        
        $p_foiz=round($plus*100/$q_soni,0);
        $m_foiz=round($minus*100/$q_soni,0);
        $b_foiz=round($betaraf*100/$q_soni,0);
        
        

        $k_rais=Calclus::where('degre_id','2')->latest()->first();
        $k_azo1=Calclus::where('degre_id','1')->latest()->first();
        $k_azo2=Calclus::where('id','!=',$k_azo1->id)->where('degre_id','1')->latest()->first();

        $rais=User::with('category')->where('degre_id',4)->get();    
        $kotib=User::with('category')->where('degre_id',2)->get();
       
        
        $templateProcessor=new TemplateProcessor('Word/protocol.docx');
        $templateProcessor->setValue('userid',$vote[0]->id);
        $templateProcessor->setValue('username',$vote[0]->username);
        $templateProcessor->setValue('date',date('d-m-Y', strtotime($vote[0]->date)));
        $templateProcessor->setValue('b_soni',$vote[0]->number);
        $templateProcessor->setValue('k_rais',$k_rais->name);
        $templateProcessor->setValue('k_azo1',$k_azo1->name);
        $templateProcessor->setValue('k_azo2',$k_azo2->name);

        $templateProcessor->setValue('rais',$rais[0]->name);
        $templateProcessor->setValue('r_i_daraja',$rais[0]->ilmiy_daraja);
        $templateProcessor->setValue('r_shifr',$rais[0]->category->shifr);
        
        $templateProcessor->setValue('kotib',$kotib[0]->name);
        $templateProcessor->setValue('k_i_daraja',$kotib[0]->ilmiy_daraja);
        $templateProcessor->setValue('k_shifr',$kotib[0]->category->shifr);

        $templateProcessor->setValue('theme',$vote[0]->theme);
        $templateProcessor->setValue('shifr',$vote[0]->category->shifr);
        $templateProcessor->setValue('kengash',$vote[0]->category->name);
        $templateProcessor->setValue('soni',$soni);
        $templateProcessor->setValue('plus',$plus);
        $templateProcessor->setValue('minus',$minus);
        $templateProcessor->setValue('betaraf',$betaraf);
        $templateProcessor->setValue('q_soni',$q_soni);
        $templateProcessor->setValue('qatnashmagan',$qatnashmaganlar);
        $templateProcessor->setValue('i_azolar',$iqtisoslik_azolar);
        $templateProcessor->setValue('p_foiz',$p_foiz);
        $templateProcessor->setValue('m_foiz',$m_foiz);
        $templateProcessor->setValue('b_foiz',$b_foiz);
        $filename=$vote[0]->username;
        $values=[];
        for($i=0;$i<count($values1);$i++){
            $k=2+$i;
            if($values1[$i]->degre_id !=4 and $values1[$i]->degre_id !=2){
                $ar=['id'=>$k,'name'=>$values1[$i]->name,'i_daraja'=>$values1[$i]->ilmiy_daraja,'shifr'=>$values1[$i]->category->shifr];
                array_push($values,$ar);
            }
        }
       
        $templateProcessor->cloneRowAndSetValues('id',$values);
        $templateProcessor->saveAs($filename.'.docx'); 
        return response()->download($filename.'.docx')->deleteFileAfterSend(true);
    }
     
}

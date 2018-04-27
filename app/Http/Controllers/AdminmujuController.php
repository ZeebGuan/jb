<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminmujuController  extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$idcard='';$count='';$name='';$phone='';$beizhu='';$gongxu='';$title='';$totelpage='';
            if($do=='list'){
                $totelpage=ceil(DB::table('jb_muju')->count()/10);
            }elseif($do=='mujulist'){
                if($request->has('currPage')){
                    $currPage=$request->get('currPage');
                }else{
                    $currPage=1;
                }
                if($request->has('pageSize')){
                    $pageSize=$request->get('pageSize');
                }else{
                    $pageSize=10;
                }
                $page=($currPage-1)*$pageSize;
                $result=DB::table('jb_muju')
                    ->leftjoin('jb_gongxu','jb_muju.gx_id','=','jb_gongxu.id')
                    ->select('jb_muju.id','jb_muju.title','jb_muju.pic','jb_muju.bianhao','jb_gongxu.title as gxtitle');
                if($request->has('title')){
                    $title=$request->input('title');
                    $result=$result->where('jb_muju.title','like','%'.$title.'%');
                }
                if($request->has('gongxu')){
                    $gongxu=$request->input('gongxu');
                    $result=$result->where('jb_gongxu.title','like','%'.$gongxu.'%');
                }
                $result=$result->orderby('jb_muju.id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$functionController::highLight($e->id,$id,$color = "red").'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'","gxtitle":"'.$functionController::highLight($e->gxtitle,$gongxu,$color = "red").'","bianhao":"'.$e->bianhao.'","pic":"'.$e->pic.'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }elseif($do=='add'){
                $maxid=DB::select('select bianhao from jb_muju order by bianhao desc limit 0,1');
                if(count($maxid)=='1'){
                    $id=$maxid[0]->bianhao+1;
                }else{
                    $id='100001';
                }
                $data=DB::select('select id,title from jb_gongxu order by id desc');
            }elseif($do=='edit'){
                $data=DB::select('select id,title,bianhao,gx_id,pic from jb_muju where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该设备';
                }
                $gongxu=DB::select('select id,title from jb_gongxu order by id desc');            }
            return view('admin.muju',[
                'data'=>$data,
                'count'=>$count,
                'beizhu'=>$beizhu, 'gongxu'=>$gongxu, 'title'=>$title,
                'do'=>$do,'totelpage'=>$totelpage,
                'user'=>$user,
                'name'=>$name,
                'id'=>$id,
                'phone'=>$phone,
                'idcard'=>$idcard
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }



}
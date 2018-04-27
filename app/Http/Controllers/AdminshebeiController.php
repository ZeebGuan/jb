<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminshebeiController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$idcard='';$count='';$name='';$phone='';$beizhu='';$gongxu='';$title='';$totelpage='';
            if($do=='list'){
                $totelpage=ceil(DB::table('jb_shebei')->count()/10);
            }elseif($do=='add'){
                $maxid=DB::select('select id from jb_shebei order by id desc limit 0,1');
                if(count($maxid)=='1'){
                    $id=$maxid[0]->id+1;
                }else{
                    $id='1000';
                }
                $data=DB::select('select id,title from jb_gongxu order by id desc');
            }elseif($do=='edit'){
                $data=DB::select('select id,title,gongxu from jb_shebei where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该设备';
                }
                $gongxu=DB::select('select id,title from jb_gongxu order by id desc');
            }elseif($do=='shebeilist'){
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
                $result=DB::table('jb_shebei')->select('id','title','gongxu');

                if($request->has('title')){
                    $title=$request->input('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('gongxu')){
                    $gongxu=$request->input('gongxu');
                    $str=explode(' ',$gongxu);
                    $a=',';
                    for($i=0;$i<count($str);$i++){
                        $gx=DB::table('jb_gongxu')->where('title','like','%'.$str[$i].'%')->select('id')->get();
                        foreach($gx as $e){
                            $a=$a.$e->id.',';
                        }
                    }
                    $a=trim($a,',');
                    $a=explode(',',$a);
                    for($i=0;$i<count($a);$i++){

                        $result=$result->where('gongxu','like','%,'.$a[$i].',%');
                    }

                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $gx=AdminshebeiController::totitle($e->gongxu);
                    if($request->has('gongxu')){
                        $g=$request->input('gongxu');
                        $s=explode(' ',$g);
                        for($i=0;$i<count($s);$i++){
                            $gx=$functionController::highLight($gx,$s[$i],$color = "red");
                        }
                    }
                    $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'","gongxu":"'.$gx.'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }
            return view('admin.shebei',[
                'data'=>$data,
                'count'=>$count,
                'beizhu'=>$beizhu, 'gongxu'=>$gongxu, 'title'=>$title,'totelpage'=>$totelpage,
                'do'=>$do,
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

    //把ID转换
    public static function totitle($str){
        $str=trim($str,',');
        $str=explode(',',$str);
        $gongxu=DB::table('jb_gongxu')->whereIn('id',$str)->select('id','title')->get();
        $a='';
        foreach($gongxu as $e){
            $a=$a.$e->title.',';
        }
        return trim($a,',');
    }

}
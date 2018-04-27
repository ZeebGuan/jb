<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminyuangongController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$idcard='';$count='';$name='';$phone='';$beizhu='';$gongxu='';$totelpage='';
            if($do=='list'){
                $totelpage=ceil(DB::table('jb_worker')->count()/10);
            }elseif($do=='add'){
                $maxid=DB::select('select idcard from jb_worker order by idcard desc limit 0,1');
                if(count($maxid)=='1'){
                    $id=$maxid[0]->idcard+1;
                }else{
                    $id='10000001';
                }
                $data=DB::select('select id,title from jb_gongxu order by id desc');
            }elseif($do=='info'){
                $data=DB::select('select id,idcard,name,phone,beizhu,sex,shijian from jb_worker where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该员工资料';
                }
                $gongxu=DB::select('select id,title from jb_gongxu order by id desc');

            }elseif($do=='yuangonglist'){
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
                $result=DB::table('jb_worker')->select('id','idcard','name','phone','sex','shijian','beizhu');
                if($request->has('idcard')){
                    $idcard=$request->input('idcard');
                    $result=$result->where('idcard','like','%'.$idcard.'%');
                }
                if($request->has('name')){
                    $name=$request->input('name');
                    $result=$result->where('name','like','%'.$name.'%');
                }
                if($request->has('phone')){
                    $phone=$request->input('phone');
                    $result=$result->where('phone','like','%'.$phone.'%');
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
                        $result=$result->where('beizhu','like','%,'.$a[$i].',%');
                    }

                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $gx=AdminshebeiController::totitle($e->beizhu);
                    if($request->has('gongxu')){
                        $g=$request->input('gongxu');
                        $s=explode(' ',$g);
                        for($i=0;$i<count($s);$i++){
                            $gx=$functionController::highLight($gx,$s[$i],$color = "red");
                        }
                    }
                    if($e->sex=='1'){$sex='男';}else{$sex='女';}

                    $str=$str.'{"id":"'.$e->id.'","idcard":"'.$functionController::highLight($e->idcard,$idcard,$color = "red").'","name":"'.$functionController::highLight($e->name,$name,$color = "red").'","phone":"'.$functionController::highLight($e->phone,$phone,$color = "red").'","sex":"'.$sex.'","shijian":"'.date('Y-m-d H:i:s',$e->shijian).'","gongxu":"'.$gx.'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }
            return view('admin.yuangong',[
                'data'=>$data,
                'totelpage'=>$totelpage,
                'count'=>$count,
                'beizhu'=>$beizhu,
                'gongxu'=>$gongxu,
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

    public static function checkgongxu($str,$a){
        $a=','.$a.',';
        if(strstr($str,$a))
        {
            return 'checked';
        }
        else
        {
            return '';
        }
    }


}
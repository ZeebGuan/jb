<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminkehuController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$title='';$count='';$name='';$phone='';$dizhi='';$totelpage='';
            if($do=='list'){
                $totelpage=ceil(DB::table('jb_kehu')->count()/10);
            }elseif($do=='add'){
                $maxid=DB::select('select id from jb_kehu order by id desc limit 0,1');
                if(count($maxid)=='1'){
                    $id=$maxid[0]->id+1;
                }else{
                    $id='1';
                }
            }elseif($do=='info'){
               $data=DB::select('select id,title,name,phone,dizhi,beizhu,shijian from jb_kehu where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该客户资料';
                }
            }elseif($do=='kehulist'){
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
                $result=DB::table('jb_kehu')->select('id','title','name','phone','dizhi','beizhu','shijian');
                if($request->has('id')){
                    $id=$request->input('id');
                    $result=$result->where('id','=',$id);
                }
                if($request->has('title')){
                    $title=$request->input('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('name')){
                    $name=$request->input('name');
                    $result=$result->where('name','like','%'.$name.'%');
                }
                if($request->has('phone')){
                    $phone=$request->input('phone');
                    $result=$result->where('phone','like','%'.$phone.'%');
                }
                if($request->has('dizhi')){
                    $dizhi=$request->input('dizhi');
                    $result=$result->where('dizhi','like','%'.$dizhi.'%');
                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$functionController::highLight($e->id,$id,$color = "red").'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'","name":"'.$functionController::highLight($e->name,$name,$color = "red").'","phone":"'.$functionController::highLight($e->phone,$phone,$color = "red").'","dizhi":"'.$functionController::highLight($e->dizhi,$dizhi,$color = "red").'","beizhu":"'.$e->beizhu.'","shijian":"'.date('Y-m-d H:i:s',$e->shijian).'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }
            return view('admin.kehu',[
                'data'=>$data,
                'count'=>$count,
                'do'=>$do,
                'user'=>$user,
                'totelpage'=>$totelpage,
                'name'=>$name,
                'id'=>$id,
                'dizhi'=>$dizhi,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }



    }


}
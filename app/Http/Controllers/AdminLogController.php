<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminLogController extends Controller{
    //操作日志
    public function action(Request $request,PowerController $powerController){
        if($powerController::islogin()=='success'){
            $result=DB::table('jb_do');
            if($request->has('user')){
                $user=$request->get('user');
                $result=$result->where('user',$user);
            }else{
                $user='';
            }
            if($request->has('keyword')){
                $keyword=$request->get('keyword');
                $result=$result->where('action','like','%'.$keyword.'%');
            }else{
                $keyword='';
            }
            if($request->has('start')){
                $start=$request->get('start');
                $result=$result->where('shijian','>',$start);
            }else{
                $start='';
            }
            if($request->has('end')){
                $end=$request->get('end');
                $result=$result->where('shijian','<',$end);
            }else{
                $end='';
            }
            $result=$result->orderBy('shijian','desc');
            if($request->has('page')){
                $page=$request->get('page')-1;
            }else{
                $page='0';
            }
            $count=$result->count()-($page*10);
            $data=$result->paginate(10);

            return view('admin.log.action',[
                'data'=>$data, 'count'=>$count, 'user'=>$user,'keyword'=>$keyword,'start'=>$start,'end'=>$end,
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }

    //登录日志
    //1后台登录日志 0会员登录日志
    public function log(Request $request,PowerController $powerController,$type='0'){
        if($powerController::islogin()=='success'){
            $result=DB::table('jb_login')->where('type',$type);
            if($request->has('user')){
                $user=$request->get('user');
                $result=$result->where('user','like','%'.$user.'%');
            }else{
                $user='';
            }
            if($request->has('ip')){
                $ip=$request->get('ip');
                $result=$result->where('ip','like','%'.$ip.'%');
            }else{
                $ip='';
            }
            if($request->has('start')){
                $start=$request->get('start');
                $result=$result->where('shijian','>',$start);
            }else{
                $start='';
            }
            if($request->has('end')){
                $end=$request->get('end');
                $result=$result->where('shijian','<',$end);
            }else{
                $end='';
            }
            $result=$result->orderBy('shijian','desc');
            if($request->has('page')){
                $page=$request->get('page')-1;
            }else{
                $page='0';
            }
            $count=$result->count()-($page*10);
            $data=$result->paginate(10);

            return view('admin.log.login',[
                'data'=>$data, 'count'=>$count, 'user'=>$user,'ip'=>$ip,'start'=>$start,'end'=>$end,'type'=>$type,
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }
}
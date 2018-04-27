<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\PowerController;
use Illuminate\Support\Facades\URL;

class AdminuserController extends Controller{

    //管理员管理
    public function admin(FunctionController $functionController,PowerController $powerController,Request $request,$do='list',$id='0'){
        if($powerController::islogin()=='success'){
            $data='';$user='';$typeid='';$station='';$count='';$name='';$type='';$title='';$userinfo='';$phone='';
            if($do=='list'){
                $result=DB::table('jb_admin_user')
                    ->leftjoin('jb_admin_user_left','jb_admin_user.type','=','jb_admin_user_left.id')
                    ->select('jb_admin_user.id','jb_admin_user.user','jb_admin_user.name','jb_admin_user.type','jb_admin_user.station','jb_admin_user.shijian','jb_admin_user.lasttime','jb_admin_user.phone','jb_admin_user.ip','jb_admin_user_left.title')
                ;

                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('jb_admin_user.user','like','%'.$user.'%');
                }else{
                    $user='';
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('jb_admin_user.name','like','%'.$name.'%');
                }else{
                    $name='';
                }
                if($request->has('phone')){
                    $phone=$request->get('phone');
                    $result=$result->where('jb_admin_user.phone','like','%'.$phone.'%');
                }else{
                    $phone='';
                }
                $result=$result->orderBy('jb_admin_user.shijian','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='add'){
                $data=DB::select('select * from jb_admin_user_left  order by id asc');
                $count=count($data);
            }elseif($do=='edit'){
                $data=DB::select('select * from jb_admin_user_left  order by id asc');
                $count=count($data);
                $userinfo=DB::select('select * from jb_admin_user where id=?',[$id]);
                $title=DB::select('select * from cym_userleft where id=?',[$typeid]);
            }
            return view('admin.user',[
                'data'=>$data,'phone'=>$phone,
                'count'=>$count,
                'do'=>$do,
                'user'=>$user,
                'name'=>$name,
                'typeid'=>$typeid,
                'station'=>$station,
                'id'=>$id,
                'type'=>$type,'userinfo'=>$userinfo,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }

    //管理员管理
    public function adminleft(FunctionController $functionController,PowerController $powerController,Request $request,$do='list',$id='0'){
        if($powerController::islogin()=='success'){
            $data='';$user='';$typeid='';$station='';$count='';$name='';$type='';$keyword='';
            if($do=='list'){
                $result=DB::table('jb_admin_user_left');

                if($request->has('keyword')){
                    $keyword=$request->get('keyword');
                    $result=$result->where('title','like','%'.$keyword.'%');
                }
                $result=$result->orderBy('shijian','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='add'){

            }elseif($do=='edit'){
                $data=DB::select('select * from jb_admin_user_left where id=?',[$id]);
                $type=$data[0]->flag;
                $keyword=$data[0]->title;

            }
            return view('admin.adminleft',[
                'data'=>$data,
                'count'=>$count,
                'do'=>$do,
                'user'=>$user,
                'name'=>$name,
                'typeid'=>$typeid,
                'station'=>$station,
                'id'=>$id,
                'type'=>$type,
                'keyword'=>$keyword
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }



}
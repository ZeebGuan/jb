<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdmingongyingController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$title='';$count='';$name='';$phone='';$dizhi='';
            if($do=='list'){
                $result=DB::table('jb_gongyingshang');

                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('id')){
                    $id=$request->get('id');
                    $result=$result->where('id','=',$id);
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('name','like','%'.$name.'%');
                }
                if($request->has('phone')){
                    $phone=$request->get('phone');
                    $result=$result->where('phone','like','%'.$phone.'%');
                }
                if($request->has('dizhi')){
                    $dizhi=$request->get('dizhi');
                    $result=$result->where('dizhi','like','%'.$dizhi.'%');
                }
                $result=$result->orderby('id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='add'){
                $maxid=DB::select('select id from jb_kehu order by id desc ');
                if(count($maxid)=='1'){
                    $id=$maxid[0]->id;
                }else{
                    $id='1';
                }
            }elseif($do=='info'){
               $data=DB::select('select id,title,name,phone,dizhi,shijian from jb_gongyingshang where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该供应商资料';
                }
            }
            return view('admin.gongyingshang',[
                'data'=>$data,
                'count'=>$count,
                'dizhi'=>$dizhi,
                'do'=>$do,
                'user'=>$user,
                'name'=>$name,
                'id'=>$id,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }



    }


}
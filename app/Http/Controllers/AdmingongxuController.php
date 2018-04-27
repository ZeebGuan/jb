<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdmingongxuController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$title='';$count='';$name='';$phone='';$dizhi='';
            if($do=='list'){
                $result=DB::table('jb_gongxu');

                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
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

            }elseif($do=='edit'){
               $data=DB::select('select id,title from jb_gongxu where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该工序';
                }
            }
            return view('admin.gongxu',[
                'data'=>$data,
                'count'=>$count,
                'do'=>$do,
                'id'=>$id,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }



    }


}
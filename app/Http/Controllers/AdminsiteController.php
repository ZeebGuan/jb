<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\URL;

class AdminsiteController extends Controller{

    //网站配置
    public function index(FunctionController $functionController,PowerController $powerController,Request $request,$do='info',$id='0'){
        if($powerController::islogin()=='success'){
            $data='';
            if($do=='info'){
                $data=DB::select('select * from jb_site where id=1');
            }
            return view('admin.site',[
                'data'=>$data,'do'=>$do,
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }
}
<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;

class AdminpaidanbiController extends Controller{

    public function paidanbi(FunctionController $functionController,PowerController $powerController,Request $request){
        if($powerController::islogin()=='success'){
            $ip=DB::select('select ip,lasttime from cym_user where id=?',[$request->session()->get('adminid')]);
            $power=DB::select('select title from cym_userleft where id=?',[$request->session()->get('power')]);
            return view('admin.paidanbi',[
                'admin'=>$request->session()->get('admin'),
                'ip'=>$ip[0]->ip,
                'shijian'=>$ip[0]->lasttime,
                'power'=>$power[0]->title,
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }

}
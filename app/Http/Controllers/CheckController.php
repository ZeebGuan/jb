<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;


class CheckController extends Controller{
    //判断验证码是否正确
    public function checkcode(Request $request)
    {
        $code=$request->session()->get('code');
        if($code==$request->input('param'))
        {
            return '{"info":"验证通过！","status":"y"}';
        }else{
            return '{"info":"验证码错误，请检查！","status":"n"}';
        }
    }
    //判断手机验证码是否正确
    public function checkphonecode(Request $request)
    {
        $code=$request->session()->get('phonecode');
        if($code==$request->input('param'))
        {
            echo '{"info":"验证通过！","status":"y"}';
        }else{
            echo '{"info":"验证码错误，请检查！","status":"n"}';
        }
    }

    //判断手机号是否存在
    public function checkuser(Request $request)
    {
        $user=DB::select('select id from cym_reguser where user=? or phone=?',
        [$request->input('param'),$request->input('param')]);
        if(count($user)==1)
        {
            echo '{"info":"验证通过！","status":"y"}';
        }else{
            echo '{"info":"帐号或手机号不存在！","status":"n"}';
        }
    }


    //判断帐号是否存在
    public function checkadminuser(Request $request)
    {
        $user=DB::select('select id from jb_admin_user where user=?',[$request->input('param')]);
        if(count($user)=='0')
        {
            echo '{"info":"验证通过！","status":"y"}';
        }else{
            echo '{"info":"帐号已存在！","status":"n"}';
        }
    }
    //判断客户是否存在
    public function checkkehu(Request $request)
    {
        $user=DB::select('select id from jb_kehu where title=?',[$request->input('param')]);
        if(count($user)=='0')
        {
            echo '{"info":"验证通过！","status":"y"}';
        }else{
            echo '{"info":"该客户已存在，请检查！","status":"n"}';
        }
    }


    //判断供应商是否存在
    public function checkgongying(Request $request)
    {
        $user=DB::select('select id from jb_gongyingshang where title=?',[$request->input('param')]);
        if(count($user)=='0')
        {
            echo '{"info":"验证通过！","status":"y"}';
        }else{
            echo '{"info":"该供应商已存在，请检查！","status":"n"}';
        }
    }
}
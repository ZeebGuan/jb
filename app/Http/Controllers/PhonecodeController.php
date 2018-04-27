<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\FunctionController;
use Session;

class PhonecodeController extends Controller{
    //网页版手机短信
    //29244 短信验证码 29245匹配订单数据 29272 找回二级密码
    //$mobile 手机号码 $messageid模版ID，$values短信内容,$key短信密匙
    //返回值error_code 0发送成功 1发送失败
    public function sms(FunctionController $functionController,$phone,Request $request)
    {
        if(strlen($phone)=='11'){
            $code=rand(100000,999999);
            $functionController::sendSMS($phone, '【公众创益】您的验证码是:'.$code);
            $request->session()->put('phonecode',$code);
            $request->session()->put('phone',$phone);
        }else{
            return '非法手机号！';
        }

    }




}
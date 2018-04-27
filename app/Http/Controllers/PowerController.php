<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;

class PowerController extends Controller{
    //通用登录
    public static function islogin(){
        if(Session::get("loginstation")!="32115db466b09673")
        {
            $thisurl = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            $thisurl = urlencode($thisurl);
            return $thisurl;
        }
        else
        {
            if(Session::get('HTTP_USER_AGENT')!= md5($_SERVER['HTTP_USER_AGENT'])){
                Session::flush();
                $thisurl = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
                $thisurl = urlencode($thisurl);
                return "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
            }
            else
            {
                return 'success';
            }
        }
    }

    //判断$str是否包含$a字符
    public static function isstr($str,$a)
    {
        if(strstr($str,$a))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

}
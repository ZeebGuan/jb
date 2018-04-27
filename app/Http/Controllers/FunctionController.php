<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FunctionController extends Controller{
    /**
     * 发送短信
     * @param string $mobile 		手机号码
     * @param string $msg 			短信内容
     * @param string $needstatus 	是否需要状态报告
     */
    public static function sendSMS( $phone, $msg, $needstatus = 'true') {
        if(strlen($phone)=='11'){
            //获取手机号今天发送短信的条数
            $num=DB::select('select num from cym_phone where phone=?',[$phone]);
            if(count($num)=='1'){ //今天发送了短信，读取短信条数
                if($num[0]->num>0 && $num[0]->num<10){
                    $station='1';
                    DB::update('update cym_phone set num=num+1 where phone=?',[$phone]);
                }else{
                    $station='0';
                }
            }else{ //没有发送过短信，写入记录
                $station='1';
                DB::insert('insert into cym_phone (phone,shijian,num) values(?,?,?)',[$phone,date("Y-m-d H:i:s"),'1']);
            }
            if($station=='1'){ //发送短信
                //创蓝接口参数
                $postArr = array (
                    'account'  =>  FunctionController::siteinfo('messageuser'),
                    'password' => FunctionController::siteinfo('messagekey'),
                    'msg' => urlencode($msg),
                    'phone' => $phone,
                    'report' => $needstatus
                );
                $result =FunctionController::curlPost('http://smssh1.253.com/msg/send/json' , $postArr);
                if(!is_null(json_decode($result))){
                    $output=json_decode($result,true);
                    if(isset($output['code'])  && $output['code']=='0'){
                        return '短信发送成功！' ;
                    }else{
                        return $output['errorMsg'];
                    }
                }else{
                    return $result;
                }

            }else{
                return '短信发送超过上限,禁止发送！';
            }
        }else{
            return '非法手机号！';
        }

    }
    /**
     * 通过CURL发送HTTP请求
     * @param string $url  //请求URL
     * @param array $postFields //请求参数
     * @return mixed
     */
    public static function curlPost($url,$postFields){
        $postFields = json_encode($postFields);
        $ch = curl_init ();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8'
            )
        );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt( $ch, CURLOPT_TIMEOUT,1);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec ( $ch );
        if (false == $ret) {
            $result = curl_error(  $ch);
        } else {
            $rsp = curl_getinfo( $ch, CURLINFO_HTTP_CODE);
            if (200 != $rsp) {
                $result = "请求状态 ". $rsp . " " . curl_error($ch);
            } else {
                $result = $ret;
            }
        }
        curl_close ( $ch );
        return $result;
    }



    //加密解密函数
    //$str = 'abcdef';
    //$operation=DECODE时解密，其他值都是加密
    //authcode($str,'ENCODE',$key,0); //加密
    //authcode($str,'DECODE',$key,0); //解密
    public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
        $key='32115db466b09673';
        $ckey_length = 4;
        $key = md5($key ? $key : $GLOBALS['discuz_auth_key']);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length):
            substr(md5(microtime()), -$ckey_length)) : '';
        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) :
            sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) &&
                substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }
    }

    //搜索高亮
    public static function highLight($str,$keywords,$color = "red")
    {
        $keywords=explode(' ',$keywords);
        if (empty($keywords)) {
            return $str;
        } else{
            for($i=0;$i<count($keywords);$i++){
                $str=str_replace($keywords,"<font color=".$color .">".$keywords[$i]."</font>",$str);
            }
            return $str;
        }
    }

    //获取用户真实IP
    public static function GetIp(){
        $realip = '';
        $unknown = 'unknown';
        if (isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach($arr as $ip){
                    $ip = trim($ip);
                    if ($ip != 'unknown'){
                        $realip = $ip;
                        break;
                    }
                }
            }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){
                $realip = $_SERVER['REMOTE_ADDR'];
            }else{
                $realip = $unknown;
            }
        }else{
            if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){
                $realip = getenv("HTTP_CLIENT_IP");
            }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){
                $realip = getenv("REMOTE_ADDR");
            }else{
                $realip = $unknown;
            }
        }
        $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;
        return $realip;
    }
    //根据IP获取位置信息
    public static function GetIpLookup($ip = ''){
        if(empty($ip)){
            $ip = GetIp();
        }
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$ip);
        if(empty($res)){ return false; }
        $jsonMatches = array();
        preg_match('#\{.+?\}#', $res, $jsonMatches);
        if(!isset($jsonMatches[0])){ return false; }
        $json = json_decode($jsonMatches[0], true);
        if(isset($json['ret']) && $json['ret'] == 1){
            $json['ip'] = $ip;
            unset($json['ret']);
        }else{
            return false;
        }
        return $json;
    }

    //时间相减
    public static function tianshu($date,$date1)
    {
        //先把时分秒格式化
        $date=date('Y-m-d',strtotime($date));
        $date1=date('Y-m-d',strtotime($date1));
        $startdate=strtotime($date);
        $enddate=strtotime($date1);
        $days=round(($enddate-$startdate)/3600/24) ;
        return $days;
    }

    //获取一些网站的配置常量
    public static function siteinfo($str){
        $site=DB::select('select * from jb_site where id=1');
        return $site[0]->$str;
    }




    //判断$str是否包含$a字符
    public static function istrue($str,$a)
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
    //随机获取一张图片出来做缩略图
    //type  1产品图片2子配件图片
    public static function getpic($id,$type){
        $pic=DB::select('select pic from jb_pic where  p_id=? order by shijian desc limit 0,1',[$id]);
        if(count($pic)=='0'){
            return asset('images/nopic.png');
        }else{
            return $pic[0]->pic;
        }
    }



    //判断$str是否包含$a字符
    public static function haspic($str)
    {
        $str = str_replace(' ', '', $str);
        if($str=='')
        {
            return asset('images/nopic.png');
        }
        else
        {
            return $str;
        }
    }


    //字符串编码为UTF-8的，一个中文字符占三个字节
    public static function mysubstr($str, $start, $len)
    {
        $tmpstr="";
        $strlen = $start + $len; // 用$strlen存储字符串的总长度，即从字符串的起始位置到字符串的总长度
        for($i = $start; $i < $strlen;) {
            if (ord ( substr ( $str, $i, 1 ) ) > 0xa0) { // 如果字符串中首个字节的ASCII序数值大于0xa0,则表示汉字
                $tmpstr .= substr ( $str, $i, 3 ); // 每次取出三位字符赋给变量$tmpstr，即等于一个汉字
                $i=$i+3; // 变量自加3
            } else{
                $tmpstr .= substr ( $str, $i, 1 ); // 如果不是汉字，则每次取出一位字符赋给变量$tmpstr
                $i++;
            }
        }
        return $tmpstr; // 返回字符串
    }
    /**
     * 压缩html : 清除换行符,清除制表符,去掉注释标记
     * */
    public static function compress_html($string) {
        $string = str_replace("\r\n", '', $string); //清除换行符
        $string = str_replace("\n", '', $string); //清除换行符
        $string = str_replace("\t", '', $string); //清除制表符
        $pattern = array (
            "/> *([^ ]*) *</", //去掉注释标记
            "/[\s]+/",
            "/<!--[^!]*-->/",
            "/\" /",
            "/ \"/",
            "'/\*[^*]*\*/'"
        );
        $replace = array (
            ">\\1<",
            " ",
            "",
            "\"",
            "\"",
            ""
        );
        return preg_replace($pattern, $replace, $string);
    }

}
<?php
namespace App\Http\Controllers;
use App\Http\Controllers\CodenumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\FunctionController;
use App\Bank;
use App\Reguser;

class LoginController extends Controller{
    //验证码
    function codenum(Request $request,CodenumController $codenumController){
        $codenumController->doimg();
        $request->session()->put('code',$codenumController->getCode());
    }


    //登录界面
    function index(Request $request,FunctionController $functionController){
        $type=1;
        $code=$request->session()->get('code');
        return view('login.login',[
            'type'=>$type,
            'sitename'=>'登录--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);
    }
    //判断登录
    function checklogin(Request $request,FunctionController $functionController){
        $ip=$functionController->GetIp();
        $weizhi=$functionController->GetIpLookup($ip);
        $address=$weizhi['province'].$weizhi['city'].$weizhi['district'].'----'.$ip;
        $code=$request->session()->get('code');
        $msg='';
        //验证码是否正确
        if($code==$_POST['code'])
        {
               //判断帐号是否存在
            $user=DB::select('select id,user,name,type,station,phone,password from jb_admin_user where user=?',[$request->input('user')]);
            //帐号是否存在
            if(count($user)==1) {
                //密码是否正确
                if($functionController->authcode($user[0]->pwd,'DECODE','32115db466b09673',0)==$_POST['pwd'])
                {
                    //帐号状态
                    if($user[0]->station=='0'){ //未激活
                        $msg='帐号未激活';
                        $url=URL('login');
                    }elseif($user[0]->station=='1' || $user[0]->station=='3'){ //已激活 额度冻结
                        //写入登录记录
                        DB::insert('insert into cym_login(userid,ip,shijian,station,logintype,user,pwd) values(?,?,?,?,?,?,?)',[
                            $user[0]->id,$address,date('Y-m-d H:i:s'),'登录成功','0',$_POST['user'],$_POST['pwd']
                        ]);
                        $request->session()->put('station','success');
                        $request->session()->put('id',$user[0]->id);
                        $request->session()->put('user',$user[0]->user);
                        $request->session()->put('name',$user[0]->name);
                        $request->session()->put('phone',$user[0]->phone);
                        //额度校正 有效直推
                        $youxiao=$functionController::tuijiannum($user[0]->id);
                        if($youxiao>17){$edu=100000;}
                        else{$edu=($youxiao+1)*5000+5000;}
                        //获取当前挂单额
                        $guadan=$functionController::guadan($user[0]->id);
                        $shijiedu=$edu-$guadan;
                        DB::update('update jb_admin_user set lasttime=?,ip=?,tigongedu=? where id=?',[
                            date('Y-m-d H:i:s'),$address,$shijiedu,$user[0]->id
                        ]);
                        $msg='登录成功';
                        $url=URL('/');

                    }elseif($user[0]->station=='2'){//封号
                        $msg='帐号被封，拒绝登录';
                        $url=URL('login');
                    }else{
                        $msg='帐号异常';
                        $url=URL('login');
                    }
                }
                else{
                    //写入登录记录
                    DB::insert('insert into cym_login(userid,ip,shijian,station,logintype,user,pwd) values(?,?,?,?,?,?,?)',[
                        $user[0]->id,$address,date('Y-m-d H:i:s'),'非法登录','0',$_POST['user'],$_POST['pwd']
                    ]);
                    $msg='密码错误';
                    $url=URL('login');
                }
            }else{
                $msg='帐号或手机号不存在';
                $url=URL('login');
            }
        }
        else
        {
            $msg='验证码错误';
            $url=URL('login');
        }
        $type=2;
        return view('login.login',[
            'type'=>$type,
            'msg'=>$msg,
            'url'=>$url,
            'sitename'=>'验证登录信息--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);
    }
    //退出登录
    function logout(Request $request){
        //清除所有session
        //$request->session()->flush();
        $request->session()->forget('station');
        $request->session()->forget('id');
        $request->session()->forget('user');
        $request->session()->forget('name');
        $type=3;
        return view('login.logout',[
            'type'=>$type,
            'sitename'=>'退出登录--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);
    }

    //注册
    function reg(Request $request,FunctionController $functionController,$tuijian='0'){

        $userid=($tuijian-88)/2;
        //如果userid是整数并且大于0
        if(is_int($userid) && $userid>0)
        {
            $tuijian=DB::select('select user from cym_reguser where id=?',[$userid]);
            if(count($tuijian)=='1'){
                $user=$tuijian[0]->user;
            }else{
                $user="";
            }
        }
        else{
            $user="";
        }
        $bank=Bank::get();
        return view('login.reg',[
            'user'=>$user,
            'bank'=>$bank,
            'regstation'=>$functionController::siteinfo('regstation'),
            'sitename'=>'会员注册--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);
    }

    //注册信息验证
    function checkreguser(Request $request,FunctionController $functionController){
        $type=5;
        //首先判断是否开启注册
        if($functionController::siteinfo('regstation')=='1'){
            //判断手机验证码是否正确
            if($request->session()->get('phonecode')==$_POST['code']){
                //判断帐号或手机号是否已存在
                $user=DB::select('select id from cym_reguser where user=? or phone=?',[$_POST['user'],$_POST['user']]);
                $phone=DB::select('select id from cym_reguser where user=? or phone=?',[$_POST['phone'],$_POST['phone']]);
                if(count($user)=='0' && count($phone)=='0'){
                    //身份证是否已注册
                    $cardnum=DB::select('select id from cym_reguser where idcard=?',[$_POST['cardnum']]);
                    if(count($cardnum)=='0'){
                        //推荐人帐号是否已存在
                        $tuijian=DB::select('select id from cym_reguser where user=?',[$_POST['tuijian']]);
                        if(count($tuijian)=='0'){
                            $msg='推荐人帐号不存在！';
                            $url=URL('reg');
                        }else{
                            //姓名与户名必须一致
                            if($_POST['name']==$_POST['huming']){
                                //限制某些地区身份证注册
                                if($functionController::xianzhi($_POST['cardnum'])=='0'){
                                    //判断密码是否符合要求
                                    if($functionController::checkregpwd($request->input('user'),$request->input('pwd'),$request->input('erpwd'))=='1'){
                                        //姓名，银行卡，身份证联网认证
                                        if($functionController::checkinfo($_POST['name'],$_POST['banknum'],$_POST['cardnum'])=='1'){
                                            $user=str_replace(' ','',$request->input('user'));
                                            $phone=str_replace(' ','',$request->input('phone'));
                                            $e=DB::insert('insert into cym_reguser (user,pwd,erpwd,tuijian,name,sex,idcard,phone,bankname,kaihuhang,kaihudizhi,huming,banknum,weixin,alipay,qq,shijian,sheng,shi) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[
                                                $user,$functionController::authcode($request->input('pwd'),'ENCODE','e8fe11ba8061',0),$functionController::authcode($request->input('erpwd'),'ENCODE','e8fe11ba8061',0),
                                                $tuijian[0]->id,$request->input('name'),$request->input('sex'),str_replace(' ','',$request->input('cardnum')),$phone,
                                                $request->input('bankname'),$request->input('kaihuhang'),$request->input('kaihudizhi'),$request->input('huming'),
                                                str_replace(' ','',$request->input('banknum')),$request->input('weixin'),$request->input('alipay'),$request->input('qq'),
                                                date('Y-m-d H:i:s'),$request->input('sheng'),$request->input('shi')
                                            ]);
                                            if($e){
                                                //同步数据到众享IM
                                                $functionController::PostZx($request->input('phone'));
                                                $functionController::POSTmrzg($request->input('phone'));
                                                $msg='注册成功，请等待账户激活！';
                                                $url=URL('login');
                                            }else{
                                                $msg='数据异常，注册失败！';
                                                $url=URL('reg');
                                            }

                                        }else{
                                            $msg='实名认证失败！';
                                            $url=URL('reg');
                                        }
                                    }else{
                                        $msg='帐号、密码、二级密码不能一样，密码为5-16位字符！';
                                        $url=URL('reg');
                                    }
                                }elseif($functionController::xianzhi($request->input('cardnum'))=='1'){
                                    $msg='该地区会员已达上限！';$url=URL('reg');
                                }elseif($functionController::xianzhi($request->input('cardnum'))=='2'){
                                    $msg='年龄需满18周岁低于65周岁！';$url=URL('reg');
                                }
                            }else{
                                $msg='姓名与银行户名必须一致！';
                                $url=URL('reg');
                            }
                        }
                    }else{
                        $msg='身份证号码已注册！';
                        $url=URL('reg');
                    }

                }else{
                    $msg='帐号或手机号已存在！';
                    $url=URL('reg');
                }

            }else{
                $msg='手机验证码错误！';
                $url=URL('reg');
            }
        }else{
            $msg='该地区会员已达上限！';
            $url=URL('login');
        }
        return view('login.login',[
            'type'=>$type,
            'msg'=>$msg,
            'url'=>$url,
            'sitename'=>'验证注册信息--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);

    }


    //重置密码
    function resetpwd(Request $request){
        $type=4;
        return view('login.resetpwd',[
            'type'=>$type,
            'sitename'=>'重置密码--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);
    }

    //重置密码数据验证
    public function checkresetpwd(Request $request,FunctionController $functionController){
        $phone=$request->session()->get('phone');
        $code=$request->session()->get('phonecode');
        if($phone==$_POST['phone'] && $code==$_POST['code']){
            //判断手机号是否存在
            $isphone=DB::select('select id from cym_reguser where phone=?' ,[$_POST['phone']]);
            if(count($isphone)=='1'){
                $pwd=$functionController::authcode($_POST['pwd'],'ENCODE','e8fe11ba8061',0);
                DB::update('update cym_reguser set pwd=? where phone=?',[$pwd,$_POST['phone']]);
                $msg='密码重置成功！';
                $url=URL('login');
            }else{
                $msg='手机号不存在！';
                $url=URL('login');
            }

        }else{
            $msg='手机号或手机验证码异常，请重试！';
            $url=URL('login');
        }
        $type=6;
        return view('login.login',[
            'type'=>$type,
            'msg'=>$msg,
            'url'=>$url,
            'sitename'=>'重置密码--'.FunctionController::siteinfo('sitename'),
            'keyword'=>FunctionController::siteinfo('keyword'),
            'description'=>FunctionController::siteinfo('description')
        ]);

    }


    public function phonecode(Request $request,FunctionController $functionController){
        if($request->has('type'))
        {
            $mobile=$request->get('phone');
            if($request->get('type')=='code'){
                $messageid='29244';
                $values=rand(1000,9999);
                $functionController::SMS($mobile,$messageid,$values);
                $request->session()->put('phonecode',$values);
                $request->session()->put('phone',$mobile);
                return '获取验证码成功';
            }else{
                return '获取验证码失败';
            }
        }
        else{return '获取验证码失败';}
    }


}
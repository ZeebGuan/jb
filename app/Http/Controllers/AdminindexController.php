<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\CodenumController;

class AdminindexController extends Controller{

    //验证码
    function codenum(Request $request,CodenumController $codenumController){
        $codenumController->doimg();
        $request->session()->put('code',$codenumController->getCode());
    }

    //登录界面
    public function login(FunctionController $functionController,Request $request){
        if($request->has('go')){
            $go=$request->get('go');
        }else{
            $go='';
        }
        return view('admin.login',[
            'sitename'=>$functionController::siteinfo('sitename'),
            'keyword'=>$functionController::siteinfo('keyword'),
            'description'=>$functionController::siteinfo('description'),
            'go'=>$go
        ]);
    }
    //后台首页
    public function index(FunctionController $functionController,PowerController $powerController,Request $request){
        if($powerController::islogin()=='success'){
            $nav='';
            $power=DB::select('select flag from jb_admin_user_left where id=?',[$request->session()->get('power')]);
            //订单管理
            if($powerController::isstr($power[0]->flag,'a')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>订单管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'a1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/order/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>订单列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'a2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/order/tongji').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>订单统计</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //库存管理
            if($powerController::isstr($power[0]->flag,'b')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>库存管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'b1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/product/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>产品管理</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'b4')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/xilie/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>系列管理</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'b3')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/yuanliao/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>原料管理</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //客户管理
            if($powerController::isstr($power[0]->flag,'c')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>客户管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'c1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/kehu/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>客户列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'c2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/kehu/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加客户</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //业务员管理
            if($powerController::isstr($power[0]->flag,'d')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>业务员管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'d1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/yewuyuan/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>业务员列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'d2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/yewuyuan/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加业务员</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //模具管理
            if($powerController::isstr($power[0]->flag,'k')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>设备管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'k1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/shebei/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>设备列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'k2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/shebei/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加设备</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }

            //模具管理
            if($powerController::isstr($power[0]->flag,'e')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>模具管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'e1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/muju/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>模具列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'e2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/muju/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加模具</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }

            //工序管理
            if($powerController::isstr($power[0]->flag,'f')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>工序管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'f1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/gongxu/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>工序列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'f2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/gongxu/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加工序</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //员工管理
            if($powerController::isstr($power[0]->flag,'g')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>员工管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'g1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/yuangong/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>员工列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'g2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/yuangong/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加员工</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //任务管理
            if($powerController::isstr($power[0]->flag,'m')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>任务管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'m1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/renwu/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>任务列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'m2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/renwu/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加任务</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //供应商管理
            if($powerController::isstr($power[0]->flag,'m')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>供应商管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'m1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/gongying/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>供应商列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'m2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/gongying/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加供应商</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //采购管理
            if($powerController::isstr($power[0]->flag,'m')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>采购管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'m1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/gongying/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>采购列表</a></li>';
                }

                $nav=$nav.'</ul></li>';
            }
            //网站配置
            if($powerController::isstr($power[0]->flag,'g')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>网站配置<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'g1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/site/info').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>网站配置</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }
            //管理员管理
            if($powerController::isstr($power[0]->flag,'h')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>管理员管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'h1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/admin/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>管理员列表</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'h2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/admin/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>添加管理员</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'h3')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/adminleft/list').'" target="menuFrame"><i class="glyph-icon icon-chevron-right3"></i>账户角色</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'h4')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/adminleft/add').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>添加角色</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }

            //日志管理
            if($powerController::isstr($power[0]->flag,'j')=='1'){
                $nav=$nav.'<li class="menu-list"><a style="cursor:pointer" class="firsta"><i class="glyph-icon xlcd"></i>日志管理<s class="sz"></s></a><ul>';
                if($powerController::isstr($power[0]->flag,'j1')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/action').'" target="menuFrame"><i class="glyph-icon icon-chevron-right1"></i>操作日志</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'j2')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/log/1').'" target="menuFrame"><i class="glyph-icon icon-chevron-right2"></i>系统登录日志</a></li>';
                }
                if($powerController::isstr($power[0]->flag,'j3')=='1'){
                    $nav=$nav.'<li><a href="'.URL('jb_admin/log/0').'" target="menuFrame"><i class="glyph-icon icon-chevron-right3"></i>客户登录日志</a></li>';
                }
                $nav=$nav.'</ul></li>';
            }

            return view('admin.index',[
                'admin'=>$request->session()->get('admin'),
                'nav'=>$nav,
                'sitename'=>$functionController::siteinfo('sitename'),
                'keyword'=>$functionController::siteinfo('keyword'),
                'description'=>$functionController::siteinfo('description'),
                'adminid'=>$request->session()->get('adminid'),
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }

    //后台main主页
    public function main(FunctionController $functionController,PowerController $powerController,Request $request){
        if($powerController::islogin()=='success'){
            $ip=DB::select('select ip,lasttime from jb_admin_user where id=?',[$request->session()->get('adminid')]);
            $power=DB::select('select title from jb_admin_user_left where id=?',[$request->session()->get('power')]);
            return view('admin.main',[
                'admin'=>$request->session()->get('admin'),
                'ip'=>$ip[0]->ip,
                'shijian'=>date('Y-m-d H:i:s',$ip[0]->lasttime),
                'power'=>$power[0]->title,
                'hostip'=>$_SERVER['SERVER_ADDR']
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }

    //退出登录
    public function logout(Request $request){
        //清除所有session
        //$request->session()->flush();
        //清除指定session
        $request->session()->forget('loginstation');
        $request->session()->forget('admin');
        $request->session()->forget('name');
        $request->session()->forget('power');
        $request->session()->forget('adminid');
        $request->session()->forget('HTTP_USER_AGENT');
        return Redirect::to('jb_admin/login');
    }

    //判断登录
    public  function logincheck(FunctionController $functionController,Request $request){
        //判断帐号是否存在
        $user=DB::select('select id,user,name,type,password,station from jb_admin_user where user=?',[$request->input('user')]);
        if(count($user)=='1'){
            //判断 一下状态，IP地址
            $ip=$functionController::GetIp();
            $weizhi=$functionController::GetIpLookup($ip);
            $address=$weizhi["province"].$weizhi["city"].$weizhi["district"]." ---- ".$ip;
            //判断密码是否相等
            $pwd=$functionController::authcode($user[0]->password,'DECODE','',0);
            if($pwd==$request->input('pwd')){
                if($user[0]->station=='1'){
                    //正常帐号登录成功
                    DB::insert('insert into jb_login(ip,shijian,userid,station,type,user) values (?,?,?,?,?,?)',[
                        $address,time(),$user[0]->id,'登录成功','1',$request->input('user')
                    ]);
                    DB::update('update jb_admin_user set lasttime=?,ip=? where id=?',[time(),$address,$user[0]->id]);
                    $request->session()->put('loginstation','32115db466b09673');
                    $request->session()->put('admin',$user[0]->user);
                    $request->session()->put('name',$user[0]->name);
                    $request->session()->put('power',$user[0]->type);
                    $request->session()->put('adminid',$user[0]->id);
                    $request->session()->put('HTTP_USER_AGENT',md5($_SERVER['HTTP_USER_AGENT']));
                    if($request->input('go')==''){
                        return Redirect::to('jb_admin/');
                    }else{
                        return Redirect::to($request->input('go'));
                    }
                }elseif($user[0]->station=='1'){
                    //帐号锁定，写入记录
                    DB::insert('insert into jb_login(ip,shijian,userid,station,type,user) values (?,?,?,?,?,?)',[
                        $address,time(),$user[0]->id,'帐号锁定','1',$request->input('user')
                    ]);
                    return '帐号锁定,拒绝登录！';
                }else{
                    return '帐号异常！';
                }
            }else{
                //帐号锁定，写入记录
                DB::insert('insert into jb_login(ip,shijian,userid,station,type,user) values (?,?,?,?,?,?)',[
                    $address,time(),$user[0]->id,'密码错误','1',$request->input('user')
                ]);
                return '密码错误！';
            }
        }else{
            return '帐号不存在！';
        }
    }



}
<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\PowerController;
use Illuminate\Support\Facades\URL;
use Session;

class AdmindosqlController extends Controller{

    //执行sql语句的页面
    public function excsql(Request $request,FunctionController $functionController,PowerController $powerController,$do='',$id=''){
        $msg='异常操作！';
        $url=$_SERVER['HTTP_REFERER'];
        $ip=$functionController::GetIp();
        $weizhi=$functionController::GetIpLookup($ip);
        $address=$weizhi["province"].$weizhi["city"].$weizhi["district"]." ---- ".$ip;
        if($powerController::islogin()=='success'){
            //删除登录记录
            if($do=='delalluserlogin'){
                AdmindosqlController::log('删除会员登录记录成功',$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::delete('delete from cym_login where logintype=0');
                $msg='删除成功！';
            }
            if($do=='delalladminlogin'){
                AdmindosqlController::log('删除后台登录记录成功',$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::delete('delete from cym_login where logintype=1');
                $msg='删除成功！';
            }
            //更新网站配置
            if($do=='site'){
                    AdmindosqlController::log('更新网站配置成功',$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_site set sitename=?,keyword=?,description=?,phone=?,dizhi=?,cnzz=?,station=?,regstation=?,qq=?,email=?,fax=?,kefu=?,kucun=? where id=1',[
                        $request->input('sitename'),$request->input('keyword'),$request->input('description'),
                        $request->input('phone'),$request->input('dizhi'),
                        $request->input('cnzz'),$request->input('station'),$request->input('regstation'),
                        $request->input('qq'),$request->input('email'),$request->input('fax'),$request->input('kefu'),$request->input('kucun')
                    ]);
                $msg='修改成功！';
            }
            //管理员帐号锁定 解锁
            if($do=='suoding'){
                AdmindosqlController::log('锁定帐号成功，帐号ID：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::update('update jb_admin_user set station=2 where id=?',[$id]);
                $msg='锁定帐号成功！';
            }
            //管理员帐号锁定 解锁
            if($do=='deladmin'){
                AdmindosqlController::log('删除帐号成功，帐号ID：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::delete('delete from jb_admin_user where id=?',[$id]);
                $msg='锁定帐号成功！';
            }

            if($do=='jiesuo'){
                AdmindosqlController::log('解除帐号成功，帐号ID：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::update('update jb_admin_user set station=1 where id=?',[$id]);
                $msg='解除帐号成功！';
            }
            if($do=='addadminuser'){
                AdmindosqlController::log('添加管理员帐号成功，帐号：'.$request->input('user'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                $pwd=$functionController::authcode($request->input('pwd'),'ENCODE','',0);
                DB::insert('insert into jb_admin_user(user,name,password,type,station,phone,shijian,lasttime,ip) values (?,?,?,?,?,?,?,?,?)',[
                    $request->input('user'),$request->input('name'),$pwd,$request->input('typeid'),$request->input('station'),$request->input('phone'),time(),time(),''
                    ]);
                $msg='添加帐号成功！';
            }
            //修改帐号
            if($do=='editadminuser'){
                AdmindosqlController::log('修改帐号成功，帐号ID：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                $pwd=$functionController::authcode($request->input('pwd'),'ENCODE','',0);
                DB::update('update cym_user set p_name=?,station=?,p_pwd=? where id=?',[
                    $request->input('name'),$request->input('station'),$pwd,$id]);
                $msg='修改成功！';
            }
            //帐号角色
            if($do=='addadminleft'){
                AdmindosqlController::log('添加帐号角色成功，角色名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                $flag='';
                if(count($request->input('flag'))>0){
                    for($i=0;$i<count($request->input('flag'));$i++){
                        $flag=$flag.$request->input('flag')[$i].',';
                    }
                }
                DB::insert('insert into jb_admin_user_left(title,flag,shijian) values (?,?,?)',[
                    $request->input('title'),$flag,time()
                ]);
                $msg='添加成功！';
            }

            //帐号角色
            if($do=='editadminleft'){
                $userleft=DB::select('select title from jb_admin_user_left where id=?',[$id]);
                if(count($userleft)=='1'){
                    AdmindosqlController::log('修改帐号角色成功，ID：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    $flag='';
                    if(count($request->input('flag'))>0){
                        for($i=0;$i<count($request->input('flag'));$i++){
                            $flag=$flag.$request->input('flag')[$i].',';
                        }
                    }
                    DB::update('update jb_admin_user_left set title=?,flag=? where id=?',[
                        $request->input('title'),$flag,$id
                    ]);
                    $msg='修改成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //帐号角色
            if($do=='deladminleft'){
                $userleft=DB::select('select title from jb_admin_user_left where id=?',[$id]);
                if(count($userleft)=='1'){
                    AdmindosqlController::log('删除帐号角色成功，ID：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));

                    DB::delete('delete from jb_admin_user_left where id=?',[$id]);
                    $msg='删除成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //
            //添加客户
            if($do=='addkehu'){
                //判断客户名称是否存在
                $is=DB::select('select id from jb_kehu where title=?',[$request->input('title')]);
                if(count($is)=='1'){
                    $msg='该客户已存在，请检查！';
                }else{
                    AdmindosqlController::log('添加客户成功，客户名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::insert('insert into jb_kehu(title,name,phone,dizhi,beizhu,shijian) VALUES (?,?,?,?,?,?)',[
                        $request->input('title'),$request->input('name'),$request->input('phone'),$request->input('dizhi'),
                        $request->input('beizhu'),time()
                    ]);
                    $msg='添加客户成功！';
                }
            }
            //更新客户资料成功
            if($do=='editkehu'){
                $kehu=DB::select('select id from jb_kehu where id=?',[$id]);
                if(count($kehu)=='1'){
                    AdmindosqlController::log('更新客户资料成功，客户编号：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_kehu set title=?,name=?,phone=?,dizhi=?,beizhu=? where id=?',[
                        $request->input('title'),$request->input('name'),$request->input('phone'),$request->input('dizhi'),$request->input('beizhu'),$id
                    ]);
                    $msg='更新客户资料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //删除客户资料
            if($do=='delkehu'){
                $is=DB::select('select id,title from jb_kehu where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除客户资料成功，客户ID：'.$id.',客户名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_kehu where id=?',[$id]);
                    $msg='删除客户资料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //添加供应商
            if($do=='addgongying'){
                //判断供应商名称是否存在
                $is=DB::select('select id from jb_gongyingshang where title=?',[$request->input('title')]);
                if(count($is)=='1'){
                    $msg='该供应商已存在，请检查！';
                }else{
                    AdmindosqlController::log('添加供应商成功，客户名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::insert('insert into jb_gongyingshang(title,name,phone,dizhi,shijian) VALUES (?,?,?,?,?)',[
                        $request->input('title'),$request->input('name'),$request->input('phone'),$request->input('dizhi'), time()
                    ]);
                    $msg='添加供应商成功！';
                }
            }
            //更新供应商资料成功
            if($do=='editgongying'){
                $is=DB::select('select id from jb_gongyingshang where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('更新供应商资料成功，供应商编号：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_gongyingshang set title=?,name=?,phone=?,dizhi=? where id=?',[
                        $request->input('title'),$request->input('name'),$request->input('phone'),$request->input('dizhi'),$id
                    ]);
                    $msg='更新供应商资料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //删除供应商资料
            if($do=='delgongying'){
                $is=DB::select('select id,title from jb_gongyingshang where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除供应商资料成功，客户ID：'.$id.',供应商名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_gongyingshang where id=?',[$id]);
                    $msg='删除供应商资料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //添加工序
            if($do=='addgongxu'){
                //判断工序是否存在
                $is=DB::select('select id from jb_gongxu where title=?',[$request->input('title')]);
                if(count($is)=='1'){
                    $msg='该工序已存在，请检查！';
                }else{
                    AdmindosqlController::log('添加工序成功，工序名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::insert('insert into jb_gongxu(title) VALUES (?)',[$request->input('title')]);
                    $msg='添加工序成功！';
                }
            }
            //更新工序
            if($do=='editgongxu'){
                $is=DB::select('select id from jb_gongxu where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('更新工序成功，工序编号：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_gongxu set title=? where id=?',[
                        $request->input('title'),$id
                    ]);
                    $msg='更新工序成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //删除供应商资料
            if($do=='delgongxu'){
                $is=DB::select('select id,title from jb_gongxu where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除工序成功，ID：'.$id.',名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_gongxu where id=?',[$id]);
                    $msg='删除工序成功！';
                }else{
                    $msg='ID异常！';
                }
            }

            //添加员工
            if($do=='addyuangong'){
                AdmindosqlController::log('添加员工成功，员工名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                $beizhu='';
                if($request->input('beizhu')!=''){
                    $beizhu=',';
                    for($i=0;$i<count($request->input('beizhu'));$i++){
                        $beizhu=$beizhu.$request->input('beizhu')[$i].',';
                    }
                }
                DB::insert('insert into jb_worker(idcard,name,phone,sex,shijian,beizhu) VALUES (?,?,?,?,?,?)',[
                    $request->input('idcard'),$request->input('name'),$request->input('phone'),$request->input('sex'),strtotime($request->input('shijian')),$beizhu
                ]);
                $msg='添加员工成功！';
            }
            //更新员工资料
            if($do=='edityuangong'){
                $is=DB::select('select id from jb_worker where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('更新员工资料成功，供应商编号：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    $beizhu='';
                    if($request->input('beizhu')!=''){
                        $beizhu=',';
                        for($i=0;$i<count($request->input('beizhu'));$i++){
                            $beizhu=$beizhu.$request->input('beizhu')[$i].',';
                        }
                    }
                    DB::update('update jb_worker set name=?,phone=?,sex=?,shijian=?,beizhu=? where id=?',[
                        $request->input('name'),$request->input('phone'),$request->input('sex'),strtotime($request->input('shijian')),$beizhu,$id
                    ]);
                    $msg='更新员工资料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //删除员工资料
            if($do=='delyuangong'){
                $is=DB::select('select id,name,idcard from jb_worker where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除员工资料成功，员工ID：'.$id.',员工工号：'.$is[0]->idcard.',员工姓名：'.$is[0]->name,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_worker where id=?',[$id]);
                    $msg='删除员工资料成功！';
                }else{
                    $msg='ID异常！';
                }
            }

            //产品系列
            if($do=='addproductxilie'){
                AdmindosqlController::log('添加系列成功，系列名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::insert('insert into jb_xilie(title,type) VALUES (?,?)',[
                    $request->input('title'),$request->input('type')
                ]);
                $msg='添加系列成功！';
            }
            //产品系列
            if($do=='editproductxilie'){
                $is=DB::select('select id from jb_xilie where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('更新系列成功，系列编号：'.$id,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_xilie set title=? where id=?',[
                        $request->input('title'),$id
                    ]);
                    $msg='更新产品系列成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //产品系列
            if($do=='delproductxilie'){
                $is=DB::select('select id,title from jb_xilie where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除产品系列成功，系列编号：'.$id.',系列名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_xilie where id=?',[$id]);
                    $msg='删除产品系列成功！';
                }else{
                    $msg='ID异常！';
                }
            }

            //产品
            if($do=='addyuanliao'){
                AdmindosqlController::log('添加原料成功，原谅名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::insert('insert into jb_product(title,typeid,bianhao,rukutime,shijian,picihao,sell_station,type,kucun,guige,danwei) VALUES (?,?,?,?,?,?,?,?,?,?,?)',[
                    $request->input('title'),$request->input('typeid'),$request->input('bianhao'),strtotime($request->input('rukutime')),
                    time(),$request->input('picihao'),'0','3',$request->input('kucun'),$request->input('guige'),$request->input('danwei')
                ]);
                if($request->input('pic')!=''){
                    //获取产品ID
                    $p=DB::select('select * from jb_product where title=? order by shijian desc limit 0,1',[$request->input('title')]);
                    $picstr=explode("|", $request->input('pic'));
                    for($i=0;$i<count($picstr)-1;$i++)
                    {
                        if($i!=count($picstr)-1)
                        {
                            DB::insert('insert into jb_pic(pic,type,shijian,p_id) values (?,?,?,?)',[
                                $picstr[$i],'3',time(),$p[0]->id
                            ]);
                        }
                    }
                }
                $msg='添加原料成功！';
            }
            //产品
            if($do=='edityuanliao'){
                $is=DB::select('select id,title from jb_product where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('更新原料成功，ID：'.$id.',原料名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_product set title=?,typeid=?,bianhao=?,rukutime=?,picihao=?,kucun=?,guige=?,danwei=? where id=?',[
                        $request->input('title'),$request->input('typeid'),$request->input('bianhao'),strtotime($request->input('rukutime')),
                        $request->input('picihao'),$request->input('kucun'),$request->input('guige'),$request->input('danwei'),$id
                    ]);
                    DB::delete('delete from jb_pic where type=3 and p_id=?',[$id]);
                    if($request->input('pic')!=''){
                        $picstr=explode("|", $request->input('pic'));
                        for($i=0;$i<count($picstr)-1;$i++)
                        {
                            if($i!=count($picstr)-1)
                            {
                                DB::insert('insert into jb_pic(pic,type,shijian,p_id) values (?,?,?,?)',[
                                    $picstr[$i],'3',time(),$id
                                ]);
                            }
                        }
                    }
                    $msg='更新原料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //产品
            if($do=='delproduct'){
                $is=DB::select('select id,title from jb_product where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除产品成功，编号：'.$id.',名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_product where id=?',[$id]);
                    $msg='删除产品成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //产品
            if($do=='addproductgx'){
                $is=DB::select('select id,title from jb_product where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('添加工序成功，产品ID：'.$id.',产品名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    //先清空在重新写入
                    DB::delete('delete from jb_product_gongxu where p_id=?',[$id]);
                    $pid=$request->input('p_id');
                    $gongxuid=$request->input('gongxu_id');
                    if(count($gongxuid)>0){
                        for($i=0;$i<count($gongxuid);$i++){
                            DB::insert('insert into jb_product_gongxu(p_id,gx_id,pp_id) VALUES (?,?,?)',[
                                $id,$gongxuid[$i],$pid[$i]
                            ]);
                        }
                    }
                    $msg='添加工序成功！';
                }else{
                    $msg='ID异常！';
                }
            }

            //产品下单
            if($do=='addorder'){
                $num=$request->input('num');
                $price=$request->input('price');
                $pid=$request->input('pid');
                //下主订单
                $e=DB::insert('insert into jb_order (orderid,kehu_id,name,phone,endtime,jine,admin_id,didian,beizhu,shijian,monitime,station,type) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',[
                    $request->input('orderid'),$request->input('kehu_id'),$request->input('name'),$request->input('kehu_phone'),strtotime($request->input('endtime')),
                    $request->input('jine'),$request->session()->get('adminid'),$request->input('kehu_didian'),$request->input('beizhu'),
                    time(),strtotime($request->input('monitime')),'1','2'
                ]);
                //分支写入产品参数
                if($e){
                    AdmindosqlController::log('下单成功，客户名称：'.$request->input('kehu_title').',金额：'.$request->input('jine'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    if(count($pid)>0){
                        for($i=0;$i<count($pid);$i++){
                            DB::insert('insert into jb_orderlist(orderid,pid,num,jine,totel,shijian) VALUES (?,?,?,?,?,?)',[
                                $request->input('orderid'),$pid[$i],$num[$i],$price[$i],$num[$i]*$price[$i],time()
                            ]);
                        }
                    }
                    $msg='下单成功！';
                }else{
                    $msg='下单异常，请核查！';
                }
            }
            //修改订单
            if($do=='editorder'){
                $num=$request->input('num');
                $price=$request->input('price');
                $pid=$request->input('pid');
                //判断订单号是否存在
                $order=DB::select('select id from jb_order where orderid=?',[$request->input('p_orderid')]);
                if(count($order)=='1'){ //订单存在，修改
                    $e=DB::update('update jb_order set kehu_id=?,name=?,phone=?,endtime=?,jine=?,didian=?,beizhu=?,monitime=? where id=?',[
                        $request->input('p_id'),$request->input('p_name'),$request->input('p_phone'),strtotime($request->input('p_endtime')),$request->input('p_jine'),
                        $request->input('p_didian'),$request->input('p_beizhu'),strtotime($request->input('p_monitime')),$order[0]->id
                    ]);
                    //分支写入产品参数
                    if($e){
                        //先清除存在的
                        DB::delete('delete from jb_orderlist where orderid=?',[$request->input('p_orderid')]);
                        AdmindosqlController::log('修改订单成功，客户名称：'.$request->input('kehu_title').',金额：'.$request->input('jine'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                        if(count($pid)>0){
                            for($i=0;$i<count($pid);$i++){
                                DB::insert('insert into jb_orderlist(orderid,pid,num,jine,totel,shijian) VALUES (?,?,?,?,?,?)',[
                                    $request->input('p_orderid'),$pid[$i],$num[$i],$price[$i],$num[$i]*$price[$i],time()
                                ]);
                            }
                        }
                        $msg='修改订单成功！';
                    }else{
                        $msg='下单异常，请核查！';
                    }
                }else{
                    $msg='订单号不存在，请检查！';
                }

            }


            //模具
            if($do=='addmuju'){
                $pic='';
                if($request->input('pic')!=''){
                    $picstr=explode("|", $request->input('pic'));
                    $pic=$picstr[0];
                }
                AdmindosqlController::log('添加模具成功，模具名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::insert('insert into jb_muju(title,bianhao,pic,gx_id) VALUES (?,?,?,?)',[
                    $request->input('title'),$request->input('bianhao'),$pic,$request->input('gx_id')
                ]);
                $msg='添加原料成功！';
            }
            //产品
            if($do=='edityuanliao'){
                $is=DB::select('select id,title from jb_muju where id=?',[$id]);
                $pic='';
                if($request->input('pic')!=''){
                    $picstr=explode("|", $request->input('pic'));
                    $pic=$picstr[0];
                }
                if(count($is)=='1'){
                    AdmindosqlController::log('更新模具成功，ID：'.$id.',模具名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::update('update jb_muju set title=?,bianhao=?,pic=?,gx_id=? where id=?',[
                        $request->input('title'),$request->input('bianhao'),
                        $pic,$request->input('gx_id'),$id
                    ]);
                    $msg='更新原料成功！';
                }else{
                    $msg='ID异常！';
                }
            }
            //产品
            if($do=='delmuju'){
                $is=DB::select('select id,bianhao,title from jb_muju where id=?',[$id]);
                if(count($is)=='1'){
                    AdmindosqlController::log('删除模具成功，编号：'.$is[0]->bianhao.',名称：'.$is[0]->title,$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::delete('delete from jb_muju where id=?',[$id]);
                    $msg='删除产品成功！';
                }else{
                    $msg='ID异常！';
                }
            }


            if($do=='addshebei'){
                AdmindosqlController::log('添加设备成功，设备名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                $beizhu=$request->input('beizhu');
                $str='';
                if(count($beizhu)>0){
                    $str=',';
                    for($i=0;$i<count($beizhu);$i++){
                        $str=$str.$beizhu[$i].',';
                    }
                }
                $e=DB::insert('insert into jb_shebei (id,title,gongxu) VALUES (?,?,?)',[
                    $request->input('id'),$request->input('title'),$str
                ]);
                if($e){
                    $msg='添加设备成功！';
                }else{
                    $msg='数据异常，添加失败！';
                }
            }
            if($do=='editshebei'){
                $shebei=DB::select('select title,gongxu from jb_shebei where id=?',[$id]);
                if(count($shebei)=='1'){
                    AdmindosqlController::log('更新设备资料成功，设备名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    $beizhu=$request->input('beizhu');
                    $str='';
                    if(count($beizhu)>0){
                        $str=',';
                        for($i=0;$i<count($beizhu);$i++){
                            $str=$str.$beizhu[$i].',';
                        }
                    }
                    $e=DB::update('update jb_shebei set title=?,gongxu=? where id=?',[
                        $request->input('title'),$str,$id
                    ]);
                    if($e){
                        $msg='更新设备资料成功！';
                    }else{
                        $msg='数据异常，更新失败！';
                    }
                }else{
                    $msg='ID异常，设备编号不存在！';
                }

            }

            return view('admin.do',[
                'msg'=>$msg,'url'=>$url,
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }



    public static function log($log,$ip,$weizhi)
    {
        $logpath=public_path('log')."/".date("Ymd").".txt";
        $address=$weizhi["province"].$weizhi["city"].$weizhi["district"];
        $log_f=fopen($logpath,"a+");
        fputs($log_f,'帐号：'.Session::get('admin')."\r\n");
        fputs($log_f,'操作：'.$log."\r\n");
        fputs($log_f,'时间：'.date('Y-m-d H:i:s')."\r\n");
        fputs($log_f,'IP：'.$ip."\r\n");
        fputs($log_f,'位置：'.$address."\r\n");
        fclose($log_f);
        //同时也写入数据库记录
        DB::insert('insert into jb_do(user,action,shijian,location) values (?,?,?,?)',[
            Session::get('admin'),$log,time(),$ip.'----'.$address
        ]);
    }
}
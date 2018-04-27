<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Session;
use App\Http\Controllers\FunctionController;
use App\Http\Controllers\PowerController;
use Illuminate\Support\Facades\URL;

class AdminmemberController extends Controller{

    public function member(FunctionController $functionController,PowerController $powerController,Request $request,$do='list',$id='0'){
        if($powerController::islogin()=='success'){
            $data='';$user='';$cardnum='';$station='';$orderstation='';$count='';$name='';$start='';$end='';$type='';$i=0;$page=1;$num=0;$totel7='0';$totel8='0';
            $tuijian='';$phone='';$userid='';$jine='';$jine1='';$totel1='0';$totel2='0';$totel3='0';$totel4='0';$totel5='0';$totel6='0';$totel9='0';$jibie='';
            if($do=='list'){
                $result=DB::table('cym_reguser')
                        ->leftjoin('cym_jibie','cym_jibie.id','=','cym_reguser.jibie')
                        ->select('cym_reguser.id','cym_reguser.isorder','cym_reguser.delstation','cym_reguser.user','cym_reguser.name','cym_reguser.tuijian','cym_reguser.phone','cym_reguser.station','cym_reguser.tigongedu','cym_reguser.shijian','cym_reguser.jhshijian','cym_reguser.fhshijian','cym_reguser.djshijian','cym_reguser.jinbi','cym_reguser.yinbi','cym_reguser.totel','cym_reguser.paidanbi','cym_jibie.title')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','like','%'.$user.'%');
                }
                if($request->has('userid')){
                    $userid=$request->get('userid');
                    $result=$result->where('cym_reguser.id','=',$userid);
                }
                if($request->has('jibie')){
                    $jibie=$request->get('jibie');
                    $result=$result->where('cym_reguser.jibie','=',$jibie);
                }
                if($request->has('phone')){
                    $phone=$request->get('phone');
                    $result=$result->where('cym_reguser.phone','like','%'.$phone.'%');
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('cym_reguser.name','like','%'.$name.'%');
                }
                if($request->has('tuijian')){
                    $tuijian=$request->get('tuijian');
                    $result=$result->where('cym_reguser.tuijian','=',$tuijian);
                }
                if($request->has('cardnum')){
                    $cardnum=$request->get('cardnum');
                    $result=$result->where('cym_reguser.idcard','like','%'.$cardnum.'%');
                }
                if($request->has('station')){
                    $station=$request->get('station');
                    if($station=='4'){
                        $result=$result->where('cym_reguser.station','!=','2');
                    }else{
                        $result=$result->where('cym_reguser.station','=',$station);
                    }
                }
                if($request->has('orderstation')){
                    $orderstation=$request->get('orderstation');
                    $result=$result->where('cym_reguser.isorder','=',$orderstation);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_reguser.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_reguser.shijian','<=',$end);
                }
                if($station=='2'){
                    $result=$result->orderBy('cym_reguser.fhshijian','desc');
                }elseif($station=='3'){
                    $result=$result->orderBy('cym_reguser.djshijian','desc');
                }else{
                    $result=$result->orderBy('cym_reguser.shijian','desc');
                }
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);


            }elseif($do=='tuandui'){
                $result=DB::table('cym_tuandui')
                    ->leftjoin('cym_reguser','cym_tuandui.userid','=','cym_reguser.id')
                    ->select('cym_tuandui.user','cym_reguser.user as reguser','cym_tuandui.name','cym_tuandui.shijian','cym_tuandui.beizhu')
                ;

                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_tuandui.user','like','%'.$user.'%');
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_tuandui.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_tuandui.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_tuandui.shijian','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='info'){
                $data=DB::select('select * from cym_reguser where id=?',[$id]);
            }elseif($do=='reg'){
                $data=DB::select('select id,title from cym_bank');
            }
            elseif($do=='shouyi'){
                if($request->has('user')){
                    $user=$request->get('user');
                    $memberid=DB::select('select id from cym_reguser where user=? or phone=?',[$user,$user]);
                    if(count($memberid)=='1'){
                        $tigong=DB::select('select sum(jine) as money from cym_offer where userid=? and station=5 and type=1',[$memberid[0]->id]);
                        $qingqiu=DB::select('select sum(jine) as money from cym_offer where userid=? and station=5 and type=2',[$memberid[0]->id]);
                        $tigongold=DB::select('select sum(jine) as money from cym_offer_old where userid=? and station=5 and type=1',[$memberid[0]->id]);
                        $qingqiuold=DB::select('select sum(jine) as money from cym_offer_old where userid=? and station=5 and type=2',[$memberid[0]->id]);
                        $jine=$qingqiu[0]->money+$qingqiuold[0]->money-$tigong[0]->money-$tigongold[0]->money;
                    }else{
                        $jine='帐号或手机号不存在';
                    }
                }else{
                    $jine='0';
                }
            }elseif($do=='qianbao'){
                $result=DB::table('cym_qianbao')
                    ->leftjoin('cym_reguser','cym_qianbao.userid','=','cym_reguser.id')
                    ->select('cym_qianbao.id','cym_qianbao.userid','cym_qianbao.num','cym_qianbao.oldnum','cym_qianbao.nownum','cym_qianbao.shijian','cym_qianbao.beizhu','cym_reguser.user','cym_reguser.name')
                ;
                $result1=DB::table('cym_qianbao')
                    ->leftjoin('cym_reguser','cym_qianbao.userid','=','cym_reguser.id')
                    ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','=',$user);
                    $result1=$result1->where('cym_reguser.user','=',$user);
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('cym_qianbao.beizhu',$type);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_qianbao.shijian','>=',$start);
                    $result1=$result1->where('cym_qianbao.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_qianbao.shijian','<=',$end);
                    $result1=$result1->where('cym_qianbao.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_qianbao.id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                if($request->has('type')){
                    $totel1=$result1->where('cym_qianbao.beizhu',$request->get('type'))->sum('cym_qianbao.num');
                }else{
                    $totel1=$result1->sum('cym_qianbao.num');
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='benjin'){
                $result=DB::table('cym_benjin')
                    ->leftjoin('cym_reguser','cym_benjin.userid','=','cym_reguser.id')
                    ->select('cym_benjin.id','cym_benjin.userid','cym_benjin.num','cym_benjin.oldnum','cym_benjin.nownum','cym_benjin.shijian','cym_benjin.beizhu','cym_reguser.user','cym_reguser.name')
                ;
                $result1=DB::table('cym_benjin')
                    ->leftjoin('cym_reguser','cym_benjin.userid','=','cym_reguser.id')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','=',$user);
                    $result1=$result1->where('cym_reguser.user','=',$user);
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('cym_benjin.beizhu',$type);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_benjin.shijian','>=',$start);
                    $result1=$result1->where('cym_benjin.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_benjin.shijian','<=',$end);
                    $result1=$result1->where('cym_benjin.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_benjin.id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                if($request->has('type')){
                    $totel1=$result1->where('cym_benjin.beizhu',$request->get('type'))->sum('cym_benjin.num');
                }else{
                    $totel1=$result1->sum('cym_benjin.num');
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='hongli'){
                $result=DB::table('cym_hongli')
                    ->leftjoin('cym_reguser','cym_hongli.userid','=','cym_reguser.id')
                    ->select('cym_hongli.id','cym_hongli.userid','cym_hongli.num','cym_hongli.oldnum','cym_hongli.nownum','cym_hongli.shijian','cym_hongli.beizhu','cym_reguser.user','cym_reguser.name')
                ;
                $result1=DB::table('cym_hongli')
                    ->leftjoin('cym_reguser','cym_hongli.userid','=','cym_reguser.id')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','=',$user);
                    $result1=$result1->where('cym_reguser.user','=',$user);
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('cym_hongli.beizhu',$type);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_hongli.shijian','>=',$start);
                    $result1=$result1->where('cym_hongli.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_hongli.shijian','<=',$end);
                    $result1=$result1->where('cym_hongli.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_hongli.id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                if($request->has('type')){
                    $totel1=$result1->where('cym_hongli.beizhu',$request->get('type'))->sum('cym_hongli.num');
                }else{
                    $totel1=$result1->sum('cym_hongli.num');
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='zhonggou'){
                $result=DB::table('cym_zhonggou')
                    ->leftjoin('cym_reguser','cym_zhonggou.userid','=','cym_reguser.id')
                    ->select('cym_zhonggou.id','cym_zhonggou.userid','cym_zhonggou.num','cym_zhonggou.oldnum','cym_zhonggou.nownum','cym_zhonggou.shijian','cym_zhonggou.beizhu','cym_reguser.user','cym_reguser.name')
                ;
                $result1=DB::table('cym_zhonggou')
                    ->leftjoin('cym_reguser','cym_zhonggou.userid','=','cym_reguser.id')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','=',$user);
                    $result1=$result1->where('cym_reguser.user','=',$user);
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('cym_zhonggou.beizhu',$type);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_zhonggou.shijian','>=',$start);
                    $result1=$result1->where('cym_zhonggou.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_zhonggou.shijian','<=',$end);
                    $result1=$result1->where('cym_zhonggou.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_zhonggou.id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                if($request->has('type')){
                    $totel1=$result1->where('cym_zhonggou.beizhu',$request->get('type'))->sum('cym_zhonggou.num');
                }else{
                    $totel1=$result1->sum('cym_zhonggou.num');
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='yucun'){
                $result=DB::table('cym_qianbao')
                    ->leftjoin('cym_reguser','cym_qianbao.userid','=','cym_reguser.id')
                    ->select('cym_qianbao.id','cym_qianbao.userid','cym_qianbao.num','cym_qianbao.oldnum','cym_qianbao.nownum','cym_qianbao.shijian','cym_qianbao.beizhu','cym_reguser.user','cym_reguser.name')
                ;

                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','like','%'.$user.'%');
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_qianbao.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_qianbao.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_qianbao.shijian','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);


            }elseif($do=='shouyibiao'){
                $result=DB::table('cym_shouyi')
                    ->leftjoin('cym_reguser','cym_shouyi.userid','=','cym_reguser.id')
                    ->select('cym_shouyi.id','cym_shouyi.userid','cym_shouyi.jine','cym_shouyi.shijian','cym_reguser.user','cym_reguser.name')
                ;
                $result1=DB::table('cym_shouyi')
                    ->leftjoin('cym_reguser','cym_shouyi.userid','=','cym_reguser.id')
                    ->select('cym_shouyi.id','cym_shouyi.userid','cym_shouyi.jine','cym_shouyi.shijian','cym_reguser.user','cym_reguser.name')
                ;
                $result2=DB::table('cym_shouyi')
                    ->leftjoin('cym_reguser','cym_shouyi.userid','=','cym_reguser.id')
                    ->select('cym_shouyi.id','cym_shouyi.userid','cym_shouyi.jine','cym_shouyi.shijian','cym_reguser.user','cym_reguser.name')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user',$user);
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('cym_reguser.name',$name);
                    $result1=$result1->where('cym_reguser.name',$name);
                    $result2=$result2->where('cym_reguser.name',$name);
                }

                if($request->has('jine')){
                    $jine=$request->get('jine');
                    $result=$result->where('cym_shouyi.jine','>=',$jine);
                    $result1=$result1->where('cym_shouyi.jine','>=',$jine);
                    $result2=$result2->where('cym_shouyi.jine','>=',$jine);
                }
                if($request->has('jine1')){
                    $jine1=$request->get('jine1');
                    $result=$result->where('cym_shouyi.jine','<=',$jine1);
                    $result1=$result1->where('cym_shouyi.jine','<=',$jine1);
                    $result2=$result2->where('cym_shouyi.jine','<=',$jine1);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_reguser.shijian','>=',$start);
                    $result1=$result1->where('cym_reguser.shijian','>=',$start);
                    $result2=$result2->where('cym_reguser.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_reguser.shijian','<=',$end);
                    $result1=$result1->where('cym_reguser.shijian','<=',$end);
                    $result2=$result2->where('cym_reguser.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_shouyi.jine','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $totel1=$result1->where('cym_shouyi.jine','>','0')->sum('cym_shouyi.jine');
                $totel2=$result2->where('cym_shouyi.jine','<','0')->sum('cym_shouyi.jine');
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);


            }elseif($do=='noorder'){
                $result=DB::table('cym_shouyi')
                    ->leftjoin('cym_reguser','cym_shouyi.userid','=','cym_reguser.id')
                    ->select('cym_shouyi.id','cym_shouyi.userid','cym_shouyi.jine','cym_shouyi.shijian','cym_reguser.user','cym_reguser.name')
                ;
                if($request->has('jine') && $request->has('jine1')){
                    $jine=$request->get('jine');
                    $result=$result->where('cym_shouyi.jine','>=',$jine);
                    $jine1=$request->get('jine1');
                    $result=$result->where('cym_shouyi.jine','<=',$jine1);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                }else{
                    $start='0';
                }
                if($request->has('end')){
                    $end=$request->get('end');
                }else{
                    $end='0';
                }
                $result=$result->orderBy('cym_shouyi.jine','desc');
                $count='1';
                $data=$result->paginate(50000);

            }elseif($do=='zhucechaxun'){
                if($request->has('start')){
                    $start=$request->get('start');
                }
                if($request->has('end')){
                    $end=$request->get('end');
                }
                if($request->has('user')){
                    $user=$request->get('user');
                }
                if($request->has('type')){
                    $type=$request->get('type');
                }
                $i=0;$y1=0;$y2=0;$y3=0;$y4=0;$y5=0;
                if($request->has('start') && $request->has('end') && $request->has('user') && $request->has('type')){
                    //通过帐号获取userid
                    $id=DB::select('select id from cym_reguser where user=?',[$request->get('user')]);
                    if(count($id)=='1'){
                        //帐号存在，读取一代会员
                        $user1=DB::select('select id from cym_reguser where station in (1,3) and tuijian=?',[
                            $id[0]->id
                        ]);
                        if($request->get('type')=='0'){  //全部帐号
                            $user11=DB::select('select id from cym_reguser where station in (1,3) and tuijian=? and shijian between ? and ?',[
                                $id[0]->id,$start,$end
                            ]);
                        }elseif($request->get('type')=='1'){ //排过单帐号
                            $user11=DB::select('select id from cym_reguser where station in (1,3) and isorder=1 and tuijian=? and shijian between ? and ?',[
                                $id[0]->id,$start,$end
                            ]);
                        }elseif($request->get('type')=='2'){  //未排过单帐号
                            $user11=DB::select('select id from cym_reguser where station in (1,3) and isorder=0 and tuijian=? and shijian between ? and ?',[
                                $id[0]->id,$start,$end
                            ]);
                        }
                        $y1=count($user11);
                        if(count($user1)>0){
                            //存在二代会员，读取
                            foreach ($user1 as $a){
                                $user2=DB::select('select id from cym_reguser where station in (1,3) and tuijian=?',[
                                    $a->id
                                ]);
                                if($request->get('type')=='0'){  //全部帐号
                                    $user22=DB::select('select id from cym_reguser where station in (1,3) and tuijian=? and shijian between ? and ?',[
                                        $a->id,$start,$end
                                    ]);
                                }elseif($request->get('type')=='1'){ //排过单帐号
                                    $user22=DB::select('select id from cym_reguser where station in (1,3) and isorder=1 and tuijian=? and shijian between ? and ?',[
                                        $a->id,$start,$end
                                    ]);
                                }elseif($request->get('type')=='2'){  //未排过单帐号
                                    $user22=DB::select('select id from cym_reguser where station in (1,3) and isorder=0 and tuijian=? and shijian between ? and ?',[
                                        $a->id,$start,$end
                                    ]);
                                }
                                $y2=$y2+count($user22);
                                if(count($user2)>0){
                                    //存在三代会员，读取
                                    foreach ($user2 as $b){
                                        $user3=DB::select('select id from cym_reguser where station in (1,3) and tuijian=?',[
                                            $b->id
                                        ]);
                                        if($request->get('type')=='0'){  //全部帐号
                                            $user33=DB::select('select id from cym_reguser where station in (1,3) and tuijian=? and shijian between ? and ?',[
                                                $b->id,$start,$end
                                            ]);
                                        }elseif($request->get('type')=='1'){ //排过单帐号
                                            $user33=DB::select('select id from cym_reguser where station in (1,3) and isorder=1 and tuijian=? and shijian between ? and ?',[
                                                $b->id,$start,$end
                                            ]);
                                        }elseif($request->get('type')=='2'){  //未排过单帐号
                                            $user33=DB::select('select id from cym_reguser where station in (1,3) and isorder=0 and tuijian=? and shijian between ? and ?',[
                                                $b->id,$start,$end
                                            ]);
                                        }
                                        $y3=$y3+count($user33);
                                        if(count($user3)>0){
                                            //存在四代会员，读取
                                            foreach ($user3 as $c){
                                                $user4=DB::select('select id from cym_reguser where station in (1,3) and tuijian=?',[
                                                    $c->id
                                                ]);
                                                if($request->get('type')=='0'){  //全部帐号
                                                    $user44=DB::select('select id from cym_reguser where station in (1,3) and tuijian=? and shijian between ? and ?',[
                                                        $c->id,$start,$end
                                                    ]);
                                                }elseif($request->get('type')=='1'){ //排过单帐号
                                                    $user44=DB::select('select id from cym_reguser where station in (1,3) and isorder=1 and tuijian=? and shijian between ? and ?',[
                                                        $c->id,$start,$end
                                                    ]);
                                                }elseif($request->get('type')=='2'){  //未排过单帐号
                                                    $user44=DB::select('select id from cym_reguser where station in (1,3) and isorder=0 and tuijian=? and shijian between ? and ?',[
                                                        $c->id,$start,$end
                                                    ]);
                                                }
                                                $y4=$y4+count($user44);
                                                if(count($user4)>0){
                                                    //存在五代会员，读取
                                                    foreach ($user4 as $d){
                                                        if($request->get('type')=='0'){  //全部帐号
                                                            $user5=DB::select('select id from cym_reguser where station in (1,3) and tuijian=? and shijian between ? and ?',[
                                                                $d->id,$start,$end
                                                            ]);
                                                        }elseif($request->get('type')=='1'){ //排过单帐号
                                                            $user5=DB::select('select id from cym_reguser where station in (1,3) and isorder=1 and tuijian=? and shijian between ? and ?',[
                                                                $d->id,$start,$end
                                                            ]);
                                                        }elseif($request->get('type')=='2'){  //未排过单帐号
                                                            $user5=DB::select('select id from cym_reguser where station in (1,3) and isorder=0 and tuijian=? and shijian between ? and ?',[
                                                                $d->id,$start,$end
                                                            ]);
                                                        }
                                                        $y5=$y5+count($user5);
                                                    }
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                        }
                    }else{
                        $i='-1';
                    }
                }else{
                    $i='-2';
                }
                $i=$y1+$y2+$y3+$y4+$y5;
            }elseif($do=='paidanshuaxin'){
                if($request->has('start')){
                    $start=$request->get('start');
                }
                if($request->has('end')){
                    $end=$request->get('end');
                }
                if($request->has('page')){
                    $page=$request->get('page');
                    $limit=$page-1;
                }else{
                    $page='1';
                    $limit=0;
                }
                if($request->has('num')){
                    $num=$request->get('num');
                }else{
                    $num=100;
                }
                $i=0;
                if($request->has('start') && $request->has('end')){
                    //通过帐号获取userid
                    $id=DB::select('select id,user,totel from cym_reguser where totel>=? and station=1 and id!=66 order by id asc limit ?,1',[$num,$limit]);
                    //总帐号数
                    $toteluser=DB::select('select id from cym_reguser where totel>=? and id!=66 and station=1',[$num]);
                    $totel1=count($toteluser);
                    if(count($id)=='1'){
                        $totel2=$id[0]->id;
                        $totel3=$id[0]->user;
                        $totel4=$id[0]->totel;
                        //读取自己帐号排单量
                        $totel5=$totel5+AdminmemberController::totelpaidan($id[0]->id,$start,$end);
                        //帐号存在，读取一代会员
                        $user1=DB::select('select id from cym_reguser where station=1 and tuijian=?',[
                            $id[0]->id
                        ]);
                        if(count($user1)>0){
                            //判断一下直推必须大于10
                            if(count($user1)>9){
                                //存在二代会员，读取
                                foreach ($user1 as $a){
                                    //一代排单总数
                                    $totel5=$totel5+AdminmemberController::totelpaidan($a->id,$start,$end);
                                    $user2=DB::select('select id from cym_reguser where station=1 and tuijian=?',[
                                        $a->id
                                    ]);
                                    if(count($user2)>0){
                                        //存在三代会员，读取
                                        foreach ($user2 as $b){
                                            //二代代排单总数
                                            $totel5=$totel5+AdminmemberController::totelpaidan($b->id,$start,$end);
                                            $user3=DB::select('select id from cym_reguser where station=1 and tuijian=?',[
                                                $b->id
                                            ]);

                                            if(count($user3)>0){
                                                //存在四代会员，读取
                                                foreach ($user3 as $c){
                                                    //一代排单总数
                                                    $totel5=$totel5+AdminmemberController::totelpaidan($c->id,$start,$end);
                                                    $user4=DB::select('select id from cym_reguser where station=1 and tuijian=?',[
                                                        $c->id
                                                    ]);
                                                    if(count($user4)>0){
                                                        //存在五代会员，读取
                                                        foreach ($user4 as $d){
                                                            //一代排单总数
                                                            $totel5=$totel5+AdminmemberController::totelpaidan($d->id,$start,$end);
                                                            $user5=DB::select('select id from cym_reguser where station=1 and tuijian=?',[
                                                                $d->id
                                                            ]);
                                                            //读取五代排单
                                                            if(count($user5)>0){
                                                                foreach ($user5 as $e){
                                                                    //一代排单总数
                                                                    $totel5=$totel5+AdminmemberController::totelpaidan($e->id,$start,$end);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                        }
                                    }
                                }
                                //生成了总排单 $totel
                                $pingjun=round($totel5/$id[0]->totel);
                                DB::insert('insert into cym_paidan (userid,paidan,pingjun,shijian,beizhu,totel) VALUES (?,?,?,?,?,?)',[
                                    $id[0]->id,$totel5,$pingjun,date('Y-m-d H:i:s'),$start.'----'.$end,$id[0]->totel
                                ]);

                            }else{
                                $i='-3';
                            }
                        }
                    }else{
                        $i='-2';
                    }
                }else{
                    $i='-1';
                }

            }elseif($do=='paidanhedui'){
                if($request->has('start')){
                    $start=$request->get('start');
                }
                if($request->has('end')){
                    $end=$request->get('end');
                }
                if($request->has('user')){
                    $user=$request->get('user');
                }
                $i=0;$data='';$totel5=0;
                if($request->has('start') && $request->has('end') && $request->has('user')){
                    //通过帐号获取userid
                    $id=DB::select('select id,user,totel from cym_reguser where user=?',[$request->get('user')]);
                    if(count($id)=='1'){
                        $totel2=$id[0]->id;
                        $totel3=$id[0]->user;
                        $totel4=$id[0]->totel;
                        //读取自己帐号排单量
                        $totel5=$totel5+AdminmemberController::totelpaidan($id[0]->id,$start,$end);
                        $data=$data.'<tr class="tr"><td>序号</td><td>会员帐号</td><td>排单总量</td><td>备注</td><td>操作</td></tr>';
                        $data=$data.'<tr><td>'.$i++.'</td><td>'.$id[0]->user.'</td><td>'.AdminmemberController::totelpaidan($id[0]->id,$start,$end).'</td><td>自己帐号</td><td><a href="'.URL('5538830c29f8a8e4/excsql/fenghao/'.$id[0]->id).'" onclick="queren(\'确定封号吗？\')">封号</a></td></tr>';
                        //帐号存在，读取一代会员
                        $user1=DB::select('select id,user from cym_reguser where station=1 and tuijian=?',[
                            $id[0]->id
                        ]);
                        if(count($user1)>0){
                            //存在一代会员，读取
                            foreach ($user1 as $a){
                                //一代排单总数
                                $totel5=$totel5+AdminmemberController::totelpaidan($a->id,$start,$end);
                                $data=$data.'<tr><td>'.$i++.'</td><td>'.$a->user.'</td><td>'.AdminmemberController::totelpaidan($a->id,$start,$end).'</td><td>一代</td><td><a href="'.URL('5538830c29f8a8e4/excsql/fenghao/'.$a->id).'" onclick="queren(\'确定封号吗？\')">封号</a></td></tr>';
                                $user2=DB::select('select id,user from cym_reguser where station=1 and tuijian=?',[
                                    $a->id
                                ]);
                                if(count($user2)>0){
                                    //存在二代会员，读取
                                    foreach ($user2 as $b){
                                        //二代排单总数
                                        $totel5=$totel5+AdminmemberController::totelpaidan($b->id,$start,$end);
                                        $data=$data.'<tr><td>'.$i++.'</td><td>'.$b->user.'</td><td>'.AdminmemberController::totelpaidan($b->id,$start,$end).'</td><td>二代</td><td><a href="'.URL('5538830c29f8a8e4/excsql/fenghao/'.$b->id).'" onclick="queren(\'确定封号吗？\')">封号</a></td></tr>';
                                        $user3=DB::select('select id,user from cym_reguser where station=1 and tuijian=?',[
                                            $b->id
                                        ]);
                                        if(count($user3)>0){
                                            //存在三代会员，读取
                                            foreach ($user3 as $c){
                                                //三代排单总数
                                                $totel5=$totel5+AdminmemberController::totelpaidan($c->id,$start,$end);
                                                $data=$data.'<tr><td>'.$i++.'</td><td>'.$c->user.'</td><td>'.AdminmemberController::totelpaidan($c->id,$start,$end).'</td><td>三代</td><td><a href="'.URL('5538830c29f8a8e4/excsql/fenghao/'.$c->id).'" onclick="queren(\'确定封号吗？\')">封号</a></td></tr>';
                                                $user4=DB::select('select id,user from cym_reguser where station=1 and tuijian=?',[
                                                    $c->id
                                                ]);
                                                if(count($user4)>0){
                                                    //存在四代会员，读取
                                                    foreach ($user4 as $d){
                                                        //四代排单总数
                                                        $totel5=$totel5+AdminmemberController::totelpaidan($d->id,$start,$end);
                                                        $data=$data.'<tr><td>'.$i++.'</td><td>'.$d->user.'</td><td>'.AdminmemberController::totelpaidan($d->id,$start,$end).'</td><td>四代</td><td><a href="'.URL('5538830c29f8a8e4/excsql/fenghao/'.$d->id).'" onclick="queren(\'确定封号吗？\')">封号</a></td></tr>';
                                                        $user5=DB::select('select id,user from cym_reguser where station=1 and tuijian=?',[
                                                            $d->id
                                                        ]);
                                                        //读取五代排单
                                                        if(count($user5)>0){
                                                            foreach ($user5 as $e){
                                                                //一代排单总数
                                                                $totel5=$totel5+AdminmemberController::totelpaidan($e->id,$start,$end);
                                                                $data=$data.'<tr><td>'.$i++.'</td><td>'.$e->user.'</td><td>'.AdminmemberController::totelpaidan($e->id,$start,$end).'</td><td>五代</td><td><a href="'.URL('5538830c29f8a8e4/excsql/fenghao/'.$e->id).'" onclick="queren(\'确定封号吗？\')">封号</a></td></tr>';
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                            $totel6=round($totel5/$id[0]->totel);
                        }else{
                            $totel6=$totel5;
                        }
                    }else{
                        $i='-2';
                    }
                }else{
                    $i='-1';
                }

            }elseif($do=='paidantongji'){
                $result=DB::table('cym_paidan')
                    ->leftjoin('cym_reguser','cym_paidan.userid','=','cym_reguser.id')
                    ->select('cym_paidan.id','cym_paidan.userid','cym_paidan.paidan','cym_paidan.pingjun','cym_paidan.shijian','cym_paidan.beizhu','cym_paidan.totel','cym_reguser.user','cym_reguser.name')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user',$user);
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('cym_reguser.name',$name);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_paidan.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_paidan.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_paidan.shijian','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='dongtai'){
                $result=DB::table('cym_dongtai')
                    ->leftjoin('cym_reguser','cym_dongtai.userid','=','cym_reguser.id')
                    ->select('cym_dongtai.id','cym_dongtai.userid','cym_dongtai.jine','cym_dongtai.beizhu','cym_dongtai.typeid','cym_dongtai.orderid','cym_dongtai.shijian','cym_reguser.user','cym_reguser.name')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user',$user);
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('cym_reguser.name',$name);
                }
                if($request->has('jine')){
                    $jine=$request->get('jine');
                    $result=$result->where('cym_dongtai.orderid',$jine);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_dongtai.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_dongtai.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_dongtai.shijian','desc');
                $totel1=$result->sum('cym_dongtai.jine');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='jifen'){
                $result=DB::table('cym_shuzi')
                    ->leftjoin('cym_reguser','cym_shuzi.userid','=','cym_reguser.id')
                    ->select('cym_shuzi.id','cym_shuzi.userid','cym_shuzi.num','cym_shuzi.beizhu','cym_shuzi.oldnum','cym_shuzi.nownum','cym_shuzi.shijian','cym_reguser.user','cym_reguser.name')
                ;
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user',$user);
                }
                if($request->has('name')){
                    $name=$request->get('name');
                    $result=$result->where('cym_reguser.name',$name);
                }
                if($request->has('station')){
                    $station=$request->get('station');
                    $result=$result->where('cym_shuzi.beizhu',$station);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_shuzi.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_shuzi.shijian','<=',$end);
                }
                $result=$result->orderBy('cym_shuzi.shijian','desc');
                $totel1=$result->sum('cym_shuzi.num');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }
            return view('admin.member',[
                'data'=>$data,
                'i'=>$i,
                'page'=>$page,
                'jine'=>$jine,
                'jine1'=>$jine1,
                'count'=>$count,
                'do'=>$do,
                'num'=>$num,
                'user'=>$user,
                'name'=>$name,
                'station'=>$station,
                'orderstation'=>$orderstation,
                'id'=>$id,
                'phone'=>$phone,
                'totel1'=>$totel1,
                'totel2'=>$totel2,
                'totel3'=>$totel3,
                'totel4'=>$totel4,
                'totel5'=>$totel5,
                'totel6'=>$totel6,
                'totel7'=>$totel7,
                'totel8'=>$totel8,
                'totel9'=>$totel9,
                'start'=>$start,
                'end'=>$end,
                'type'=>$type,
                'jibie'=>$jibie,
                'userid'=>$userid,
                'cardnum'=>$cardnum,
                'tuijian'=>$tuijian,
                'power'=>$request->session()->get('power')
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }

    //判断时间段内是否排单
    //判断是否排单
    public static function totelpaidan($userid,$k,$j){
        $e=DB::select('select sum(jine) as totel from cym_offer where type=1 and station in (0,1,2,4,5) and userid=? and shijian between ? and ?',[$userid,$k,$j]);
        if($e[0]->totel==''){
            return '0';
        }else{
            return $e[0]->totel;
        }
    }

    //判断是否排单
    public static function paidan($userid){
        $e=DB::select('select id from cym_offer where userid=?',[$userid]);
        if(count($e)=='0'){
            $e1=DB::select('select id from cym_offer_old where userid=?',[$userid]);
            if(count($e1)=='0'){
                return '0';
            }else{
                return '1';
            }
        }else{
            return '1';
        }
    }

    //判断时间段内是否排单
    //判断是否排单
    public static function ispaidan($userid,$num){
        $e=DB::select('select id from cym_offer where userid=? and shijian<?',[$userid,date('Y-m-d H:i:s',strtotime('-'.$num.' day'))]);
        if(count($e)=='0'){
            $e1=DB::select('select id from cym_offer_old where userid=? and shijian<?',[$userid,date('Y-m-d H:i:s',strtotime('-'.$num.' day'))]);
            if(count($e1)=='0'){
                return '0';
            }else{
                return '1';
            }
        }else{
            return '1';
        }
    }

    //获取预存钱包
    public static function yucun($userid){
        $e=DB::select('select qianbao from cym_yucun where userid=?',[$userid]);
        if(count($e)=='0'){
            return '0';
        }else{
            return $e[0]->qianbao;
        }
    }

    //挂单指提供帮助的冻结期和排队中 匹配中
    public static function guadan($userid){
        $e=DB::select('select sum(jine) as jine from cym_offer where type=1 and station in (0,1,2,4) and userid=?',[$userid]);
        if($e[0]->jine==''){
            return '0';
        }else{
            return $e[0]->jine;
        }
    }

    public static function jibie(){
        $jibie=DB::select('select * from cym_jibie order by id desc');
        $a='';
        foreach($jibie as $e){
            $a=$a.'<option value="'.$e->id.'">'.$e->title.'</option>';
        }
        return $a;
    }

    //获取预存钱包
    public static function userjibie($id){
        $e=DB::select('select title from cym_jibie where id=?',[$id]);
        if(count($e)=='0'){
            return '数据不存在';
        }else{
            return $e[0]->title;
        }
    }

}

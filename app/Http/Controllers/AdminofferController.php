<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminofferController extends Controller{

    public function offer(FunctionController $functionController,PowerController $powerController,Request $request,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$user='';$cardnum='';$station='';$count='';$name='';$start='';$end='';$start1='';$end1='';$djstart='';$djend='';
            $tuijian='';$phone='';$userid='';$jine='';$type='1';$orderid ='';$paixu ='';$offer='';$ordertype='1';
            $time='';$totel1='0';$totel2='0';$zhouqi='';
            if($do=='list'){
                $result=DB::table('cym_offer')
                    ->leftjoin('cym_reguser','cym_offer.userid','=','cym_reguser.id')
                    ->select('cym_offer.id','cym_offer.jiangjinstation','cym_offer.typeid','cym_offer.edustation','cym_offer.type','cym_offer.paystation','cym_offer.orderid','cym_offer.jine','cym_offer.shengyu','cym_offer.renshu','cym_offer.shijian','cym_offer.ppshijian','cym_offer.djshijian','cym_offer.cjshijian','cym_offer.station','cym_reguser.id as userid','cym_reguser.user','cym_reguser.name','cym_reguser.station as userstation')
                ;
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('cym_offer.type','=',$type);
                }else{
                    $type='1';
                    $result=$result->where('cym_offer.type','=','1');
                }
                if($request->has('user')){
                    $user=$request->get('user');
                    $result=$result->where('cym_reguser.user','=',$user);
                }
                if($request->has('id')){
                    $id=$request->get('id');
                    $result=$result->where('cym_offer.id','=',$id);
                }
                if($request->has('zhouqi')){
                    $zhouqi=$request->get('zhouqi');
                    $result=$result->where('cym_offer.typeid','=',$zhouqi);
                }
                if($request->has('orderid')){
                    $orderid=$request->get('orderid');
                    $result=$result->where('cym_offer.orderid','like','%'.$orderid.'%');
                }
                if($request->has('station')){
                    $station=$request->get('station');
                    if($station=='2'){
                        $result=$result->where('cym_offer.station','=','2');
                        $result=$result->where('cym_offer.paystation','=','0');
                        $result=$result->where('cym_reguser.station','!=','2');
                    }elseif($station=='8'){
                        $result=$result->where('cym_offer.station','=','2');
                        $result=$result->where('cym_offer.paystation','!=','0');
                        $result=$result->where('cym_reguser.station','!=','2');
                    }
                    else{
                        $result=$result->where('cym_offer.station','=',$station);
                    }
                }
                if($request->has('jine')){
                    $jine=$request->get('jine');
                    $result=$result->where('cym_offer.jine','>=',$jine);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('cym_offer.shijian','>=',$start);
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('cym_offer.shijian','<=',$end);
                }
                if($request->has('start1')){
                    $start1=$request->get('start1');
                    $result=$result->where('cym_offer.djshijian','>=',$start1);
                }
                if($request->has('end1')){
                    $end1=$request->get('end1');
                    $result=$result->where('cym_offer.djshijian','<=',$end1);
                }
                if($request->has('paixu')){
                    $paixu=$request->get('paixu');
                    $result=$result->orderBy('cym_offer.'.$paixu,'desc');
                }else{
                    $result=$result->orderBy('cym_offer.shijian','desc');
                }
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                if($type=='2' && $station=='1'){
                    if($start!='' && $end!=''){
                        $p1=DB::select('select sum(jine) as jine,sum(shengyu) as shengyu from cym_offer where type=2 and station=1 and shijian between ? and ?',[$start,$end]);
                    }else{
                        $p1=DB::select('select sum(jine) as jine,sum(shengyu) as shengyu from cym_offer where type=2 and station=1');
                    }
                    $totel1=$p1[0]->jine;
                    $totel2=$p1[0]->shengyu;
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }

            return view('admin.offer',[
                'data'=>$data,'offer'=>$offer,'time'=>$time,'ordertype'=>$ordertype,
                'type'=>$type,'zhouqi'=>$zhouqi,
                'orderid'=>$orderid ,
                'paixu'=>$paixu,
                'jine'=>$jine,
                'count'=>$count,
                'do'=>$do,
                'user'=>$user,
                'name'=>$name,
                'station'=>$station,
                'id'=>$id,
                'phone'=>$phone,
                'start'=>$start,
                'end'=>$end,
                'djstart'=>$djstart,
                'djend'=>$djend,
                'start1'=>$start1,
                'end1'=>$end1,
                'userid'=>$userid,
                'cardnum'=>$cardnum,
                'tuijian'=>$tuijian,
                'totel1'=>$totel1,
                'totel2'=>$totel2,
            ]);
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }


    }

    //订单信息返回
    public static function orderinfo($id,PowerController $powerController){
        if($powerController::islogin()=='success'){
            $offer=DB::select('select * from cym_offer where id=?',[$id]);
            if(count($offer)=='1'){
                $user=DB::select('select * from cym_reguser where id=?',[$offer[0]->userid]);
                if(count($user)=='1'){
                    return '<div class="chuli">
                            <div class="close" onclick="guanbi()"></div>
                            <div class="con">
                                <form name="form1" action="'.URL('5538830c29f8a8e4/excsql/editorder/'.$id).'" method="post">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <li><span>订单号：</span> '.$offer[0]->orderid.' </li>
                                <li><span>会员编号：</span>  '.$user[0]->id.' </li>
                                <li><span>手机：</span>   '.$user[0]->phone.'  </li>
                                <li><span>金额：</span> '.$offer[0]->jine.'   </li>
                                <li><span>剩余金额：</span>  <input type="text" name="shengyu" value="'.$offer[0]->shengyu.'" class="text"></li>
                                <li><span>人数：</span> <input type="text" name="renshu" value="'.$offer[0]->renshu.'" class="text">  </li>
                                <li><span>回到匹配：</span> <input type="radio" name="shi" value="0" checked="checked">否 <input type="radio" name="shi" value="1">是 </li>
                                <li><span></span> <input type="submit" class="sub" value="修改"  />   </li>
                                </form>
                            </div>
                        </div>';
                }else{
                    $offer=DB::select('select * from cym_offer_old where id=?',[$id]);
                    if(count($offer)=='1'){
                        $user=DB::select('select * from cym_reguser where id=?',[$offer[0]->userid]);
                        if(count($user)=='1'){
                            return '<div class="chuli">
                            <div class="close" onclick="guanbi()"></div>
                            <div class="con">
                                <form name="form1" action="'.URL('5538830c29f8a8e4/excsql/editorder/'.$id).'" method="post">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <li><span>订单号：</span> '.$offer[0]->orderid.' </li>
                                <li><span>会员编号：</span>  '.$user[0]->id.' </li>
                                <li><span>手机：</span>   '.$user[0]->phone.'  </li>
                                <li><span>金额：</span> '.$offer[0]->jine.'   </li>
                                <li><span>剩余金额：</span>  <input type="text" name="shengyu" value="'.$offer[0]->shengyu.'" class="text"></li>
                                <li><span>人数：</span> <input type="text" name="renshu" value="'.$offer[0]->renshu.'" class="text">  </li>
                                <li><span>回到匹配：</span> <input type="radio" name="shi" value="0" checked="checked">否 <input type="radio" name="shi" value="1">是 </li>
                                <li><span></span> <input type="submit" class="sub" value="修改"  />   </li>
                                </form>
                            </div>
                        </div>';
                        }else{
                            return '<div class="chuli">
                            <div class="close" onclick="guanbi()"></div>
                            <div class="con"color: #ff0000; font-size: 20px;">
                                帐号不存在！
                            </div>
                        </div>';
                        }
                    }else{
                        return '<div class="chuli">
                            <div class="close" onclick="guanbi()"></div>
                            <div class="con"color: #ff0000; font-size: 20px;">
                                订单异常！
                            </div>
                        </div>';
                    }
                }
            }else{
                return '<div class="chuli">
                            <div class="close" onclick="guanbi()"></div>
                            <div class="con"color: #ff0000; font-size: 20px;">
                                订单异常！
                            </div>
                        </div>';
            }
        }else{
            return Redirect::to('5538830c29f8a8e4/login?go='.$powerController::islogin());
        }
    }

    //订单信息返回
    public static function getorderinfo($orderid,$a){
            $offer=DB::select('select * from cym_offer where orderid=?',[$orderid]);
            if(count($offer)=='1'){
                return $offer[0]->$a;
            }else{
                $offer=DB::select('select * from cym_offer_old where orderid=?',[$orderid]);
                if(count($offer)=='1'){
                    return $offer[0]->$a;
                }else{
                    return '订单号不存在';
                }
            }

    }




}
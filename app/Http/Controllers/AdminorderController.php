<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;

class AdminorderController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$count='';$id='';$name='';$kehu='';$title='';$phone='';$orderid='';$station='';$paixu='shijian';$fangshi='desc';
            $start='';$end='';$station='';$type='';$jine='';$kehulist='';$totelpage='';$xilie='';$shenhe='0';
            $power=DB::select('select flag from jb_admin_user_left where id=?',[$request->session()->get('power')]);
            //订单审核权限
            if($powerController::isstr($power[0]->flag,'a3')=='1'){$shenhe='1';}
            if($do=='list'){
                //客户参数
                $kehulist=DB::select('select id,title from jb_kehu order by id desc');
                $xilie=DB::select('select id,title from jb_xilie where type=1 order by id desc');
                $totelpage=ceil(DB::table('jb_kehu')->count()/10);
                //产品参数
                $count=ceil(DB::table('jb_product')->count()/10);

            }elseif($do=='orderlist'){
                //pageSize
                //currPage  第几页
                //title
                //$page=($request->input('currPage')-1)*$request->input('pageSize');
                if($request->has('currPage')){
                    $currPage=$request->get('currPage');
                }else{
                    $currPage=1;
                }
                if($request->has('pageSize')){
                    $pageSize=$request->get('pageSize');
                }else{
                    $pageSize=10;
                }
                $page=($currPage-1)*$pageSize;
                $result=DB::table('jb_order')
                        ->leftjoin('jb_kehu','jb_order.kehu_id','=','jb_kehu.id')
                        ->select('jb_order.id','jb_order.jine','jb_order.orderid','jb_order.station','jb_kehu.title','jb_order.name','jb_order.phone','jb_order.endtime','jb_order.shijian','jb_order.station','jb_order.type') ;
                if($request->has('orderid')){
                    $orderid=$request->get('orderid');
                    $result=$result->where('jb_order.orderid','like','%'.$orderid.'%');
                }
                if($request->has('station')){
                    $station=$request->get('station');
                    $result=$result->where('jb_order.station','=',$station);
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('jb_order.type','=',$type);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('jb_order.shijian','>=',strtotime($start));
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('jb_order.shijian','<=',strtotime($end));
                }

                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('jb_kehu.title','like','%'.$title.'%');
                }
                $totelprice=$result->sum('jb_order.jine');
                if($request->has('paixu')){
                    $paixu=$request->get('paixu');
                }
                if($request->has('fangshi')){
                    $fangshi=$request->get('fangshi');
                }

                $result=$result->orderby('jb_order.'.$paixu,$fangshi);
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');

                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","totelprice":"'.$totelprice.'","content":[';
                foreach($result as $e){
                    if($e->station=='0'){$station='草稿';}
                    elseif($e->station=='1'){$station='待审核';}
                    elseif($e->station=='2'){$station='待付款';}
                    elseif($e->station=='3'){$station='已付款';}
                    elseif($e->station=='4'){$station='生产中';}
                    elseif($e->station=='5'){$station='已发货';}
                    elseif($e->station=='6'){$station='已完成';}
                    elseif($e->station=='7'){$station='审核不通过';}
                    if($e->type=='1'){$type='客户订单';}
                    elseif($e->type=='2'){$type='内部订单';}
                    $str=$str.'{"id":"'.$e->id.'","jine":"'.$e->jine.'","shijian":"'.date('Y-m-d H:i:s',$e->shijian).'","endtime":"'.date('Y-m-d H:i:s',$e->endtime).'","name":"'.$e->name.'","type":"'.$type.'","station":"'.$station.'","orderid":"'.$functionController::highLight($e->orderid,$orderid,$color = "red").'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }elseif($do=='kehulist'){
                if($request->has('currPage')){
                    $currPage=$request->get('currPage');
                }else{
                    $currPage=1;
                }
                if($request->has('pageSize')){
                    $pageSize=$request->get('pageSize');
                }else{
                    $pageSize=10;
                }
                $page=($currPage-1)*$pageSize;
                $result=DB::table('jb_kehu');
                if($request->has('title')){
                    if($request->input('title')=='客户名称/联系人/电话'){
                        $title=$request->get('title');
                    }else{
                        $title=$request->get('title');
                        $result=$result->where('title','like','%'.$title.'%')
                            ->orWhere('name','like','%'.$title.'%')
                            ->orWhere('phone','like','%'.$title.'%');
                    }
                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'","name":"'.$functionController::highLight($e->name,$title,$color = "red").'","phone":"'.$functionController::highLight($e->phone,$title,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }elseif($do=='kehuinfo'){
                if($request->has('id')){
                    $kehuinfo=DB::select('select id,title,name,phone,dizhi from jb_kehu where id=?',[$request->get('id')]);
                    if(count($kehuinfo)=='1'){
                        $str='';
                        $currPage=$request->input('currPage');
                        $str=$str.'{"id":"'.$kehuinfo[0]->id.'","title":"'.$kehuinfo[0]->title.'","name":"'.$kehuinfo[0]->name.'","phone":"'.$kehuinfo[0]->phone.'","dizhi":"'.$kehuinfo[0]->dizhi.'"}';
                        return json_decode($str,true);
                    }else{
                        $str='{"id":"","title":"","name":"","phone":"","didian":"","error":"数据异常"}';

                    }
                }else{
                    $str='{"id":"","title":"","name":"","phone":"","didian":"","error":"数据异常"}';
                }
            }elseif($do=='productinfo'){
                if($request->has('id')){
                    $productinfo=DB::select('select id,title from jb_product where id=?',[$request->get('id')]);
                    if(count($productinfo)=='1'){
                        $str='';
                        $currPage=$request->input('currPage');
                        $str=$str.'{"id":"'.$productinfo[0]->id.'","title":"'.$productinfo[0]->title.'"}';
                        return json_decode($str,true);
                    }else{
                        $str='{"id":"","title":"","error":"数据异常"}';
                    }
                }else{
                    $str='{"id":"","title":"","error":"数据异常"}';
                }
            }elseif($do=='productlist'){
                //pageSize
                //currPage  第几页
                //title
                //$page=($request->input('currPage')-1)*$request->input('pageSize');
                if($request->has('currPage')){
                    $currPage=$request->get('currPage');
                }else{
                    $currPage=1;
                }
                if($request->has('pageSize')){
                    $pageSize=$request->get('pageSize');
                }else{
                    $pageSize=10;
                }
                if($request->has('sell_station')){
                    $sell_station=$request->get('sell_station');
                }else{
                    $sell_station=1;
                }
                $page=($currPage-1)*$pageSize;
                $result=DB::table('jb_product');
                if($sell_station=='2'){

                }else{
                    $result=$result->where('sell_station',$sell_station);
                }

                $result=DB::table('jb_product')->select('id','title','guige');
                if($request->has('title')){
                    if($request->input('title')=='名称/规格'){
                        $title=$request->get('title');
                    }else{
                        $title=$request->get('title');
                        $result=$result->where('title','like','%'.$title.'%')
                            ->orWhere('guige','like','%'.$title.'%');
                    }
                }
                if($request->has('typeid')){
                    if($request->input('typeid')==''){

                    }else{
                        $typeid=$request->get('typeid');
                        $result=$result->where('typeid','=',$typeid);
                    }
                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'","guige":"'.$functionController::highLight($e->guige,$title,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }elseif($do=='productitem'){
                if($request->has('str')){
                    $str=$request->get('str');
                    $str=rtrim($str, '|');
                    $str=explode('|',$str);
                    $s='';

                    $totelprice=0;
                    for($i=0;$i<count($str);$i++){
                        $result=DB::select('select id,title,guige,jine from jb_product where id=?',[$str[$i]]);
                        if(count($result)=='1'){
                            $totelprice=$totelprice+$result[0]->jine;
                            $s=$s.'{"id":"'.$result[0]->id.'","title":"'.$result[0]->title.'","guige":"'.$result[0]->guige.'","jine":"'.$result[0]->jine.'"},';
                        }
                    }
                    $s='{"totelprice":"'.$totelprice.'","content":['.rtrim($s, ',')."]}";
                    return json_decode($s,true);
                }
            }elseif($do=='orderdetail'){
                $data=DB::select('select jb_order.id,orderid,kehu_id,name,phone,endtime,jine,didian,beizhu,shijian,monitime,station,type from jb_order where id=?',[$request->get('id')]);
                $str='';
                if(count($data)=='1'){
                    //获取匹配订单
                    $order=DB::select('select jb_product.title,jb_product.guige,jb_orderlist.id,jb_orderlist.pid,jb_orderlist.num,jb_orderlist.jine,jb_orderlist.totel,jb_orderlist.shijian from jb_orderlist LEFT JOIN jb_product on jb_orderlist.pid=jb_product.id where jb_orderlist.orderid=? order by id desc',[$data[0]->orderid]);

                    $kehu=DB::select('select title from jb_kehu where id=?',[$data[0]->kehu_id]);
                    $str=$str.'{"o_oid":"'.$data[0]->id.'","o_orderid":"'.$data[0]->orderid.'","o_kehuid":"'.$data[0]->kehu_id.'","o_kehutitle":"'.$kehu[0]->title.'","o_jine":"'.$data[0]->jine.'",';
                    $str=$str.'"o_name":"'.$data[0]->name.'","o_phone":"'.$data[0]->phone.'","o_endtime":"'.date('Y-m-d H:i:s',$data[0]->endtime).'","o_shijian":"'.date('Y-m-d H:i:s',$data[0]->shijian).'",';
                    $str=$str.'"o_station":"'.$data[0]->station.'","o_monitime":"'.date('Y-m-d H:i:s',$data[0]->monitime).'","o_type":"'.$data[0]->type.'","o_didian":"'.$data[0]->didian.'","o_beizhu":"'.$data[0]->beizhu.'","content":[';
                    foreach($order as $e){
                        $str=$str.'{"id":"'.$e->id.'","title":"'.$e->title.'","guige":"'.$e->guige.'","pid":"'.$e->pid.'","num":"'.$e->num.'","jine":"'.$e->jine.'","totel":"'.$e->totel.'"},';
                    }
                    $str=rtrim($str,',');
                    $str=$str.']}';
                    return json_decode($str,true);
                }
            }
            return view('admin.order',[
                'data'=>$data,
                'count'=>$count,'jine'=>$jine,'kehulist'=>$kehulist,
                'do'=>$do, 'kehu'=>$kehu,'start'=>$start,'end'=>$end,'station'=>$station,'type'=>$type,
                'id'=>$id,'paixu'=>$paixu,'fangshi'=>$fangshi,'orderid'=>$orderid,
                'name'=>$name,'totelpage'=>$totelpage,'xilie'=>$xilie,'shenhe'=>$shenhe,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }

    public function doorder(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$count='';$name='';$kehu='';$title='';$phone='';$orderid='';$station='';$paixu='shijian';$fangshi='desc';
            $start='';$end='';$station='';$type='';$jine='';$kehulist='';$totelpage='';$xilie='';$shenhe='0';
            $power=DB::select('select flag from jb_admin_user_left where id=?',[$request->session()->get('power')]);
            //订单审核权限
            if($powerController::isstr($power[0]->flag,'a3')=='1'){$shenhe='1';}
            if($do=='shenhe'){
                $data=DB::select('select jb_order.id,jb_order.orderid,jb_order.kehu_id,jb_order.name,jb_order.phone,jb_order.endtime,jb_order.jine,jb_order.didian,jb_order.beizhu,jb_order.shijian,jb_order.monitime,jb_order.station,jb_order.type，jb_kehu.title as kehutitle from jb_order LEFT JOIN jb_kehu on jb_order.kehu_id=jb_kehu.id where jb_order.id=?',[$id]);
                if(count($data)=='1'){
                    //获取匹配订单
                    $order=DB::select('select jb_product.title,jb_product.guige,jb_orderlist.id,jb_orderlist.pid,jb_orderlist.num,jb_orderlist.jine,jb_orderlist.totel,jb_orderlist.shijian from jb_orderlist LEFT JOIN jb_product on jb_orderlist.pid=jb_product.id where jb_orderlist.orderid=? order by id desc',[$data[0]->orderid]);

                }
            }
            return view('admin.doorder',[
                'data'=>$data,
                'count'=>$count,'jine'=>$jine,'kehulist'=>$kehulist,
                'do'=>$do, 'kehu'=>$kehu,'start'=>$start,'end'=>$end,'station'=>$station,'type'=>$type,
                'id'=>$id,'paixu'=>$paixu,'fangshi'=>$fangshi,'orderid'=>$orderid,
                'name'=>$name,'totelpage'=>$totelpage,'xilie'=>$xilie,'shenhe'=>$shenhe,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }



    }

    //获取模拟时间
    public function moni(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $toteltime=date('Y-m-d H:i:s');$msg='';$content='';
            if($do=='gettime'){
                if($request->has('num') && $request->has('pid') && $request->has('orderid')){
                    //先清除orderid记录
                    DB::delete('delete from jb_moni where orderid=?',[$request->get('orderid')]);
                    $num=trim($request->get('num'),'|');
                    $pid=trim($request->get('pid'),'|');
                    $num=explode('|',$num);
                    $pid=explode('|',$pid);
                    $toteltime=0;
                    for($i=0;$i<count($num);$i++){
                        AdminorderController::channeng($pid[$i],$num[$i],$request->get('orderid'));
                    }
                    //读取哪些产品库存不足
                    $product=DB::select('select jb_product.title,jb_product.danwei,jb_moni.num,jb_product.kucun from jb_moni LEFT JOIN jb_product on jb_moni.pid=jb_product.id where jb_moni.orderid=? order by jb_moni.id desc',[$request->get('orderid')]);
                    if(count($product)>0){
                        foreach($product as $e){
                            if($e->num>$e->kucun){
                                $msg=$msg.$e->title.'库存不足！';
                                $content=$content.'{"title":"'.$functionController::highLight($e->title,$e->title,$color = "red").'","num":"'.$functionController::highLight($e->num,$e->num,$color = "red").'","kucun":"'.$functionController::highLight($e->kucun,$e->kucun,$color = "red").'","danwei":"'.$functionController::highLight($e->danwei,$e->danwei,$color = "red").'"},';
                            }else{
                                $content=$content.'{"title":"'.$e->title.'","num":"'.$e->num.'","kucun":"'.$e->kucun.'","danwei":"'.$e->danwei.'"},';
                            }
                        }
                    }

                }
                $alltime=DB::select('select sum(time) as time from jb_moni where orderid=?',[$request->get('orderid')]);
                if(count($alltime)=='1'){$toteltime=$alltime[0]->time;}
                //每天工作8小时
                $toteltime=ceil($toteltime/8);
                $toteltime=date("Y-m-d H:i:s",time()+$toteltime*86400);
                $str='{"shijian":"'.$toteltime.'","msg":"'.$msg.'","content":['.$content;
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }

        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }

    //单个产品循环获取产能
    public static function channeng($id,$num,$orderid){
        $pro=DB::select('select type,guige,danwei,channeng,kucun,chang,kuan,houdu,zhijing,leixing,title,type from jb_product where id=?',[$id]);
        $time=0;
        if(count($pro)=='1'){
            //判断产品ID和订单号是否存在记录
            $moni=DB::select('select id,orderid,pid,kucun,num from jb_moni where orderid=? and pid=?',[$orderid,$id]);
            if(count($moni)=='1'){
                //叠加
                DB::update('update jb_moni set count=count+1,num=num+? where orderid=? and pid=?',[$num,$orderid,$id]);
            }else{
                //写入模拟表
                DB::insert('insert into jb_moni (orderid,pid,kucun,num) VALUES (?,?,?,?)',[
                    $orderid,$id,$pro[0]->kucun,$num
                ]);
            }
            if($pro[0]->kucun>=$num){
                $time=$time+0;
            }else{
                $channeng=$pro[0]->channeng;
                $channeng=AdminorderController::getfloatlength($channeng);
                //需要生产的数量
                $need=$num-$pro[0]->kucun;
                if($pro[0]->type=='3'){
                    $time=$time; DB::update('update jb_moni set time=? where orderid=? and pid=?',[0,$orderid,$id]);
                }else{
                    $time=$need/$channeng+$time; DB::update('update jb_moni set time=? where orderid=? and pid=?',[$need/$channeng,$orderid,$id]);
                }
                //读取子配件，判断配件或者原料是否足够
                $peijianlist=DB::select('select jb_peijianlist.ppid,jb_peijianlist.num,jb_product.type,jb_product.chang,jb_product.kuan,jb_product.houdu,jb_product.zhijing,jb_product.leixing,jb_product.channeng,jb_product.kucun,jb_product.title from jb_peijianlist left join jb_product on jb_peijianlist.ppid=jb_product.id where jb_peijianlist.pid=?',[$id]);
                if(count($peijianlist)>0){
                    foreach($peijianlist as $e){
                        //判断每个配件或者原料是否足够
                        $neadpj=$need*$e->num;
                        if($e->kucun>=$neadpj){
                            $time=$time+0;
                        }else{
                            $channengp=$e->num;
                            //需要生产的数量
                            $totel=$neadpj-$e->kucun;
                            if($e->type=='3'){
                                $time=$time;
                            }else{
                                $time=$totel/$pro[0]->channeng+$time;
                            }
                            $time=$time+self::channeng($e->ppid,$totel,$orderid);
                        }
                    }
                }
            }
            return $time;
        }else{
           return 'ID不存在';
        }
    }

    public static function getfloatlength($num){
        $count = 0;
        $temp = explode ( '.', $num );
        if (sizeof ( $temp ) > 1) {
            $decimal = end ( $temp );
            $count = strlen ( $decimal );
        }
        if($count>2){
            $num=number_format($num, 2, '.', '')+0.01;
        }
        return $num;
    }
}
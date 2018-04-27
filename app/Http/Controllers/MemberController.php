<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FunctionController;
Use App\Http\Controllers\AdminorderController;


class MemberController extends Controller{

    public function index(Request $request,FunctionController $functionController){
        if($request->session()->has('station')){
            return view('member.index',[
                'sitename'=>'网站首页--'.FunctionController::siteinfo('sitename'),
                'keyword'=>FunctionController::siteinfo('keyword'),
                'description'=>FunctionController::siteinfo('description')
            ]);
        }else{
            return Redirect::to('login');
        }
    }

    public function left(Request $request,FunctionController $functionController){
        if($request->session()->has('station')){
            $userinfo=DB::select('select cym_reguser.name,cym_reguser.user,cym_reguser.totel,cym_reguser.tigongedu,cym_reguser.paidanbi,cym_reguser.qianbao,cym_jibie.title from cym_reguser left join cym_jibie on cym_reguser.jibie=cym_jibie.id where cym_reguser.id=?',[
                $request->session()->get('id')
            ]);
            $mingri='0';
            $mr=DB::select('select jine from cym_mingri where userid=?',[$request->session()->get('id')]);
            if(count($mr)=='1'){$mingri=$mr[0]->jine;}
            $guadan=$functionController::guadan($request->session()->get('id'));
            $shouyi=0;
            //求助已完成减去帮助已完成
            $bangzhu_old=DB::select('select sum(jine) as totel from cym_offer_old where type=1 and station=5 and userid=?',[$request->session()->get('id')]);
            $bangzhu=DB::select('select sum(jine) as totel from cym_offer where type=1 and station=5 and userid=?',[$request->session()->get('id')]);
            $qiuzhu_old=DB::select('select sum(jine) as totel from cym_offer_old where type=2 and userid=?',[$request->session()->get('id')]);
            $qiuzhu=DB::select('select sum(jine) as totel from cym_offer where type=2 and userid=?',[$request->session()->get('id')]);
            $shouyi=$qiuzhu_old[0]->totel+$qiuzhu[0]->totel-$bangzhu_old[0]->totel-$bangzhu[0]->totel;
            //本金钱包
            $licaiqianbao=DB::select('select jine from cym_licai where userid=?',[$request->session()->get('id')]);
            if(count($licaiqianbao)=='1'){$licai=$licaiqianbao[0]->jine;}else{$licai=0;}

            return view('member.left',[
                'name'=>$userinfo[0]->name,
                'user'=>$userinfo[0]->user,
                'mingri'=>$mingri,'guadan'=>$guadan,'shouyi'=>$shouyi,'licai'=>$licai,
                'title'=>$userinfo[0]->title,
                'totel'=>$userinfo[0]->totel,
                'tigongedu'=>$userinfo[0]->tigongedu,
                'paidanbi'=>$userinfo[0]->paidanbi,
                'qianbao'=>$userinfo[0]->qianbao
            ]);
        }else{
            return Redirect::to('login');
        }
    }

    public function top(Request $request,FunctionController $functionController){
        if($request->session()->has('station')){
            $pwd=DB::select('select pwd from cym_reguser where id=?',[$request->session()->get('id')]);
            $pwd1=$functionController::authcode($pwd[0]->pwd,'DECODE','e8fe11ba8061',0);
            $pwdlen=strlen($pwd1);
            return view('member.top',[
                'pwdlen'=>$pwdlen
            ]);
        }else{
            return Redirect::to('login');
        }
    }

    public function main(Request $request,FunctionController $functionController){
        if($request->session()->has('station')){
            $guadan=$functionController::guadan($request->session()->get('id'));
            $tuijian=$request->session()->get('id')*2+88;
            $jingtai=$functionController::jingtaishouyi($request->session()->get('id'));
            $user=DB::select('select * from cym_reguser where id=?',[$request->session()->get('id')]);
            //读取预存钱包
            $fushu=DB::select('select qianbao from cym_fushuqianbao where userid=?',[$request->session()->get('id')]);
            if(count($fushu)=='0'){$fushuqianbao='0';}else{$fushuqianbao=$fushu[0]->qianbao;}
            //系统当前排单总金额
            $totel=DB::select('select sum(jine) as totel from cym_offer where type=1 and shijian between ? and ?',[
                date('Y-m-d 00:00:00'),date('Y-m-d H:i:s')
            ]);
            //排单信息
            $paidan=DB::select('select * from cym_paidaninfo where id=1');
            if($paidan[0]->station=='1'){
                $nowpaidan=$paidan[0]->nowpaidan;
                $totelpaidan=$paidan[0]->totelpaidan+$totel[0]->totel;
            }else{
                $nowpaidan=0;
                $totelpaidan=0;
            }
            return view('member.main',[
                'guadan'=>$guadan,'nowpaidan'=>$nowpaidan,'totelpaidan'=>$totelpaidan,
                'tuijian'=>$tuijian,
                'fushu'=>$fushuqianbao,
                'user'=>$user
            ]);
        }else{
            return Redirect::to('main');
        }
    }

    public function erweima(Request $request,FunctionController $functionController){
        if($request->session()->has('station')){
            $guadan=$functionController::guadan($request->session()->get('id'));
            $tuijian=$request->session()->get('id')*2+88;
            $jingtai=$functionController::jingtaishouyi($request->session()->get('id'));
            $user=DB::select('select * from cym_reguser where id=?',[$request->session()->get('id')]);
            return view('member.erweima',[
                'sitename'=>'二维码邀请链接--'.FunctionController::siteinfo('sitename'),
                'keyword'=>FunctionController::siteinfo('keyword'),
                'description'=>FunctionController::siteinfo('description'),
                'shouyi'=>FunctionController::siteinfo('paiduishouyi'),
                'tuijian'=>$tuijian
            ]);
        }else{
            return Redirect::to('main');
        }
    }



    //测试
    public function test(Request $request,FunctionController $functionController,AdminorderController $adminorderController){

        return ceil(10.001);

    }

    //更新会员排单状态
    public static function key($num){
        $count = 0;
        $temp = explode ( '.', $num );
        if (sizeof ( $temp ) > 1) {
            $decimal = end ( $temp );
            $count = strlen ( $decimal );
        }
        if($count>2)
        return $count;
    }


}
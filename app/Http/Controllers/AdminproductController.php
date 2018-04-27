<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FunctionController;
use Illuminate\Support\Facades\URL;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\AdmindosqlController;

class AdminproductController extends Controller{

    public function index(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$img='';$imgurl='';$user='';$title='';$count='';$typename='';$phone='';$dizhi='';$xilie='';$typeid='';$guige='';$paixu='shijian';$fangshi='desc';
            $totelpage=0;$gongxu='';$gxcount='';$ppcount='';$pgxinfo='';$peijianlist='';
            $xilie=DB::table('jb_xilie')->get();
            $ptotelpage=ceil(DB::table('jb_product')->count()/10);
            if($do=='list'){
                $result=DB::table('jb_product')->where('type','!=','3');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('guige')){
                    $guige=$request->get('guige');
                    $result=$result->where('guige','like','%'.$guige.'%');
                }
                if($request->has('id')){
                    $id=$request->get('id');
                    $result=$result->where('id','=',$id);
                }
                if($request->has('typeid')){
                    $typeid=$request->get('typeid');
                    $result=$result->where('typeid','=',$typeid);
                    //typeid获取title
                    $type=DB::select('select title from jb_xilie where id=?',[$typeid]);
                    if(count($type)=='1'){
                        $typename=$type[0]->title;
                    }else{
                        $typename='不存在该系列';
                    }
                    $xilie=DB::select('select id,title from jb_xilie where type!=3 and id!=? order by id desc',[$typeid]);
                }else{
                    $xilie=DB::select('select id,title from jb_xilie where type!=3 order by id desc');
                }
                $result=$result->orderby($paixu,$fangshi);
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);

            }elseif($do=='add'){
                $xilie=DB::select('select id,title from jb_xilie where type!=3 order by id desc');

            }elseif($do=='edit'){
                $data=DB::select('select * from jb_product where id=?',[$id]);
                $pic=DB::select('select id,pic from jb_pic where p_id=?',[$id]);
                if(count($pic)>0){
                    foreach($pic as $e){
                        $imgurl=$imgurl.trim($e->pic)."|";
                        $img=$img.'<li><img src="'.trim($e->pic).'" width=180 height=120><a href='.URL('jb_admin/excsql/delpic/'.$e->id).' onclick="return confirm(\'确定要删除这图片吗？\')">删除</a></li>';
                    }
                }
                if(count($data)=='0'){
                    return 'ID异常，不存在该产品!';
                }else{
                    $type=DB::select('select title from jb_xilie where id=?',[$data[0]->typeid]);
                    if(count($type)=='1'){
                        $typename=$type[0]->title;
                    }else{
                        $typename='不存在该系列';
                    }
                    $xilie=DB::select('select id,title from jb_xilie where type!=3 and id!=? order by id desc',[$data[0]->typeid]);
                }
                //获取配件列表
                $peijian=DB::select('select jb_product.title,jb_product.guige,jb_peijianlist.ppid,jb_peijianlist.num from jb_peijianlist LEFT JOIN jb_product on jb_peijianlist.ppid=jb_product.id where jb_peijianlist.pid=? ORDER by jb_peijianlist.id asc',[$id]);
                if(count($peijian)>0){
                    foreach($peijian as $e){
                        $peijianlist=$peijianlist.'<tr><td>'.$e->title.'</td><td>'.$e->guige.'</td><td width=200><input type="text" class="input num_input_flag" value="'.$e->num.'" name="num[]" datatype="*" style="width: 200px; text-align: center;" ></td><input type="hidden" name="pid[]" value="'.$e->ppid.'"></td><td><a href="javascript:;" id="a'.$e->ppid.'" onclick="removep('.$e->ppid.')">删除</a></td></tr>';
                    }
                }

            }elseif($do=='fuzhi'){
                $data=DB::select('select * from jb_product where id=?',[$id]);
                $pic=DB::select('select id,pic from jb_pic where type=1 and p_id=?',[$id]);
                if(count($pic)>0){
                    foreach($pic as $e){
                        $imgurl=$imgurl.trim($e->pic)."|";
                        $img=$img.'<li><img src="'.trim($e->pic).'" width=180 height=120><a href='.URL('jb_admin/excsql/delpic/'.$e->id).' onclick="return confirm(\'确定要删除这图片吗？\')">删除</a></li>';
                    }
                }
                if(count($data)=='0'){
                    return 'ID异常，不存在该产品!';
                }else{
                    $type=DB::select('select title from jb_xilie where id=?',[$data[0]->typeid]);
                    if(count($type)=='1'){
                        $typename=$type[0]->title;
                    }else{
                        $typename='不存在该系列';
                    }
                    $xilie=DB::select('select id,title from jb_xilie where type=1 and id!=? order by id desc',[$data[0]->typeid]);
                }
                //获取配件列表
                $peijian=DB::select('select jb_product.title,jb_product.guige,jb_peijianlist.ppid,jb_peijianlist.num from jb_peijianlist LEFT JOIN jb_product on jb_peijianlist.ppid=jb_product.id where jb_peijianlist.pid=? ORDER by jb_peijianlist.id asc',[$id]);
                if(count($peijian)>0){
                    foreach($peijian as $e){
                        $peijianlist=$peijianlist.'<tr><td>'.$e->title.'</td><td>'.$e->guige.'</td><td width=200><input type="text" class="input num_input_flag" value="'.$e->num.'" name="num[]" datatype="*" style="width: 200px; text-align: center;" ></td><input type="hidden" name="pid[]" value="'.$e->ppid.'"></td><td><a href="javascript:;" id="a'.$e->ppid.'" onclick="removep('.$e->ppid.')">删除</a></td></tr>';
                    }
                }
            }elseif($do=='editproductxilie'){
                $data=DB::select('select id,title,type from jb_xilie where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该系列';
                }
            }elseif($do=='productxilie'){
                $result=DB::table('jb_xilie')->where('type','1');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                $result=$result->orderby('id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
                $totelpage=ceil($result->count()/10);
            }
            elseif($do=='editpeijianxilie'){
                $data=DB::select('select id,title,type from jb_xilie where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该系列';
                }
            }elseif($do=='peijianxilie'){
                $result=DB::table('jb_xilie')->where('type','2');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('id')){
                    $id=$request->get('id');
                    $result=$result->where('id','=',$id);
                }
                $result=$result->orderby('id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
            }elseif($do=='backproductxilie'){
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
                $result=DB::table('jb_xilie');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('type','=',$type);
                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }elseif($do=='gongxulist'){
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
                $result=DB::table('jb_gongxu');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }elseif($do=='gongxuitem'){
                if($request->has('id')){
                    $gongxuinfo=DB::select('select id,title from jb_gongxu where id=?',[$request->get('id')]);
                    if(count($gongxuinfo)=='1'){
                        $str='';
                        $str=$str.'{"id":"'.$gongxuinfo[0]->id.'","title":"'.$gongxuinfo[0]->title.'"}';
                        return json_decode($str,true);
                    }else{
                        $str='{"id":"","title":"","error":"数据异常"}';
                    }
                }else{
                    $str='{"id":"","title":"","error":"数据异常"}';
                }
            }elseif($do=='gongxuadd'){
                if($request->has('str')){
                    $str=$request->get('str');
                    $str=rtrim($str, '|');
                    $str=explode('|',$str);
                    $s='';
                    for($i=0;$i<count($str);$i++){
                        $result=DB::select('select id,title from jb_gongxu where id=?',[$str[$i]]);
                        if(count($result)=='1'){
                            $s=$s.'{"id":"'.$result[0]->id.'","title":"'.$result[0]->title.'"},';
                        }
                    }
                    $s='{"content":['.rtrim($s, ',')."]}";
                    return json_decode($s,true);
                }else{
                    return '数据异常...';
                }
            }elseif($do=='peijianlist'){
                if($request->has('pid')){
                    if($request->input('pid')!=''){
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
                        $result=DB::table('jb_peijianlist')
                                ->leftjoin('jb_product','jb_peijianlist.ppid','=','jb_product.id')
                                ->where('jb_peijianlist.pid',$request->input('pid'))
                        ;
                        if($request->has('title')){
                            $title=$request->get('title');
                            $result=$result->where('jb_product.title','like','%'.$title.'%');
                        }
                        $result=$result->orderby('jb_peijianlist.id','desc');
                        $totelpage=ceil($result->count()/$pageSize);
                        $result=$result->skip($page)->take($pageSize)->get();
                        $str='';
                        $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                        foreach($result as $e){
                            $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'"},';
                        }
                        $str=$str."]}";
                        $str = str_replace(",]}","]}",$str);
                        return json_decode($str,true);
                    }else{
                        return '产品ID不存在!';
                    }
                }else{
                    return '产品ID不存在!';
                }
            }elseif($do=='peijianinfo'){
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
            }elseif($do=='choosepp'){
                if($request->has('str')){
                    $str=$request->get('str');
                    $str=rtrim($str, '|');
                    $str=explode('|',$str);
                    $ppid='|';$pptitle='';
                    for($i=0;$i<count($str);$i++){
                        $result=DB::select('select id,title from jb_product where id=?',[$str[$i]]);
                        if(count($result)=='1'){
                            $ppid=$ppid.$result[0]->id.'|';
                            $pptitle=$pptitle.$result[0]->title.'|';
                        }
                    }
                    $s='{"id":"'.$ppid.'","title":"'.rtrim($pptitle, '|').'"}';
                    return json_decode($s,true);
                }
            }
            return view('admin.product',[
                'data'=>$data, 'totelpage'=>$totelpage,'gxcount'=>$gxcount,'ppcount'=>$ppcount,'pgxinfo'=>$pgxinfo,'ptotelpage'=>$ptotelpage,'peijianlist'=>$peijianlist,
                'count'=>$count,
                'guige'=>$guige,
                'do'=>$do,
                'xilie'=>$xilie,
                'typeid'=>$typeid,
                'img'=>$img,
                'imgurl'=>$imgurl,
                'paixu'=>$paixu,
                'fangshi'=>$fangshi,
                'user'=>$user,'gongxu'=>$gongxu,
                'typename'=>$typename,
                'id'=>$id,
                'dizhi'=>$dizhi,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }

    public function xilie(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$img='';$imgurl='';$user='';$title='';$count='';$typename='';$phone='';$dizhi='';$xilie='';$typeid='';$guige='';$paixu='shijian';$fangshi='desc';
            $totelpage=0;$gongxu='';$gxcount='';$ppcount='';$pgxinfo='';
            $xilie=DB::table('jb_xilie')->get();
            if($do=='list'){
                $result=DB::table('jb_xilie')->where('type','1');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                $result=$result->orderby('id','desc');
                if($request->has('page')){
                    $page=$request->get('page')-1;
                }else{
                    $page='0';
                }
                $count=$result->count()-($page*10);
                $data=$result->paginate(10);
                $totelpage=ceil($result->count()/10);

            }elseif($do=='edit'){
                $data=DB::select('select id,title,type from jb_xilie where id=?',[$id]);
                if(count($data)=='0'){
                    return 'ID异常，不存在该系列';
                }
            }elseif($do=='backproductxilie'){
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
                $result=DB::table('jb_xilie');
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('title','like','%'.$title.'%');
                }
                if($request->has('type')){
                    $type=$request->get('type');
                    $result=$result->where('type','=',$type);
                }
                $result=$result->orderby('id','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $str=$str.'{"id":"'.$e->id.'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }
            return view('admin.xilie',[
                'data'=>$data, 'totelpage'=>$totelpage,'gxcount'=>$gxcount,'ppcount'=>$ppcount,'pgxinfo'=>$pgxinfo,
                'count'=>$count,
                'guige'=>$guige,
                'do'=>$do,
                'xilie'=>$xilie,
                'typeid'=>$typeid,
                'img'=>$img,
                'imgurl'=>$imgurl,
                'paixu'=>$paixu,
                'fangshi'=>$fangshi,
                'user'=>$user,'gongxu'=>$gongxu,
                'typename'=>$typename,
                'id'=>$id,
                'dizhi'=>$dizhi,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }

    public function addnext(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id=''){
        if($powerController::islogin()=='success'){
            $data='';$img='';$imgurl='';$user='';$title='';$count='';$typename='';$phone='';$dizhi='';$xilie='';$typeid='';$guige='';$paixu='shijian';$fangshi='desc';
            $totelpage=0;$gongxu='';$gxcount='';$ppcount='';$pgxinfo='';
            $xilie=DB::table('jb_xilie')->get();$type=$request->get('type');
            if($do=='addnext'){
                $t=DB::select('select title from jb_product where id=?',[$id]);
                if(count($t)=='1'){
                    $title=$t[0]->title;
                }else{
                    return '产品ID不存在';
                }
                $gxcount=ceil(DB::table('jb_gongxu')->count()/10);
                $ppcount=ceil(DB::table('jb_peijianlist')->where('pid',$id)->count()/10);
                //判断一下有没有存在的数据
                $gxinfo=DB::select('select * from jb_gongxu where id=?',[$id]);
                $gongxu=DB::select('select id,title from jb_gongxu order by id desc');
                //需要获取一下产品工序信息
                $gx=DB::select('select p_id,gx_id,pp_id from jb_product_gongxu where p_id=?',[$id]);
                if(count($gx)>0){
                    foreach($gx as $e){
                        $gxtitle=DB::select('select title from jb_gongxu where id=?',[$e->gx_id]);
                        $pp_id=trim($e->pp_id,'|');
                        $pp_id=explode('|',$pp_id);
                        $pp_title='';
                        for($i=0;$i<count($pp_id);$i++){
                            $t=DB::select('select title from jb_product where id=?',[$pp_id[$i]]);
                            $pp_title=$pp_title.$t[0]->title.'|';
                        }
                        $pp_title=trim($pp_title,'|');
                        $pgxinfo=$pgxinfo.'<tr><td>'.$gxtitle[0]->title.'</td><td width="300"><input type="text" class="input" value="'.$pp_title.'" onclick="choosegx('.$e->gx_id.')" name="[]" id="gxtitle'.$e->gx_id.'" datatype="*" style="width: 300px; text-align: center;"><input type="hidden" name="gongxu_id[]" value="'.$e->gx_id.'"><input type="hidden" id="gxid'.$e->gx_id.'" name="p_id[]" value="'.$e->pp_id.'"></td><td><a href="javascript:;" id="a'.$e->gx_id.'" onclick="removep('.$e->gx_id.')">删除</a></td></tr>';
                    }
                }
            }elseif($do=='addproduct'){
                if($request->has('title')){
                    $title=$request->input('title');
                }
                if($title==''){
                    return '产品名称不能为空，添加失败！';
                }else{
                    //获取一下typeid的type，1产品2配件3原料
                    $type1=DB::select('select type from jb_xilie where id=?',[$request->input('typeid')]);
                    if(count($type1)=='1'){
                        $lei=$type1[0]->type;
                    }else{
                        return '不存在该系列，添加失败！';
                    }
                    AdmindosqlController::log('添加产品成功，系列名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::insert('insert into jb_product(title,guige,jine,vip_zhekou,dandu_zhekou,danwei,kucun,channeng,typeid,shijian,content,sell_station,type,leixing) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[
                        $request->input('title'),$request->input('guige'),$request->input('jine'),$request->input('vip_zhekou'),
                        $request->input('dandu_zhekou'),$request->input('danwei'),$request->input('kucun'),$request->input('channeng'),
                        $request->input('typeid'),time(),$request->input('content'),$request->input('sell_station'),$lei,$request->input('leixing')
                    ]);
                    $p=DB::select('select * from jb_product where title=? order by shijian desc limit 0,1',[$request->input('title')]);
                    if($request->has('chang')){
                        DB::update('update jb_product set chang=? where id=?',[$request->input('chang'),$p[0]->id]);
                    }
                    if($request->has('kuan')){
                        DB::update('update jb_product set kuan=? where id=?',[$request->input('kuan'),$p[0]->id]);
                    }
                    if($request->has('houdu')){
                        DB::update('update jb_product set houdu=? where id=?',[$request->input('houdu'),$p[0]->id]);
                    }
                    if($request->has('zhijing')){
                        DB::update('update jb_product set zhijing=? where id=?',[$request->input('zhijing'),$p[0]->id]);
                    }
                    if($request->input('pic')!=''){
                        //获取产品ID
                        $picstr=explode("|", $request->input('pic'));
                        for($i=0;$i<count($picstr)-1;$i++)
                        {
                            if($i!=count($picstr)-1)
                            {
                                DB::insert('insert into jb_pic(pic,type,shijian,p_id) values (?,?,?,?)',[
                                    $picstr[$i],'1',time(),$p[0]->id
                                ]);
                            }
                        }
                    }
                    $num=$request->input('num');
                    $pid=$request->input('pid');
                    if($num!=''){
                        for($i=0;$i<count($num);$i++){
                            DB::insert('insert into jb_peijianlist (pid,ppid,num) VALUES (?,?,?)',[
                                $p[0]->id,$pid[$i],$num[$i]
                            ]);
                        }
                    }
                    if(count($p)=='1'){
                        $id=$p[0]->id;
                        return Redirect::to('jb_admin/addnext/addnext/'.$id);
                    }else{
                        return '数据异常，请核查...';
                    }
                }
            }elseif($do=='fuzhiproduct'){
                if($request->has('title')){
                    $title=$request->input('title');
                }
                if($title==''){
                    return '产品名称不能为空，添加失败！';
                }else{
                    //获取一下typeid的type，1产品2配件3原料
                    $type1=DB::select('select type from jb_xilie where id=?',[$request->input('typeid')]);
                    if(count($type1)=='1'){
                        $lei=$type1[0]->type;
                    }else{
                        return '不存在该系列，添加失败！';
                    }
                    AdmindosqlController::log('添加产品成功，系列名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                    DB::insert('insert into jb_product(title,guige,jine,vip_zhekou,dandu_zhekou,danwei,kucun,channeng,typeid,shijian,content,sell_station,type,leixing) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[
                        $request->input('title'),$request->input('guige'),$request->input('jine'),$request->input('vip_zhekou'),
                        $request->input('dandu_zhekou'),$request->input('danwei'),$request->input('kucun'),$request->input('channeng'),
                        $request->input('typeid'),time(),$request->input('content'),$request->input('sell_station'),$lei,$request->input('leixing')
                    ]);
                    $p=DB::select('select * from jb_product where title=? order by shijian desc limit 0,1',[$request->input('title')]);
                    if($request->has('chang')){
                        DB::update('update jb_product set chang=? where id=?',[$request->input('chang'),$p[0]->id]);
                    }
                    if($request->has('kuan')){
                        DB::update('update jb_product set kuan=? where id=?',[$request->input('kuan'),$p[0]->id]);
                    }
                    if($request->has('houdu')){
                        DB::update('update jb_product set houdu=? where id=?',[$request->input('houdu'),$p[0]->id]);
                    }
                    if($request->has('zhijing')){
                        DB::update('update jb_product set zhijing=? where id=?',[$request->input('zhijing'),$p[0]->id]);
                    }
                    if($request->input('pic')!=''){
                        //获取产品ID
                        $picstr=explode("|", $request->input('pic'));
                        for($i=0;$i<count($picstr)-1;$i++)
                        {
                            if($i!=count($picstr)-1)
                            {
                                DB::insert('insert into jb_pic(pic,type,shijian,p_id) values (?,?,?,?)',[
                                    $picstr[$i],'1',time(),$p[0]->id
                                ]);
                            }
                        }
                    }
                    $num=$request->input('num');
                    $pid=$request->input('pid');
                    if($num!=''){
                        for($i=0;$i<count($num);$i++){
                            DB::insert('insert into jb_peijianlist (pid,ppid,num) VALUES (?,?,?)',[
                                $p[0]->id,$pid[$i],$num[$i]
                            ]);
                        }
                    }
                    //工序列表也复制一下
                    $gxlist=DB::select('select p_id,gx_id,pp_id from jb_product_gongxu where p_id=?',[$id]);
                    foreach($gxlist as $e){
                        DB::insert('insert into jb_product_gongxu (p_id,gx_id,pp_id) VALUES (?,?,?)',[
                            $p[0]->id,$e->gx_id,$e->pp_id
                        ]);
                    }
                    if(count($p)=='1'){
                        return Redirect::to('jb_admin/addnext/addnext/'.$p[0]->id);
                    }else{
                        return '数据异常，请核查...';
                    }
                }
            }
            elseif($do=='editproduct'){
                $id=$request->get('id');
                //更新产品信息
                AdmindosqlController::log('更新产品成功，产品编号：'.$id.',产品名称：'.$request->input('title'),$functionController::GetIp(),$functionController::GetIpLookup($functionController::GetIp()));
                DB::update('update jb_product set title=?,guige=?,jine=?,vip_zhekou=?,dandu_zhekou=?,danwei=?,kucun=?,channeng=?,typeid=?,content=?,sell_station=?,leixing=? where id=?',[
                    $request->input('title'),$request->input('guige'),$request->input('jine'),$request->input('vip_zhekou'),
                    $request->input('dandu_zhekou'),$request->input('danwei'),$request->input('kucun'),$request->input('channeng'),
                    $request->input('typeid'),$request->input('content'),$request->input('sell_station'),$request->input('leixing'),$id
                ]);
                if($request->has('chang')){
                    DB::update('update jb_product set chang=? where id=?',[$request->input('chang'),$id]);
                }
                if($request->has('kuan')){
                    DB::update('update jb_product set kuan=? where id=?',[$request->input('kuan'),$id]);
                }
                if($request->has('houdu')){
                    DB::update('update jb_product set houdu=? where id=?',[$request->input('houdu'),$id]);
                }
                if($request->has('zhijing')){
                    DB::update('update jb_product set zhijing=? where id=?',[$request->input('zhijing'),$id]);
                }
                DB::delete('delete from jb_pic where p_id=?',[$id]);
                if($request->input('pic')!=''){
                    $picstr=explode("|", $request->input('pic'));
                    for($i=0;$i<count($picstr)-1;$i++)
                    {
                        if($i!=count($picstr)-1)
                        {
                            DB::insert('insert into jb_pic(pic,shijian,p_id) values (?,?,?)',[
                                $picstr[$i],time(),$id
                            ]);
                        }
                    }
                }
                //更新子配件列表
                DB::delete('delete from jb_peijianlist where pid=?',[$id]);
                $num=$request->input('num');
                $pid=$request->input('pid');
                if($num!=''){
                    for($i=0;$i<count($num);$i++){
                        DB::insert('insert into jb_peijianlist (pid,ppid,num) VALUES (?,?,?)',[
                            $id,$pid[$i],$num[$i]
                        ]);
                    }
                }
                $ptitle=DB::select('select title from jb_product where id=?',[$id]);
                if(count($ptitle)=='1'){
                    $title=$ptitle[0]->title;

                    return Redirect::to('jb_admin/addnext/addnext/'.$id);
                }else{
                    return '数据异常，产品ID不存在...';
                }
            }
            return view('admin.addnext',[
                'data'=>$data, 'totelpage'=>$totelpage,'gxcount'=>$gxcount,'ppcount'=>$ppcount,'pgxinfo'=>$pgxinfo,'type'=>$type,
                'count'=>$count,
                'guige'=>$guige,
                'do'=>$do,
                'xilie'=>$xilie,
                'typeid'=>$typeid,
                'img'=>$img,
                'imgurl'=>$imgurl,
                'paixu'=>$paixu,
                'fangshi'=>$fangshi,
                'user'=>$user,'gongxu'=>$gongxu,
                'typename'=>$typename,
                'id'=>$id,
                'dizhi'=>$dizhi,
                'phone'=>$phone,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }
    public function yuanliao(Request $request,FunctionController $functionController,PowerController $powerController,$do='list',$id='0'){
        if($powerController::islogin()=='success'){
            $data='';$count='';$name='';$kehu='';$title='';$phone='';$orderid='';$station='';$paixu='shijian';$fangshi='desc';
            $start='';$end='';$station='';$type='';$jine='';$kehulist='';$totelpage='';$imgurl='';$img='';$typename='';
            $xilie=DB::table('jb_xilie')->where('type','3')->get();
            if($do=='list'){
                //客户参数
                $kehulist=DB::select('select id,title from jb_kehu order by id desc');
                $totelpage=ceil(DB::table('jb_kehu')->count()/10);
                //产品参数
                $count=ceil(DB::table('jb_product')->count()/10);

            }elseif($do=='edit'){
                $data=DB::select('select * from jb_product where id=?',[$id]);
                $pic=DB::select('select id,pic from jb_pic where p_id=?',[$id]);
                if(count($pic)>0){
                    foreach($pic as $e){
                        $imgurl=$imgurl.trim($e->pic)."|";
                        $img=$img.'<li><img src="'.trim($e->pic).'" width=180 height=120><a href='.URL('jb_admin/excsql/delpic/'.$e->id).' onclick="return confirm(\'确定要删除这图片吗？\')">删除</a></li>';
                    }
                }
                if(count($data)=='0'){
                    return 'ID异常，不存在该产品!';
                }else{
                    $type=DB::select('select title from jb_xilie where id=?',[$data[0]->typeid]);
                    if(count($type)=='1'){
                        $typename=$type[0]->title;
                    }else{
                        $typename='不存在该系列';
                    }
                    $xilie=DB::select('select id,title from jb_xilie where type=3 and id!=? order by id desc',[$data[0]->typeid]);
                }

            }elseif($do=='yuanliaolist'){
                //pageSize
                //currPage  第几页
                //title
                //$page=($request->input('currPage')-1)*$request->input('pageSize');
                $bianhao='';$picihao='';
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
                $result=DB::table('jb_product')
                    ->leftjoin('jb_xilie','jb_product.typeid','=','jb_xilie.id')
                    ->where('jb_xilie.type','=','3')
                    ->select('jb_product.id','jb_product.title','jb_product.danwei','jb_product.guige','jb_product.typeid','jb_product.shijian','jb_product.bianhao','jb_product.rukutime','jb_product.picihao','jb_product.kucun','jb_product.shijian') ;
                if($request->has('title')){
                    $title=$request->get('title');
                    $result=$result->where('jb_product.title','like','%'.$title.'%');
                }
                if($request->has('guige')){
                    $guige=$request->get('guige');
                    $result=$result->where('jb_product.guige','like','%'.$guige.'%');
                }
                if($request->has('bianhao')){
                    $bianhao=$request->get('bianhao');
                    $result=$result->where('jb_product.bianhao','like','%'.$bianhao.'%');
                }
                if($request->has('picihao')){
                    $picihao=$request->get('picihao');
                    $result=$result->where('jb_product.picihao','like','%'.$picihao.'%');
                }
                if($request->has('typeid')){
                    $typeid=$request->get('typeid');
                    $result=$result->where('jb_product.typeid','=',$typeid);
                }
                if($request->has('start')){
                    $start=$request->get('start');
                    $result=$result->where('jb_product.rukutime','>=',strtotime($start));
                }
                if($request->has('end')){
                    $end=$request->get('end');
                    $result=$result->where('jb_product.rukutime','<=',strtotime($end));
                }
                $result=$result->orderby('jb_product.shijian','desc');
                $totelpage=ceil($result->count()/$pageSize);
                $result=$result->skip($page)->take($pageSize)->get();
                $str='';
                $currPage=$request->input('currPage');

                $str='{"currPage":"'.$currPage.'","totalPage":"'.$totelpage.'","content":[';
                foreach($result as $e){
                    $pic=$functionController::getpic($e->id,3);
                    $str=$str.'{"id":"'.$e->id.'","kucun":"'.$e->kucun.'","guige":"'.$e->guige.'","danwei":"'.$e->danwei.'","pic":"'.$pic.'","typeid":"'.$e->typeid.'","shijian":"'.date('Y-m-d H:i:s',$e->shijian).'","rukutime":"'.date('Y-m-d H:i:s',$e->rukutime).'","title":"'.$functionController::highLight($e->title,$title,$color = "red").'","bianhao":"'.$functionController::highLight($e->bianhao,$bianhao,$color = "red").'","picihao":"'.$functionController::highLight($e->picihao,$picihao,$color = "red").'"},';
                }
                $str=$str."]}";
                $str = str_replace(",]}","]}",$str);
                return json_decode($str,true);
            }
            return view('admin.yuanliao',[
                'data'=>$data,
                'count'=>$count,'jine'=>$jine,'kehulist'=>$kehulist,
                'do'=>$do, 'kehu'=>$kehu,'start'=>$start,'end'=>$end,'station'=>$station,'type'=>$type,
                'id'=>$id,'paixu'=>$paixu,'fangshi'=>$fangshi,'orderid'=>$orderid,
                'name'=>$name,'totelpage'=>$totelpage,'xilie'=>$xilie,
                'phone'=>$phone,'typename'=>$typename,'img'=>$img,'imgurl'=>$imgurl,
                'title'=>$title
            ]);
        }else{
            return Redirect::to('jb_admin/login?go='.$powerController::islogin());
        }
    }




}
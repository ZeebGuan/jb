<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/shop-style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('js/nav.js')}}"></script>
    <script language="javascript">
        function jianum()
        {
            var num=document.getElementById("jine").value;
            document.getElementById("jine").value=parseInt(num)+1;
        }
        function jiannum()
        {
            var num=document.getElementById("jine").value;
            if(parseInt(num)<=1){
                alert("最小购买1件");
                document.getElementById("jine").value=1;
            }else {
                document.getElementById("jine").value=parseInt(num)-1;
            }
        }
    </script>
    <script src="{{asset('js/ZoomPic.js')}}"></script>
</head>

<body>
@include('shop.top')
<div id="content">
    <div class="content">
        <div class="c-title"><p>{{$data[0]->title}}</p></div>
        <div class="c-top" style="margin-top:30px;">
            <div id="focus_Box">
                <span class="prev">&nbsp;</span>
                <span class="next">&nbsp;</span>
                <ul>
                    @foreach($pic as $e)
                        <li><a href="javascript:;"><img src="http://www.mrgzcy.com{{trim($e->pic)}}"></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="s-right">
                <div class="jiage">
                    <font>创益金币：{{$data[0]->jinbijiage}}</font>
                    <font>创益银币：{{$data[0]->yinbijiage}}</font>
                    <span>创益金币库存：{{\App\Http\Controllers\FunctionController::kucun($id,1)}}</span>
                    <span>创益银币库存：{{\App\Http\Controllers\FunctionController::kucun($id,0)}}</span>
                    <span>每个ID限购：{{$data[0]->xiangou}}</span>
                </div>
                <form name="form1" id="form1" method="post" action="{{URL('shop/check-shop/'.$id)}}">
                    <div class="gentou">
                        <span>购买数量：</span>
                        <input type="button" name="jian" value="" class="button" onclick="jiannum()" />
                        <input type="text" name="jine" id="jine" value="1" class="input"/>
                        <input type="button" name="jia" value="" class="button" onclick="jianum()" />
                        <span class="Validform_checktip" style="display:none"></span>
                    </div>
                    <input type="submit" value="我要兑换" class="sumbit" onclick="checkfrom" />
                </form>
            </div>
        </div>
        <div class="c-nav"><a href="javascript:;" class="hover">商品描述</a></div>
        <div class="c-con">
            <div class="c-con-con">{!! $data[0]->content !!}</div>
        </div>
    </div>
</div>
<div class="clear"></div>
@include('shop.foot')
<script src="{{asset('js/pic_tab.js')}}"></script>
<script type="text/javascript">
    jq('#demo1').banqh({
        box:"#demo1",//总框架
        pic:"#ban_pic1",//大图框架
        pnum:"#ban_num1",//小图框架
        prev_btn:"#prev_btn1",//小图左箭头
        next_btn:"#next_btn1",//小图右箭头
        pop_prev:"#prev2",//弹出框左箭头
        pop_next:"#next2",//弹出框右箭头
        prev:"#prev1",//大图左箭头
        next:"#next1",//大图右箭头
        pop_div:"#demo2",//弹出框框架
        pop_pic:"#ban_pic2",//弹出框图片框架
        pop_xx:".pop_up_xx",//关闭弹出框按钮
        mhc:".mhc",//朦灰层
        autoplay:true,//是否自动播放
        interTime:5000,//图片自动切换间隔
        delayTime:400,//切换一张图片时间
        pop_delayTime:400,//弹出框切换一张图片时间
        order:0,//当前显示的图片（从0开始）
        picdire:true,//大图滚动方向（true为水平方向滚动）
        mindire:true,//小图滚动方向（true为水平方向滚动）
        min_picnum:5,//小图显示数量
        pop_up:true//大图是否有弹出框
    })
</script>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('js/jquery.js')}}"></script>
    <script language="javascript" type="text/javascript" src="{{asset('rili/WdatePicker.js')}}"></script>
    <SCRIPT LANGUAGE=javascript>
        function getuser(userid,id)
        {
            if($("#id"+userid).hasClass('has')){
                $("#id"+userid).removeClass('has');
                $("#id"+userid+" p:first").removeClass('open');
                $("#id"+userid).addClass('more');
                $("#id"+userid).children('span').remove();
            }else{
                var xmlHttp;
                try
                {
                    xmlHttp=new XMLHttpRequest();
                }
                catch (e)
                {
                    try
                    {
                        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch (e)
                    {
                        try
                        {
                            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch (e)
                        {
                            alert("您的浏览器不支持ajax");
                            return false;
                        }
                    }
                }
                xmlHttp.onreadystatechange=function()
                {
                    if(xmlHttp.readyState==4)
                    {
                        $("#id"+userid).append(xmlHttp.responseText);
                        $("#id"+userid).removeClass('more');
                        $("#id"+userid).addClass('has');
                        $("#id"+userid+" p:first").addClass('open');
                    }
                }
                var url="{{URL('info-member')}}/"+userid+"/"+id;
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
            }
        }
    </SCRIPT>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')


<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>个人信息</a> / 推荐结构</div>
        <div class="info-nav">
            <a href="{{URL('info-index')}}" class="index">我的激活码</a>
            <a href="{{URL('info-guanli')}}" class="guanli">个人资料管理</a>
            <a href="{{URL('info-pwd')}}" class="pwd">修改交易密码</a>
            <a href="{{URL('info-tuijian')}}" class="tuijian-hover">推荐结构</a>
            <a href="{{URL('info-tuandui')}}" class="index">团队记录</a>
        </div>
        <div class="tuijianjiegou">
            @foreach($user as $e)
                <li>
                    @if(\App\Http\Controllers\InfoController::tuijiannum($e->id)>0)
                        <span id="id{{$e->id}}" class="more"><a onclick="getuser({{$e->id}},1)"></a><p onclick="getuser({{$e->id}},1)">
                    @else
                        <span><a></a><p class="no">
                    @endif
                        {{$e->user}} {{$e->name}} (团队人数：{{$e->totel}})  (一代) @if($e->station=='3')<font color="#ff0000">额度冻结</font> @endif</p>
                    </span>
                </li>
            @endforeach

        </div>
            {{$user->links()}}
    </div>
</div>
<script language="javascript" src="{{asset('js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

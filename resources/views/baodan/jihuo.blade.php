<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/city.js')}}" type="text/javascript"></script>
    <SCRIPT LANGUAGE=javascript>
        function del() {
            var msg = "确定激活该会员帐号吗？";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        }
        function closewin()
        {
            document.getElementById("mess").style.display="none";
        }
        function jihuo(id)
        {
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
                    document.getElementById("mess").style.display="block";
                    document.getElementById("mess").innerHTML=xmlHttp.responseText;
                }
            }
            var url="{{URL('jihuouser')}}/"+id;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);

        }

    </SCRIPT>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="main">首页</a> / <a>会员注册</a></div>
        <div class="b-nav">
            <a href="baodan-index" class="index">会员注册</a>
            <a href="baodan-jihuo" class="jihuo-hover">激活会员</a>
            <a href="baodan-jilu" class="jilu">激活记录</a>
            <a href="baodan-denglu" class="shenqing">登录记录</a>

        </div>
        <div class="e-content">

            <table width="887" style="text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#dededc" >
                    <td>序列号</td>
                    <td>会员帐号</td>
                    <td>姓名</td>
                    <td>注册时间</td>
                    <td>手机</td>
                    <td>激活状态</td>
                    <td>操作</td>
                </tr>
                @foreach($user as $e)
                    <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{{$count--}}</td>
                        <td>{{$e->user}}</td>
                        <td>{{$e->name}}</td>
                        <td>{{$e->shijian}}</td>
                        <td>{{$e->phone}}</td>
                        <td>
                            @if($e->station=="0")
                            <font color="#FF0000">未激活</font></td>
                            @else
                            已激活
                            @endif
                        </td>
                        <td>
                            @if($e->station=="0")
                                <a href='javascript:;' onclick='jihuo("{{$e->id}}")'>激活</a>
                            @else
                                <a href='javascript:;' onclick="alert('帐号已激活，无需重复操作！')"><font color="#00FF00">已激活</font></a>
                            @endif

                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="7">{{$user->links()}}</td>
                </tr>
            </table>



        </div>
    </div>
</div>
<script language="javascript" src="{{ asset('js/Validform_v5.3.2.js') }}"></script>
<div id="mess"></div>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

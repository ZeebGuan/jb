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
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="main">首页</a> / <a>会员注册</a></div>
        <div class="b-nav">
            <a href="baodan-index" class="index">会员注册</a>
            <a href="baodan-jihuo" class="jihuo">激活会员</a>
            <a href="baodan-jilu" class="jilu">激活记录</a>
            <a href="baodan-denglu" class="shenqing-hover">登录记录</a>
        </div>
        <div class="e-content">

            <table width="887" style="margin-top:20px; text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#dededc" >
                    <td>序列号</td>
                    <td>会员帐号</td>
                    <td>时间</td>
                    <td>地址</td>
                    <td>登陆类型</td>
                </tr>
                @foreach($jilu as $e)
                    <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{{$count--}}</td>
                        <td>{{$user}}</td>
                        <td>{{$e->shijian}}</td>
                        <td>{{$e->ip}}</td>
                        <td>
                            @if($e->station=='登录成功')
                                网页登录成功
                            @elseif($e->station=='非法登录')
                                <font color="#f00">非法登录</font>
                            @else
                                {{$e->station}}
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5">{{$jilu->links()}}</td>
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

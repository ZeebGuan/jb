<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript">
        function logout()
        {
            if (confirm("您确定要退出控制面板吗？"))
                top.location = "{{URL('5538830c29f8a8e4/logout')}}";
            return false;
        }
    </script>
    <script language="javascript" src="{{asset('admin/js/date.js')}}"></script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="top">
    <div class="con">
        <a href="javascript:;" onclick="logout();" class="logout">安全退出</a>
        <a href="/" class="logout index" target="_blank">网站首页</a>
        欢迎您 <b style="color:#f00">{{$admin}}</b><br />
        权限组：{{$power}}  【<span id="divT"></span>】<br />
        上一次登录时间：{{$shijian}}<br />
        上一次登录地址：{{$ip}}/{{$hostip}}<br />
    </div>
</div>
<div id="main">
    <div class="con">
        <p align="center" style="padding:150px 0px; font-size:28px; color:#f00;">欢迎登录本系统！</p>
        <p align="center"></p>
        <p align="right"></p>
    </div>
</div>
</body>
</html>

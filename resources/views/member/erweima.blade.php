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

</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="location"><a href="javascript:history.go(-1)">返回</a> / <a href="/main">首页</a> / <a>邀请二维码</a></div>
    <div class="er-notice">
        <div class="notice">
            <font size="+5">公众创益</font>
        </div>
        <div class="erweima-pic">
            <img src="http://qr.liantu.com/api.php?text={{URL('reg')}}/{{$tuijian}}" alt="邀请链接"/>
        </div>
        <div class="erweima-yaoqing">
            <span>我的专属邀请链接</span> {{URL('reg')}}/{{$tuijian}}
        </div>
    </div>
</div>
</body>
</html>

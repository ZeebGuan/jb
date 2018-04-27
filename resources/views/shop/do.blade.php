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
        <script language="javascript">
        var nn = 2;
        function num()
        {
            document.getElementById("nuber").innerHTML = nn;
            if(nn>0)nn --;
        }
        function SetNum()
        {
            setInterval("num()",1000);
        }
        function goto()
        {
            @if($urltype=='1')
            setTimeout(function(){window.history.go(-1)},3000);
            @else
            setTimeout(function(){window.location.href={{ $url }}},3000);
            @endif
        }
    </script>
</head>
<body onLoad="SetNum();">
@include('shop.top')
<div class="clear"></div>
<div id="content">
    <div class="content">
        <div class="nav">操作中心</div>
        <div class="fabu">
            <div class='mes'>
                <h1>{{ $msg }}</h1>
                @if($urltype=='1')
                    <span id='nuber'>2</span> 秒钟后自动返回登录... <br>如果没有自动返回，请点击这里  <a href="javascript:;" onclick="history.go(-1)">返回上一页</a>。
                @else
                    <span id='nuber'>2</span> 秒钟后自动返回登录... <br>如果没有自动返回，请点击这里  <a href="{{$url}}" >返回上一页</a>。
                @endif
                <script language="JavaScript">goto();</script>
            </div>";



        </div>
    </div>
</div>
<div class="clear"></div>
@include('shop.foot')
</body>
</html>


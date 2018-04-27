<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript">
        var nn = 2;
        function num()
        {
            document.getElementById("nuber").innerHTML = nn;
            if(nn>0){
                nn --;
            }
        }
        function SetNum()
        {
            setInterval("num()",1000);
        }
        function myrefresh(){
            window.location.href="{{$url}}";
        }
        setTimeout('myrefresh()',3000);
    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0"  onLoad="SetNum();">
<div id="main">
    <div class="user">
        <div class="bigTitleName">操作中心</div>
        <div class="smallEngTitleName">OPERATION CENTER</div>
        <div class="smallTitleBottomDiv"></div>
        <div class="user-search" style="height:350px;">
            <div class="title"><span></span></div>
            <div class='mes'>
                <h1>{{$msg}}</h1>
                @if($url=='javascript::go(-1)')
                <span id='nuber'>3</span> 秒钟后自动返回... 如果没有自动返回，请点击这里  <a href="javascript:;" onclick="history.back()">返回上一页</a>。
                @else
                <span id='nuber'>3</span> 秒钟后自动返回... 如果没有自动返回，请点击这里<a href="{{$url}}">返回上一页</a>。
                @endif
            </div>
        </div>
    </div>
</div>
</body>
</html>


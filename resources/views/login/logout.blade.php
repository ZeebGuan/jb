<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>退出登录成功</title>
    <link rel="stylesheet" media="screen" type="text/css" href="{{ asset('css/login.css') }}" />
    <script language="javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.js,jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script language="javascript">
        var nn = 2;
        function num()
        {
            document.getElementById("nuber").innerHTML = nn;
            if(nn>0){nn--}
        }
        function SetNum()
        {
            setInterval("num()",1000);
        }
        function goto()
        {
            setTimeout(function(){window.location.href="{{URL('login')}}"},3000);
        }
    </script>
    @if(\App\Http\Controllers\FunctionController::siteinfo('station')=="0")
        <script language=javascript>window.top.location.href='{{URL('update')}}';</script>";}
    @endif
</head>
<body onLoad="SetNum();">
<div id="login">
    <div class="login">
        <div class="mess">
				<div class='mes'>
				<h1>退出登录成功</h1>
				<span id='nuber'>2</span> 秒钟后自动返回登录... <br><br>如果没有自动返回，请点击这里  <a href="{{URL('login')}}">登录界面</a>。
				<script language="JavaScript">goto();</script>
				</div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $.backstretch([
        '{{ asset('/images/bg3.png') }}',
        '{{ asset('/images/bg5.png') }}',
        '{{ asset('/images/bg2.jpg') }}'
    ], {
        fade : 1000, // 动画时长
        duration : 2000 // 切换延时
    });
</script>

<script language="javascript" src="{{ asset('js/Validform_v5.3.2.js') }}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
        beforeSubmit:function(curform){
            document.onkeydown=function(event){
                e = event ? event :(window.event ? window.event : null);
                if(e.keyCode==13){
                    document.getElementById("loginform").submit();
                }
            }
        },
    });
</script>
</body>
</html>

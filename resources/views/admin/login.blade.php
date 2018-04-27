<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link href="{{asset('favicon.ico')}}" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" media="screen" type="text/css" href="{{ asset('css/login.css') }}" />
    <script language="javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.js,jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script type="text/jscript">
    function psw(el) {
            if (el.value == '请输入密码') {
                el.value = '';
                el.type = 'password';
            }
        }
        function txt(el) {
            if (!el.value) {
                el.type = 'text';
                el.value = '请输入密码';
            }
        }
    </script>
    <script language="javascript">
        var nn = 2;
        function num()
        {
            document.getElementById("nuber").innerHTML = nn;
            if(nn>0){nn --};
        }
        function SetNum()
        {
            setInterval("num()",1000);
        }
        function goto(url)
        {
            setTimeout(function(){window.location.href=url},3000);
        }
    </script>
    @if(\App\Http\Controllers\FunctionController::siteinfo('station')=="0")
        <script language=javascript>window.top.location.href='{{URL('update')}}';</script>";}
    @endif
</head>

<body onLoad="SetNum();">
<div id="login">
    <div class="login">
        <div class="top">
            <span>排产系统</span>
            <img src="{{asset('/images/login-logo.png')}}" width="45" height="45" alt=""/>&nbsp;梅州金滨金属
        </div>

            <div class="con">
                <div class="tips"><b>用户登录</b>LOGIN IN</div>
                <form name="loginform" id="loginform" class="form" method="post" action="{{ URL('jb_admin/logincheck') }}">
                    <li><span>用户名：</span><input type="text" name="user" class="text" value="请输入用户名" onfocus="if(this.value=='请输入用户名'){this.value='';}" onblur="if(this.value==''){this.value='请输入用户名';}" nullmsg="请输入用户名！" datatype="*" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </li>
                    <li><span>密&nbsp;&nbsp;&nbsp;码：</span>
                        <input type="text" autocomplete="off" name="pwd" id="pwd" value="请输入密码" onfocus="psw(this)" onblur="txt(this)" class="text" nullmsg="请输入密码！" datatype="*" />
                    </li>
                    <li><span>验证码：</span>
                        <input type="text" maxlength="4" nullmsg="请输入验证码！" errormsg="请输入验证码！" datatype="*" name="code" class="code" value="请输入验证码" onfocus="if(this.value=='请输入验证码'){this.value='';}" onblur="if(this.value==''){this.value='请输入验证码';}" ajaxurl="{{ URL('checkcode') }}" />
                        <img class="imgcode" title="点击刷新" src="{{ URL('codenum') }}" onclick="this.src='{{ URL('codenum') }}?'+Math.random();">
                    </li>
                    <li class="nobg"><input type="submit" value="登 录" class="sub" /></li>
                </form>

            </div>


    </div>
</div>
<script type="text/javascript">
    $.backstretch([
        '{{ asset('/images/jloginbg04.jpg') }}'
    ], {
        fade : 1000, // 动画时长
        duration : 2000 // 切换延时
    });
</script>

<script language="javascript" src="{{ asset('js/Validform_v5.3.2.js') }}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:1,
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}" />
    <script type="javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js,jquery.backstretch.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script>
        function psw(el) {
            if (el.value == '请输入新密码') {
                el.value = '';
                el.type = 'password';
            }
        }
        function txt(el) {
            if (!el.value) {
                el.type = 'text';
                el.value = '请输入新密码';
            }
        }
        function getmessage()
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
            var phone=document.getElementById("phone").value;
            if(phone!="")
            {
                xmlHttp.onreadystatechange=function()
                {
                    if(xmlHttp.readyState==4)
                    {
                        document.getElementById("get").innerHTML=xmlHttp.responseText;
                    }
                }
                var url="{{URL('phonecode')}}/"+phone;
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
            }
            else
            {
                alert("请输入手机号码");
            }
        }
    </script>
    @if(\App\Http\Controllers\FunctionController::siteinfo('station')=="0")
        <script language=javascript>window.top.location.href='{{URL('update')}}';</script>";}
    @endif
</head>

<body>
<div id="login">
    <div class="login">
        <div class="top"></div>
        <div class="con">
            <form class="resetform" method="post" action="{{URL('checkresetpwd')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <li><input type="text" class="text" name="phone" id="phone" value="请输入手机号码" onfocus="if(this.value=='请输入手机号码'){this.value='';}" onblur="if(this.value==''){this.value='请输入手机号码';}" nullmsg="请输入手机号码！" nullmsg="请输入手机号码！" datatype="m"  ajaxurl="{{ URL('checkuser') }}" /></li>
                <li><input type="text" class="text" name="pwd" value="请输入新密码" onfocus="psw(this)" onblur="txt(this)" class="text" nullmsg="请输入新密码！"  errormsg="密码为6-16位字符，包含数字和字母"  datatype="/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/" ajaxurl="{{URL('checkpwdlen')}}"  /></li>
                <li><input type="text" nullmsg="请输入验证码！" errormsg="请输入6位字符验证码！" datatype="*6-6" name="code" class="code" value="请输入验证码" onfocus="if(this.value=='请输入验证码'){this.value='';}" onblur="if(this.value==''){this.value='请输入验证码';}" ajaxurl="{{ URL('checkphonecode') }}" />
                    <input type="button" class="get" name="btn" id="btn" value="获取手机验证码"/>
                    <div class="Validform_checktip" id="get"></div>

                </li>

                <li><input type="submit" value="更新" class="sub" /></li>
                <li><a href="{{ URL('login') }}">登录</a><span></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ URL('reg') }}">注册</a></li>
            </form>
        </div>
    </div>
</div>

<script language="javascript" src="{{ asset('js/Validform_v5.3.2.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $(".resetform").Validform({
            tiptype:3,
        });
    })
</script>

<script type="text/javascript">
    var wait=60;
    function time(o)
    {
        if (wait == 0) {
            o.removeAttribute("disabled");
            o.value="免费获取验证码";
            wait = 60;
            document.getElementById("btn").style.backgroundColor="#0099FF";
        }
        else
        {
            o.setAttribute("disabled", true);
            o.value="重新发送(" + wait + ")";
            wait--;
            setTimeout(function() {
                        time(o)
                    },
                    1000)
        }
    }
    document.getElementById("btn").onclick=function()
    {
        if(document.getElementById("phone").value!="" && document.getElementById("phone").value!="请输入手机号码" )
        {
            time(this);
            getmessage();
            document.getElementById("btn").style.backgroundColor="#ccc";
        }
        else
        {
            alert("请输入手机号码！");
        }

    }
</script>
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
</body>
</html>
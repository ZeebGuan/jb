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
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>邮件中心</a> / 写邮件</div>
        <div class="e-nav">
            <a href="{{URL('email')}}" class="shou">收件箱</a>
            <a href="{{URL('email-post')}}" class="fa">发件箱</a>
            <a href="{{URL('email-write')}}" class="xie-hover">写邮件</a>
        </div>
        <div class="e-con">
            <form class="form" method="post" action="{{URL('do/emailwrite')}}">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="240" align="right">收件人：</td>
                        <td>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <input type="text" name="user" value="" class="text"  nullmsg="请输入帐号/手机号码！" datatype="*" ajaxurl="{{URL('checkuser')}}"/></td>
                    </tr>
                    <tr>
                        <td align="right">主题：</td>
                        <td><input type="text" name="title" value="" class="text" nullmsg="请输入主题！" datatype="*" />

                        </td>
                    </tr>
                    <tr>
                        <td align="right">内容：</td>
                        <td><textarea id="content" name="content" style="width:500px; height:300px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr color="#999999" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td>
                            <input type="submit" class="sub" value="发送邮件" />
                            <input type="button" value="返回上页" class="but" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">var ue = UE.getEditor('content');</script>
<script language="javascript" src="{{asset('js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

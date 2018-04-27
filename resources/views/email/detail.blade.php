<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>邮件中心</a> / 邮件详情</div>
        <div class="e-nav">
            <a href="{{URL('email')}}" class="shou{{$shoucss}}">收件箱</a>
            <a href="{{URL('email-post')}}" class="fa{{$facss}}">发件箱</a>
            <a href="{{URL('email-write')}}" class="xie">写邮件</a>
        </div>
        <div class="e-content">
            <table width="887" style="margin-top:20px; text-align:left; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="200" align="right">发件人：</td>
                    <td>{{$fa}}</td>
                </tr>
                <tr>
                    <td align="right">收件人：</td>
                    <td>{{$shou}}</td>
                </tr>
                <tr>
                    <td align="right">时间：</td>
                    <td>{{$email[0]->shijian}}</td>
                </tr>
                <tr>
                    <td align="right">标题：</td>
                    <td>{{$email[0]->title}}</td>
                </tr>
                <tr>
                    <td align="right" valign="top">邮件内容：</td>
                    <td>{!! $email[0]->content !!}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><br /><br /><input type="button" onclick="javascript:history.go(-1)" value="返回上页" class="but" />
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>

</body>
</html>

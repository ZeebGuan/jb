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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="main">首页</a> / <a>匹配中心</a> / 排单币转让记录</div>
        <div class="info-nav">
            <a href="{{URL('paidanbi')}}" class="index">转让排单币</a>
            <a href="{{URL('paidanbi-zhuanrang')}}" class="guanli-hover">转让记录</a>
            <a href="{{URL('paidanbi-jieshou')}}" class="pwd">接收记录</a>
        </div>
        <div class="e-content">

            <table width="887" style="margin-top:20px; text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#dededc" >
                    <td>序列号</td>
                    <td>会员账户</td>
                    <td>接收会员账户</td>
                    <td>排单币数量</td>
                    <td>时间</td>
                </tr>
                @foreach($jilu as $e)
                    <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{{$count--}}</td>
                        <td>{{$user}}</td>
                        <td>{{$e->user}}</td>
                        <td>{{$e->num}}</td>
                        <td>{{$e->shijian}}</td>
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

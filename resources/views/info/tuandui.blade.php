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
    <script language="javascript" type="text/javascript" src="{{asset('rili/WdatePicker.js')}}"></script>
    <script type="text/javascript">
        function sousuo(){
            var url="{{URL('info-index')}}/"+document.getElementById('keywords').value;
            window.location.href=url;
        }
    </script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')


<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>个人信息</a> / 团队记录</div>
        <div class="info-nav">
            <a href="{{URL('info-index')}}" class="index">我的激活码</a>
            <a href="{{URL('info-guanli')}}" class="guanli">个人资料管理</a>
            <a href="{{URL('info-pwd')}}" class="pwd">修改交易密码</a>
            <a href="{{URL('info-tuijian')}}" class="tuijian">推荐结构</a>
            <a href="{{URL('info-tuandui')}}" class="index-hover">团队记录</a>
        </div>
        <div class="e-content">

            <table width="895" style="text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#dededc" >
                    <td>序号</td>
                    <td>会员账户</td>
                    <td>会员姓名</td>
                    <td>时间</td>
                    <td>备注</td>
                </tr>
                @foreach($tuandui as $e)
                    <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{{$count--}}</td>
                        <td>{{$e->user}}</td>
                        <td>{{$e->name}}</td>
                        <td>{{$e->shijian}}</td>
                        <td>{{$e->beizhu}}</td>
                    </tr>
                   
                @endforeach
                <tr>
                    <td colspan="5">{{$tuandui->links()}}</td>
                </tr>
            </table>

        </div>

    </div>
</div>
<script language="javascript" src="{{asset('js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

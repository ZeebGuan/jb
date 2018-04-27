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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>理财钱包</a> / 理财转换记录</div>
        <div class="info-nav">
            <a href="{{URL('licai-zhuanhuan')}}" class="index">负数钱包转换</a>
            <a href="{{URL('licai-allzhuanhuan')}}" class="pwd">系统负数转换</a>
            <a href="{{URL('licai-jinbi')}}" class="award" style="margin-right: 5px;">金币理财转换</a>
            <a href="{{URL('licai-zhuanhuanjilu')}}" class="guanli-hover">理财转换记录</a>
            <a href="{{URL('licai-yinbi')}}" class="tuijian">银币天使转换</a>
        </div>
        <div class="e-content">
                <table width="887" style="text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc" >
                        <td>序列号</td>
                        <td>会员帐号</td>
                        <td>金额</td>
                        <td>时间</td>
                        <td>类型</td>
                    </tr>
                    @foreach($order as $e)
                        <tr>
                            <td>{{$count--}}</td>
                            <td>{{$user}}</td>
                            <td>{{$e->jine}}</td>
                            <td>{{$e->shijian}}</td>
                            <td>
                                @if($e->type==0)
                                    负数钱包转换
                                @elseif($e->type==1)
                                    系统负数转换
                                @else
                                    金币转换
                                @endif
                            </td>

                        </tr>

                    @endforeach
                    <tr>
                        <td colspan="5">{{$order->links()}}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>

</body>
</html>

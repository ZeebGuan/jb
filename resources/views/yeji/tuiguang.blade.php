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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>业绩薪酬</a> / 推广工资</div>
        <div class="info-nav">
            <a href="{{URL('jiangjin-index')}}" class="index">负数分红</a>
            <a href="{{URL('jiangjin-licai')}}" class="pwd">理财分红</a>
            <a href="{{URL('jiangjin-jiedong')}}" class="guanli">解冻记录</a>
            <a href="{{URL('jiangjin-zhitui')}}" class="tuijian">直推动态</a>
            <a href="{{URL('jiangjin-tuiguang')}}" class="award-hover">工资奖励</a>
        </div>
        <div class="e-content">
                <table width="887" style="text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc" >
                        <td>序列号</td>
                        <td>订单号</td>
                        <td>周期</td>
                        <td>金额</td>
                        <td>会员帐号</td>
                        <td>生成时间</td>
                        <td>备注</td>
                    </tr>
                    @foreach($order as $e)
                        <tr>
                            <td>{{$count--}}</td>
                            <td>{{$e->orderid}}</td>
                            <td>
                                @if($e->typeid=='1')<font color="#FF0000">15天</font>
                                @elseif($e->typeid=='2')<font color="#FF0000">30天</font>
                                @elseif($e->typeid=='3')<font color="#FF0000">60天</font>
                                @else<font color="#FF0000">90天</font>
                                @endif
                            </td>
                            <td><font color="#FF0000">{{$e->jine}}</font></td>
                            <td>{{$e->user}}</td>
                            <td>{{$e->shijian}}</td>
                            <td>{{$e->beizhu}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">{{$order->links()}}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>

</body>
</html>

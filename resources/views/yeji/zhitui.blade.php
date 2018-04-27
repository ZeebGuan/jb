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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>业绩薪酬</a> / 直推动态</div>
        <div class="info-nav">
            <a href="{{URL('jiangjin-index')}}" class="index">负数分红</a>
            <a href="{{URL('jiangjin-licai')}}" class="pwd">理财分红</a>
            <a href="{{URL('jiangjin-jiedong')}}" class="guanli">解冻记录</a>
            <a href="{{URL('jiangjin-zhitui')}}" class="tuijian-hover">直推动态</a>
            <a href="{{URL('jiangjin-tuiguang')}}" class="award">工资奖励</a>
        </div>
        <div class="e-content">
                <table width="887" style="text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc" >
                        <td width="50">序号</td>
                        <td width="80">会员账号</td>
                        <td>真实姓名</td>
                        <td width="180">订单号</td>
                        <td>冻结时间</td>
                        <td>订单金额</td>
                        <td>订单状态</td>
                        <td>周期</td>
                        <td>类型</td>
                    </tr>

                    @foreach($order as $e)
                        <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{{$count--}}</td>
                            <td>{{$e->user}}</td>
                            <td>{{$e->name}}</td>
                            <td>{{$e->orderid}}</td>
                            <td>
                                @if($e->djshijian=='')
                                    未冻结
                                @else
                                    {{$e->djshijian}}
                                @endif
                            </td>
                            <td>{{$e->jine}}</td>
                            @if($e->station=="0")
                                <td><font color="#000000">排队中</font></td>
                            @elseif($e->station=="1")
                                <td><font color="#FF0000">匹配中</font></td>
                            @elseif($e->station=="2")
                                @if($e->paystation=="0")
                                    <td><font color="#FF0000">付款中</font></td>
                                @else
                                    <td><font color="#0000FF">已付款,待确认</font></td>
                                @endif
                            @elseif($e->station=="3")
                                <td><font color="#0000ff">未付款</font></td>
                            @elseif($e->station=="4")
                                <td><font color="#00ff00">冻结期</font></td>
                            @elseif($e->station=="5")
                                <td><font color="#FF0000">已完成</font></td>
                            @elseif($e->station=="6")
                            <td><font color="#FF0000">作废</font></td>
                            @elseif($e->station=="7")
                                <td><font color="#FF0000">拒绝付款</font></td>"
                            @elseif($e->station=="8")
                                <td><font color="#FF0000">冻结中</font></td>"
                            @endif
                            <td>@if($e->typeid=='1')<font color="#FF0000">15天</font>
                                @elseif($e->typeid=='2')<font color="#FF0000">30天</font>
                                @elseif($e->typeid=='3')<font color="#FF0000">60天</font>
                                @else<font color="#FF0000">90天</font>
                                @endif
                            </td>

                            @if($e->type=="1")
                                <td><font color='#ff0000'>众筹参与</font></td>
                            @else
                                <td><font color='#0000ff'>众筹红利</font></td>
                            @endif

                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="9">{!! $order->links() !!}</td>
                    </tr>
                </table>
        </div>
    </div>
</div>

</body>
</html>

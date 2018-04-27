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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>业绩薪酬</a> / 解冻记录</div>
        <div class="info-nav">
            <a href="{{URL('jiangjin-index')}}" class="index">负数分红</a>
            <a href="{{URL('jiangjin-licai')}}" class="pwd">理财分红</a>
            <a href="{{URL('jiangjin-jiedong')}}" class="guanli-hover">解冻记录</a>
            <a href="{{URL('jiangjin-zhitui')}}" class="tuijian">直推动态</a>
            <a href="{{URL('jiangjin-tuiguang')}}" class="award">工资奖励</a>
        </div>
        <div class="e-content">
                <table width="887" style="text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc" >
                        <td width="80">序号</td>
                        <td width="180">订单号</td>
                        <td width="80">金额</td>
                        <td>下单时间</td>
                        <td>冻结日期</td>
                        <td>解冻日期</td>
                        <td>周期</td>
                    </tr>

                    @foreach($order as $e)
                        <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{{$count--}}</td>
                            <td>{{$e->orderid}}</td>
                            <td>{{$e->jine}}</td>
                            <td>{{$e->shijian}}</td>
                            <td>{{$e->djshijian}}</td>
                            @if($e->cjshijian=="" || $e->cjshijian=="0000-00-00 00:00:00")
                                <td>未解冻</td>
                            @else
                                <td>{{$e->cjshijian}}</td>
                            @endif
                            <td>
                                @if($e->typeid=='1')15天
                                @elseif($e->typeid=='2')30天
                                @elseif($e->typeid=='3')60天
                                @elseif($e->typeid=='4')90天
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="8">{!! $order->links() !!}


                        </td>
                    </tr>
                </table>
        </div>
    </div>
</div>

</body>
</html>

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
    <script src="{{asset('js/jquery-1.4.4.min.js')}}" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
        var interval = 1000;
        function ShowCountDown(year,month,day,h,i,s,divname)
        {
            var now = new Date();
            var endDate = new Date(year, month-1,day,h,i,s);
            var leftTime=endDate.getTime()-now.getTime();
            var leftsecond = parseInt(leftTime/1000);
            var day1=Math.floor(leftsecond/(60*60*24));
            var hour=Math.floor((leftsecond-day1*24*60*60)/3600);
            var minute=Math.floor((leftsecond-day1*24*60*60-hour*3600)/60);
            var second=Math.floor(leftsecond-day1*24*60*60-hour*3600-minute*60);
            var cc = document.getElementById(divname);
            hour=((hour < 10) ? "0":"")+hour;
            minute=((minute < 10) ? "0":"")+minute;
            second=((second < 10) ? "0":"")+second;
            cc.innerHTML =hour+":"+minute+":"+second;
        }
        window.setInterval(function(){
            @foreach($order as $t)
                @if($t->station=='2')
                    ShowCountDown({{date('Y,m,d,H,i,s',strtotime($t->shijian.'+22 hour'))}},'divdown{{$t->id}}');
                @endif
            @endforeach
        }, interval);

    </script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="main">首页</a> / <a>匹配记录</a></div>
        <div class="info-nav">
            <a href="{{URL('pipei-tigong')}}" class="index">众筹参与</a>
            <a href="{{URL('pipei-qingqiu')}}" class="guanli">众筹红利</a>
            <a href="{{URL('pipei-bangzhu')}}" class="pwd{{$css1}}">参与记录</a>
            <a href="{{URL('pipei-qiuzhu')}}" class="tuijian{{$css2}}">红利记录</a>
            <a href="{{URL('pipei-qianbao')}}" class="index">钱包明细</a>
        </div>
        <div class="e-content">
            <table width="887" style="text-align:left; line-height:36px; margin-top:-35px; margin-bottom:5px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#ff0000">下单时间：<b>{{$offer[0]->shijian}}</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            订单总金额：<b>{{$offer[0]->jine}}</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            剩余金额： <b>{{$offer[0]->shengyu}}</b>&nbsp;&nbsp;&nbsp;&nbsp;
                            匹配人数： <b>{{$offer[0]->renshu}}</b> </font></td>
                    <td width="100" align="center" bgcolor="#999999"><a href="javascript:history.go(-1)"><font color="#ffffff">返回上一页</font></a></td>

                </tr>
            </table>
            <table width="887" style="text-align:center; line-height:36px; margin-left:3px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor='#dededc' >
                    <td>@if($do=='1')众筹红利单号@else众筹参与订单号@endif</td>
                    <td>会员帐号</td>
                    <td>会员电话</td>
                    <td>匹配金额</td>
                    <td>匹配时间</td>
                    <td>订单状态</td>
                    <td>倒计时</td>
                    <td>操作</td>
                </tr>
                @foreach($order as $e)
                <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                    @if($do=='1')
                        <td>{{$e->orderid}}</td>
                        <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->orderid,'user')}}</td>
                        <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->orderid,'phone')}}</td>
                    @else
                        <td>{{$e->pipeiid}}</td>
                        <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->pipeiid,'user')}}</td>
                        <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->pipeiid,'phone')}}</td>
                    @endif
                    <td>{{$e->jine}}</td>
                    <td>{{$e->shijian}}</td>
                    <td>
                        @if($do=='1')
                            @if($e->station=="0")<font color="#000000">排队中</font>
                            @elseif($e->station=="1")<font color="#FF0000">匹配中</font>
                            @elseif($e->station=="2")
                                @if($e->paystation=="0")
                                    <font color="#FF0000">付款中</font>
                                @else
                                    <font color="#FF0000">已付款</font>
                                @endif
                            @elseif($e->station=="3")
                                <font color="#0000ff">未付款</font>
                            @elseif($e->station=="4")
                                <font color="#00ff00">冻结期</font>
                            @elseif($e->station=="5")
                                <font color="#FF0000">已完成</font>
                            @elseif($e->station=="6")
                                <font color="#FF0000">作废</font>
                            @elseif($e->station=="7")
                                <font color="#FF0000">拒绝付款</font>
                            @endif
                        @else
                            @if($e->paystation=="0")
                                <font color="#000000">未付款</font>
                            @elseif($e->paystation=="1")
                                <font color="#0000ff">已付款，请确认</font>
                            @elseif($e->paystation=="2")
                                <font color="#FF0000">已收款</font>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($e->station=="2")
                            @if(date("Y-m-d H:i:s")<date("Y-m-d H:i:s",strtotime($e->shijian.'+22 hour')))
                            <font color="#ff0000"><span id='divdown{{$e->id}}'>00:00:00</span></font>
                            @else
                            <font color=#000000">00:00:00</font>
                            @endif
                        @else
                            <font color=#666666">00:00:00</font>
                        @endif
                    </td>
                    <td>
                        <a href='{{URL('pipei-info/'.$do.'/'.$id.'/'.$e->id.'/order')}}'><font color="#00ff00">进入</font></a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8">{{$order->links()}}</td>
                </tr>
            </table>
        </div>



    </div>


</div>
<script type="text/javascript">
    $("#chk_noall").click(function() {
        $("input[name='groupid[]']").each(function(idx, item) {
            $(item).attr("checked", !$(item).attr("checked"));
        })
    });
</script>
<script type="text/javascript">
    function action(){
        document.getElementById('form2').submit();
    }
</script>
</body>
</html>

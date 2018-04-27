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
        $("#chk_noall").click(function() {
            $("input[name='groupid[]']").each(function(idx, item) {
                $(item).attr("checked", !$(item).attr("checked"));
            })
        });
        function sousuo(){
            var url="{{URL('pipei-bangzhu')}}/"+document.getElementById('keywords').value;
            window.location.href=url;
        }
    </script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>匹配中心</a> / <a>钱包明细</a></div>
        <div class="info-nav">
            <a href="{{URL('pipei-tigong')}}" class="index">众筹参与</a>
            <a href="{{URL('pipei-qingqiu')}}" class="guanli">众筹红利</a>
            <a href="{{URL('pipei-bangzhu')}}" class="pwd">参与记录</a>
            <a href="{{URL('pipei-qiuzhu')}}" class="tuijian">红利记录</a>
            <a href="{{URL('pipei-qianbao')}}" class="index-hover">钱包明细</a>
        </div>
        <div class="info-content">
            <div class="info-content-nav" style="background: none;">
                <a href="{{URL('pipei-qianbao')}}?type=2"  @if($type=='2')  class="hover" @endif>本金钱包明细</a>
                <a href="{{URL('pipei-qianbao')}}?type=3"  @if($type=='3')  class="hover" @endif>红利钱包明细</a>
                <a href="{{URL('pipei-qianbao')}}?type=4"  @if($type=='4')  class="hover" @endif>众购钱包明细</a>
                <a href="{{URL('pipei-qianbao')}}?type=1"  @if($type=='1')  class="hover" @endif>天使资本明细</a>
            </div>
                <table width="875" style="margin-top:55px;line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc">
                        <td width="40">序号</td>
                        <td>操作前金额</td>
                        <td>金额</td>
                        <td>操作后金额</td>
                        <td>时间</td>
                        <td>备注</td>
                    </tr>
                    @foreach($offer as $offers)
                    <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{{$count--}}</td>
                            <td>{{ $offers->oldnum }}</td>
                            <td>
                                @if($offers->nownum<$offers->oldnum)
                                    <font color="#0000ff">{{ $offers->num }}</font>
                                @else
                                    <font color="#ff0000">{{ $offers->num }}</font>
                                @endif
                            </td>
                            <td>{{ $offers->nownum }}</td>
                            <td>{{ $offers->shijian }}</td>
                            <td>
                                @if($offers->nownum<$offers->oldnum)
                                    <font color="#0000ff">{{ $offers->beizhu }}</font>
                                @else
                                    <font color="#ff0000">{{ $offers->beizhu }}</font>
                                @endif
                            </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="10">{{$offer->appends(['type'=>$type])->links()}}</td>
                    </tr>
                    <tr>
                        <td colspan="10" align="left">&nbsp;&nbsp;<font color="#ff0000">* 只显示30天内的钱包明细</font> </td>
                    </tr>
                </table>

        </div>
    </div>
</div>
</body>
</html>

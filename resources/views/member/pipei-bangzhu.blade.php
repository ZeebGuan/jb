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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>众筹参与</a></div>
        <div class="info-nav">
            <a href="{{URL('pipei-tigong')}}" class="index">众筹参与</a>
            <a href="{{URL('pipei-qingqiu')}}" class="guanli">众筹红利</a>
            <a href="{{URL('pipei-bangzhu')}}" class="pwd-hover">参与记录</a>
            <a href="{{URL('pipei-qiuzhu')}}" class="tuijian">红利记录</a>
            <a href="{{URL('pipei-qianbao')}}" class="index">钱包明细</a>
        </div>
        <div class="info-content">
                <table width="875" style="margin-top:20px;line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc">
                        <td width="40">选择</td>
                        <td width="180">单号</td>
                        <td>金额</td>
                        <td>剩余金额</td>
                        <td>人数</td>
                        <td width="160">冻结时间</td>
                        <td width="160">匹配时间</td>
                        <td>状态</td>
                        <td>周期</td>
                        <td>操作</td>
                    </tr>
                    @foreach($offer as $offers)
                    <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td><input type="checkbox" value="{{ $offers->id }}" name="groupid[]" /></td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($offers->orderid,$keywords,$color = "red") !!}</td>
                            <td>{{ $offers->jine }}</td>
                            <td>{{ $offers->shengyu }}</td>
                            <td>{{ $offers->renshu }}</td>
                            <td>@if($offers->djshijian=='')未匹配@elseif($offers->djshijian=='0000-00-00 00:00:00')未匹配@else{{$offers->djshijian}}@endif</td>
                            <td>@if($offers->ppshijian=='')未匹配@elseif($offers->ppshijian=='0000-00-00 00:00:00')未匹配@else{{$offers->ppshijian}}@endif</td>
                            <td>@if($offers->station=='0')
                                    <font color="#000000">排队中</font>
                                @elseif($offers->station=='1')<font color="#FF0000">匹配中</font>
                                @elseif($offers->station=='2')
                                    @if($offers->paystation=='0')
                                        <font color="#FF0000">付款中</font>
                                    @else
                                        <font color="#FF0000">已付款</font>
                                    @endif
                                @elseif($offers->station=='3')
                                    <font color="#0000ff">未付款</font>
                                @elseif($offers->station=='4')
                                    <font color="#00ff00">冻结期</font>
                                @elseif($offers->station=='5')
                                    <font color="#FF0000">已完成</font>
                                @elseif($offers->station=='6')
                                    <font color="#FF0000">作废</font>
                                @elseif($offers->station=='8')
                                    <font color="#FF0000">已冻结</font>
                                @else
                                    其他
                                @endif
                            </td>
                            <td>@if($offers->typeid=='1')<font color="#FF0000">15天</font>
                                @elseif($offers->typeid=='2')<font color="#FF0000">30天</font>
                                @elseif($offers->typeid=='3')<font color="#FF0000">60天</font>
                                @else<font color="#FF0000">90天</font>
                                @endif
                            </td>
                            <td><a href="{{URL('pipei-jilu')}}/1/{{$offers->orderid}}/{{$offers->id}}"> <font color=#00ff00>查看</font></a></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="10">{{$fenye->links()}}</td>
                    </tr>
                </table>

        </div>
    </div>
</div>
<script language="javascript" src="js/Validform_v5.3.2.js"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
        beforeSubmit:function(curform){
            $.ajax({
                type: "POST",
                url: "ajax/checkpaidanbi.php",//请求的后台地址
                data: "jine="+document.getElementById("jine").values,//前台传给后台的参数
                success: function(msg){//msg:返回值
                    if(msg=="0"){alert("排单币数量不足!");return false;}
                }
            });

            //这里明确return false的话表单将不会提交;
        },
    });
</script>
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

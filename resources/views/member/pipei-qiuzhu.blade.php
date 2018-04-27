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
            var url="{{URL('pipei-qiuzhu')}}/"+document.getElementById('keywords').value;
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
            <a href="{{URL('pipei-bangzhu')}}" class="pwd">参与记录</a>
            <a href="{{URL('pipei-qiuzhu')}}" class="tuijian-hover">红利记录</a>
            <a href="{{URL('pipei-qianbao')}}" class="index">钱包明细</a>
        </div>
            <div class="info-content" style="padding-bottom:30px;">
                    <table width="887" style="height: 16px; overflow: hidden; padding: 0px; margin: 0px;" align="center" bgcolor="#dededc" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="padding: 0px;" width="50"><span id="chk_noall" name="chk_noall" class="xuan" style="cursor:pointer; ">全选</span></td>
                            <td width="610" align="right" style="padding: 0px;">订单号搜索：</td>
                            <td width="153" style="padding: 0px;">
                                <input type="text" name="keywords" id="keywords"  class="text" value="{{$keywords}}"  />
                                <input type="button" class="sub" value="" onclick="sousuo()" />
                            </td>
                        </tr>
                    </table>
                <table width="875" style="margin-top:20px;line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                        <tr bgcolor="#dededc" >
                            <td width="40">选择</td>
                            <td width="180">单号</td>
                            <td>金额</td>
                            <td>剩余金额</td>
                            <td>人数</td>
                            <td>下单时间</td>
                            <td>匹配时间</td>
                            <td>状态</td>
                            <td>操作</td>
                        </tr>

                        @foreach($offer as $offers)
                            <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td width="40"><input type="checkbox" value="{{ $offers->id }}" name="groupid[]" /></td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($offers->orderid,$keywords,$color = "red") !!}</td>
                                <td>{{ $offers->jine }}</td>
                                <td>{{ $offers->shengyu }}</td>
                                <td>{{ $offers->renshu }}</td>
                                <td>{{ $offers->shijian }}</td>
                                <td>
                                    @if($offers->ppshijian=='')
                                        未匹配
                                    @elseif($offers->ppshijian=='0000-00-00 00:00:00')
                                        未匹配
                                    @else
                                        {{$offers->ppshijian}}
                                    @endif
                                </td>
                                <td>
                                    @if($offers->station=='0')
                                        <font color="#000000">排队中</font>
                                    @elseif($offers->station=='1')
                                        <font color="#FF0000">匹配中</font>
                                    @elseif($offers->station=='2')
                                        <font color="#FF0000">付款中</font>
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
                                <td>
                                    <a href="{{URL('pipei-jilu')}}/2/{{$offers->orderid}}/{{$offers->id}}"> <font color=#00ff00>查看</font></a>

                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9">{{$fenye->links()}}</td>
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

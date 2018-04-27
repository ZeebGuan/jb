<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('5538830c29f8a8e4/offer/'.$do)}}?type={{$type}}&user={{$user}}&jine={{$jine}}&orderid={{$orderid}}&start={{$start}}&end={{$end}}&start1={{$start1}}&end1={{$end1}}&station={{$station}}&paixu={{$paixu}}&id={{$id}}&zhouqi={{$zhouqi}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }

        }
        function queren(msg)
        {
            if(!confirm(msg))
            {
                window.event.returnValue = false;
            }
        }
        function editorder(id)
        {
            var xmlHttp;
            try
            {
                xmlHttp=new XMLHttpRequest();
            }
            catch (e)
            {
                try
                {
                    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch (e)
                {
                    try
                    {
                        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    catch (e)
                    {
                        alert("您的浏览器不支持AJAX！");
                        return false;
                    }
                }
            }
            document.getElementById("chuli").style.display='block'
            xmlHttp.onreadystatechange=function()
            {
                if(xmlHttp.readyState==4)
                {
                    document.getElementById("chuli").style.display="block";
                    document.getElementById("chuli").innerHTML=xmlHttp.responseText;
                }
            }
            var url="{{URL('orderinfo')}}/"+id;
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);

        }
    </script>
    @if($do=='jilu')
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

            @foreach($data as $e)
                @if($e->station=='2')
                    ShowCountDown({{date("Y,m,d,H,i,s",strtotime("$e->shijian +1 day"))}},'divdown{{$e->id}}');
                @endif
            @endforeach
        }, interval);
    </script>
    @endif
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    @if($do=='list')
    <div class="user">
        <div class="title"><span></span>@if($type=='1')帮助记录@else求助记录@endif</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/list')}}">
                <input type="hidden" name="type" value="{{$type}}" />
                &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                订单号：<input type="text" name="orderid" class="text" value="{{$orderid}}" />
                订单ID：<input type="text" name="id" class="text" value="{{$id}}" />
                订单状态：<select name="station" class="text">
                    @if($station=='0')<option value="0">排队中</option>
                    @elseif($station=='1')<option value="1">匹配中</option>
                    @elseif($station=='2')<option value="2">付款中</option>
                    @elseif($station=='3')<option value="3">未付款</option>
                    @elseif($station=='4')<option value="4">冻结期</option>
                    @elseif($station=='5')<option value="5">完成</option>
                    @elseif($station=='6')<option value="6">废单</option>
                    @elseif($station=='7')<option value="7">拒绝付款</option>
                    @elseif($station=='8')<option value="8">已付款</option>
                    @endif
                    <option value="">全部</option>
                    <option value="0">排队中</option>
                    <option value="1">匹配中</option>
                    <option value="2">付款中</option>
                    <option value="3">未付款</option>
                    <option value="4">冻结期</option>
                    <option value="5">完成</option>
                    <option value="6">废单</option>
                    <option value="7">拒绝付款</option>
                    <option value="8">已付款</option>
                </select>

                下单时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  /> <!-- 两个时间同时选择--><br />
                冻结时间：<input type="text" name="start1" value="{{$start1}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="end1" value="{{$end1}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  /> <!-- 两个时间同时选择-->
                &nbsp;排序方式：
                <select name="paixu" class="text">
                    @if($paixu=='ppshijian')
                        <option value="ppshijian">匹配时间</option>
                        <option value="shijian">下单时间</option>
                        <option value="djshijian">冻结时间</option>
                    @elseif($paixu=='djshijian')
                        <option value="djshijian">冻结时间</option>
                        <option value="shijian">下单时间</option>
                        <option value="ppshijian">匹配时间</option>
                    @else
                        <option value="shijian">下单时间</option>
                        <option value="ppshijian">匹配时间</option>
                        <option value="djshijian">冻结时间</option>
                    @endif
                </select>
                &nbsp;周期：
                <select name="zhouqi" class="text">
                    @if($zhouqi=='1')
                        <option value="1">15天</option>
                        <option value="">全部</option>
                        <option value="2">30天</option>
                        <option value="3">60天</option>
                        <option value="4">90天</option>
                    @elseif($zhouqi=='2')
                        <option value="2">30天</option>
                        <option value="">全部</option>
                        <option value="1">15天</option>
                        <option value="3">60天</option>
                        <option value="4">90天</option>
                    @elseif($zhouqi=='3')
                        <option value="3">60天</option>
                        <option value="">全部</option>
                        <option value="1">15天</option>
                        <option value="2">30天</option>
                        <option value="4">90天</option>
                    @elseif($zhouqi=='4')
                        <option value="4">90天</option>
                        <option value="">全部</option>
                        <option value="1">15天</option>
                        <option value="2">30天</option>
                        <option value="3">60天</option>
                    @else
                        <option value="">全部</option>
                        <option value="1">15天</option>
                        <option value="2">30天</option>
                        <option value="3">60天</option>
                        <option value="4">90天</option>
                    @endif
                </select>
                金额：<input type="text" name="jine" class="text" errormsg="金额只能输入数字" value="{{$jine}}" ignore="ignore" datatype="n" />
                <input type="submit" value="查找" class="button" />
                <a href="{{URL('5538830c29f8a8e4/offer/list')}}?type={{$type}}">清楚搜索条件</a>
                <a href="{{URL('execl/phonecode')}}">导出execl</a>
            </form>
        </div>

        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td >订单序号</td>
                    <td >订单号</td>
                    <td>金额</td>
                    <td>剩余金额</td>
                    <td>人数</td>
                    @if($type=='1')<td>周期</td> @endif
                    <td>会员帐号</td>
                    <td>真实姓名</td>
                    <td>下单时间</td>
                    <td>匹配时间</td>
                    <td>冻结时间</td>
                    <td>成交时间</td>
                    <td>状态</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->id,$id,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->orderid,$orderid,$color = "red") !!}</td>
                        <td>{!! $e->jine !!}</td>
                        <td>{!! $e->shengyu !!}</td>
                        <td>{!! $e->renshu !!}</td>
                        @if($type=='1')
                            <td>
                                @if($e->typeid=='1')15天
                                @elseif($e->typeid=='2')30天
                                @elseif($e->typeid=='3')60天
                                @elseif($e->typeid=='4')90天
                                @endif
                            </td>
                        @endif
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                        <td>{!! $e->shijian !!}</td>
                        <td>@if($e->ppshijian=='' || $e->ppshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font> @else{!! $e->ppshijian !!}@endif</td>
                        <td>@if($e->djshijian=='' || $e->djshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font>@else{!! $e->djshijian !!}@endif</td>
                        <td>@if($e->cjshijian=='' || $e->cjshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font> @else{!! $e->cjshijian !!}@endif</td>
                        <td>
                            @if($e->userstation=='2')
                                <font color="#ff0000">已被封号</font>
                            @else
                                @if($e->station=='0')<font color="#000000">排队中</font>
                                @elseif($e->station=='1')<font color="#FF0000">匹配中</font>
                                @elseif($e->station=='2')
                                    @if($e->paystation=='0')<font color="#FF0000">付款中</font>
                                    @else <font color="#FF0000">已付款</font>
                                    @endif
                                @elseif($e->station=='3')<font color="#0000ff">未付款</font>
                                @elseif($e->station=='4')<font color="#00ff00">冻结期</font>
                                @elseif($e->station=='5')<font color="#FF0000">已完成</font>
                                @elseif($e->station=='6')<font color="#FF0000">作废</font>
                                @elseif($e->station=='7')<font color="#FF0000">拒绝付款</font>
                                @endif
                            @endif
                        </td>
                        <td>
                            <a href="{{URL('5538830c29f8a8e4/offer/jilu')}}?id={{$e->id}}">查看</a>
                            @if($e->shengyu!='0.00')
                                    | <a href="{{URL('5538830c29f8a8e4/offer/shoudong')}}?type={{$type}}&id={{$e->id}}">手动匹配</a>
                            @endif

                            @if($e->jine==$e->shengyu && $e->renshu=='0')
                                    | <a href="{{URL('5538830c29f8a8e4/excsql/deloffer/'.$e->id)}}" onclick='delcfm()'>删除</a>
                            @endif

                            @if($e->shengyu=='0' && $e->renshu!='0' && $e->station!='5')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/wancheng/'.$e->id)}}" onclick='doorder()'>已完成</a>
                            @endif

                            @if($e->station=='2' && $e->type=='1' && $e->shengyu=='0' && $e->renshu!='0')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/dongjie/'.$e->id)}}" onclick='doorder()'>进入冻结</a>
                            @endif
                            @if($e->station!='5')
                                | <a href="javascript:;" onclick="editorder({{$e->id}})">修改</a>
                            @endif
                            @if($e->type=='1')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/fenghao/'.$e->userid)}}" onclick="queren('确定封号吗？')">封号</a>
                            @endif
                            @if($e->edustation=='0')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/eduhuanyuan/'.$e->id)}}" onclick="queren('确定还原订单额度吗？')">额度还原</a>
                            @endif
                            @if($e->jiangjinstation=='1' && $e->station=='4')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/jiangjinstation/'.$e->id)}}" onclick="queren('确定重置奖金吗？')">重置奖金</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                @if($type=='2' && $station=='1')
                    <tr>
                        <td colspan="13" style="font-size: 24px; padding: 20px 0px;">
                            总金额：<font color="#ff0000">{{$totel1}}</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            剩余金额：<font color="#ff0000">{{$totel2}}</font>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['type'=>$type,'zhouqi'=>$zhouqi,'user'=>$user,'orderid'=>$orderid,'id'=>$id,'station'=>$station,'start'=>$start,'end'=>$end,'start1'=>$start1,'end1'=>$end1,'paixu'=>$paixu,'jine'=>$jine])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>
    </div>
        @elseif($do=='old')
            <div class="user">
                <div class="title"><span></span>@if($type=='1')帮助记录@else求助记录@endif</div>
                <div class="user-search">
                    <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/old')}}">
                        <input type="hidden" name="type" value="{{$type}}" />
                        &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                        订单号：<input type="text" name="orderid" class="text" value="{{$orderid}}" />
                        订单ID：<input type="text" name="id" class="text" value="{{$id}}" />
                        订单状态：<select name="station" class="text">
                            @if($station=='0')<option value="0">排队中</option>
                            @elseif($station=='1')<option value="1">匹配中</option>
                            @elseif($station=='2')<option value="2">付款中</option>
                            @elseif($station=='3')<option value="3">未付款</option>
                            @elseif($station=='4')<option value="4">冻结期</option>
                            @elseif($station=='5')<option value="5">完成</option>
                            @elseif($station=='6')<option value="6">废单</option>
                            @elseif($station=='7')<option value="7">拒绝付款</option>
                            @elseif($station=='8')<option value="8">已付款</option>
                            @endif
                            <option value="">全部</option>
                            <option value="0">排队中</option>
                            <option value="1">匹配中</option>
                            <option value="2">付款中</option>
                            <option value="3">未付款</option>
                            <option value="4">冻结期</option>
                            <option value="5">完成</option>
                            <option value="6">废单</option>
                            <option value="7">拒绝付款</option>
                            <option value="8">已付款</option>
                        </select>

                        下单时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                        至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  /> <!-- 两个时间同时选择--><br />
                        冻结时间：<input type="text" name="start1" value="{{$start1}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                        至 &nbsp;<input type="text" name="end1" value="{{$end1}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  /> <!-- 两个时间同时选择-->
                        &nbsp;排序方式：
                        <select name="paixu" class="text">
                            @if($paixu=='ppshijian')
                                <option value="ppshijian">匹配时间</option>
                                <option value="shijian">下单时间</option>
                                <option value="djshijian">冻结时间</option>
                            @elseif($paixu=='djshijian')
                                <option value="djshijian">冻结时间</option>
                                <option value="shijian">下单时间</option>
                                <option value="ppshijian">匹配时间</option>
                            @else
                                <option value="shijian">下单时间</option>
                                <option value="ppshijian">匹配时间</option>
                                <option value="djshijian">冻结时间</option>
                            @endif
                        </select>
                        &nbsp;周期：
                        <select name="zhouqi" class="text">
                            @if($zhouqi=='1')
                                <option value="1">15天</option>
                                <option value="">全部</option>
                                <option value="2">30天</option>
                                <option value="3">60天</option>
                                <option value="4">90天</option>
                            @elseif($zhouqi=='2')
                                <option value="2">30天</option>
                                <option value="">全部</option>
                                <option value="1">15天</option>
                                <option value="3">60天</option>
                                <option value="4">90天</option>
                            @elseif($zhouqi=='3')
                                <option value="3">60天</option>
                                <option value="">全部</option>
                                <option value="1">15天</option>
                                <option value="2">30天</option>
                                <option value="4">90天</option>
                            @elseif($zhouqi=='4')
                                <option value="4">90天</option>
                                <option value="">全部</option>
                                <option value="1">15天</option>
                                <option value="2">30天</option>
                                <option value="3">60天</option>
                            @else
                                <option value="">全部</option>
                                <option value="1">15天</option>
                                <option value="2">30天</option>
                                <option value="3">60天</option>
                                <option value="4">90天</option>
                            @endif
                        </select>
                        金额：<input type="text" name="jine" class="text" errormsg="金额只能输入数字" value="{{$jine}}" ignore="ignore" datatype="n" />
                        <input type="submit" value="查找" class="button" />
                        <a href="{{URL('5538830c29f8a8e4/offer/old')}}?type={{$type}}">清楚搜索条件</a>
                        <a href="{{URL('execl/phonecode')}}">导出execl</a>
                    </form>
                </div>

                <div class="user-list">
                    <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                        <tr class="tr">
                            <td >订单序号</td>
                            <td >订单号</td>
                            <td>金额</td>
                            <td>剩余金额</td>
                            <td>人数</td>
                            @if($type=='1')<td>周期</td> @endif
                            <td>会员帐号</td>
                            <td>真实姓名</td>
                            <td>下单时间</td>
                            <td>匹配时间</td>
                            <td>冻结时间</td>
                            <td>成交时间</td>
                            <td>状态</td>
                            <td>操作</td>
                        </tr>
                        @foreach($data as $e)
                            <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->id,$id,$color = "red") !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->orderid,$orderid,$color = "red") !!}</td>
                                <td>{!! $e->jine !!}</td>
                                <td>{!! $e->shengyu !!}</td>
                                <td>{!! $e->renshu !!}</td>
                                @if($type=='1')
                                    <td>
                                        @if($e->typeid=='1')15天
                                        @elseif($e->typeid=='2')30天
                                        @elseif($e->typeid=='3')60天
                                        @elseif($e->typeid=='4')90天
                                        @endif
                                    </td>
                                @endif
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                                <td>{!! $e->shijian !!}</td>
                                <td>@if($e->ppshijian=='' || $e->ppshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font> @else{!! $e->ppshijian !!}@endif</td>
                                <td>@if($e->djshijian=='' || $e->djshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font>@else{!! $e->djshijian !!}@endif</td>
                                <td>@if($e->cjshijian=='' || $e->cjshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font> @else{!! $e->cjshijian !!}@endif</td>
                                <td>
                                    @if($e->userstation=='2')
                                        <font color="#ff0000">已被封号</font>
                                    @else
                                        @if($e->station=='0')<font color="#000000">排队中</font>
                                        @elseif($e->station=='1')<font color="#FF0000">匹配中</font>
                                        @elseif($e->station=='2')
                                            @if($e->paystation=='0')<font color="#FF0000">付款中</font>
                                            @else <font color="#FF0000">已付款</font>
                                            @endif
                                        @elseif($e->station=='3')<font color="#0000ff">未付款</font>
                                        @elseif($e->station=='4')<font color="#00ff00">冻结期</font>
                                        @elseif($e->station=='5')<font color="#FF0000">已完成</font>
                                        @elseif($e->station=='6')<font color="#FF0000">作废</font>
                                        @elseif($e->station=='7')<font color="#FF0000">拒绝付款</font>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <a href="{{URL('5538830c29f8a8e4/offer/jilu')}}?id={{$e->id}}">查看</a>
                                    @if($e->shengyu!='0.00')
                                        | <a href="{{URL('5538830c29f8a8e4/offer/shoudong')}}?type={{$type}}&id={{$e->id}}">手动匹配</a>
                                    @endif

                                    @if($e->jine==$e->shengyu && $e->renshu=='0')
                                        | <a href="{{URL('5538830c29f8a8e4/excsql/deloffer/'.$e->id)}}" onclick='delcfm()'>删除</a>
                                    @endif

                                    @if($e->shengyu=='0' && $e->renshu!='0' && $e->station!='5')
                                        | <a href="{{URL('5538830c29f8a8e4/excsql/wancheng/'.$e->id)}}" onclick='doorder()'>已完成</a>
                                    @endif

                                    @if($e->station=='2' && $e->type=='1' && $e->shengyu=='0' && $e->renshu!='0')
                                        | <a href="{{URL('5538830c29f8a8e4/excsql/dongjie/'.$e->id)}}" onclick='doorder()'>进入冻结</a>
                                    @endif
                                    @if($e->station!='5')
                                        | <a href="javascript:;" onclick="editorder({{$e->id}})">修改</a>
                                    @endif
                                    @if($e->type=='1')
                                        | <a href="{{URL('5538830c29f8a8e4/excsql/fenghao/'.$e->userid)}}" onclick="queren('确定封号吗？')">封号</a>
                                    @endif
                                    @if($e->edustation=='0')
                                        | <a href="{{URL('5538830c29f8a8e4/excsql/eduhuanyuan/'.$e->id)}}" onclick="queren('确定还原订单额度吗？')">额度还原</a>
                                    @endif
                                    @if($e->jiangjinstation=='1' && $e->station=='4')
                                        | <a href="{{URL('5538830c29f8a8e4/excsql/jiangjinstation/'.$e->id)}}" onclick="queren('确定重置奖金吗？')">重置奖金</a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        @if($type=='2' && $station=='1')
                            <tr>
                                <td colspan="13" style="font-size: 24px; padding: 20px 0px;">
                                    总金额：<font color="#ff0000">{{$totel1}}</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    剩余金额：<font color="#ff0000">{{$totel2}}</font>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="user-page">
                    <div align="center">{{$data->appends(['type'=>$type,'zhouqi'=>$zhouqi,'user'=>$user,'orderid'=>$orderid,'id'=>$id,'station'=>$station,'start'=>$start,'end'=>$end,'start1'=>$start1,'end1'=>$end1,'paixu'=>$paixu,'jine'=>$jine])->links()}}</div>
                    <input class="text" type="text" name="page" id="page" value="" />
                    <input type="submit" class="sub" value="GO" onclick="gotopage()" />
                </div>
            </div>
    @elseif($do=='shoudong')
        <div class="user">
            <div class="title"><span></span>订单信息</div>
            <div class="user-search">
                <table width="100%" style="text-align:left; line-height:36px; margin-bottom:5px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#ff0000">您的订单号：<b>{{$data[0]->orderid}}</b> 匹配到的订单 &nbsp;&nbsp;&nbsp;&nbsp;
                                该订单总金额：<b>{{$data[0]->jine}}</b>，剩余金额： <b>{{$data[0]->shengyu}}</b> </font>
                        </td>
                        <td width="100" align="center" bgcolor="#999999"><a href="javascript:history.go(-1)"><font color="#ffffff">返回上一页</font></a></td>
                    </tr>
                </table>
            </div>
            <div class="user-list">
                <form name="form1" class="myform" method="post" action="{{URL('5538830c29f8a8e4/excsql/pipei/'.$id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="100%" style="text-align:left;background-color:#fff; margin-top:30px; line-height:50px;" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="right" width="200">订单号：</td>
                            <td><input type="text" class="text" name="orderid" value="{{date('YmdHis').rand(100000,999999)}}"  /> 系统生成，不可修改</td>
                        </tr>
                        <tr>
                            <td align="right">金额：</td>
                            <td><input type="text" class="text" name="jine" value="{{$data[0]->shengyu}}"  /> 默认为该订单的剩余金额</td>
                        </tr>
                        <tr>
                            <td align="right">会员帐号：</td>
                            <td><input type="text" class="text" name="user" value="" nullmsg="请输入会员帐号！" datatype="*" ajaxurl="{{URL('checkuser')}}"/> </td>
                        </tr>
                        <tr>
                            <td align="right">确认密码：</td>
                            <td><input type="text" class="text" name="pwd" value="" nullmsg="请输入密码！" datatype="*" ajaxurl="{{URL('checkadminpwd')}}"/> </td>
                        </tr>

                        <tr>
                            <td align="right"><input type="hidden" name="type" value="" /></td>
                            <td><input type="submit" class="sub" value="提交" /> </td>              </tr>
                    </table>
                </form>
            </div>
        </div>
    @elseif($do=='jilu')
        <div class="user">
            <div class="title"><span></span>订单信息</div>
            <div class="user-search">
                <table width="100%" style="text-align:left; line-height:36px; margin-bottom:5px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#ff0000">您的订单号：<b>{{$offer[0]->orderid}}</b> 匹配到的订单
                                &nbsp;&nbsp;&nbsp;&nbsp;该订单总金额：<b>{{$offer[0]->jine}}</b>，
                                剩余金额： <b>{{$offer[0]->shengyu}}</b> 匹配人数： <b>{{$offer[0]->renshu}}</b> </font></td>
                        <td width="100" align="center" bgcolor="#999999"><a href="javascript:history.go(-1)"><font color="#ffffff">返回上一页</font></a></td>
                    </tr>
                </table>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序列号</td>
                        <td>匹配订单号</td>
                        <td>会员帐号</td>
                        <td>会员电话</td>
                        <td>推荐人电话</td>
                        <td>订单总金额</td>
                        <td>匹配金额</td>
                        <td>匹配时间</td>
                        <td>订单状态</td>
                        <td>倒计时</td>
                        <td>操作</td>
                        <td>删除</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td width="80">{{$e->id}}</td>
                            @if($offer[0]->type=='1')
                                <td>{{$e->orderid}}</td>
                                <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->orderid,'user')}}</td>
                                <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->orderid,'phone')}}</td>
                                <td>{{\App\Http\Controllers\FunctionController::userinfo(\App\Http\Controllers\FunctionController::getuserinfo($e->orderid,'tuijian'),'phone')}}</td>
                                <td>{{\App\Http\Controllers\AdminofferController::getorderinfo($e->orderid,'jine')}}</td>
                            @else
                                <td>{{$e->pipeiid}}</td>
                                <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->pipeiid,'user')}}</td>
                                <td>{{\App\Http\Controllers\FunctionController::getuserinfo($e->pipeiid,'phone')}}</td>
                                <td>{{\App\Http\Controllers\FunctionController::userinfo(\App\Http\Controllers\FunctionController::getuserinfo($e->pipeiid,'tuijian'),'phone')}}</td>
                                <td>{{\App\Http\Controllers\AdminofferController::getorderinfo($e->pipeiid,'jine')}}</td>
                            @endif
                            <td>{{$e->jine}}</td>
                            <td>{{$e->shijian}}</td>
                            <td>
                                @if($offer[0]->type=='1')
                                    @if($e->station=='2')
                                        @if($e->paystation=='0')<font color="#FF0000">付款中</font>
                                        @else <font color="#FF0000">已付款</font>
                                        @endif
                                    @elseif($e->station=='3')<font color="#0000ff">未付款</font>
                                    @elseif($e->station=='4')<font color="#00ff00">冻结期</font>
                                    @elseif($e->station=='5')<font color="#FF0000">已完成</font>
                                    @elseif($e->station=='6')<font color="#FF0000">作废</font>
                                    @elseif($e->station=='7')<font color="#FF0000">拒绝付款</font>
                                    @endif
                                @else
                                    @if($e->station=='7')<font color="#FF0000">拒绝付款</font>
                                    @else
                                        @if($e->paystation=='0')
                                            <font color="#FF0000">付款中</font>
                                        @elseif($e->paystation=='1')
                                            <font color="#00FF00">已付款</font>
                                        @elseif($e->paystation=='2')
                                            <font color="#0000FF">已收款</font>
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($e->station=='2')
                                    @if(strtotime(date("Y-m-d H:i:s"))<strtotime(date("Y-m-d H:i:s",strtotime("$e->shijian +1 day"))))
                                        <font color="#ff0000"><span id="divdown{{$e->id}}">00:00:00</span></font>
                                    @else
                                        <font color=#666666">00:00:00</font>
                                    @endif
                                @else
                                    <font color="#666666">00:00:00</font>
                                @endif
                            </td>
                            <td>
                                <a href="{{URL('5538830c29f8a8e4/offer/info/')}}?ordertype={{$offer[0]->type}}&id={{$e->id}}&type=order"> <font color="#0000ff">进入</font></a>&nbsp;
                            </td>
                            <td>
                                <a href="{{URL('5538830c29f8a8e4/excsql/delorder/'.$e->id)}}" onclick="queren('确定删除吗？')"> <font color="#ff0000">删除</font></a>&nbsp;
                            </td>


                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['id'=>$id])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>

        </div>
    @elseif($do=='info')
        <div class="user">
            <div class="title"><span></span>订单信息</div>
            @if($ordertype=='1')
            <div class="user-info">
                <a href="{{URL('5538830c29f8a8e4/offer/info')}}?ordertype=1&id={{$id}}&type=order" @if($type=='order')class="hover"@endif>查看资料</a>
                <a href="{{URL('5538830c29f8a8e4/offer/info')}}?ordertype=1&id={{$id}}&type=info" @if($type=='info')class="hover"@endif>账户信息</a>
                <a href="{{URL('5538830c29f8a8e4/offer/info')}}?ordertype=1&id={{$id}}&type=payinfo" @if($type=='payinfo')class="hover"@endif>付款信息</a>
                <a href="{{URL('5538830c29f8a8e4/offer/jilu')}}?id={{$paixu}}">返回匹配记录</a>
            </div>
            @if($type=='order')
            <div class="user-search">
                <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="300" align="right">单号：</td>
                        <td><input type="text" readonly="readonly" class="input" name="orderid" value="{{$offer[0]->orderid}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">接收人会员号：</td>
                        <td><input type="text" readonly="readonly" class="input" name="userid" value="{{$userid[0]->user}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">接收人姓名：</td>
                        <td><input type="text" readonly="readonly" class="input" name="name" value="{{$userid[0]->name}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">金额：</td>
                        <td><input type="text" readonly="readonly" class="input" name="jine" value="{{$data[0]->jine}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">剩余金额：</td>
                        <td><input type="text" readonly="readonly" class="input" name="jine" value="{{$offer[0]->shengyu}}" /></td>
                    </tr>

                    <tr>
                        <td align="right">联系电话：</td>
                        <td><input type="text" readonly="readonly" class="input" name="phone" value="{{$userid[0]->phone}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">推荐人姓名：</td>
                        <td><input type="text" readonly="readonly" class="input" name="name1" value="{{\App\Http\Controllers\FunctionController::userinfo($userid[0]->tuijian,'name')}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">推荐人电话：</td>
                        <td><input type="text" readonly="readonly" class="input" name="phone1" value="{{\App\Http\Controllers\FunctionController::userinfo($userid[0]->tuijian,'phone')}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">匹配时间：</td>
                        <td><input type="text" readonly="readonly" class="input" name="ppshijian" value="{{$offer[0]->ppshijian}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">状态：</td>

                        <td>
                            @if($data[0]->paystation=='0')
                            <input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="未付款" />
                            @elseif($data[0]->paystation=='1')
                            <input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="已付款" />
                            @elseif($data[0]->paystation=='2')
                            <input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="对方已确认收款" />
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td>
                            @if($data[0]->paystation=='1')
                                <input type="button" value="确认收款" class="goback" onclick="window.location.href='{{URL('5538830c29f8a8e4/excsql/querenshoukuan/'.$data[0]->id)}}'" />
                            @endif
                            <input type="button" value="返回上页" class="goback" onclick="javascript:history.go(-1)" />

                        </td>
                    </tr>
                </table>
                <br /><br /><br />
            </div>
            @elseif($type=='info')
            <div class="user-search">
                <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="300" align="right">银行名称：</td>
                        <td><input type="text" readonly="readonly" class="input" name="bankname" value="{{$userid[0]->bankname}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">开户行：</td>
                        <td><input type="text" readonly="readonly" class="input" name="kaihuhang" value="{{$userid[0]->kaihuhang}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">银行地址：</td>
                        <td><input type="text" readonly="readonly" class="input" name="kaihudizhi" value="{{$userid[0]->kaihudizhi}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">户名：</td>
                        <td><input type="text" readonly="readonly" class="input" name="huming" value="{{$userid[0]->huming}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">银行卡号：</td>
                        <td><input type="text" readonly="readonly" class="input" name="banknum" value="{{$userid[0]->banknum}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">支付宝：</td>
                        <td><input type="text" readonly="readonly" class="input" name="alipay" value="{{$userid[0]->alipay}}" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><input type="button" value="返回上页" class="goback" onclick="javascript:history.go(-1)" /></td>
                    </tr>
                </table>
                <br /><br />
            </div>
            @elseif($type=='payinfo')
            <div class="user-search">
                <table width="887" align="center" style="line-height:50px; padding-left:50px; font-size:14px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="200" align="right">转账日期：</td>
                        <td>{{$data[0]->paytime}}</td>
                    </tr>
                    <tr>
                        <td  valign="top" align="right">备注信息：</td>
                        <td valign="top">{{$data[0]->beizhu}}</td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><input type="button" value="返回上页" class="goback" onclick="javascript:history.go(-1)" /></td>
                    </tr>
                </table>
                <br /><br />
            </div>
            @endif
            @elseif($ordertype=='2')
                <div class="user-info">
                    <a href="{{URL('5538830c29f8a8e4/offer/info')}}?ordertype=2&id={{$id}}&type=order" @if($type=='order')class="hover"@endif>查看资料</a>
                    <a href="{{URL('5538830c29f8a8e4/offer/info')}}?ordertype=2&id={{$id}}&type=payinfo" @if($type=='payinfo')class="hover"@endif>付款信息</a>
                    <a href="{{URL('5538830c29f8a8e4/offer/jilu')}}?id={{$paixu}}">返回匹配记录</a>
                </div>

        @if($type=='order')
        <div class="user-search">
            <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="300" align="right">单号：</td>
                    <td><input type="text" readonly="readonly" class="input" name="orderid" value="{{$offer[0]->orderid}}" /></td>
                </tr>
                <tr>
                    <td align="right">接收人会员号：</td>
                    <td><input type="text" readonly="readonly" class="input" name="userid" value="{{$userid[0]->user}}" /></td>
                </tr>
                <tr>
                    <td align="right">接收人姓名：</td>
                    <td><input type="text" readonly="readonly" class="input" name="name" value="{{$userid[0]->name}}" /></td>
                </tr>
                <tr>
                    <td align="right">金额：</td>
                    <td><input type="text" readonly="readonly" class="input" name="jine" value="{{$data[0]->jine}}" /></td>
                </tr>
                <tr>
                    <td align="right">联系电话：</td>
                    <td><input type="text" readonly="readonly" class="input" name="phone" value="{{$userid[0]->phone}}" /></td>
                </tr>
                <tr>
                    <td align="right">推荐人姓名：</td>
                    <td><input type="text" readonly="readonly" class="input" name="name1" value="{{\App\Http\Controllers\FunctionController::userinfo($userid[0]->tuijian,'name')}}" /></td>
                </tr>
                <tr>
                    <td align="right">推荐人电话：</td>
                    <td><input type="text" readonly="readonly" class="input" name="phone1" value="{{\App\Http\Controllers\FunctionController::userinfo($userid[0]->tuijian,'phone')}}" /></td>
                </tr>
                <tr>
                    <td align="right">匹配时间：</td>
                    <td><input type="text" readonly="readonly" class="input" name="ppshijian" value="{{$offer[0]->ppshijian}}" /></td>
                </tr>
                <tr>
                    <td align="right">状态：</td>
                    <td>
                        @if($data[0]->paystation=='0')
                            <input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="未付款" />
                        @elseif($data[0]->paystation=='1')
                            <input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="已付款，请确认" />
                        @elseif($data[0]->paystation=='2')
                            <input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="已确认收款" />
                        @endif
                    </td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td>
                        @if($data[0]->paystation=='1')
                        <input type="button" value="确认收款" class="goback" onclick="window.location.href='{{URL('5538830c29f8a8e4/excsql/querenshoukuan/'.$data[0]->id)}}'" />
                        @endif
                        <input type="button" value="返回上页" class="goback" onclick="javascript:history.go(-1)" /></td>
                </tr>

            </table>
            <br /> <br /> <br /> <br /> <br />
        </div>
        @elseif($type=='payinfo')
        <div class="user-search">
            <table width="887" align="center" style="line-height:50px; font-size:14px;" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="200" align="right">转账日期：</td>
                    <td>{{$data[0]->paytime}}</td>
                </tr>
                <tr>
                    <td  valign="top" align="right">备注信息：</td>
                    <td valign="top">{{$data[0]->beizhu}}</td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td align="left"><input type="button" value="返回上页" class="goback" onclick="javascript:history.go(-1)" /></td>
                </tr>

            </table>
            <br /><br />
        </div>
        @endif
        <br />
            @endif
    </div>
    @elseif($do=='autooffer')
        <div class="user">
            <div class="title"><span></span>自动众筹参与</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/autooffer')}}">
                    &nbsp;注册时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    &nbsp;
                    金额:<input type="text" name="jine" value="{{$jine}}" />
                    <input type="submit" value="开始下单" class="button" />
                </form>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>用户ID</td>
                        <td>订单编号</td>
                        <td>金额</td>
                        <td>下单时间</td>
                        <td>状态</td>
                    </tr>

                </table>
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
        </div>
    @elseif($do=='forzen')
        <div class="user">
            <div class="title"><span></span>冻结资金</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/forzen')}}">
                    &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    订单号：<input type="text" name="orderid" class="text" value="{{$orderid}}" />


                    下单时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择<br />
                    &nbsp;排序方式：
                    <select name="paixu" class="text">
                        @if($paixu=='ppshijian')
                        <option value="ppshijian">匹配时间</option>
                        <option value="shijian">下单时间</option>
                        @else
                        <option value="shijian">下单时间</option>
                        <option value="ppshijian">匹配时间</option>
                        @endif
                    </select>
                    <input type="submit" value="查找" class="button" />
                </form>

            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td width="100">订单号</td>
                        <td>金额</td>
                        <td>剩余金额</td>
                        <td>人数</td>
                        <td>会员帐号</td>
                        <td>真实姓名</td>
                        <td>下单时间</td>
                        <td>匹配时间</td>
                        <td>冻结时间</td>
                        <td>成交时间</td>
                        <td>状态</td>
                        <td>操作</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->orderid,$orderid,$color = "red") !!}</td>
                            <td>{!! $e->jine !!}</td>
                            <td>{!! $e->shengyu !!}</td>
                            <td>{!! $e->renshu !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->shijian !!}</td>
                            <td>@if($e->ppshijian=='' || $e->ppshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font> @else{!! $e->ppshijian !!}@endif</td>
                            <td>@if($e->djshijian=='' || $e->djshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font>@else{!! $e->djshijian !!}@endif</td>
                            <td>@if($e->cjshijian=='' || $e->cjshijian=='0000-00-00 00:00:00')<font color="#FF0000">未生成</font> @else{!! $e->cjshijian !!}@endif</td>
                            <td>
                                @if($e->userstation=='2')
                                    <font color="#ff0000">已被封号</font>
                                @else
                                    @if($e->station=='0')<font color="#000000">排队中</font>
                                    @elseif($e->station=='1')<font color="#FF0000">匹配中</font>
                                    @elseif($e->station=='2')
                                        @if($e->paystation=='0')<font color="#FF0000">付款中</font>
                                        @else <font color="#FF0000">已付款</font>
                                        @endif
                                    @elseif($e->station=='3')<font color="#0000ff">未付款</font>
                                    @elseif($e->station=='4')<font color="#00ff00">冻结期</font>
                                    @elseif($e->station=='5')<font color="#FF0000">已完成</font>
                                    @elseif($e->station=='6')<font color="#FF0000">作废</font>
                                    @elseif($e->station=='7')<font color="#FF0000">拒绝付款</font>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a href="{{URL('5538830c29f8a8e4/excsql/forzenorder/'.$e->id)}}" onclick='doorder()'>冻结钱包</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'orderid'=>$orderid,'start'=>$start,'end'=>$end,'paixu'=>$paixu])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>

        </div>
    @elseif($do=='forzenlist')
        <div class="user">
            <div class="title"><span></span>冻结资金列表</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/forzenlist/')}}">
                    &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    订单编号：<input type="text" name="orderid" class="text" value="{{$orderid}}" />
                    状态：<select name="station" class="text">
                        @if($station=='1')
                            <option value="1">冻结</option>
                            <option value="">全部</option>
                            <option value="2">释放</option>
                        @elseif($station=='2')
                            <option value="2">释放</option>
                            <option value="">全部</option>
                            <option value="1">冻结</option>
                        @else
                            <option value="">全部</option>
                            <option value="1">冻结</option>
                            <option value="2">释放</option>
                        @endif
                    </select>

                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择<br />
                    &nbsp;
                    <input type="submit" value="查找" class="button" /> <a href="{{URL('5538830c29f8a8e4/offer/forzenlist/')}}">清除搜索条件</a>
                </form>

            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td width="100">订单编号</td>
                        <td>金额</td>
                        <td>会员帐号</td>
                        <td>真实姓名</td>
                        <td>时间</td>
                        <td>状态</td>
                        <td>操作</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->oid,$orderid,$color = "red") !!}</td>
                            <td>{!! $e->money !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->addtime !!}</td>
                            <td>
                                @if($e->userstation=='2')
                                    <font color="#ff0000">已被封号</font>
                                @else
                                    @if($e->type=='1')<font color="#0000ff">冻结</font>
                                    @else<font color="#FF0000">释放</font>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a href="{{URL('5538830c29f8a8e4/offer/forzeninfo/'.$e->id)}}">手动释放</a> |
                                <a href="{{URL('5538830c29f8a8e4/excsql/delforzen/'.$e->id)}}" onclick='queren("确定删除吗")'>删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'orderid'=>$orderid,'start'=>$start,'end'=>$end,'station'=>$station])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>

        </div>
    @elseif($do=='paidan')
        <div class="user">
            <div class="title"><span></span>手动排单</div>
            <div class="user-search" style="margin-top: 50px;">
                <form class="myform" method="post" action="{{URL('5538830c29f8a8e4/excsql/dopaidan')}}">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right">需要排单的帐号：</td>
                            <td><input type="text" name="user" value="" class="input" nullmsg="请输入会员帐号！" datatype="*" /><font color="#ff0000">多个帐号请用英文输入法状态下逗号,隔开</font>
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="440" align="right">金额：</td>
                            <td><input type="text" name="jine" value="" class="input"  nullmsg="请输入金额！" datatype="n" /></td>
                        </tr>
                        <tr>
                            <td width="440" align="right">排单时间：</td>
                            <td>
                                <input type="text" name="shijian" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                            </td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td>
                                <input type="submit" class="sub" value="提交" />
                            </td>
                        </tr>
                    </table>
                </form>

                <hr>
                <form class="myform" method="post" action="{{URL('5538830c29f8a8e4/excsql/editorderuserid')}}">
                    <table width="100%" style="margin-top: 30px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right"></td>
                            <td>
                                <b>修改订单号所属会员ID</b>
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">订单号orderid：</td>
                            <td><input type="text" name="orderid" value="" class="input" nullmsg="请输入订单号！" datatype="*" />
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="440" align="right">会员ID：</td>
                            <td><input type="text" name="userid" value="" class="input"  nullmsg="请输入会员ID" datatype="n" /></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td>
                                <input type="submit" class="sub" value="提交" />
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    @elseif($do=='qiuzhu')
        <div class="user">
            <div class="title"><span></span>手动求助</div>
            <div class="user-search" style="margin-top: 50px;">
                <form class="myform" method="post" action="{{URL('5538830c29f8a8e4/excsql/doqiuzhu')}}">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right">需要求助的帐号：</td>
                            <td><input type="text" name="user" value="" class="input" nullmsg="请输入会员帐号！" datatype="*" ajaxurl="{{ URL('checkuser') }}" />
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td width="440" align="right">金额：</td>
                            <td><input type="text" name="jine" value="" class="input"  nullmsg="请输入金额！" datatype="n" /></td>
                        </tr>
                        <tr>
                            <td width="440" align="right">排单时间：</td>
                            <td><input type="text" name="shijian" value="{{$start}}" class="time
                laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" /></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td>
                                <input type="submit" class="sub" value="提交" />
                            </td>
                        </tr>
                    </table>
                </form><br><br><br>
            </div>
        </div>
    @elseif($do=='deljiangjin')
        <div class="user">
            <div class="title"><span></span>删除奖金</div>
            <div class="user-search">
                <form name="form1" class="myform" method="post" action="{{URL('5538830c29f8a8e4/excsql/deljiangjin')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    用户id:<input type="text" id="userid" name="userid" value="" />&nbsp;&nbsp;
                    注册开始时间：<input id="addstart" type="text" name="addstart" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input id="addend" type="text" name="addend" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    &nbsp;&nbsp;
                    下单时间：<input id="start" type="text" name="start" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" id="end" name="end" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择&nbsp;&nbsp;
                    <input type="submit" value="全部删除" class="button" onclick="queren('确定全部删除吗？')"/>
                </form>
            </div>
        </div>
    @elseif($do=='changestation')
        <div class="user">
            <div class="title"><span></span>订单状态改变</div>
            <div class="user-search" style="padding: 200px 0px;">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/excsql/changestation')}}">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;下单时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    &nbsp;金额:<input type="text" name="jine" value="{{$jine}}" />
                    <input type="submit" value="全部改变" class="button" onclick="queren('确定全部改变吗？')" />
                </form>
            </div>
        </div>
    @elseif($do=='jiangjinerror')
        <div class="user">
            <div class="title"><span></span>奖金修复</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/jiangjinerror')}}">
                    &nbsp;&nbsp;时间：<input type="text" name="start" id="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" id="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    <input type="submit" value="开始修复" class="button" />
                    <a href="{{URL('5538830c29f8a8e4/offer/jiangjinerror')}}">清除时间</a>
                </form>
            </div>
            <div class="user-list"  style="background:#fff;">
                <hr>
                <p align="center" style="font-size:24px; font-weight:bolder; line-height:50px; padding:200px 0px;">
                    {!! $data !!}
                </p>
            </div>


        </div>
    @elseif($do=='edu')
        <div class="user">
            <div class="title"><span></span>额度校正</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/edu')}}">
                    &nbsp;会员编号：<input type="text" name="userid" value="{{$userid}}" class="text" />
                    <input type="submit" value="查询" class="button" />
                </form>
            </div>
        @if($userid!='')
                @if(count($data)=='1')
                    <div class="user-list">
                        <table width="100%" style="text-align:left;background-color:#fff; margin-top:30px; line-height:50px; font-size:20px;" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="right" width="300">会员帐号:&nbsp;&nbsp;</td>
                                <td>{{$data[0]->user}}</td>
                            </tr>
                            <tr>
                                <td align="right" width="300">真实姓名:&nbsp;&nbsp;</td>
                                <td>{{$data[0]->name}}</td>
                            </tr>
                            <tr>
                                <td align="right" width="300">直推有效个数:&nbsp;&nbsp;</td>
                                <td>{{\App\Http\Controllers\FunctionController::tuijiannum($userid)}}</td>
                            </tr>
                            <tr>
                                <td align="right">排单中的金额：&nbsp;&nbsp;</td>
                                <td>{{\App\Http\Controllers\FunctionController::guadan($userid)}}</td>
                            </tr>
                            <tr>
                                <td align="right">众筹参与剩余额度：&nbsp;&nbsp;</td>
                                <td>{{$data[0]->tigongedu}}</td>
                            </tr>
                            <tr>
                                <td align="right">众筹参与实际剩余额度：&nbsp;&nbsp;</td>
                                <td>{{$start}}</td>
                            </tr>

                            <tr>
                                <td align="right">&nbsp;&nbsp;</td>
                                <td>
                                    <a href='{{URL('5538830c29f8a8e4/offer/edu')}}?userid={{$end}}'>下一个</a> &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href='{{URL('5538830c29f8a8e4/excsql/gengxinedu/'.$userid)}}'>更新额度</a>
                                </td>
                            </tr>
                        </table>

                    </div>
                @else
                    <div class="user-list"  style="background:#fff;">
                        <hr>
                        <p align="center" style="font-size:24px; font-weight:bolder; color:#ff0000; line-height:50px; padding:200px 0px;">
                            会员编号不存在
                        </p>
                    </div>

                @endif
        @else
                <div class="user-list"  style="background:#fff;">
                    <hr>
                    <p align="center" style="font-size:24px; font-weight:bolder; color:#ff0000; line-height:50px; padding:200px 0px;">
                        请输入会员编号
                    </p>
                </div>
        @endif
        </div>
    @elseif($do=='pipeimoshi')
        <div class="user">
            <div class="title"><span></span>匹配模式</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/pipeimoshi')}}">
                    &nbsp;众筹红利下单时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    &nbsp;众筹参与下单时间：<input type="text" name="start1" value="{{$start1}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end1" value="{{$end1}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    <br>&nbsp;匹配类型：
                    <select name="type" class="text">
                        @if($type=='1')
                            <option value="1">大金额</option>
                            <option value="">全部</option>
                            <option value="2">小金额</option>
                        @elseif($type=='2')
                                <option value="2">小金额</option>
                                <option value="">全部</option>
                                <option value="1">大金额</option>
                        @else
                                <option value="">全部</option>
                                <option value="1">大金额</option>
                                <option value="2">小金额</option>
                        @endif
                    </select>
                    金额：<input name="jine" value="{{$jine}}" class="text"/>

                    <input type="submit" value="开始匹配" class="button" />
                </form>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>众筹红利订单</td>
                        <td>众筹参与订单</td>
                        <td>匹配成功金额</td>
                        <td>剩余匹配金额</td>
                        <td>匹配时间</td>
                        <td>状态</td>
                    </tr>
                    {!! $data !!}
                </table>
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>


        </div>
    @elseif($do=='awardlist')
        <div class="user">
            <div class="title"><span></span>奖金释放列表</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/offer/awardlist')}}">
                    &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    订单编号：<input type="text" name="orderid" class="text" value="{{$orderid}}" />
                    状态：<select name="station" class="text">
                        @if($station=='1')
                            <option value="1">动态奖</option>
                            <option value="">全部</option>
                            <option value="2">管理奖</option>
                        @elseif($station=='2')
                            <option value="2">管理奖</option>
                            <option value="">全部</option>
                            <option value="1">动态奖</option>
                        @else
                            <option value="">全部</option>
                            <option value="1">动态奖</option>
                            <option value="2">管理奖</option>
                        @endif
                    </select>

                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择<br />
                    &nbsp;

                    <input type="submit" value="查找" class="button" />
                    <a style="color: red;" href="{{URL('5538830c29f8a8e4/offer/awardlist')}}">清除搜索条件</a>
                    <a style="color: red;" href="{{URL('5538830c29f8a8e4/excsql/deltuiguang/1')}}">删除重复推广奖</a>
                    <a style="color: red;" href="{{URL('5538830c29f8a8e4/excsql/deltuiguang/2')}}">删除重复管理奖</a>

                </form>

            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td width="100">订单编号</td>
                        <td>金额</td>
                        <td>会员帐号</td>
                        <td>真实姓名</td>
                        <td>时间</td>
                        <td>状态</td>
                        <td>操作</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->oid,$orderid,$color = "red") !!}</td>
                            <td>{!! $e->money !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->addtime !!}</td>
                            <td>
                                @if($e->userstation=='2')
                                    <font color="#ff0000">已被封号</font>
                                @else
                                    @if($e->type=='1')<font color="#0000ff">动态奖</font>
                                    @else<font color="#FF0000">管理奖</font>
                                    @endif
                                @endif
                            </td>
                            <td>
                                <a href="{{URL('5538830c29f8a8e4/excsql/delaward/'.$e->id)}}" onclick='queren("确定删除吗")'>删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'orderid'=>$orderid,'start'=>$start,'end'=>$end,'station'=>$station])->links()}}</div>
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>

        </div>
    @endif
</div>
<div id="chuli">
    <div class="chuli">
        <div class="close" onclick="guanbi()"></div>
        <div class="con">

        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('admin/js/jquery-1.6.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform();  //就这一行代码！;
        tiptype:3
    })
</script>
</body>
</html>

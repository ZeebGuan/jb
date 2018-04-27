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
            var url="{{URL('5538830c29f8a8e4/log/'.$type)}}?user={{$user}}&ip={{$ip}}&start={{$start}}&end={{$end}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }

        }
    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    <div class="user">
        <div class="bigTitleName">登录记录</div>
        <div class="smallEngTitleName">LOGIN RECORD</div>
        <div class="smallTitleBottomDiv"></div>
        <div class="user-search">
            <div class="title"><span></span></div>
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/log/'.$type)}}">
                帐号名：<input type="text" name="user" class="text" value="{{$user}}" />
                IP信息：<input type="text" name="ip" class="text" value="{{$ip}}" />
                时间段：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                <input type="submit" value="" class="chazhao" /><a href="{{URL('jb_admin/log/'.$type)}}">清楚搜索条件</a>
                @if($type=='0')
                <a href="{{URL('jb_admin/excsql/delalluserlogin')}}" onclick=delcfm()><font color="#FF0000">删除所有客户登录记录</font></a>
                @else
                <a href="{{URL('jb_admin/excsql/delalladminlogin')}}" onclick=delcfm()><font color="#FF0000">删除所有系统登录记录</font></a>
                @endif
            </form>
        </div>
        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:0px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td width="80">序列号</td>
                    <td>用户名</td>
                    <td>IP</td>
                    <td>登录时间</td>
                    <td>登录状态</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td width="80">{{$count--}}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->ip,$ip,$color = "red") !!}</td>
                        <td width="340">{{date('Y-m-d H:i:s',$e->shijian)}}</td>
                        <td width="240">{{$e->station}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['user'=>$user,'ip'=>$ip,'start'=>$start,'end'=>$end])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>

    </div>
</div>
<script type="text/javascript" src="{{asset('admin/js/jquery-1.6.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform();  //就这一行代码！;
    })
</script>
</body>
</html>

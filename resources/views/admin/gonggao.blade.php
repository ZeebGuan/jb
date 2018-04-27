<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('5538830c29f8a8e4/gonggao/list')}}?user={{$user}}&title={{$title}}&start={{$start}}&end={{$end}}&page="+page;
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
        @if($do=='list')
        <div class="title"><span></span>公告消息</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/gonggao/list')}}">
                &nbsp;&nbsp;标题：<input type="text" name="title" class="text" value="{{$title}}" />
                收件人：<input type="text" name="user" class="text" value="{{$user}}" />
                时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                <input type="submit" value="" class="chazhao" /><a href="{{URL('5538830c29f8a8e4/gonggao/list')}}">清除搜索条件</a>
            </form>
        </div>
        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td>序列号</td>
                    <td>标题</td>
                    <td>类型</td>
                    <td>收件人</td>
                    <td>时间</td>
                    <td>状态</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td width="80">{{$count--}}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->title,$title,$color = "red") !!}</td>
                        @if($e->userid=='0')<td>系统公告</td>@else<td>系统消息</td>@endif
                        @if($e->userid=='0')<td>所有人</td>@else<td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>@endif

                        <td width="340">{{$e->shijian}}</td>
                        <td width="140">@if($e->station=='0')<font color="#FF0000">未读</font>@else已读@endif</td>
                        <td><a href='{{URL('5538830c29f8a8e4/excsql/delgonggao/'.$e->id)}}' onclick='delcfm()'>删除</a> | <a href='{{URL('5538830c29f8a8e4/gonggao/edit/'.$e->id)}}'>修改</a> </td>
                    </tr>
                @endforeach



            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['user'=>$user,'title'=>$title,'start'=>$start,'end'=>$end])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>
        @elseif($do=='add')
        <div class="title"><span></span>发送消息</div>
        <div class="user-search">
            <form class="form" method="post" action="{{URL('5538830c29f8a8e4/excsql/addgonggao/')}}">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right">主题：</td>
                        <td><input type="text" name="title" value="" class="input" nullmsg="请输入主题！" datatype="*" />
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="240" align="right">收件人：</td>
                        <td><input type="text" name="user" value="" class="input"  nullmsg="请输入帐号/手机号码！" datatype="*" ajaxurl="{{URL('checkuser')}}" ignore="ignore"/>留空就是系统公告</td>
                    </tr>

                    <tr>
                        <td align="right">内容：</td>
                        <td><textarea id="content" name="content" style="width:500px; height:300px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr color="#999999" /></td>
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
            @elseif($do=='edit')
        <div class="title"><span></span>发送消息</div>
        <div class="user-search">
            <form class="form" method="post" action="{{URL('5538830c29f8a8e4/excsql/editgonggao/'.$id)}}">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right">主题：</td>
                        <td><input type="text" name="title" value="{{$title}}" class="input" nullmsg="请输入主题！" datatype="*" />
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="240" align="right">收件人：</td>
                        <td><input type="text" name="user" value="{{$user}}" class="input"  nullmsg="请输入帐号/手机号码！" datatype="*" ajaxurl="{{URL('checkuser')}}" ignore="ignore"/>留空就是系统公告</td>
                    </tr>

                    <tr>
                        <td align="right">内容：</td>
                        <td><textarea id="content" name="content" style="width:500px; height:300px;">{{$content}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><hr color="#999999" /></td>
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
        @endif
    </div>
</div>
<script type="text/javascript">var ue = UE.getEditor('content');</script>
<script language="javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

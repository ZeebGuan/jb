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
            var url="{{URL('jb_admin/admin/list')}}?user={{$user}}&name={{$name}}&page="+page;
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
        <div class="title"><span></span>管理员管理</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/admin/list')}}">
                &nbsp;登录帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                真实姓名：<input type="text" name="name" class="text" value="{{$name}}" />
                手机号码：<input type="text" name="phone" class="text" value="{{$phone}}" />
                <input type="submit" value="查找" class="button" />
                <a href="{{URL('jb_admin/admin/list')}}">清除搜索条件</a>
            </form>
        </div>
        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td>序号</td>
                    <td>登录帐号</td>
                    <td>真实姓名</td>
                    <td>手机号码</td>
                    <td>角色</td>
                    <td>用户状态</td>
                    <td>创建时间</td>
                    <td>最后登录时间</td>
                    <td>最后登录</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td width="80">{{$e->id}}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->phone,$phone,$color = "red") !!}</td>
                        <td>{{$e->title}}</td>
                        @if($e->station=='1')<td>正常</td>@else<td><font color="#FF0000">锁定</font></td>@endif
                        <td>{{date('Y-m-d H:i:s',$e->shijian)}}</td>
                        <td>{{date('Y-m-d H:i:s',$e->lasttime)}}</td>
                        <td>{{$e->ip}}</td>
                        <td>
                            @if($e->station=='1')
                                <a href='{{URL('jb_admin/excsql/suoding/'.$e->id)}}'>锁定</a>
                            @else
                                <a href='{{URL('jb_admin/excsql/jiesuo/'.$e->id)}}'><font color="#FF0000">解锁</font></a>
                            @endif
                                | <a href='{{URL('jb_admin/admin/edit/'.$e->id)}}'>修改</a>
                                | <a href='{{URL('jb_admin/excsql/deladmin/'.$e->id)}}' onclick='delcfm()'>删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['user'=>$user,'name'=>$name,'phone'=>$phone])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>
        @elseif($do=='add')
        <div class="title"><span></span>帐号添加</div>
        <div class="user-search" style="padding-left:30%; width:60%; margin-top: 100px;">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addadminuser/')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                登录帐号：<input type="text" name="user" nullmsg="请输入登录帐号！" ajaxurl="{{URL('checkadminuser')}}" datatype="*3-20"  class="ipput" value="" /><font color="#FF0000">*</font><br />
                真实姓名：<input type="text" name="name" nullmsg="请输入真实姓名！" datatype="*"  class="ipput" value="" /><font color="#FF0000">*</font><br />
                手机号码：<input type="text" name="phone" nullmsg="请输入手机号！" datatype="m"  class="ipput" value="" /><font color="#FF0000">*</font><br />
                帐号角色：<select name="typeid" style="width:300px; height:30px; line-height:30px;">
                    @for($i=0;$i<$count;$i++)
                    <option value="{{$data[$i]->id}}">{{$data[$i]->title}}</option>
                    @endfor
                </select>
                <br />
                用户状态：<select name="station" style="width:300px; height:30px; line-height:30px;">
                    <option value="1">正常</option>
                    <option value="2">锁定</option>
                </select>
                <br />
                登陆密码：<input type="text" name="pwd" class="ipput" value="" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"  /><font color="#FF0000">*</font><br />
                确认密码：<input type="text" name="pwd1" class="ipput" value="" datatype="*" recheck="pwd" nullmsg="请再输入一次密码！" errormsg="您两次输入的账号密码不一致！" /><font color="#FF0000">*</font>
                <br />
                <input type="submit" value="" class="tianjia" />
                <a href="javascript:history.go(-1);">返回上一页</a>
            </form>
            <br /><br />
        </div>
        @elseif($do=='edit')
        <div class="title"><span></span>管理员帐号修改</div>
        <div class="user-search" style="width:70%; padding-left:20%;margin-top: 100px;">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editadminuser/'.$id)}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                登录帐号：<input type="text" name="user" class="ipput" value="{{$user}}" readonly="readonly" /><font color="#FF0000">* 不可修改</font><br />
                真实姓名：<input type="text" name="name" nullmsg="请输入真实姓名！" datatype="*"  class="ipput" value="{{$name}}" /><font color="#FF0000">*</font><br />
                用户状态：<select name="station" style="width:300px; height:30px; line-height:30px;">
                    @if($station=='0')
                        <option value="0">正常</option>
                        <option value="1">锁定</option>
                    @else
                        <option value="1">锁定</option>
                        <option value="0">正常</option>
                    @endif
                </select>
                <br />

                修改密码：<input type="text" name="pwd" class="ipput" value="" datatype="*6-16" nullmsg="请设置密码！" errormsg="密码范围在6~16位之间！"  ignore="ignore"  /><font color="#FF0000">* 不修改密码的话，请留空即可！</font><br />

                <input type="submit" value="修改" class="edit" /><a href="javascript:history.go(-1);">返回上一页</a>
            </form>
            <br /><br /><br /><br /><br /><br />
        </div>
        @endif
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

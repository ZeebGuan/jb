<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />

    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery-1.4.4.min.js')}}" type="text/javascript"></script>
    <script language="javascript">
        $(function() {
            $("#checkAll").click(function() {
                $('input[name="subBox"]').attr("checked",this.checked);
            });
            var $subBox = $("input[name='subBox']");
            $subBox.click(function(){
                $("#checkAll").attr("checked",$subBox.length == $("input[name='subBox']:checked").length ? true : false);
            });
        });
    </script>
    <SCRIPT LANGUAGE=javascript>
        function del() {
            var msg = "您真的确定要删除吗？";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        }
    </SCRIPT>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>邮件中心</a> / 收件箱</div>
        <div class="e-nav">
            <a href="{{URL('email')}}" class="shou-hover">收件箱</a>
            <a href="{{URL('email-post')}}" class="fa">发件箱</a>
            <a href="{{URL('email-write')}}" class="xie">写邮件</a>
        </div>
        <div class="e-content">
            <table width="887" align="center" bgcolor="#dededc" height="36" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="xie"><a href="email-write">写邮件</a></td>
                    <td class="xuan"><span id="chk_noall" name="chk_noall" style="cursor:pointer; ">全选</span>
                    </td>
                    <td class="del"><a href="javascript:;" onclick="action()">删除</a>
                    </td>
                    <td >

                    </td>
                </tr>
            </table>
            <form name="form2" id="form2" action="{{URL('do/delallemail')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="887" style="margin-top:20px; text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr bgcolor="#dededc" >
                        <td>选择</td>
                        <td>序号</td>
                        <td>发件人</td>
                        <td>标题</td>
                        <td>摘要</td>
                        <td>发件时间</td>
                        <td>状态</td>
                        <td>操作</td>
                    </tr>

                    @foreach($email as $e)
                        <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td><input type='checkbox' value='{{$e->id}}' name='groupid[]' /></td>
                            <td>{{$count--}}</td>
                            <td>{{$e->user}}</td>
                            <td>{{$e->title}}</td>
                            <td>{{strip_tags($e->content)}}</td>
                            <td>{{$e->shijian}}</td>
                            <td>
                            @if($e->station=='0')
                                    <font color="#FF0000">未读</font>
                                @else
                                    <font color="#0000FF">已读</font>
                                @endif
                            </td>
                            <td> <a href="{{URL('email-detal')}}/shou/{{$e->id}}">查看</a>  | <a href="{{URL('do')}}/delemail/{{$e->id}}" onclick='javascript:return del()'>删除</a> </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="7">{{$email->links()}}</td>
                    </tr>
                </table>
            </form>
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
        var msg = "您真的确定要删除吗？";
        if (confirm(msg)==true){
            document.getElementById('form2').submit();
        }else{
            return false;
        }

    }
</script>
</body>
</html>

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
    <SCRIPT LANGUAGE=javascript>
        function del() {
            var msg = "您真的确定全部标记已读吗？";
            if (confirm(msg)==true){
                return true;
            }else{
                return false;
            }
        }
        function getxiaoxi(id)
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
                        alert("您的浏览器不支持ajax");
                        return false;
                    }
                }
            }
            xmlHttp.onreadystatechange=function()
            {
                if(xmlHttp.readyState==4)
                {
                    document.getElementById("id"+id).innerHTML=xmlHttp.responseText;
                }
            }
            if(document.getElementById("id"+id).innerHTML.indexOf("xiaoxicon")>0)
            {
                var url="{{URL('getgonggao/cha/')}}/"+id;
            }
            else
            {
                var url="{{URL('getgonggao/shou/')}}/"+id;
            }
            xmlHttp.open("GET",url,true);
            xmlHttp.send(null);
        }
    </SCRIPT>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>系统公告</a></div>

        <div class="e-content">
            <table width="887" align="center" bgcolor="#dededc" height="36" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="xuan" style="width:10px;"><span id="chk_noall" name="chk_noall" style="cursor:pointer; ">全选</span>
                    </td>
                </tr>
            </table>
            <form name="form2" id="form2" action="" method="post">
                <div class="xiaoxilist" id="xiaoxilist">
                    @foreach($gonggao as $e)
                        <li id='id{{$e->id}}' onclick='getxiaoxi({{$e->id}})'>
                        <font color='#0000ff'>查看</font>
                        <span>{{$e->shijian}}</span>
                        <input type='checkbox' value='{{$e->id}}' name='groupid[]' />{{$e->title}}
                        </li>
                    @endforeach

                </div>
            </form>
            {{$gonggao->links()}}
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
        var msg = "您真的确定全部标记已读吗？";
        if (confirm(msg)==true){
            document.getElementById('form2').submit();
        }else{
            return false;
        }
    }
</script>
</body>
</html>

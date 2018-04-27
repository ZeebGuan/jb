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
        function sousuo(){
            var url="{{URL('info-index')}}/"+document.getElementById('keywords').value;
            window.location.href=url;
        }
    </script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')


<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>个人信息</a> / 我的激活码</div>
        <div class="info-nav">
            <a href="{{URL('info-index')}}" class="index-hover">我的激活码</a>
            <a href="{{URL('info-guanli')}}" class="guanli">个人资料管理</a>
            <a href="{{URL('info-pwd')}}" class="pwd">修改交易密码</a>
            <a href="{{URL('info-tuijian')}}" class="tuijian">推荐结构</a>
            <a href="{{URL('info-tuandui')}}" class="index">团队记录</a>
        </div>
        <div class="e-content">
            <form method="post" action="{{URL('do/zhuanrang')}}" class="form">
                <table width="895" align="center" bgcolor="#ffffff" height="36" border="0" cellspacing="0" cellpadding="0" style="margin-top:-20px;">
                    <tr>
                        <td width="80"> &nbsp;转让帐号:</td>
                        <td width="150"><input type="text" class="text" value="" name="user" nullmsg="请输入帐号或手机号！" datatype="*" ajaxurl="{{URL('checkuser')}}" />
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        </td>
                        <td width="50">
                            数量：
                        </td>
                        <td  width="260">
                            <input type="text" class="text" value="" name="num" nullmsg="请输入转让激活码数量！" datatype="n" ajaxurl="{{URL('checkjihuoma')}}" />
                            <input type="submit" value="转让" class="zhuan"/>

                        </td>
                        <td>
                            <a href="{{URL('info-zhuanrang')}}" style="display:block; width:100px; float:left; height:36px; line-height:36px; background:#dedede; text-align:center;">转让记录</a>
                            <a href="{{URL('info-jieshou')}}" style="display:block; margin-left: 20px; width:100px; float:left; height:36px; line-height:36px; background:#dedede; text-align:center;">接收记录</a>
                        </td>
                    </tr>
                </table>
            </form>




            <table width="895" style="margin-top:20px; text-align:center; line-height:36px;" align="center" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#dededc" >
                    <td>序号</td>
                    <td>激活码</td>
                    <td>会员名</td>
                    <td>使用用户</td>
                    <td>添加时间</td>
                    <td>使用时间</td>
                    <td>状态</td>
                </tr>
                @foreach($jihuoma as $e)
                <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                    <td>{{$count--}}</td>
                    <td>{{$e->pin}}</td>
                    <td>{{$user}}</td>
                    <td>
                        @if($e->user=='')
                            <font color="#FF0000">未使用</font>
                        @else
                        {{$e->user}}
                        @endif
                    </td>
                    <td>{{$e->sqshijian}}</td>
                    <td>
                        @if($e->syshijian=='0000-00-00 00:00:00' || $e->syshijian=='')
                            <font color="#FF0000">未使用</font>
                        @else
                           {{$e->syshijian}}
                        @endif
                    </td>
                    <td>
                        @if($e->station=='0')
                            <font color="#0000ff">未使用</font>
                        @elseif($e->station=='1')
                            已使用
                        @else
                            <font color="#FF0000">已失效</font>
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="7">{{$jihuoma->links()}}</td>
                </tr>
            </table>

        </div>

    </div>
</div>
<script language="javascript" src="{{asset('js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>匹配中心</a> / 创益币转让</div>
        <div class="info-nav">
            <a href="{{URL('chuangyibi')}}" class="index-hover">转让创益币</a>
            <a href="{{URL('chuangyibi-zhuanrang')}}" class="guanli">转让记录</a>
            <a href="{{URL('chuangyibi-jieshou')}}" class="pwd">接收记录</a>

            <a href="{{URL('chuangyibi-duihuanjilu')}}" class="tuijian" style="margin-left: 5px;">金币兑换记录</a>
        </div>
        <form class="form" action="{{URL('do/zhuanrangchuangyibi')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="info-content" style="padding-bottom:30px;">
                <div class="info-content-table" style="background:#fff;">
                    <table width="855" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="250">创益金币总数：</td>
                            <td><input type="text" class="input" name="jinbi" value="{{$jinbi}}" style="color:#f00;" readonly="readonly"  /></td>
                        </tr>
                        <tr>
                            <td align="right" width="250">创益银币总数：</td>
                            <td><input type="text" class="input" name="yinbi" value="{{$yinbi}}" style="color:#f00;" readonly="readonly"  /></td>
                        </tr>
                        <tr>
                            <td align="right">会员账户或手机号：</td>
                            <td><input type="text" class="input" name="user" value="" datatype="*" nullmsg="请输入会员账户" ajaxurl="{{URL('checkuser')}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">转让数量：</td>
                            <td><input type="text" class="input" name="num" value="1" datatype="n" nullmsg="请输入转让数量"  />
                            </td>
                        </tr>

                        <tr>
                            <td align="right">二级密码：</td>
                            <td><input type="password" class="input" name="erpwd" value="" ajaxurl="{{URL('checkerpwd')}}" datatype="*" nullmsg="请输入二级密码" /></td>
                        </tr>
                        <tr>
                            <td align="right">身份证后6位：</td>
                            <td><input type="password" class="input" name="cardnum" value="" ajaxurl="{{URL('checkcardnumlast')}}" datatype="*" nullmsg="请输入身份证后6位" /></td>
                        </tr>

                        <tr>
                            <td align="right">转让类型：</td>
                            <td align="left">
                                <input type="radio" name="type" value="1" checked />创益金币
                                <input type="radio" name="type" value="0" />创益银币
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="info-content-sub">
                <input type="submit" class="sub" value="提交保存" />
                <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
            </div>
        </form>


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

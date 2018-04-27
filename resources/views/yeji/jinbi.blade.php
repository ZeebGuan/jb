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
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>理财钱包</a> / 负数钱包转换</div>
        <div class="info-nav">
            <a href="{{URL('licai-zhuanhuan')}}" class="index">负数钱包转换</a>
            <a href="{{URL('licai-allzhuanhuan')}}" class="pwd">系统负数转换</a>
            <a href="{{URL('licai-jinbi')}}" class="award-hover" style="margin-right: 5px;">金币理财转换</a>
            <a href="{{URL('licai-zhuanhuanjilu')}}" class="guanli">理财转换记录</a>
            <a href="{{URL('licai-yinbi')}}" class="tuijian">银币天使转换</a>
        </div>
        <form class="form" action="{{URL('do/jinbilicai')}}" method="post">
            <div class="info-content">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="info-content-table"  style="background: #fff;">
                    <table width="855" border="0" align="center" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="320" align="right">创益金币：</td>
                            <td><input type="text" class="input" name="fushu" value="{{$jinbi}}" readonly/></td>
                        </tr>
                        <tr>
                            <td align="right">理财钱包：</td>
                            <td><input type="text" class="input" name="licai" value="{{$licai}}" readonly/></td>
                        </tr>
                        <tr>
                            <td align="right">转换数量：</td>
                            <td><input type="text" class="input" name="jine" value="" datatype="n" nullmsg="请输入转换数量！" errormsg="请输入10的倍数！" ajaxurl="{{URL('checkjinbilicai')}}" /> </td>
                        </tr>
                        <tr>
                            <td align="right" style="padding: 0px;"></td>
                            <td align="left" style="padding: 0px;"><font color="#ff0000">* 金币转换理财钱包比例1:50</font> </td>
                        </tr>
                        <tr>
                            <td align="right">二级密码：</td>
                            <td><input type="password" class="input" name="erpwd" value="" ajaxurl="{{URL('checkerpwd')}}" datatype="*" nullmsg="请输入二级密码" /></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><font color="#ff0000">注：转换后，将无法还原，请谨慎操作！</font> </td>
                        </tr>
                    </table>
                </div>



            </div>
            <div class="info-content-sub">
                <input type="submit" class="sub" value="转 换"  />
                <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)"  />
            </div>
        </form>
    </div>
</div>

</body>
<script language="javascript" src="{{asset('js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(".form").Validform({
        tiptype:3,
    });
</script>
</html>

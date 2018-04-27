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
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>众筹红利</a></div>
        <div class="info-nav">
            <a href="{{URL('pipei-tigong')}}" class="index">众筹参与</a>
            <a href="{{URL('pipei-qingqiu')}}" class="guanli-hover">众筹红利</a>
            <a href="{{URL('pipei-bangzhu')}}" class="pwd">参与记录</a>
            <a href="{{URL('pipei-qiuzhu')}}" class="tuijian">红利记录</a>
            <a href="{{URL('pipei-qianbao')}}" class="index">钱包明细</a>
        </div>
        <form class="form" action="{{URL('do/qiuzhu')}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="info-content" style="padding-bottom:30px;">
                <div class="info-content-table" style="background:#fff;">
                    <table width="855" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="250">本金钱包：</td>
                            <td><input type="text" class="input"  name="benjin" value="{{$user[0]->benjin}}" readonly="readonly" style="color:#f00;" /></td>
                        </tr>
                        <tr>
                            <td align="right" width="250">红利钱包：</td>
                            <td><input type="text" class="input" name="hongli" value="{{$user[0]->hongli}}" readonly="readonly" style="color:#f00;" /></td>
                        </tr>
                        <tr>
                            <td align="right" width="250">请选择钱包：</td>
                            <td align="left">
                                <input type="radio" value="0" name="type" checked/>本金钱包
                                <input type="radio" value="1" name="type" />红利钱包
                            </td>
                        </tr>

                        <tr>
                            <td align="right">众筹金额：</td>
                            <td><input type="text" class="input" style="color:#f00;" name="jine" value="" datatype="n" nullmsg="请输入众筹金额" ajaxurl="{{URL('checkqiuzhujine')}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">二级密码：</td>
                            <td><input type="password" class="input" name="erpwd" value="" ajaxurl="{{URL('checkerpwd')}}" datatype="*" nullmsg="请输入二级密码" /></td>
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
</body>
</html>

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
    <script language="javascript">
        function geterpwd()
        {
            alert('请联系客服找回二级密码!');
        }
    </script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')


<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>个性信息</a> / 修改密码</div>
        <div class="info-nav">
            <a href="{{URL('info-index')}}" class="index">我的激活码</a>
            <a href="{{URL('info-guanli')}}" class="guanli">个人资料管理</a>
            <a href="{{URL('info-pwd')}}" class="pwd-hover">修改交易密码</a>
            <a href="{{URL('info-tuijian')}}" class="tuijian">推荐结构</a>
            <a href="{{URL('info-tuandui')}}" class="index">团队记录</a>
        </div>
        <form class="form" action="{{URL('do/editpwd')}}" method="post">
        <div class="info-content">

                <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                    <div class="info-content-table"  style="background: #fff;">
                        <table width="855" border="0" align="center" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="300" align="right">会员帐号：</td>
                                <td><input type="text" class="input" name="user" value="{{$user}}" readonly="readonly" /></td>
                            </tr>
                            <tr>
                                <td  align="right">密码类型：</td>
                                <td align="left">
                                    <input type="radio" name="type" value="1" checked/>登录密码
                                    <input type="radio" name="type" value="0"/>二级密码
                                </td>
                            </tr>
                            <tr>
                                <td align="right">旧密码：</td>
                                <td><input type="password" class="input" name="pwd" value=""  nullmsg="请输入旧密码！" datatype="*" ajaxurl="{{URL('checkerpwd')}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">新密码：</td>
                                <td><input type="password" class="input" name="erpwd" value=""  nullmsg="请输入新密码！"  errormsg="只能输入8位字符,包含数字和字母"  datatype="/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/" ajaxurl="{{URL('checkpwdlen')}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">确认新密码：</td>
                                <td><input type="password" class="input" name="erpwd1" value="" datatype="*" errormsg="请输入确认密码！" recheck="erpwd" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="left"><a href="javascript:;" onclick="geterpwd()"><font color="#FF0000">找回二级密码</font></a> <span id="notice"></span></td>
                            </tr>
                        </table>
                    </div>



        </div>
        <div class="info-content-sub">
                <input type="submit" class="sub" value="提交保存"  />
                <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)"  />
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

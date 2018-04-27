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
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="{{URL('main')}}">首页</a> / <a>个人信息</a> / 个人资料管理</div>
        <div class="info-nav">
            <a href="{{URL('info-index')}}" class="index">我的激活码</a>
            <a href="{{URL('info-guanli')}}" class="guanli-hover">个人资料管理</a>
            <a href="{{URL('info-pwd')}}" class="pwd">修改交易密码</a>
            <a href="{{URL('info-tuijian')}}" class="tuijian">推荐结构</a>
            <a href="{{URL('info-tuandui')}}" class="index">团队记录</a>
        </div>
        <div class="info-content">
            @if($do=='info')
                <div class="info-content" style="padding-bottom:10px;">
                    <div class="info-content-nav">
                        <a href="{{URL('info-guanli/info')}}" class="hover">会员信息</a>
                        <a href="{{URL('info-guanli/yeji')}}">会员业绩</a>
                        <a href="{{URL('info-guanli/user')}}">账户信息</a>
                        <a href="{{URL('info-guanli/contact')}}">联系信息</a>
                    </div>
                    <div class="info-content-table">
                        <table width="855"  border="0" align="center" bgcolor="#dededc" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="290" align="right">会员帐号：</td>
                                <td><input type="text" class="input" name="phone" value="{{$userinfo[0]->user}}" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">姓名：</td>
                                <td><input type="text" class="input" name="phone" value="{{$userinfo[0]->name}}" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">性别：</td>
                                <td>
                                    <input type="text" class="input" name="sex" value="{{$userinfo[0]->sex}}" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">身份证：</td>
                                <td><input type="text" class="input" name="phone" value="******************" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">注册时间：</td>
                                <td><input type="text" class="input" name="phone" value="{{$userinfo[0]->shijian}}" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">最后登录时间：</td>
                                <td><input type="text" class="input" name="phone" value="{{$userinfo[0]->lasttime}}" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">推荐人帐号：</td>
                                <td><input type="text" class="input" name="tuijian" value="{{$tuijian}}" readonly="readonly" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                        </table>
                    </div>
                </div>
        </div>
        <div class="info-content-sub">
            <input type="submit" class="sub" value="提交保存" onclick="alert('请联系客服修改资料！')" />
            <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)"  />
        </div>

                @elseif($do=='yeji')
                <div class="info-content" style="padding-bottom:10px;">
                    <div class="info-content-nav">
                        <a href="{{URL('info-guanli/info')}}">会员信息</a>
                        <a href="{{URL('info-guanli/yeji')}}" class="hover">会员业绩</a>
                        <a href="{{URL('info-guanli/user')}}">账户信息</a>
                        <a href="{{URL('info-guanli/contact')}}">联系信息</a>
                    </div>
                    <div class="info-content-table">

                        <table width="855" border="0" align="center" bgcolor="#dededc" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="290" align="right">直推有效人数：</td>
                                <td><input type="text" readonly class="input" name="tuijian" value="{{$num}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">可用额度：</td>
                                <td><input type="text" readonly class="input" name="keyong" id="keyong" value="{{$userinfo[0]->qianbao}}" /></td>
                            </tr>

                        </table>
                    </div>
                </div>
        </div>
        <div class="info-content-sub">
            <input type="submit" class="sub" value="提交保存" onclick="alert('请联系客服修改资料！')" />
            <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)"  />
        </div>

            @elseif($do=='user')
                <div class="info-content" style="padding-bottom:10px;">
                    <div class="info-content-nav">
                        <a href="{{URL('info-guanli/info')}}">会员信息</a>
                        <a href="{{URL('info-guanli/yeji')}}">会员业绩</a>
                        <a href="{{URL('info-guanli/user')}}" class="hover">账户信息</a>
                        <a href="{{URL('info-guanli/contact')}}">联系信息</a>
                    </div>
                    <div class="info-content-table">
                        <table width="855" border="0" align="center" bgcolor="#dededc" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="290" align="right">银行名称：</td>
                                <td><input type="text" class="input" name="bankname" value="{{$userinfo[0]->bankname}}"  readonly="readonly" />
                                    <font size="-2" color="#ff0000">* 不可修改</font>

                                </td>
                            </tr>
                            <tr>
                                <td align="right">开户行：</td>
                                <td><input type="text" class="input" name="kaihuhang" value="{{$userinfo[0]->kaihuhang}}"   readonly="readonly"/>
                                    <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">银行地址：</td>
                                <td><input type="text" class="input" name="kaihudizhi" value="{{$userinfo[0]->kaihudizhi}}"   readonly="readonly"/>
                                    <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">银行户名：</td>
                                <td><input type="text" class="input" name="huming" value="{{$userinfo[0]->huming}}"  readonly="readonly" />
                                    <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">银行账户：</td>
                                <td><input type="text" class="input" name="banknum" value="{{$userinfo[0]->banknum}}" readonly="readonly" />
                                    <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">支付宝：</td>
                                <td><input type="text" class="input" name="alipay" value="{{$userinfo[0]->alipay}}"  readonly="readonly" />
                                    <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                        </table>
                    </div>
                </div>
        </div>
        <div class="info-content-sub">
            <input type="submit" class="sub" value="提交保存" onclick="alert('请联系客服修改资料！')" />
            <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)"  />
        </div>
            @elseif($do=='contact')
                <div class="info-content" style="padding-bottom:10px;">
                    <div class="info-content-nav">
                        <a href="{{URL('info-guanli/info')}}">会员信息</a>
                        <a href="{{URL('info-guanli/yeji')}}">会员业绩</a>
                        <a href="{{URL('info-guanli/user')}}">账户信息</a>
                        <a href="{{URL('info-guanli/contact')}}" class="hover">联系信息</a>
                    </div>
                    <div class="info-content-table">
                        <table width="855" border="0" align="center" bgcolor="#dededc" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="290" align="right">手机号码：</td>
                                <td><input type="text" class="input" name="phone" value="{{$userinfo[0]->phone}}" readonly="readonly" />  <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">QQ号码：</td>
                                <td><input type="text" class="input" name="qq" value="{{$userinfo[0]->qq}}"  readonly="readonly" />  <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">微信号码：</td>
                                <td><input type="text" class="input" name="weixin" value="{{$userinfo[0]->weixin}}" readonly="readonly" />  <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                            <tr>
                                <td align="right">联系地址：</td>
                                <td><input type="text" class="input" name="address" value="{{$userinfo[0]->sheng}}{{$userinfo[0]->shi}}" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </tr>
                        </table>
                    </div>
                </div>
                </div>
                <div class="info-content-sub">
                    <input type="submit" class="sub" value="提交保存" onclick="alert('请联系客服修改资料！')" />
                    <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)"  />
                </div>
            @endif

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

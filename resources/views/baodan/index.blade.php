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
    <script src="{{asset('js/city.js')}}" type="text/javascript"></script>
</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="main">首页</a> / <a>会员注册</a></div>
        <div class="b-nav">
            <a href="baodan-index" class="index-hover">会员注册</a>
            <a href="baodan-jihuo" class="jihuo">激活会员</a>
            <a href="baodan-jilu" class="jilu">激活记录</a>
            <a href="baodan-denglu" class="shenqing">登录记录</a>
        </div>
        <div class="info-content">
            @if($regstation=="1")
            <form class="form" method="post" action="{{URL('do/reg')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="info-content" style="padding-bottom:30px;">
                    <div class="info-content-table" style="background:#fff;">

                        <table width="855" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="right">会员帐号：</td>
                                <td><input type="text" class="input" id="user" name="user" value="" errormsg="只能输入数字和字母" nullmsg="请输入会员帐号！" datatype="/[A-Za-z0-9]/" ajaxurl="{{URL('checkreg')}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">登录密码：</td>
                                <td><input type="password" class="input" id="pwd" name="pwd" value="" nullmsg="请输入会员密码！" errormsg="密码为6-16位字符，包含数字和字母"  datatype="/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/" ajaxurl="{{URL('checkpwdlen')}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">确认登录密码：</td>
                                <td><input type="password" class="input" name="pwd1" value=""  datatype="*" recheck="pwd" nullmsg="请再输入一次登录密码！" errormsg="您两次输入的密码不一致！" /></td>
                            </tr>
                            <tr>
                                <td align="right">二级密码：</td>
                                <td><input type="password" class="input" id="erpwd" name="erpwd" value=""  nullmsg="请输入二级密码！" errormsg="密码为6-16位字符，包含数字和字母"  datatype="/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/" ajaxurl="{{URL('checkpwdlen')}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">确认二级密码：</td>
                                <td><input type="password" class="input" name="erpwd1" value="" datatype="*" recheck="erpwd" nullmsg="请再输入一次二级密码！" errormsg="您两次输入的密码不一致！" /></td>
                            </tr>
                            <tr>
                                <td align="right">推荐人帐号：</td>
                                <td><input type="text" class="input" name="tuijian" value="{{$user}}" nullmsg="请输入推荐人帐号！" datatype="*" ajaxurl="{{URL('checktuijian')}}" /></td>
                            </tr>
                            <tr>
                                <td align="right">姓名：</td>
                                <td><input type="text" class="input" name="name" value="" nullmsg="请输入姓名！" datatype="*" /></td>
                            </tr>
                            <tr>
                                <td align="right">性别：</td>
                                <td>
                                    <select name="sex" class="input" style="width:300px;" nullmsg="请选择性别！" datatype="*">
                                        <option value="男">男</option>
                                        <option value="女">女</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">身份证：</td>
                                <td><input type="text" class="input" name="cardnum" value="" nullmsg="请输入身份证！" datatype="idcard" errormsg="身份证号码格式错误！" ajaxurl="{{URL('checkcardnum')}}"/></td>
                            </tr>
                            <tr>
                                <td align="right">手机号码：</td>
                                <td><input type="text" class="input" name="phone" value="" datatype="m" nullmsg="请输入手机号码！"  ajaxurl="{{URL('checkreg')}}" /></td>
                            </tr>
                            <tr>
                                <td width="290" align="right">银行名称：</td>
                                <td>
                                    <select name="bankname" class="input" style="width:300px;" nullmsg="请选择银行名称！" datatype="*">
                                        @foreach($bank as $e)
                                           <option value="{{$e->title}}">{{$e->title}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">开户行：</td>
                                <td><input type="text" class="input" name="kaihuhang" value="" nullmsg="请输入开户行！" datatype="*"/></td>
                            </tr>
                            <tr>
                                <td align="right">开户地址：</td>
                                <td><input type="text" class="input" name="kaihudizhi" value="" nullmsg="请输入开户地址！" datatype="*" /></td>
                            </tr>
                            <tr>
                                <td align="right">户名：</td>
                                <td><input type="text" class="input" name="huming" recheck="name" errormsg="户名必须与真实姓名一致！" value="" nullmsg="请输入户名！" datatype="*" /></td>
                            </tr>
                            <tr>
                                <td align="right">银行帐号：</td>
                                <td><input type="text" class="input" name="banknum" value="" nullmsg="请输入银行帐号！" datatype="n" /></td>
                            </tr>
                            <tr>
                                <td align="right">支付宝：</td>
                                <td><input type="text" class="input" name="alipay" value="" /></td>
                            </tr>
                            <tr>
                                <td align="right">微信：</td>
                                <td><input type="text" class="input" name="weixin" value="" /></td>
                            </tr>
                            <tr>
                                <td align="right">QQ：</td>
                                <td><input type="text" class="input" name="qq" value="" /></td>
                            </tr>
                            <tr>
                                <td align="right">省份：</td>
                                <td><SELECT name="sheng" id="to_cn" onchange="set_city(this, document.getElementById('city')); WYL();" class="input" nullmsg="请选择省份！" datatype="*" >
                                        <option value="">请选择</option>
                                        <option value=北京>北京</option>
                                        <option value=上海>上海</option>
                                        <option value=天津>天津</option>
                                        <option value=重庆>重庆</option>
                                        <option value=河北省>河北省</option>
                                        <option value=山西省>山西省</option>
                                        <option value=辽宁省>辽宁省</option>
                                        <option value=吉林省>吉林省</option>
                                        <option value=黑龙江省>黑龙江省</option>
                                        <option value=江苏省>江苏省</option>
                                        <option value=浙江省>浙江省</option>
                                        <option value=安徽省>安徽省</option>
                                        <option value=福建省>福建省</option>
                                        <option value=江西省>江西省</option>
                                        <option value=山东省>山东省</option>
                                        <option value=河南省>河南省</option>
                                        <option value=湖北省>湖北省</option>
                                        <option value=湖南省>湖南省</option>
                                        <option value=广东省>广东省</option>
                                        <option value=海南省>海南省</option>
                                        <option value=四川省>四川省</option>
                                        <option value=贵州省>贵州省</option>
                                        <option value=云南省>云南省</option>
                                        <option value=陕西省>陕西省</option>
                                        <option value=甘肃省>甘肃省</option>
                                        <option value=青海省>青海省</option>
                                        <option value=内蒙古>内蒙古</option>
                                        <option value=广西>广西</option>
                                        <option value=西藏>西藏</option>
                                        <option value=宁夏>宁夏</option>
                                        <option value=新疆>新疆</option>
                                        <option value=香港>香港</option>
                                        <option value=澳门>澳门</option>
                                    </SELECT> </td>
                            </tr>
                            <tr>
                                <td align="right">市区：</td>
                                <td><select id="city" class="input" nullmsg="请选择市区！" datatype="*" name="shi">
                                        <option value="">请选择</option>
                                    </select> </td>
                            </tr>

                        </table>

                    </div>
                </div>
                <div class="info-content-sub">
                    <input type="submit" class="sub" value="提交保存" />
                    <input type="button" value="返回上页" class="but" onclick="history.back()" />
                </div>
            </form>
            @else
            <div class="info-content" style="padding-bottom:30px;">
                <div class="info-content-table" style="background:#fff; text-align: center; line-height: 500px; font-size: 50px; color: #ff0000;">

                    今日系统注册人数已达上限 !!!

                </div>
            </div>
            @endif


        </div>
    </div>
</div>
<script language="javascript" src="{{ asset('js/Validform_v5.3.2.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $(".form").Validform({
            tiptype:3,
            beforeSubmit:function(curform){
                var user=document.getElementById('user').value;
                var pwd=document.getElementById('pwd').value;
                var erpwd=document.getElementById('erpwd').value;
                if(user!=pwd && user!=erpwd && pwd!=erpwd){
                    return true;
                }else{
                    alert("帐号、密码、二级密码不能重复！");
                    return false;
                }
            },
            datatype:{
                "idcard":function(gets,obj,curform,datatype){
                    var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
                    var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;

                    if (gets.length == 15) {
                        return isValidityBrithBy15IdCard(gets);
                    }else if (gets.length == 18){
                        var a_idCard = gets.split("");// 得到身份证数组
                        if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {
                            return true;
                        }
                        return false;
                    }
                    return false;

                    function isTrueValidateCodeBy18IdCard(a_idCard) {

                        var sum = 0; // 声明加权求和变量
                        if (a_idCard[17].toLowerCase() == 'x') {
                            a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作
                        }
                        for ( var i = 0; i < 17; i++) {
                            sum += Wi[i] * a_idCard[i];// 加权求和
                        }
                        valCodePosition = sum % 11;// 得到验证码所位置
                        if (a_idCard[17] == ValideCode[valCodePosition]) {
                            return true;
                        }
                        return false;
                    }

                    function isValidityBrithBy18IdCard(idCard18){
                        var year = idCard18.substring(6,10);
                        var month = idCard18.substring(10,12);
                        var day = idCard18.substring(12,14);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 这里用getFullYear()获取年份，避免千年虫问题
                        if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                    function isValidityBrithBy15IdCard(idCard15){
                        var year =  idCard15.substring(6,8);
                        var month = idCard15.substring(8,10);
                        var day = idCard15.substring(10,12);
                        var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));
                        // 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法
                        if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){
                            return false;
                        }
                        return true;
                    }

                }

            }


        });
    })
</script>
</body>
</html>

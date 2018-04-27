<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="stylesheet" media="screen" type="text/css" href="{{ asset('css/login.css') }}" />
    <script src="{{ asset('js/jquery.js') }}"></script>

    <script src="{{ asset('js/city.js') }}"></script>
    <script src="{{ asset('js/jquery.nicescroll.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tongyi").click(function(){
                $("#notice").hide(2000);
            });
            $("#jujue").click(function(){
                window.location.href="{{ URL('login') }}";
            });

        });
        function getmessage()
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
            var phone=document.getElementById("phone").value;
            if(phone!="")
            {
                xmlHttp.onreadystatechange=function()
                {
                    if(xmlHttp.readyState==4)
                    {
                        document.getElementById("get").innerHTML=xmlHttp.responseText;
                    }
                }
                var url="{{URL('phonecode')}}/"+phone;
                xmlHttp.open("GET",url,true);
                xmlHttp.send(null);
            }
            else
            {
                alert("请输入手机号码");
            }
        }

    </script>
    @if(\App\Http\Controllers\FunctionController::siteinfo('station')=="0")
        <script language=javascript>window.top.location.href='{{URL('update')}}';</script>";}
    @endif
</head>

<body>
@if($regstation==0)
<div id="notice" onclick="window.location.href='{{URL('/')}}'">
    <div class="con">
        <div class="content" >
            <h1 style="padding-top: 200px; font-size: 44px;">今日系统注册人数已达上限 !!!</h1>
        </div>
    </div>
</div>
@endif
<div id="notice">
    <div class="con" style="height:420px;">
        <div class="content">
            <h1>公众创益风险提示</h1><br>
            <p>公众创益平台，响应国家号召“以大众创业 万众创新”为指导，以“消费资本论”为依据，以“法商管理”为基准，将资本经济和实体经济相结合，设计打造经济闭环生态圈，创新驱动发展实体。由于模式创新在社会实践中无法给您任何承诺，盈亏风险理性自担。请您参与之前认真阅读以下条款：
            </p>
            <p>1、公众创益平台仅作为明日众购商城的推广平台，非盈利和担保机构；</p>
            <p>2、谢绝公务员、军人、教师、学生参与。参与者要用非关键资金理性参与，投资的风险参与者自行承担；</p>
            <p> 3、无论是平台还是推广者，推广中均不得承诺兜底；</p>
            <p> 4、拒绝一人多号的小号现象，发现损失自担。（如推荐人和参与者均为一人即自己推荐自己）；</p>
            <p> 5、倡导小额参与大胆推广，实现短期收益和长期分红。</p>
            <p>创新有风险，投资需谨慎</p>
            <p align="right">公众创益运营中心<br>2018年3月1日</p>
        </div>
        <div class="button">
            <input type="button" class="submit" value="我已阅读以上资料,同意并继续" name="tongyi" id="tongyi">
            <input type="button" class="submit jujue" value="我不同意以上资料,退出注册" name="jujue" id="jujue">
        </div>
    </div>
</div>

<div id="reg">
    <div class="reg">
        <div class="top"><a href="{{ URL('/') }}"></a></div>
        <div class="con">
            <form class="form" method="post" action="{{URL('checkreguser')}}">
                <li><div class="left">会员帐号</div><input type="text" class="input" id="user" name="user" errormsg="只能输入数字和字母" value="" nullmsg="请输入会员帐号！" datatype="/[A-Za-z0-9]/" ajaxurl="{{ URL('checkreg') }}" />
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </li>
                <li><div class="left">登录密码</div><input type="password" errormsg="密码为6-16位字符，包含数字和字母" class="input" id="pwd" name="pwd" value="" nullmsg="请输入会员密码！" datatype="/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/" ajaxurl="{{ URL('checkpwdlen') }}"/></li>
                <li><div class="left">确认登录密码</div><input type="password" class="input" name="pwd1" value=""  datatype="*8-20" recheck="pwd" nullmsg="请再输入一次登录密码！" errormsg="您两次输入的密码不一致！" /></li>
                <li><div class="left">二级密码</div><input type="password" class="input" id="erpwd" name="erpwd" value="" nullmsg="请输入二级密码！" datatype="*6-20" /></li>
                <li><div class="left">确认二级密码</div><input type="password" class="input" name="erpwd1" value="" datatype="*" recheck="erpwd" nullmsg="请再输入一次二级密码！" errormsg="您两次输入的密码不一致！" /></li>
                <li><div class="left">推荐人帐号</div><input type="text" class="input" name="tuijian" value="{{$user}}" nullmsg="请输入推荐人帐号！" datatype="*" ajaxurl="{{URL('checktuijian')}}" /></li>
                <li><div class="left">姓名</div><input type="text" class="input" name="name" value="" nullmsg="请输入姓名！" datatype="*" /></li>
                <li><div class="left">性别</div><select name="sex" class="input" style="width:363px;" nullmsg="请选择性别！" datatype="*">
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select></li>
                <li><div class="left">身份证</div><input type="text" class="input" name="cardnum" value="" nullmsg="请输入身份证！" datatype="idcard" errormsg="身份证号码格式错误！" ajaxurl="{{URL('checkcardnum')}}" /></li>

                <li><div class="left">银行名称</div><select name="bankname" class="input" style="width:363px;" nullmsg="请选择银行名称！" datatype="*">
                    @foreach($bank as $bankname)
                    <option value="{{$bankname->title}}">{{$bankname->title}}</option>
                    @endforeach
                    </select></li>
                <li><div class="left">开户行</div><input type="text" class="input" name="kaihuhang" value="" nullmsg="请输入开户行！" datatype="*"/></li>
                <li><div class="left">开户地址</div><input type="text" class="input" name="kaihudizhi" value="" nullmsg="请输入开户地址！" datatype="*" /></li>
                <li><div class="left">户名</div><input type="text" class="input" name="huming" recheck="name" errormsg="户名必须与真实姓名一致！"  value="" nullmsg="请输入户名！" datatype="*" /></li>
                <li><div class="left">银行帐号</div><input type="text" class="input" name="banknum" value="" nullmsg="请输入银行帐号！" datatype="*" /></li>
                <li><div class="left">支付宝</div><input type="text" class="input" name="alipay" value="" /></li>
                <li><div class="left">微信</div><input type="text" class="input" name="weixin" value="" /></li>
                <li><div class="left">QQ</div><input type="text" class="input" name="qq" value="" /></li>
                <li><div class="left">手机号码</div><input type="text" class="input" name="phone" value="" nullmsg="请输入手机号码！" datatype="m" id="phone"  ajaxurl="{{URL('checkreg')}}" /></li>
                <li><div class="left">省份</div>
                    <SELECT name="sheng" id="to_cn" onchange="set_city(this, document.getElementById('city')); WYL();" class="input" nullmsg="请选择省份！" datatype="*" >
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
                    </SELECT>
                </li>

                <li><div class="left">市区</div>
                    <select id="city" class="input" nullmsg="请选择市区！" datatype="*" name="shi">
                        <option value="">请选择</option>
                    </select>
                    <div class="Validform_checktip" id="get"></div>

                </li>



                <li><div class="left">手机验证码</div><input type="text" ajaxurl="{{URL('checkphonecode')}}"  name="code" class="code" value="请输入验证码" onfocus="if(this.value=='请输入验证码'){this.value='';}" onblur="if(this.value==''){this.value='请输入验证码';}" nullmsg="请输入手机验证码！" datatype="n6-6"  />
                    <input type="button" class="get"  id="btn" value="获取手机验证码"/>
                    <div class="Validform_checktip" id="get"></div>

                </li>
                <li><div class="left"></div><input type="submit" value="注册" class="sub" /></li>
                <li><div class="left"></div><a href="{{ URL('login') }}">登录</a><span></span><a href="{{ URL('resetpwd') }}">忘记密码</a></li>
            </form>

        </div>
        <div class="notice">
            <b>温馨提示:</b><br>
            注册姓名,身份证,银行卡必须真实对应,如有错误将认证失败!
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

<script type="text/javascript">
    var wait=60;
    function time(o)
    {
        if (wait == 0) {
            o.removeAttribute("disabled");
            o.value="免费获取验证码";
            wait = 60;
            document.getElementById("btn").style.backgroundColor="#09F";
        }
        else
        {
            o.setAttribute("disabled", true);
            o.value="重新发送(" + wait + ")";
            wait--;
            setTimeout(function() {
                        time(o)
                    },
                    1000)
        }
    }
    document.getElementById("btn").onclick=function()
    {
        if(document.getElementById("phone").value!="")
        {
            time(this);
            getmessage();
            document.getElementById("btn").style.backgroundColor="#ccc";
        }
        else
        {
            alert("请输入手机号码！");
        }

    }
</script>
</body>
</html>
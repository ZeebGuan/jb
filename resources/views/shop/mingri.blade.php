<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{$sitename}}</title>
    <meta name="Keywords" content="{{$keyword}}">
    <meta name="description" content="{{$description}}" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="{{asset('css/shop-style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('js/nav.js')}}"></script>
</head>

<body>
@include('shop.top')
<div class="clear"></div>
<div id="content">
    <div class="content">
        <div class="top"><p>会员中心</p></div>
        <div class="left">
            <li><a class="icon1" href="{{URL('shop/center')}}">我的账户</a></li>
            <li><a class="icon2" href="{{URL('shop/duihuanbi')}}">创益币兑换</a></li>
            <li class="hover"><a class="icon2" href="{{URL('shop/mingri')}}">明日钱包转换</a></li>
            <li><a class="icon4" href="{{URL('shop/duihuanjhm')}}">激活码兑换</a></li>
            <li><a class="icon6" href="{{URL('shop/xiadan')}}">下单记录</a></li>
            <li><a class="icon7" href="{{URL('shop/dizhi')}}">收寄地址</a></li>
        </div>
        <div class="right">
            @if($type=='0')
                <div class="con" style=" padding-top:50px;font-size: 28px; font-weight: bolder; color: #ff0000;">
                    您的手机号没有对应的明日帐号
                </div>
            @elseif($type=='1')
                <div class="con" style="margin-top: 20px;">
                    <form action="{{URL('shop/do/zhuanhuanmingri')}}"  method="post" class="form">
                        <input readonly type="text" class="text" value="会员姓名："/>
                        <input readonly type="text" class="text1" id="name" name="name" value="{{$name}}"/>
                        <input readonly type="text" class="text" value="会员帐号："/>
                        <input readonly type="text" class="text1" id="user" name="user" value="{{$user}}"/>
                        <input readonly type="text" class="text" value="冻结钱包："/>
                        <input readonly type="text" class="text1" id="qianbao" name="qianbao" value="{{$dj}}"/>
                        <input readonly type="text" class="text" value="会员收益："/>
                        <input readonly type="text" class="text1" id="shouyi" name="shouyi" value="{{$shouyi}}"/>
                        <div id="dh" style="display: block;">
                            <p><b>*</b> 收益为负数才可以转换明日钱包，正数不可转换。</p>
                            <p><b>*</b> 转换将消耗冻结钱包金额，负数将全额转换，每个账号只可转换一次，请确认后在进行操作。</p>

                            @if($shouyi<0)
                            <input type="submit" class="botton" value="转换" />
                            @else
                            <input type="button" onclick="alert('收益为负数才可以转换，您不符合条件！')" class="botton" value="转换" />
                            @endif
                        </div>
                    </form>
                </div>
                @else
                    <div class="con" style=" padding-top:10px;font-size: 28px; font-weight: bolder; color: #ff0000;">
                        <input readonly type="text" class="text" value="明日钱包："/>
                        <input readonly type="text" class="text1" id="name" name="name" value="{{$data[0]->jine}}"/>
                        <input readonly type="text" class="text" value="转换时间："/>
                        <input readonly type="text" class="text1" id="user" name="user" value="{{$data[0]->shijian}}"/>
                        <div id="dh" style="display: block;">
                            <p><b>*</b> 每个账户只能转换一次</p>
                        </div>
                    </div>

            @endif


        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>
@include('shop.foot')
</body>
</html>
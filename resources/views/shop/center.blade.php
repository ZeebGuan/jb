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
            <li class="hover"><a class="icon1" href="{{URL('shop/center')}}">我的账户</a></li>
            <li><a class="icon2" href="{{URL('shop/duihuanbi')}}">创益币兑换</a></li>
            <li><a class="icon2" href="{{URL('shop/mingri')}}">明日钱包转换</a></li>
            <li><a class="icon4" href="{{URL('shop/duihuanjhm')}}">激活码兑换</a></li>
            <li><a class="icon6" href="{{URL('shop/xiadan')}}">下单记录</a></li>
            <li><a class="icon7" href="{{URL('shop/dizhi')}}">收寄地址</a></li>
        </div>
        <div class="right">
            <div class="con">
                <input readonly type="text" class="text" value="会员姓名："/>
                <input readonly type="text" class="text1" value="{{$data[0]->name}}"/>
                <input readonly type="text" class="text" value="会员帐号："/>
                <input readonly type="text" class="text1" value="{{$data[0]->user}}"/>
                <input readonly type="text" class="text" value="创益金币："/>
                <input readonly type="text" class="text1" value="{{$data[0]->jinbi}}"/>
                <input readonly type="text" class="text" value="创益银币："/>
                <input readonly type="text" class="text1" value="{{$data[0]->yinbi}}"/>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<div class="clear"></div>
@include('shop.foot')
</body>
</html>
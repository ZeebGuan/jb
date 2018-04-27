<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>首页-</title>
    <meta name="Keywords" content="">
    <meta name="description" content="" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script language="javascript" src="js/jquery.js"></script>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="tuiguang">
        <div class="yaoqing">我的邀请链接 <input id="foo" class="url" type="text"  value="{{URL('reg')}}/{{$tuijian}}"></div>
        <button class="btn fuzhi"  data-clipboard-action="copy" data-clipboard-target="#foo">复制</button>
        <a href="/erweima/" target="right" class="erweima">邀请二维码</a>

    </div>
    <div class="paidaninfo">
        <span class="pd">今日所需众筹<br /><div id="paidan">{{$nowpaidan}}</div></span>
        <span class="pd1">目前众筹金额<br /><div id="paidan">{{$totelpaidan}}</div></span>
    </div>
    <div class="totel">
        <span class="pd">负数钱包<br /><div id="paidan">{{$fushu}}</div></span>
        <span class="jt">本金钱包<br /><div id="jingtai">{{$user[0]->benjin}}</div></span>
        <span class="dt">红利钱包<br /><div id="dongtai">{{$user[0]->hongli}}</div></span>
        <span class="gl">众购钱包<br /><div id="guanli">{{$user[0]->zhonggou}}</div></span>
        <span class="wd">天使资本<br /><div id="qianbao">{{$user[0]->qianbao}}</div></span>
    </div>
    <div class="nav">
        <a href="pipei-tigong" class="o">众筹参与<br />Public participation</a>
        <a href="pipei-qingqiu" class="g">众筹红利<br />All chips bonus</a>
        <a href="pipei-bangzhu" class="w">记录查询<br />To match</a>
    </div>
    <div class="tongji">
        <img src="{{asset('images/dst.png')}}" alt="" width="930"/>
    </div>
</div>
<script src="{{asset('js/clipboard.min.js')}}"></script>
<script>
    var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
</script>
</body>
</html>

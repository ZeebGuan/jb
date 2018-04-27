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
            <li class="hover"><a class="icon2" href="{{URL('shop/duihuanbi')}}">创益币兑换</a></li>
            <li><a class="icon2" href="{{URL('shop/mingri')}}">明日钱包转换</a></li>
            <li><a class="icon4" href="{{URL('shop/duihuanjhm')}}">激活码兑换</a></li>
            <li><a class="icon6" href="{{URL('shop/xiadan')}}">下单记录</a></li>
            <li><a class="icon7" href="{{URL('shop/dizhi')}}">收寄地址</a></li>
        </div>
        <div class="right">
            @if($type=='1')
                <div class="nav">
                    <a href="{{URL('shop/duihuanbi')}}">创益币兑换</a>
                    <a href="{{URL('shop/duihuanbi')}}?do=jilu"  class="hover">兑换记录</a>
                </div>
                <div class="list">
                    <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                        <tr bgcolor="#dedede">
                            <td>序号</td>
                            <td>会员帐号</td>
                            <td>兑换数量</td>
                            <td>时间</td>
                            <td>类型</td>
                        </tr>
                        @foreach($data as $e)
                            <tr>
                                <td>{{$count--}}</td>
                                <td>{{$e->user}}</td>
                                <td>{{$e->num}}</td>
                                <td>{{$e->shijian}}</td>
                                @if($e->type=='0')
                                    <td>创益银币</td>
                                @else
                                    <td>创益金币</td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9">{{$data->appends(['do'=>'jilu'])->links()}}</td>
                        </tr>


                    </table>
                </div>

            @else

                <div class="nav">
                    <a href="{{URL('shop/duihuanbi')}}" class="hover">创益币兑换</a>
                    <a href="{{URL('shop/duihuanbi')}}?do=jilu">兑换记录</a>
                </div>
                <div class="con" style="margin-top: 20px;">
                    <form action="{{URL('shop/do/duihuanbi')}}"  method="post" class="form">
                        <input readonly type="text" class="text" value="会员姓名："/>
                        <input readonly type="text" class="text1" id="name" name="name" value="{{$name}}"/>
                        <input readonly type="text" class="text" value="会员帐号："/>
                        <input readonly type="text" class="text1" id="user" name="user" value="{{$user}}"/>
                        <input readonly type="text" class="text" value="冻结钱包："/>
                        <input readonly type="text" class="text1" id="qianbao" name="qianbao" value="{{$dj}}"/>
                        <input readonly type="text" class="text" value="会员收益："/>
                        <input readonly type="text" class="text1" id="shouyi" name="shouyi" value="{{$shouyi}}"/>
                        <div id="dh" style="display: block;">
                            <p><b>*</b> 收益为负数将兑换创益金币，比例为1:50  收益为正数将兑换创益银币，比例为1:100</p>
                            <p><b>*</b> 兑换将消耗冻结钱包金额，金币兑换不得超出会员的负数上限。</p>
                            <input readonly type="text" class="text" value="兑换创益币数量："/>
                            <input type="text" class="text1" id="num" name="num" value="" nullmsg="请输入数量！" errormsg="请输入数字！" datatype="n"/>
                            <input type="submit" class="botton" value="兑换" />
                        </div>
                    </form>
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
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
            <li><a class="icon2" href="{{URL('shop/mingri')}}">明日钱包转换</a></li>
            <li class="hover"><a class="icon4" href="{{URL('shop/duihuanjhm')}}">激活码兑换</a></li>
            <li><a class="icon6" href="{{URL('shop/xiadan')}}">下单记录</a></li>
            <li><a class="icon7" href="{{URL('shop/dizhi')}}">收寄地址</a></li>
        </div>
        <div class="right">
            @if($type=='1')
                <div class="nav">
                    <a href="{{URL('shop/duihuanjhm')}}">激活码兑换</a>
                    <a href="{{URL('shop/duihuanjhm')}}?do=jilu"  class="hover">兑换记录</a>
                </div>
                <div class="list">
                    <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                        <tr bgcolor="#dedede">
                            <td>序号</td>
                            <td>会员帐号</td>
                            <td>会员姓名</td>
                            <td>兑换激活码数量</td>
                            <td>时间</td>
                        </tr>
                        @foreach($data as $e)
                            <tr>
                                <td>{{$count--}}</td>
                                <td>{{$e->user}}</td>
                                <td>{{$e->name}}</td>
                                <td>{{$e->num}}</td>
                                <td>{{$e->shijian}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9">{{$data->appends(['do'=>'jilu'])->links()}}</td>
                        </tr>


                    </table>
                </div>

            @else

                <div class="nav">
                    <a href="{{URL('shop/duihuanjhm')}}" class="hover">激活码兑换</a>
                    <a href="{{URL('shop/duihuanjhm')}}?do=jilu" >兑换记录</a>
                </div>
                <div class="con" style="margin-top: 40px;">
                    <form action="{{URL('shop/do/duihuanjihuoma')}}" method="post" class="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input readonly type="text" class="text" value="创益金币数量："/>
                        <input type="text" class="text1" name="jinbi" value="{{$user[0]->jinbi}}" readonly />
                        <input readonly type="text" class="text" value="兑换激活码数量："/>
                        <input type="text" class="text1" name="num" value="" datatype="n" nullmsg="请输入数量！"/>
                        <input readonly type="text" class="text" value="二级密码："/>
                        <input type="password" class="text1" ajaxurl="{{URL('checkerpwd')}}" name="pwd" value="" datatype="*" nullmsg="请输入二级密码！" />
                        <div class="tips">* 4个创益金币兑换一个激活码</div>
                        <input type="submit" class="botton" value="兑换"/>
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
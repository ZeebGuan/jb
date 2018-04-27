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
            <li><a class="icon4" href="{{URL('shop/duihuanjhm')}}">激活码兑换</a></li>
            <li><a class="icon6" href="{{URL('shop/xiadan')}}">下单记录</a></li>
            <li class="hover"><a class="icon7" href="{{URL('shop/dizhi')}}">收寄地址</a></li>
        </div>
        <div class="right">
            @if($type=='1')
                <div class="nav">
                    <a href="/shop/dizhi">添加收货地址</a>
                    <a href="/shop/dizhi?do=list" class="hover">收货地址管理</a>
                </div>
                <div class="list">
                    <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                        <tr bgcolor="#dedede">
                            <td>序号</td>
                            <td>姓名</td>
                            <td>电话</td>
                            <td>收货地址</td>
                            <td>操作</td>
                        </tr>
                        @foreach($data as $e)
                            <tr>
                                <td>{{$count--}}</td>
                                <td>{{$e->name}}</td>
                                <td>{{$e->phone}}</td>
                                <td>{{$e->dizhi}}</td>
                                @if($e->type=='1')
                                    <td><font color='#ff0000'>默认地址</font></td>
                                @else
                                    <td><a href="{{URL('shop/do/morendizhi/'.$e->id)}}">设为默认地址</a> </td>
                                @endif
                            </tr>
                        @endforeach


                    </table>
                </div>

            @else
                <div class="nav">
                    <a href="/shop/dizhi" class="hover">添加收货地址</a>
                    <a href="/shop/dizhi?do=list">收货地址管理</a>
                </div>
                <div class="con" style="margin-top: 40px;">
                    <form action="{{URL('shop/do/adddizhi')}}" method="post" class="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <input readonly type="text" class="text" value="姓名：" />
                        <input readonly type="text" class="text1" name="name" value="{{$user[0]->name}}"/><font>* 不可修改</font>
                        <input readonly type="text" class="text" value="手机号："/>
                        <input readonly type="text" class="text1" name="phone" value="{{$user[0]->phone}}" /><font>* 不可修改</font>
                        <input readonly type="text" class="text" value="地址："/>
                        <input type="text" class="text1" name="dizhi" value="" datatype="*" nullmsg="请输入联系地址！" />
                        <input readonly type="text" class="text" value="是否设为默认地址："/>
                        <div class="type">
                            <input type="radio" value="1" name="type" checked/> 是 &nbsp;&nbsp;
                            <input type="radio" value="0" name="type"/> 否
                        </div>
                        <input type="submit" class="botton" value="添加"/>
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
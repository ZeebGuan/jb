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
            <li class="hover"><a class="icon6" href="{{URL('shop/xiadan')}}">下单记录</a></li>
            <li><a class="icon7" href="{{URL('shop/dizhi')}}">收寄地址</a></li>
        </div>
        <div class="right">
            @if($type=='1')
                <div class="nav">
                    <a href="{{URL('shop/xiadan')}}">商品购买记录</a>
                    <a href="{{URL('shop/xiadan')}}?do=zhongchou"  class="hover">众筹跟投记录</a>
                </div>
                <div class="list">
                    <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                        <tr bgcolor="#dedede">
                            <td>序号</td>
                            <td>众筹项目</td>
                            <td>投标数量</td>
                            <td>单价</td>
                            <td>姓名</td>
                            <td>电话</td>
                            <td>收货地址</td>
                            <td>支付类型</td>
                            <td>状态</td>
                        </tr>
                        @foreach($data as $e)
                            <tr>
                                <td>{{$count--}}</td>
                                <td>{{$e->title}}</td>
                                <td>{{$e->num}}</td>
                                <td>{{$e->jiage}}</td>
                                <td>{{$e->name}}</td>
                                <td>{{$e->phone}}</td>
                                <td>{{$e->dizhi}}</td>
                                @if($e->type=='1')
                                    <td><font color='#ff0000'>创益金币</font></td>
                                @else
                                    <td>创益银币</td>
                                @endif
                                @if($e->station=='1')
                                    <td><font color='#ff0000'>已完成</font></td>
                                @else
                                    <td>已提交</td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9">{{$data->appends(['do'=>'zhongchou'])->links()}}</td>
                        </tr>


                    </table>
                </div>

            @else

                <div class="nav">
                    <a href="{{URL('shop/xiadan')}}" class="hover">商品购买记录</a>
                    <a href="{{URL('shop/xiadan')}}?do=zhongchou" >众筹跟投记录</a>
                </div>
                <div class="list">
                    <table width="100%" border="0" style="text-align:center" cellpadding="0" cellspacing="0">
                        <tr bgcolor="#dedede">
                            <td>序号</td>
                            <td>商品名称</td>
                            <td>购买数量</td>
                            <td>单价</td>
                            <td>姓名</td>
                            <td>电话</td>
                            <td>收货地址</td>
                            <td>支付类型</td>
                            <td>状态</td>
                        </tr>
                        @foreach($data as $e)
                            <tr>
                                <td>{{$count--}}</td>
                                <td>{{$e->title}}</td>
                                <td>{{$e->num}}</td>
                                <td>{{$e->jiage}}</td>
                                <td>{{$e->name}}</td>
                                <td>{{$e->phone}}</td>
                                <td>{{$e->dizhi}}</td>
                                @if($e->type=='1')
                                    <td><font color='#ff0000'>创益金币</font></td>
                                @else
                                    <td>创益银币</td>
                                @endif
                                @if($e->station=='1')
                                    <td><font color='#ff0000'>已完成</font></td>
                                @else
                                    <td>已提交</td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9">{{$data->links()}}</td>
                        </tr>

                    </table>
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
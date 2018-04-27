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
    <script language="javascript" type="text/javascript" src="{{asset('js/WdatePicker.js')}}"></script>
    <script src="{{asset('js/jquery-1.4.4.min.js')}}" type="text/javascript"></script>
    <SCRIPT LANGUAGE=javascript>
        function queren() {
            @if($order[0]->paystation=='2')
             alert("订单已确认收款，请勿重复操作！");
            @elseif($order[0]->paystation=='1')
            var msg = "是否要确认收款？";
            if (confirm(msg)==true){
                window.location.href='{{URL('do/querenfukuan/'.$id)}}';
            }else{
                return false;
            }
            @elseif($order[0]->paystation=='0')
            alert("订单尚未付款！");
            @endif
        }

    </SCRIPT>

</head>
<body style="background:url({{asset('images/main-bg_03.png')}}) repeat-y 40px 0px #dededc;" topmargin="0" leftmargin="0" rightmargin="0">
@include('member.top')
<div id="main">
    <div class="email">
        <div class="e-location"><a href="javascript:history.go(-1)">返回</a> / <a href="main">首页</a> / <a>匹配中心</a> / 匹配订单详情</div>
        @if($do=='1')
        <div class="info-nav">
            <a href="{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/order"
               @if($type=='order')class="index-hover"@else class="index"@endif
            >查看资料</a>
            <a href="{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/userinfo"
               @if($type=='userinfo')class="pwd-hover"@else class="pwd"@endif
            >账户信息</a>
            @if($order[0]->paystation=='0')
            <a href="{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/tongyi"
               @if($type=='payinfo')class="guanli-hover"@else class="guanli"@endif
            >提交付款资料</a>
            @else
                <a href="{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/payinfo"
                   @if($type=='payinfo')class="guanli-hover"@else class="guanli"@endif
                >付款信息</a>
            @endif
            <a href="{{URL('pipei-jilu')}}/{{$do}}/{{$offer[0]->orderid}}/{{$orderid}}" class="tuijian">返回匹配记录</a>
        </div>
            @if($type=='order')
                <div class="e-content">
                    <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="300" align="right">单号：</td>
                            <td><input type="text" readonly="readonly" class="input" name="orderid" value="{{$order[0]->orderid}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">接收人会员号：</td>
                            <td><input type="text" readonly="readonly" class="input" name="userid" value="{{$user[0]->user}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">接收人姓名：</td>
                            <td><input type="text" readonly="readonly" class="input" name="name" value="{{$user[0]->name}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">会员级别：</td>
                            <td><input type="text" readonly="readonly" class="input" name="name" value="{{\App\Http\Controllers\AdminmemberController::userjibie($user[0]->jibie)}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">匹配金额：</td>
                            <td><input type="text" readonly="readonly" class="input" name="jine" value="{{$order[0]->jine}}" /></td>
                        </tr>

                        <tr>
                            <td align="right">联系电话：</td>
                            <td><input type="text" readonly="readonly" class="input" name="phone" value="{{$user[0]->phone}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">推荐人姓名：</td>
                            <td><input type="text" readonly="readonly" class="input" name="name1" value="@if(!empty($tuijian)){{$tuijian[0]->name}} @else 公众创益 @endif" /></td>
                        </tr>
                        <tr>
                            <td align="right">推荐人电话：</td>
                            <td><input type="text" readonly="readonly" class="input" name="phone1" value="@if(!empty($tuijian)){{$tuijian[0]->phone}} @else 公众创益 @endif" /></td>
                        </tr>
                        <tr>
                            <td align="right">匹配时间：</td>
                            <td><input type="text" readonly="readonly" class="input" name="ppshijian" value="{{$order[0]->shijian}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">状态：</td>

                            <td><input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="@if($order[0]->paystation=='0')未付款@elseif($order[0]->paystation=='1')已付款@else 已收款@endif" /></td>
                        </tr>
                    </table>
                </div>

                <div class="e-content-sub">
                    @if($order[0]->paystation=='0')
                    <input type="button" class="sub" value="同意付款" onclick="window.location.href='{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/tongyi'" />
                    <input type="button" class="sub jujue" value="拒绝付款" onclick="window.location.href='{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/jujue'"/>
                    <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                    @else
                    <input type="button" value="返回上页" class="but" style="margin-left: 180px;" onclick="javascript:history.go(-1)" />
                    @endif
                </div>
            @elseif($type=='userinfo')
                <div class="e-content">
                    <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="300" align="right">银行名称：</td>
                            <td><input type="text" readonly="readonly" class="input" name="bankname" value="{{$user[0]->bankname}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">开户行：</td>
                            <td><input type="text" readonly="readonly" class="input" name="kaihuhang" value="{{$user[0]->kaihuhang}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">银行地址：</td>
                            <td><input type="text" readonly="readonly" class="input" name="kaihudizih" value="{{$user[0]->kaihudizhi}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">户名：</td>
                            <td><input type="text" readonly="readonly" class="input" name="huming" value="{{$user[0]->huming}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">银行卡号：</td>
                            <td><input type="text" readonly="readonly" class="input" name="banknum" value="{{$user[0]->banknum}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">支付宝：</td>
                            <td><input type="text" readonly="readonly" class="input" name="alipay" value="{{$user[0]->alipay}}" /></td>
                        </tr>
                    </table>
                </div>
                <div class="e-content-sub">
                    @if($order[0]->paystation=='0')
                        <input type="button" class="sub" value="同意付款" onclick="window.location.href='{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/tongyi'" />
                        <input type="button" class="sub jujue" value="拒绝付款" onclick="window.location.href='{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/jujue'"/>
                        <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                    @else
                        <input type="button" value="返回上页" class="but" style="margin-left: 180px;" onclick="javascript:history.go(-1)" />
                    @endif
                </div>
            @elseif($type=='payinfo')
                <div class="e-content">
                    <table width="887" align="center" style="line-height:50px; padding-left:50px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="400" align="left">&nbsp;&nbsp;&nbsp;请输入转账日期：</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="right"><input type="text" class="date" value="{{$order[0]->paytime}}" name="paytime"  readonly="readonly"/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;&nbsp;&nbsp;付款订单信息：</td>
                            <td>备注信息：</td>
                        </tr>
                        <tr>
                            <td align="left"></td>
                            <td rowspan="2" valign="top"><textarea name="beizhu" class="beizhu" id="beizhu" nullmsg="请输入备注信息！" style="height:270px" datatype="*" >{{$order[0]->beizhu}}</textarea></td>
                        </tr>
                        <tr>
                            <td align="left"><img src="/images/pic.png" id="imgurl" width="247" height="213" style="margin-top:10px; margin-left:10px;" />
                                <div id="notice"></div>

                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="e-content-sub">
                    <input type="button" style="margin-left:150px;" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                </div>
            @elseif($type=='tongyi')
                <form name="form1" class="form" action="{{URL('do/tongyifukuan/'.$id)}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="e-content">
                        <table width="887" align="center" style="line-height:50px; padding-left:50px;" border="0" cellspacing="0" cellpadding="0">
                            @if($order[0]->paystation=='0')
                            <tr>
                                <td width="400" align="left">&nbsp;&nbsp;&nbsp;请输入转账日期：</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td align="right"><input type="text" class="date" value="<?php echo date("Y-m-d H:i:s");?>" name="paytime" nullmsg="请选择付款时间！" datatype="*"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td align="left">&nbsp;&nbsp;&nbsp;请选择需要插入的图片：</td>
                                <td>请输入备注信息：</td>
                            </tr>
                            <tr>
                                <td align="left">

                                </td>
                                <td rowspan="2" valign="top"><textarea name="beizhu" class="beizhu" id="beizhu"  style="height:270px" nullmsg="请输入备注信息！" datatype="*" ></textarea></td>
                            </tr>
                            <tr>
                                <td align="left"><img src="/images/pic.png" id="imgurl" width="247" height="213" style="margin-top:10px; margin-left:10px;" />
                                    <div id="notice"></div>
                                    <input type="hidden" name="pic" value="" id="pic" />
                                </td>
                                <td>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td align="center" height="500"><font size="+5" color="#FF0000">已提交付款资料</font></td>

                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="e-content-sub">
                        <input type="submit" class="sub" value="提 交" style="margin-left:130px;" />
                        <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                    </div>
                </form>
            @elseif($type=='jujue')
                <form name="form1" class="form" action="{{URL('do/jujuefukuan/'.$id)}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="e-content">
                        <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td width="300" align="right"></td>
                                <td>拒绝理由：</td>
                            </tr>
                            <tr>
                                <td align="right"></td>
                                <td><textarea name="beizhu" class="beizhu" id="beizhu" nullmsg="请输入拒绝理由！" datatype="*" ></textarea></td>
                            </tr>
                            <tr>
                                <td align="right"></td>
                                <td><font color="#FF0000">备注：请提供充分的拒绝理由，不然会导致永久封号！</font></td>
                            </tr>
                        </table>
                    </div>
                    <div class="e-content-sub">
                        <input type="submit" class="sub" value="提 交" style="margin-left:130px;" />
                        <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                    </div>
                </form>
            @endif

        @elseif($do=='2')
            <div class="info-nav">
                <a href="{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/order"
                @if($type=='order')class="index-hover"@else class="index"@endif
                >查看资料</a>
                <a href="{{URL('pipei-info')}}/{{$do}}/{{$orderid}}/{{$id}}/payinfo"
                   @if($type=='payinfo')class="guanli-hover"@else class="guanli"@endif
                >付款信息</a>
                <a href="{{URL('pipei-jilu')}}/{{$do}}/{{$offer[0]->orderid}}/{{$orderid}}" class="tuijian">返回匹配记录</a>
            </div>
            @if($type=='order')
                <div class="e-content">
                    <table width="887" align="center" style="line-height:50px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="300" align="right">单号：</td>
                            <td><input type="text" readonly="readonly" class="input" name="orderid" value="{{$order[0]->pipeiid}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">打款人会员号：</td>
                            <td><input type="text" readonly="readonly" class="input" name="userid" value="{{$user[0]->user}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">打款人姓名：</td>
                            <td><input type="text" readonly="readonly" class="input" name="name" value="{{$user[0]->name}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">会员级别：</td>
                            <td><input type="text" readonly="readonly" class="input" name="name" value="{{\App\Http\Controllers\AdminmemberController::userjibie($user[0]->jibie)}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">匹配金额：</td>
                            <td><input type="text" readonly="readonly" class="input" name="jine" value="{{$order[0]->jine}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">联系电话：</td>
                            <td><input type="text" readonly="readonly" class="input" name="phone" value="{{$user[0]->phone}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">推荐人姓名：</td>
                            <td><input type="text" readonly="readonly" class="input" name="name1" value="@if(!empty($tuijian)){{$tuijian[0]->name}} @else 公众创益 @endif" /></td>
                        </tr>
                        <tr>
                            <td align="right">推荐人电话：</td>
                            <td><input type="text" readonly="readonly" class="input" name="phone1" value="@if(!empty($tuijian)){{$tuijian[0]->phone}} @else 公众创益 @endif" /></td>
                        </tr>
                        <tr>
                            <td align="right">匹配时间：</td>
                            <td><input type="text" readonly="readonly" class="input" name="ppshijian" value="{{$order[0]->shijian}}" /></td>
                        </tr>
                        <tr>
                            <td align="right">状态：</td>
                            <td><input type="text" readonly="readonly" style="color:#F00" class="input" name="station" value="@if($order[0]->paystation=='0')未付款@elseif($order[0]->paystation=='1')已付款@else 已收款@endif" /></td>
                        </tr>
                    </table>
                </div>

                <div class="e-content-sub">
                    <input type="button" style="margin-left:100px;" value="确认收款" class="sub" onclick="queren()" />
                    <input type="button" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                </div>
            @elseif($type=='payinfo')
                <div class="e-content">
                    <table width="887" align="center" style="line-height:50px; padding-left:50px;" border="0" cellspacing="0" cellpadding="0">
                        @if($order[0]->paystation=='0')
                        <tr>
                            <td colspan="2" align="center">
                                <br />
                                <br />
                                <font color="#FF0000" size="+5">订单尚未付款！</font>
                                <br />
                                <br />
                                <br />
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td width="400" align="left">&nbsp;&nbsp;&nbsp;打款时间：</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="right"><input type="text" class="date" value="{{$order[0]->paytime}}" name="paytime"  readonly="readonly"/></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td align="left">&nbsp;&nbsp;&nbsp;付款订单信息：</td>
                            <td>备注信息：</td>
                        </tr>
                        <tr>
                            <td align="left"></td>
                            <td rowspan="2" valign="top"><textarea name="beizhu" class="beizhu" id="beizhu" nullmsg="请输入备注信息！" style="height:270px" datatype="*" >{{$order[0]->beizhu}}</textarea></td>
                        </tr>
                        <tr>
                            <td align="left"><img src="/images/pic.png" id="imgurl" width="247" height="213" style="margin-top:10px; margin-left:10px;" />
                                <div id="notice"></div>

                            </td>
                            <td>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
                <div class="e-content-sub">
                    <input type="button" style="margin-left:150px;" value="返回上页" class="but" onclick="javascript:history.go(-1)" />
                </div>

            @else
                <script language="javascript">window.location.href='{{URL('logout')}}'</script>
            @endif
        @else
            <script language="javascript">window.location.href='{{URL('logout')}}'</script>
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

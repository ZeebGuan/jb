<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript" src="{{asset('js/city.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('5538830c29f8a8e4/member/'.$do)}}?user={{$user}}&jibie={{$jibie}}&orderstation={{$orderstation}}&jine={{$jine}}&jine1={{$jine1}}&type={{$type}}&cardnum={{$cardnum}}&phone={{$phone}}&name={{$name}}&start={{$start}}&end={{$end}}&userid={{$userid}}&tuijian={{$tuijian}}&station={{$station}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }

        }
        function queren(msg)
        {
            if(!confirm(msg))
            {
                window.event.returnValue = false;
            }
        }

    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    <div class="user">
        @if($do=='list')
        <div class="title"><span></span>会员搜索</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/list')}}">
                &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                会员编号：<input type="text" name="userid" class="text" value="{{$userid}}" />
                手机号：<input type="text" name="phone" class="text" value="{{$phone}}" />
                姓名：<input type="text" name="name" class="text" value="{{$name}}" />
                推荐人ID：<input type="text" name="tuijian" class="text" value="{{$tuijian}}" />
                状态：
                    <select name="jibie" style="height:28px;">
                        @if($jibie!='')
                            <option value="{{$jibie}}">{!! \App\Http\Controllers\AdminmemberController::userjibie($jibie) !!}</option>
                        @endif
                        <option value="">全部</option>
                        {!! \App\Http\Controllers\AdminmemberController::jibie() !!}
                    </select>
                <br />
                &nbsp;身份证号码：<input type="text" name="cardnum" class="text" value="{{$cardnum}}" />
                状态：
                <select name="station" style="height:28px;">
                    @if($station=='0')
                        <option value="0">未激活</option>
                        <option value="">全部</option>
                        <option value="1">已激活</option>
                        <option value="2">封号</option>
                        <option value="3">冻结</option>
                        <option value="4">正常</option>
                    @elseif($station=='1')
                        <option value="1">已激活</option>
                        <option value="">全部</option>
                        <option value="0">未激活</option>
                        <option value="2">封号</option>
                        <option value="3">冻结</option>
                        <option value="4">正常</option>
                    @elseif($station=='2')
                        <option value="2">封号</option>
                        <option value="">全部</option>
                        <option value="0">未激活</option>
                        <option value="1">已激活</option>
                        <option value="3">冻结</option>
                        <option value="4">正常</option>
                    @elseif($station=='3')
                        <option value="3">冻结</option>
                        <option value="">全部</option>
                        <option value="0">未激活</option>
                        <option value="1">已激活</option>
                        <option value="2">封号</option>
                        <option value="4">正常</option>
                    @elseif($station=='4')
                        <option value="4">正常</option>
                        <option value="">全部</option>
                        <option value="0">未激活</option>
                        <option value="1">已激活</option>
                        <option value="2">封号</option>
                        <option value="3">冻结</option>
                    @else
                        <option value="">全部</option>
                        <option value="0">未激活</option>
                        <option value="1">已激活</option>
                        <option value="2">封号</option>
                        <option value="3">冻结</option>
                        <option value="4">正常</option>
                    @endif
                </select>

                是否排单：
                <select name="orderstation" style="height:28px;">
                    @if($orderstation=='0')
                        <option value="0">未排单</option>
                        <option value="">全部</option>
                        <option value="1">已排单</option>
                    @elseif($orderstation=='1')
                        <option value="1">已排单</option>
                        <option value="">全部</option>
                        <option value="0">未排单</option>
                    @else
                        <option value="">全部</option>
                        <option value="0">未排单</option>
                        <option value="1">已排单</option>
                    @endif
                </select>

                &nbsp;注册时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                <input type="submit" value="查找" class="goback" /> <a href="{{URL('5538830c29f8a8e4/member/list')}}">清楚搜索条件</a>
            </form>
        </div>
        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td>会员编号</td>
                    <td>会员名</td>
                    <td>手机号</td>
                    <td>真实姓名</td>
                    <td>推荐人ID</td>
                    <td>众筹参与额度</td>
                    <td>当前排单额</td>
                    <td>注册时间</td>
                    <td>@if($station=='2')封号时间 @elseif($station=='3')冻结时间@else 激活时间@endif</td>
                    <td>状态</td>
                    <td>是否排单</td>
                    <td>团队人数</td>
                    <td>会员级别</td>
                    <td>金币</td>
                    <td>银币</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td width="80">{{$e->id}}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->phone,$phone,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->tuijian,$tuijian,$color = "red") !!}</td>
                        <td>{!! $e->tigongedu !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::guadan($e->id) !!}</td>
                        <td>{!! $e->shijian !!}</td>
                        <td>
                            @if($station=='2')
                                {!! $e->fhshijian !!}
                            @elseif($station=='3')
                                {!! $e->djshijian !!}
                            @else
                                @if($e->jhshijian=='' || $e->jhshijian=='0000-00-00 00:00:00')
                                    <font color="#FF0000">未激活</font>
                                @else
                                    {!! $e->jhshijian !!}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($e->station=='0')
                                <font color="#FF0000">未激活</font>
                            @elseif($e->station=='1')
                                <font color="#00ff00">已激活</font>
                            @elseif($e->station=='2')
                                <font color="#ff0000">封号</font>
                            @elseif($e->station=='3')
                                <font color="#0000ff">冻结</font>
                            @endif

                        </td>
                        <td>
                            @if($e->isorder=='0')
                                <font color="#0000ff">未排单</font>
                            @else
                                <font color="#ff0000">已排单</font>
                            @endif
                        </td>
                        <td>{!! $e->totel !!}</td>
                        <td>{!! $e->title !!}</td>
                        <td>{!! $e->jinbi !!}</td>
                        <td>{!! $e->yinbi !!}</td>
                        <td>
                            <a href="{{URL('5538830c29f8a8e4/member/info/'.$e->id)}}">查看资料</a> |
                            @if($e->station=='2')
                                <a href="{{URL('5538830c29f8a8e4/excsql/jiefeng/'.$e->id)}}" onclick="queren('确定解封吗？')"><font color="#ff0000">解封</font></a>
                                @if($e->delstation=='1')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/chongzhi/'.$e->id)}}" onclick="queren('确定要重置吗？')"><font color="#ff0000">重置</font></a>
                                @endif
                            @else
                                <a href="{{URL('5538830c29f8a8e4/excsql/fenghao/'.$e->id)}}" onclick="queren('确定封号吗？')">封号</a>
                            @endif
                            @if($e->station=='0')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/jihuo/'.$e->id)}}" onclick="queren('确定要激活该帐号吗？')">激活会员</a>
                            @endif
                            @if($e->station=='3')
                                    | <a href="{{URL('5538830c29f8a8e4/excsql/jiedong/'.$e->id)}}" onclick="queren('确定要解冻该帐号吗？')">解冻</a>
                            @endif
                            @if(\App\Http\Controllers\AdminmemberController::paidan($e->id)=='0')
                                | <a href="{{URL('5538830c29f8a8e4/excsql/deluser/'.$e->id)}}" onclick="queren('确定要删除该帐号吗？')">删除</a>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['user'=>$user,'jibie'=>$jibie,'userid'=>$userid,'phone'=>$phone,'name'=>$name,'tuijian'=>$tuijian,'cardnum'=>$cardnum,'station'=>$station,'orderstation'=>$orderstation,'start'=>$start,'end'=>$end])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>
            @elseif($do=='tuandui')
                <div class="title"><span></span>团队记录搜索</div>
                <div class="user-search">
                    <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/tuandui')}}">
                        &nbsp;会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />

                        &nbsp;时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                        至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                        <input type="submit" value="查找" class="goback" /> <a href="{{URL('5538830c29f8a8e4/member/tuandui')}}">清楚搜索条件</a>
                    </form>
                </div>
                <div class="user-list">
                    <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                        <tr class="tr">
                            <td>序号</td>
                            <td>跳转会员账户</td>
                            <td>跳转会员姓名</td>
                            <td>会员名</td>
                            <td>时间</td>
                            <td>备注</td>
                        </tr>
                        @foreach($data as $e)
                            <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td width="80">{{$count--}}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                                <td>{!! $e->reguser !!}</td>
                                <td>{!! $e->shijian !!}</td>
                                <td>{!! $e->beizhu !!}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="user-page">
                    <div align="center">{{$data->appends(['user'=>$user,'start'=>$start,'end'=>$end])->links()}}</div>
                    <input class="text" type="text" name="page" id="page" value="" />
                    <input type="submit" class="sub" value="GO" onclick="gotopage()" />
                </div>
        @elseif($do=='info')
        <div class="title"><span></span>会员信息</div>
        <div class="user-search">
            <br />
            <form name="form1" class="myform"  action="{{URL('5538830c29f8a8e4/excsql/edituser/'.$data[0]->id)}}" method="post">
                <table width="100%" style="font-size:14px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="200" align="right">会员ID:</td>
                        <td>{{$data[0]->id}}</td>
                    </tr>

                    @if($power=='1')
                    <tr>
                        <td align="right">会员帐号:</td>
                        <td><input type="text"  name="user" value="{{$data[0]->user}}" class="input" /> </td>
                    </tr>
                    <tr>
                        <td align="right">推荐人帐号:</td>
                        <td><input type="text" name="tuijian" value="{{\App\Http\Controllers\FunctionController::userinfo($data[0]->tuijian,'user')}}" datatype="*" class="input" ajaxurl="{{URL('checkuser')}}"  /> </td>
                    </tr>
                        <tr>
                            <td align="right">会员级别:</td>
                            <td>
                                <select name="jibie" class="input">
                                    <option value="{{$data[0]->jibie}}">{!! \App\Http\Controllers\AdminmemberController::userjibie($data[0]->jibie) !!}</option>
                                    {!! \App\Http\Controllers\AdminmemberController::jibie() !!}
                                </select>
                            </td>
                        </tr>
                    <tr>
                        <td align="right">团队人数:</td>
                        <td><input type="text" name="totel" value="{{$data[0]->totel}}" class="input"  /> </td>
                    </tr>
                    <tr>
                        <td align="right">排单币:</td>
                        <td><input type="text" name="paidanbi" value="{{$data[0]->paidanbi}}" class="input"  /> </td>
                    </tr>
                    <tr>
                        <td align="right">创益金币:</td>
                        <td><input type="text" name="jinbi" value="{{$data[0]->jinbi}}" class="input"  /> </td>
                    </tr>
                    <tr>
                        <td align="right">创益银币:</td>
                        <td><input type="text" name="yinbi" value="{{$data[0]->yinbi}}" class="input"  /> </td>
                    </tr>
                        <tr>
                            <td align="right">登录密码:</td>
                            <td><input type="text" name="pwd" value="{{\App\Http\Controllers\FunctionController::authcode($data[0]->pwd,'DECODE','e8fe11ba8061',0)}}" class="input" /> </td>
                        </tr>
                        <tr>
                            <td align="right">二级密码:</td>
                            <td><input type="text" name="erpwd" value="{{\App\Http\Controllers\FunctionController::authcode($data[0]->erpwd,'DECODE','e8fe11ba8061',0)}}" class="input" /> </td>
                        </tr>
                    @else
                        <tr>
                            <td align="right">会员帐号:</td>
                            <td><input type="text"  name="user" value="{{$data[0]->user}}" class="input" readonly /> </td>
                        </tr>
                        <tr>
                            <td align="right">推荐人帐号:</td>
                            <td><input type="text" name="tuijian" value="{{\App\Http\Controllers\FunctionController::userinfo($data[0]->tuijian,'user')}}"  class="input" readonly  /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                        </tr>
                        <tr>
                            <td align="right">会员级别:</td>
                            <td><input type="text"  name="jibie" value="{!! \App\Http\Controllers\AdminmemberController::userjibie($data[0]->jibie) !!}" class="input" readonly />  <font size="-2" color="#ff0000">* 不可修改</font></td>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">团队人数:</td>
                            <td><input type="text" name="totel" value="{{$data[0]->totel}}" class="input"  /> </td>
                        </tr>
                        <tr>
                            <td align="right">排单币:</td>
                            <td><input type="text" name="paidanbi" value="{{$data[0]->paidanbi}}" class="input" readonly /> <font size="-2" color="#ff0000">* 不可修改</font>  </td>
                        </tr>
                        <tr>
                            <td align="right">创益金币:</td>
                            <td><input type="text" name="jinbi" value="{{$data[0]->jinbi}}" class="input" readonly /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                        </tr>
                        <tr>
                            <td align="right">创益银币:</td>
                            <td><input type="text" name="yinbi" value="{{$data[0]->yinbi}}" class="input" readonly /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                        </tr>
                        <tr>
                            <td align="right">登录密码:</td>
                            <td><input type="text" name="pwd" readonly value="{{\App\Http\Controllers\FunctionController::authcode($data[0]->pwd,'DECODE','e8fe11ba8061',0)}}" class="input" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                        </tr>
                        <tr>
                            <td align="right">二级密码:</td>
                            <td><input type="text" name="erpwd" readonly value="{{\App\Http\Controllers\FunctionController::authcode($data[0]->erpwd,'DECODE','e8fe11ba8061',0)}}" class="input" /> <font size="-2" color="#ff0000">* 不可修改</font></td>
                        </tr>
                    @endif
                    <tr>
                        <td align="right">真实姓名:</td>
                        <td><input type="text" name="name" value="{{$data[0]->name}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">性别:</td>
                        <td><input type="text" name="sex" value="{{$data[0]->sex}}" class="input"  /></td>
                    </tr>
                    <tr>
                        <td align="right">身份证号码:</td>
                        <td><input type="text" name="cardnum" value="{{$data[0]->idcard}}" class="input"/></td>
                    </tr>
                    <tr>
                        <td align="right">手机号码:</td>
                        <td><input type="text" name="phone" value="{{$data[0]->phone}}" class="input"  /></td>
                    </tr>
                    <tr>
                        <td align="right">银行类型:</td>
                        <td><input type="text" name="bankname" value="{{$data[0]->bankname}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">开户行:</td>
                        <td><input type="text" name="kaihuhang" value="{{$data[0]->kaihuhang}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">开户地址:</td>
                        <td><input type="text" name="kaihudizhi" value="{{$data[0]->kaihudizhi}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">户名:</td>
                        <td><input type="text" name="huming" value="{{$data[0]->huming}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">银行卡号:</td>
                        <td><input type="text" name="banknum" value="{{$data[0]->banknum}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">微信号:</td>
                        <td><input type="text" name="weixin" value="{{$data[0]->weixin}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">支付宝:</td>
                        <td><input type="text" name="alipay" value="{{$data[0]->alipay}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">QQ:</td>
                        <td><input type="text" name="qq" value="{{$data[0]->qq}}" class="input" /></td>
                    </tr>
                    <tr>
                        <td align="right">联系地址：</td>
                        <td><input type="text" class="input" name="address" value="{{$data[0]->sheng.$data[0]->shi}}" /> <font color="#FF0000">如要修改，把这里清空，选择下面省市</font></td>
                    </tr>

                    <tr>
                        <td align="right">省份：</td>
                        <td><SELECT name="sheng" id="to_cn" onchange="set_city(this, document.getElementById('city')); WYL();" class="input" >
                                <option value="">请选择省份</option>
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
                        <td><select id="city" class="input"  name="shi">
                                <option value="">请选择市区</option>
                            </select> </td>
                    </tr>
                    <tr>
                        <td align="right">注册时间:</td>
                        <td>{{$data[0]->shijian}}</td>
                    </tr>
                    <tr>
                        <td align="right">激活时间:</td>
                        <td>{{$data[0]->jhshijian}}</td>
                    </tr>
                    <tr>
                        <td align="right">最后一次登录时间:</td>
                        <td>{{$data[0]->lasttime}}</td>
                    </tr>
                    <tr>
                        <td align="right">最后一次登录地址:</td>
                        <td>{{$data[0]->ip}}</td>
                    </tr>
                    <tr>
                        <td align="right"><input type="hidden" name="_token" value="{{csrf_token()}}"/></td>
                        <td><input type="submit" value="修改" style=" width:100px; height:40px; background:#dedede; border:none; cursor:pointer; margin-top:30px; margin-right:10px;"/><input type="button" value="返回上一页" style=" width:100px; height:40px; background:#dedede; border:none; cursor:pointer; margin-top:30px;" onclick="javascript:history.go(-1)" /></td>
                    </tr>
                </table>
            </form>

            <br /><br /><br /><br />

        </div>

        @elseif($do=='reg')
        <div class="title"><span></span>会员注册</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('5538830c29f8a8e4/excsql/reg')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="855" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right">会员帐号：</td>
                        <td><input type="text" class="input" name="user" value="" nullmsg="请输入会员帐号！" datatype="*" ajaxurl="{{URL('checkreg')}}" /></td>
                    </tr>
                    <tr>
                        <td align="right">登录密码：</td>
                        <td><input type="password" class="input" name="pwd" value="" nullmsg="请输入会员密码！" datatype="*6-20" /></td>
                    </tr>
                    <tr>
                        <td align="right">确认登录密码：</td>
                        <td><input type="password" class="input" name="pwd1" value=""  datatype="*" recheck="pwd" nullmsg="请再输入一次登录密码！" errormsg="您两次输入的密码不一致！" /></td>
                    </tr>
                    <tr>
                        <td align="right">二级密码：</td>
                        <td><input type="password" class="input" name="erpwd" value="" nullmsg="请输入二级密码！" datatype="*6-20" /></td>
                    </tr>
                    <tr>
                        <td align="right">确认二级密码：</td>
                        <td><input type="password" class="input" name="erpwd1" value="" datatype="*" recheck="erpwd" nullmsg="请再输入一次二级密码！" errormsg="您两次输入的密码不一致！" /></td>
                    </tr>
                    <tr>
                        <td align="right">推荐人帐号:</td>
                        <td><input type="text" class="input Validform_error" name="tuijian" value="" nullmsg="请输入推荐人帐号！" datatype="*" ajaxurl="{{URL('checktuijian')}}"></td>
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
                        <td><input type="text" class="input" name="cardnum" value=""  nullmsg="请输入身份证！" datatype="idcard" errormsg="身份证号码格式错误！" /></td>
                    </tr>
                    <tr>
                        <td align="right">手机号码：</td>
                        <td><input type="text" class="input" name="phone" value="" nullmsg="请输入手机号码！" datatype="n"  ajaxurl="{{URL('checkreg')}}" /></td>
                    </tr>
                    <tr>
                        <td width="290" align="right">银行名称：</td>
                        <td>
                            <select name="bankname" class="input" style="width:300px;" nullmsg="请选择银行名称！" datatype="*">

                                @for($i=0;$i<count($data);$i++)
                                    <option value="{{$data[$i]->title}}">{{$data[$i]->title}}</option>
                                @endfor
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
                        <td><input type="text" class="input" name="banknum" value="" nullmsg="请输入银行帐号！" datatype="*" /></td>
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
                        <td><SELECT name="sheng" id="to_cn" onchange="set_city(this, document.getElementById('city')); WYL();" class="input" >
                                <option value="">请选择省份</option>
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
                        <td><select id="city" class="input"  name="shi">
                                <option value="">请选择市区</option>
                            </select> </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><input type="submit" value="注册会员" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                    </tr>


                </table>
                <br /> <br /> <br /> <br />
            </form>
        </div>
        <div class="user-list">
        </div>
        @elseif($do=='shouyi')
            <div class="title"><span></span>会员搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/shouyi')}}">
                    &nbsp;会员收益查询：<input type="text" name="user" class="text" value="{{$user}}" />
                    <input type="submit" value="查找" class="goback" />
                </form>
            </div>

            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px; border:none; font-size:32px;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td height="500" width="560" align="left" style=" background:url({{asset('images/20131015115548254.jpg')}}) no-repeat">

                        </td>
                        <td height="500" align="left">
                            总收益：<font color="#FF0000" size="+3">{{$jine}}</font>
                        </td>

                    </tr>
                </table>
            </div>
        @elseif($do=='qianbao')
            <div class="title"><span></span>钱包明细搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/qianbao')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    类型：
                    <select name="type">
                        @if($type!='')
                            <option value="{{$type}}">{{$type}}</option>
                        @endif
                        <option value="">全部</option>
                        <option value="众筹参与">众筹参与</option>
                        <option value="众筹分红">众筹分红</option>
                        <option value="众筹红利">众筹红利</option>
                        <option value="预存释放">预存释放</option>
                        <option value="预存分红">预存分红</option>
                        <option value="明日释放">明日释放</option>
                        <option value="明日分红">明日分红</option>
                        <option value="推广工资">推广工资</option>
                        <option value="参与奖励">参与奖励</option>
                        <option value="预存冻结释放">预存冻结释放</option>
                        <option value="明日冻结释放">明日冻结释放</option>
                        <option value="首推奖励">首推奖励</option>
                        <option value="购物返利">购物返利</option>
                        <option value="负数转换">负数转换</option>
                        <option value="订单处理">订单处理</option>
                            <option value="银币转换">银币转换</option>
                            <option value="钱包释放">钱包释放</option>
                            <option value="实体众筹">实体众筹</option>
                    </select>
                    <input type="submit" value="查找" class="button" /><a href="{{URL('5538830c29f8a8e4/member/qianbao')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>金额统计</div>
            <div class="user-search" style="line-height: 60px;font-size: 20px;">
                &nbsp;
                @if($type!='')
                    {{$type}}:
                @else
                    总金额:
                @endif
                <font color="#ff0000" size="+3">{{$totel1}}</font>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>会员姓名</td>
                        <td>操作前金额</td>
                        <td>金额</td>
                        <td>操作后金额</td>
                        <td>时间</td>
                        <td>备注</td>

                    </tr>
                    @foreach($data as $e)
                        @if(\App\Http\Controllers\AdminmemberController::ispaidan($e->id,$start)=='0')
                            <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td>{!! $count-- !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                                <td>{!! $e->name !!}</td>
                                <td>{!! $e->oldnum !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->num }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->num }}</font>
                                    @endif
                                </td>
                                <td>{!! $e->nownum !!}</td>
                                <td>{!! $e->shijian !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->beizhu }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->beizhu }}</font>
                                    @endif
                                </td>

                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'type'=>$type,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='benjin')
            <div class="title"><span></span>本金钱包明细搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/benjin')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    类型：
                    <select name="type">
                        @if($type!='')
                            <option value="{{$type}}">{{$type}}</option>
                        @endif
                        <option value="">全部</option>
                        <option value="众筹参与">众筹参与</option>
                        <option value="众筹本金">众筹本金</option>
                        <option value="理财释放">理财释放</option>
                    </select>
                    <input type="submit" value="查找" class="button" /><a href="{{URL('5538830c29f8a8e4/member/benjin')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>金额统计</div>
            <div class="user-search" style="line-height: 60px;font-size: 20px;">
                &nbsp;
                @if($type!='')
                    {{$type}}:
                @else
                    总金额:
                @endif
                <font color="#ff0000" size="+3">{{$totel1}}</font>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>会员姓名</td>
                        <td>操作前金额</td>
                        <td>金额</td>
                        <td>操作后金额</td>
                        <td>时间</td>
                        <td>备注</td>

                    </tr>
                    @foreach($data as $e)
                        @if(\App\Http\Controllers\AdminmemberController::ispaidan($e->id,$start)=='0')
                            <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td>{!! $count-- !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                                <td>{!! $e->name !!}</td>
                                <td>{!! $e->oldnum !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->num }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->num }}</font>
                                    @endif
                                </td>
                                <td>{!! $e->nownum !!}</td>
                                <td>{!! $e->shijian !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->beizhu }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->beizhu }}</font>
                                    @endif
                                </td>

                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'type'=>$type,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='hongli')
            <div class="title"><span></span>红利钱包明细搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/hongli')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    类型：
                    <select name="type">
                        @if($type!='')
                            <option value="{{$type}}">{{$type}}</option>
                        @endif
                        <option value="">全部</option>
                        <option value="众筹分红">众筹分红</option>
                        <option value="推广工资">推广工资</option>
                        <option value="负数释放">负数释放</option>
                        <option value="负数分红">负数分红</option>
                        <option value="删除订单">删除订单</option>
                        <option value="购物返利">购物返利</option>
                        <option value="众筹红利">众筹红利</option>
                        <option value="众购转换">众购转换</option>
                            <option value="钱包释放">钱包释放</option>
                            <option value="实体众筹">实体众筹</option>
                    </select>
                    <input type="submit" value="查找" class="button" /><a href="{{URL('5538830c29f8a8e4/member/hongli')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>金额统计</div>
            <div class="user-search" style="line-height: 60px;font-size: 20px;">
                &nbsp;
                @if($type!='')
                    {{$type}}:
                @else
                    总金额:
                @endif
                <font color="#ff0000" size="+3">{{$totel1}}</font>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>会员姓名</td>
                        <td>操作前金额</td>
                        <td>金额</td>
                        <td>操作后金额</td>
                        <td>时间</td>
                        <td>备注</td>

                    </tr>
                    @foreach($data as $e)
                        @if(\App\Http\Controllers\AdminmemberController::ispaidan($e->id,$start)=='0')
                            <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td>{!! $count-- !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                                <td>{!! $e->name !!}</td>
                                <td>{!! $e->oldnum !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->num }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->num }}</font>
                                    @endif
                                </td>
                                <td>{!! $e->nownum !!}</td>
                                <td>{!! $e->shijian !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->beizhu }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->beizhu }}</font>
                                    @endif
                                </td>

                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'type'=>$type,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='zhonggou')
            <div class="title"><span></span>众购钱包明细搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/zhonggou')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    类型：
                    <select name="type">
                        @if($type!='')
                            <option value="{{$type}}">{{$type}}</option>
                        @endif
                        <option value="">全部</option>
                        <option value="众筹参与">众筹参与</option>
                        <option value="推广工资">推广工资</option>
                        <option value="负数分红">负数分红</option>
                        <option value="众购转换">众购转换</option>
                    </select>
                    <input type="submit" value="查找" class="button" /><a href="{{URL('5538830c29f8a8e4/member/zhonggou')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>金额统计</div>
            <div class="user-search" style="line-height: 60px;font-size: 20px;">
                &nbsp;
                @if($type!='')
                    {{$type}}:
                @else
                    总金额:
                @endif
                <font color="#ff0000" size="+3">{{$totel1}}</font>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>会员姓名</td>
                        <td>操作前金额</td>
                        <td>金额</td>
                        <td>操作后金额</td>
                        <td>时间</td>
                        <td>备注</td>

                    </tr>
                    @foreach($data as $e)
                        @if(\App\Http\Controllers\AdminmemberController::ispaidan($e->id,$start)=='0')
                            <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td>{!! $count-- !!}</td>
                                <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                                <td>{!! $e->name !!}</td>
                                <td>{!! $e->oldnum !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->num }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->num }}</font>
                                    @endif
                                </td>
                                <td>{!! $e->nownum !!}</td>
                                <td>{!! $e->shijian !!}</td>
                                <td>
                                    @if($e->nownum<$e->oldnum)
                                        <font color="#0000ff">{{ $e->beizhu }}</font>
                                    @else
                                        <font color="#ff0000">{{ $e->beizhu }}</font>
                                    @endif
                                </td>

                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'type'=>$type,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>

        @elseif($do=='zhucechaxun')
            <div class="title"><span></span>注册查询</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/zhucechaxun')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" datatype="*" nullmsg="请输入会员帐号" />
                    注册时间：<input type="text" name="start" datatype="*" nullmsg="请选择开始时间" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" datatype="*" nullmsg="请选择结束时间" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    是否排过单：
                    <select name="type">
                        @if($type=='2')
                            <option value="2">否</option>
                            <option value="0">全部</option>
                            <option value="1">是</option>
                        @elseif($type=='1')
                            <option value="1">是</option>
                            <option value="0">全部</option>
                            <option value="2">否</option>
                        @else
                            <option value="0">全部</option>
                            <option value="1">是</option>
                            <option value="2">否</option>
                        @endif
                    </select>
                    <input type="submit" value="查询" class="button" /> <a href="{{URL('5538830c29f8a8e4/member/zhucechaxun')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="user-page" style="text-align: center; font-size: 24px; color: #FF0000; border-top: 2px solid #dedede; padding: 50px 0px;">
                @if($i=='-1')
                    帐号不存在
                @elseif($i=='-2')
                    请输入帐号并且选择注册时间段
                @else
                    总注册人数：<b>{!! $i !!}</b>
                @endif
            </div>
        @elseif($do=='paidanshuaxin')
            <div class="title"><span></span>刷新排单统计</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/paidanshuaxin')}}">
                    下单时间：<input type="text" name="start" datatype="*" nullmsg="请选择开始时间" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" datatype="*" nullmsg="请选择结束时间" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    团队人数：<input type="text" name="num" class="text" value="{{$num}}" datatype="*" nullmsg="请输入团队人数" />
                    <input type="submit" value="执行刷新" class="button" /> <a href="{{URL('5538830c29f8a8e4/member/paidanshuaxin')}}">清楚搜索条件</a>
                </form>
            </div>
            <div style="width:100%;float:left; margin-top:20px; padding: 100px 0px; margin-bottom:50px;text-align: center; font-size: 24px; color: #000000; border-top: 2px solid #dedede;">
                @if($i=='-1')
                    请输入帐号并且选择下单时间段
                @elseif($i=='-2')
                    执行完成了
                @elseif($i=='-3')
                    直推数不足10个，自动跳过<br><br>
                    如果没有自动跳转到下一个，<a href="{{URL('5538830c29f8a8e4/member/paidanshuaxin')}}?start={{$start}}&end={{$end}}&num={{$num}}&page={{$page+1}}"><font color="#ff0000">点击这里</font></a>
                    <script language="JavaScript">
                        function goto(){
                            window.location.href='{{URL('5538830c29f8a8e4/member/paidanshuaxin')}}?start={{$start}}&end={{$end}}&num={{$num}}&page={{$page+1}}';
                        }
                        setTimeout(goto,3000);
                    </script>
                @else
                    团队人数大于{{$num}}帐号总数： <font color="#ff0000">{!! $totel1 !!}</font> <br><br>
                    当前刷新第 <font color="#ff0000">{!! $page !!}</font> 个帐号<br><br>
                    会员ID：<font color="#ff0000">{!! $totel2 !!}</font><br><br>
                    会员帐号：<font color="#ff0000">{!! $totel3 !!}</font><br><br>
                    团队数：<font color="#ff0000">{!! $totel4 !!}</font><br><br>
                    总排单：<font color="#ff0000">{!! $totel5 !!}</font><br><br>
                    平均排单：<font color="#ff0000">{!! round($totel5/$totel4) !!}</font><br><br>
                    如果没有自动跳转到下一个，<a href="{{URL('5538830c29f8a8e4/member/paidanshuaxin')}}?start={{$start}}&end={{$end}}&num={{$num}}&page={{$page+1}}"><font color="#ff0000">点击这里</font></a>
                    <script language="JavaScript">
                        function goto(){
                            window.location.href='{{URL('5538830c29f8a8e4/member/paidanshuaxin')}}?start={{$start}}&end={{$end}}&num={{$num}}&page={{$page+1}}';
                        }
                        setTimeout(goto,3000);
                    </script>
                @endif
            </div>
        @elseif($do=='paidanhedui')
            <div class="title"><span></span>核对排单统计</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/paidanhedui')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" datatype="*" nullmsg="请输入团队人数" />
                    下单时间：<input type="text" name="start" datatype="*" nullmsg="请选择开始时间" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" datatype="*" nullmsg="请选择结束时间" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    <input type="submit" value="查询" class="button" /> <a href="{{URL('5538830c29f8a8e4/member/paidanhedui')}}">清楚搜索条件</a>
                </form>
            </div>
            <div style="width:100%;float:left; margin-top:20px; padding: 50px 0px; margin-bottom:50px;text-align: center; font-size: 24px; color: #000000; border-top: 2px solid #dedede;">
                @if($i=='-1')
                    请输入帐号并且选择下单时间段
                @elseif($i=='-2')
                    帐号不存在
                @else
                    会员ID：<font color="#ff0000">{!! $totel2 !!}</font><br><br>
                    会员帐号：<font color="#ff0000">{!! $totel3 !!}</font><br><br>
                    团队数：<font color="#ff0000">{!! $totel4 !!}</font><br><br>
                    总排单：<font color="#ff0000">{!! $totel5 !!}</font><br><br>
                    平均排单：<font color="#ff0000">{!! $totel6 !!}</font><br><br>
                @endif
            </div>
            <div class="user-list" style="padding-bottom: 200px;">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    {!! $data !!}
                </table>
            </div>
        @elseif($do=='yucun')
            <div class="title"><span></span>预存钱包搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/yucun')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    <input type="submit" value="搜索" class="button" /><a href="{{URL('5538830c29f8a8e4/member/qianbao')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>金额</td>
                        <td>注册时间</td>
                        <td>操作</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! $count-- !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! $e->name !!}</td>
                            <td>{!! $e->qianbao !!}</td>
                            <td>{!! $e->shijian !!}</td>
                            <td>
                                修改 | 删除
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='shouyibiao')
            <div class="title"><span></span>收益表搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/shouyibiao')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    姓名：<input type="text" name="name" class="text" value="{{$name}}" />
                    收益范围：<input type="text" name="jine" class="text" value="{{$jine}}" />
                    至：<input type="text" name="jine1" class="text" value="{{$jine1}}" />
                    注册时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    <input type="submit" value="搜索" class="button" />
                    <a href="{{URL('5538830c29f8a8e4/member/shouyibiao')}}">清楚搜索条件</a>
                    <a href="{{URL('5538830c29f8a8e4/member/noorder')}}?jine={{$jine}}&jine1={{$jine1}}">未排单帐号搜索</a>

                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>兑换统计</div>
            <div class="user-search">
                &nbsp;正数收益统计:<font color="#ff0000" size="+3">{{$totel1}}</font>
                &nbsp;负数收益统计:<font color="#ff0000" size="+3">{{$totel2}}</font>
            </div>

            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>姓名</td>
                        <td>收益</td>
                        <td>预存钱包</td>
                        <td>当前挂单额</td>
                        <td>注册时间</td>

                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! $count-- !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->jine !!}</td>
                            <td>{!! \App\Http\Controllers\AdminmemberController::yucun($e->userid) !!}</td>
                            <td>{!! \App\Http\Controllers\AdminmemberController::guadan($e->userid) !!}</td>
                            <td>{!! $e->shijian !!}</td>

                        </tr>

                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'name'=>$name,'station'=>$station,'jine'=>$jine,'jine1'=>$jine1,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>

        @elseif($do=='paidantongji')
            <div class="title"><span></span>排单统计搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/paidantongji')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    姓名：<input type="text" name="name" class="text" value="{{$name}}" />
                    刷新时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    <input type="submit" value="搜索" class="button" /><a href="{{URL('5538830c29f8a8e4/member/paidantongji')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>姓名</td>
                        <td>排单总量</td>
                        <td>团队人数</td>
                        <td>平均排单</td>
                        <td>刷新时间</td>
                        <td>备注</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! $count-- !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->paidan !!}</td>
                            <td>{!! $e->totel !!}</td>
                            <td>{!! $e->pingjun !!}</td>
                            <td>{!! $e->shijian !!}</td>
                            <td>{!! $e->beizhu !!}</td>
                        </tr>

                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='dongtai')
            <div class="title"><span></span>推广工资搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/dongtai')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    订单号：<input type="text" name="jine" class="text" value="{{$jine}}" />
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    <input type="submit" value="搜索" class="button" /><a href="{{URL('5538830c29f8a8e4/member/dongtai')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>工资统计</div>
            <div class="user-search">
                &nbsp;工资统计:<font color="#ff0000" size="+3">{{$totel1}}</font>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>姓名</td>
                        <td>订单号</td>
                        <td>金额</td>
                        <td>周期</td>
                        <td>时间</td>
                        <td>备注</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! $count-- !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->orderid,$jine,$color = "red") !!}</td>
                            <td><font color="#f00">{!! $e->jine !!}</font> </td>
                            <td>
                            @if($e->typeid=='1')
                                    15天
                            @elseif($e->typeid=='2')
                                    30天
                            @elseif($e->typeid=='3')
                                    60天
                            @else
                                    90天
                            @endif
                            </td>
                            <td>{!! $e->shijian !!}</td>
                            <td>{!! $e->beizhu !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'jine'=>$jine,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='jifen')
            <div class="title"><span></span>会员积分搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/jifen')}}">
                    会员帐号：<input type="text" name="user" class="text" value="{{$user}}" />
                    姓名：<input type="text" name="name" class="text" value="{{$name}}" />
                    类型：
                    <select name="station">
                        @if($station!='')
                            <option value="{{$station}}">{{$station}}</option>
                        @endif
                        <option value="">全部</option>
                        <option value="众购商城">众购商城</option>
                        <option value="im游戏兑换">im游戏兑换</option>
                        <option value="众筹分红">众筹分红</option>
                    </select>
                    时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />  两个时间同时选择
                    <input type="submit" value="搜索" class="button" /><a href="{{URL('5538830c29f8a8e4/member/jifen')}}">清楚搜索条件</a>
                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>积分统计</div>
            <div class="user-search">
                &nbsp;积分统计:<font color="#ff0000" size="+3">{{$totel1}}</font>
            </div>
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>姓名</td>
                        <td>操作前金额</td>
                        <td>金额</td>
                        <td>操作后金额</td>
                        <td>时间</td>
                        <td>备注</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! $count-- !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->oldnum !!} </td>
                            <td><font color="#f00">{!! $e->num !!}</font> </td>
                            <td>{!! $e->nownum !!} </td>
                            <td>{!! $e->shijian !!}</td>
                            <td>{!! $e->beizhu !!}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="user-page">
                <div align="center">{{$data->appends(['user'=>$user,'name'=>$name,'station'=>$station,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="submit" class="sub" value="GO" onclick="gotopage()" />
            </div>
        @elseif($do=='noorder')
            <div class="title"><span></span>收益表搜索</div>
            <div class="user-search">
                <form name="form1" class="myform" method="get" action="{{URL('5538830c29f8a8e4/member/noorder')}}">
                    收益范围：<input type="text" name="jine" class="text" value="{{$jine}}" />
                    至：<input type="text" name="jine1" class="text" value="{{$jine1}}" />
                    排单:<input type="text" name="start" class="text" value="{{$start}}" />
                    至：<input type="text" name="end" class="text" value="{{$end}}" />
                    <input type="submit" value="搜索" class="button" /><a href="{{URL('5538830c29f8a8e4/member/shouyibiao')}}">返回收益表</a>
                </form>
            </div>
            @if($jine!='' && $jine1!='')
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td>序号</td>
                        <td>会员帐号</td>
                        <td>姓名</td>
                        <td>收益</td>
                        <td>预存钱包</td>
                        <td>当前挂单额</td>
                        <td>注册时间</td>
                    </tr>
                    @foreach($data as $e)
                        @if(\App\Http\Controllers\AdminmemberController::guadan($e->userid)>=$start && \App\Http\Controllers\AdminmemberController::guadan($e->userid)<=$end)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td>{!! $count++ !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->user,$user,$color = "red") !!}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->name,$name,$color = "red") !!}</td>
                            <td>{!! $e->jine !!}</td>
                            <td>{!! \App\Http\Controllers\AdminmemberController::yucun($e->userid) !!}</td>
                            <td>{!! \App\Http\Controllers\AdminmemberController::guadan($e->userid) !!}</td>
                            <td>{!! $e->shijian !!}</td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="7" style="padding: 50px 0px; text-align: center; font-size: 32px;">一共{{$count-1}}个帐号</td>
                    </tr>
                </table>
            </div>
            @endif
        @elseif($do=='shifang')
            <div class="title"><span></span>钱包释放</div>
            <div class="user-search">
                <form name="form1" class="pwd" action="{{URL('5538830c29f8a8e4/excsql/qianbaoshifang')}}" method="post">
                    <table width="100%" style="text-align:left;font-size:12px; line-height:40px; margin-top:40px;" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="right" width="150">会员帐号：</td>
                            <td>
                                <input type="text" class="ipput" name="user" datatype="*" nullmsg="请输入"  value="" ajaxurl="{{URL('checkuser')}}">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">释放金额：</td>
                            <td>
                                <input type="text" class="ipput" name="jine" datatype="n" nullmsg="请输入"  value="" />
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">类型：</td>
                            <td>
                                <input type="radio" value="0" name="type" checked/>钱包释放
                                <input type="radio" value="1" name="type"/>实体众筹
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" class="sub" name="sub" value="释 放" />
                                <input type="button" class="sub" value="返回上一页" onclick="javascript:history.go(-1)" />

                            </td>
                        </tr>

                    </table>

                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>负数钱包转换</div>
            <div class="user-search">
                <form name="form1" class="pwd" action="{{URL('5538830c29f8a8e4/excsql/fushuzhuanhuan')}}" method="post">
                    <table width="100%" style="text-align:left;font-size:12px; line-height:40px; margin-top:40px;" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="right" width="150">会员帐号：</td>
                            <td>
                                <input type="text" class="ipput" name="user" datatype="*" nullmsg="请输入"  value="" ajaxurl="{{URL('checkuser')}}">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">转换金额：</td>
                            <td>
                                <input type="text" class="ipput" name="jine" datatype="n" nullmsg="请输入"  value="" />
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" class="sub" name="sub" value="转 换" />
                                <input type="button" class="sub" value="返回上一页" onclick="javascript:history.go(-1)" />

                            </td>
                        </tr>

                    </table>

                </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>扣除天使资本</div>
            <div class="user-search">
                <form name="form1" class="pwd" action="{{URL('5538830c29f8a8e4/excsql/kouchuqianbao')}}" method="post">
                    <table width="100%" style="text-align:left;font-size:12px; line-height:40px; margin-top:40px;" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="right" width="150">会员帐号：</td>
                            <td>
                                <input type="text" class="ipput" name="user" datatype="*" nullmsg="请输入"  value="" ajaxurl="{{URL('checkuser')}}">
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">金额：</td>
                            <td>
                                <input type="text" class="ipput" name="jine" datatype="n" nullmsg="请输入"  value="" />
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">类型：</td>
                            <td>
                                <input type="radio"  name="type"  value="1" /> 增加
                                <input type="radio"  name="type"  value="0" checked /> 减少
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" class="sub" name="sub" value="提 交" />
                                <input type="button" class="sub" value="返回上一页" onclick="javascript:history.go(-1)" />

                            </td>
                        </tr>

                    </table>

                </form>
            </div>

        @endif
    </div>
</div>
<script language="javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform({
            tiptype:3,
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

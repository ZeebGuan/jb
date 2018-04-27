<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jcrossdomain.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('5538830c29f8a8e4/shop/'.$do)}}?user={{$user}}&station={{$station}}&sid={{$sid}}&orderid={{$orderid}}&keyword={{$keyword}}&start={{$start}}&end={{$end}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }
        }
        function queren()
        {
            if(!confirm("确认要已达成选中的订单吗？"))
            {
                window.event.returnValue = false;
            }
            else
            {
                javascript:form2.action='{{URL('5538830c29f8a8e4/excsql/allwanchengtoubiao')}}';
            }
        }
    </script>
    <script language="javascript" src="{{asset('admin/js/jcrossdomain.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/update.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/func.js')}}"></script>
    <script language="javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script language="javascript" src="{{asset('ueditor/ueditor.all.min.js')}}"></script>
    <script language="javascript" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script language="javascript">
        function aa(aa)
        {
            document.getElementById("picurl").value="/upload/"+aa;
            document.getElementById("picurl1").src="/upload/"+aa;
            document.getElementById("t").innerHTML="http://pic.mrgzcy.com/upload/"+aa;
        }
    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    <div class="user">
        @if($do=='list')
        <div class="title"><span></span>公益众筹项目列表</div>
        <div class="user-search">
            <form name="formsea" action="{{URL('5538830c29f8a8e4/zhongchou/list')}}" method="get">
                项目名称：<input type="text" class="text" name="keyword" id="keyword" value="{{$keyword}}" />
                时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                <input type="submit" value="查找" class="button" />
                <input type="button" value="添加" class="button" onclick="window.location.href='{{URL('5538830c29f8a8e4/zhongchou/add')}}';" />
                <a href="{{URL('5538830c29f8a8e4/zhongchou/list')}}">清除搜索条件</a>
            </form>
        </div>
        <form name="form2" method="post">
            <div class="user-list">
                <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                    <tr class="tr">
                        <td width="50">ID</td>
                        <td>项目名称</td>
                        <td>发起方</td>
                        <td>众筹总创益币</td>
                        <td>每份所需金币</td>
                        <td>每份所需银币</td>
                        <td>最大限购</td>
                        <td width="130">更新时间</td>
                        <td>投标进程</td>
                        <td width="150">操作</td>
                    </tr>
                    @foreach($data as $e)
                        <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                            <td width="50">{{$count--}}</td>
                            <td>{!! \App\Http\Controllers\FunctionController::highLight($e->title,$keyword,$color = "red") !!}</td>
                            <td>{{$e->faqi}}</td>
                            <td>{{$e->totel}}</td>
                            <td>{{$e->jinbi}}</td>
                            <td>{{$e->yinbi}}</td>
                            <td>{{$e->xiangou}}</td>
                            <td>{{$e->shijian}}</td>
                            <td>{{\App\Http\Controllers\FunctionController::zhongchou($e->id,3)}}%</td>
                            <td width="180">
                                <a href="{{URL('5538830c29f8a8e4/zhongchou/edit/'.$e->id)}}"> 修改</a>&nbsp;|
                                &nbsp;<a href="{{URL('5538830c29f8a8e4/excsql/delzhongchou/'.$e->id)}}" onclick='return confirm("你确定要删除吗？")'>删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
            <div class="user-page">
                <span id="chk_noall" name="chk_noall" style="cursor:pointer; float:left; margin-left:20px;">全选/反选</span>
                <input type="submit" value="删除" style="cursor:pointer; float:left; width:50px; height:30px; line-height:30px;"  onClick="javascript:form2.action='{{URL('5538830c29f8a8e4/excsql/delallshangpin')}}';" />
                <div align="center">{{$data->appends(['keyword'=>$keyword,'start'=>$start,'end'=>$end])->links()}}</div>
                <input class="text" type="text" name="page" id="page" value="" />
                <input type="button" class="sub" value="GO" onclick="gotopage()" />

            </div>
        </form>
        @elseif($do=='add')
        <div class="title"><span></span>添加众筹项目</div>
        <div class="user-search">
            <form name="form1" class="pwd" action="{{URL('5538830c29f8a8e4/excsql/addzhongchou')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="100%" style="text-align:left;font-size:12px; line-height:40px;" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                        <td align="right" width="150">项目名称：</td>
                        <td>
                            <input type="text" class="ipput" name="title" value=""  datatype="*" nullmsg="请输入" />
                        </td>
                    </tr>

                    <tr>
                        <td align="right" width="150">众筹总创益币：</td>
                        <td>
                            <input type="text" class="ipput" name="totel" value=""  datatype="n" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">发起方：</td>
                        <td>
                            <input type="text" class="ipput" name="faqi" value=""  datatype="*" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">每份所需金币：</td>
                        <td>
                            <input type="text" class="ipput" name="jinbi" value=""  datatype="n" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">每份所需银币：</td>
                        <td>
                            <input type="text" class="ipput" name="yinbi" value=""  datatype="n" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">金币总最大认购份数：</td>
                        <td>
                            <input type="text" class="ipput" name="jinbimax" value=""  datatype="n" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">银币总最大认购份数：</td>
                        <td>
                            <input type="text" class="ipput" name="yinbimax" value=""  datatype="n" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">最大申购份数：</td>
                        <td>
                            <input type="text" class="ipput" name="xiangou" value="1"  datatype="n" nullmsg="请输入" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">缩略图：</td>
                        <td height="60">
                            <input type="hidden" name="picurl" id="picurl" value="" nullmsg="请上传缩略图！" datatype="*" />
                            <iframe id="upload" name="upload" src="http://pic.mrgzcy.com/49cc320b3e4feee660ea64ca3f833b14/up.php?do=md5" width="200" height="60" scrolling="no" frameborder="0" style="float:left;"></iframe>
                            <img src="/images/pic.png" class="pic" id="picurl1" name="picurl1" width="100" height="80"/>
                            <div id="t"></div>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">&nbsp;幻灯片：</td>
                        <td align="left">
                            <div id="pictureUpload" style="width:640px;height:260px;background:#fbfbfb;border:solid 1px #e1e1e1;margin-top:10px;" oncontextmenu="window.event.returnValue=0">
                                <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="640" height="250" id="update" align="middle">
                                    <param name="allowFullScreen" value="false" />
                                    <param name="allowScriptAccess" value="always" />
                                    <param name="movie" value="{{asset('admin/js/update1.swf')}}" />
                                    <param name="quality" value="high" />
                                    <param name="bgcolor" value="#ffffff" />
                                    <param name="wmode" value="transparent" />
                                    <embed src="{{asset('admin/js/update1.swf')}}" quality="high" bgcolor="#ffffff" width="640" height="250" name="update" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                </object>
                                <div style="width:200px; height:20px; background:#fbfbfb; margin-top:-20px; position:absolute; z-index:999; padding-left:20px;"></div>
                            </div>
                            <div id="show" style=" width:640px;line-height:18px;font-size:12px;text-align:left;margin:0 auto; margin-bottom: 20px;"></div>
                            <input type="hidden" name="pic" id="pic" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">项目介绍：</td>
                        <td>
                            <textarea name="intro" id="intro" style="height:300px; width:700px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="150">众筹方案：</td>
                        <td>
                            <textarea name="fangan" id="fangan" style="height:300px; width:700px;"></textarea> <br />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" class="sub" name="sub" value="添加" />
                            <input type="button" class="sub" value="返回上一页" onclick="javascript:history.go(-1)" />

                        </td>
                    </tr>
                </table>

            </form>
            <br /><br />
        </div>
        @elseif($do=='edit')
            <div class="title"><span></span>修改众筹项目</div>
            <div class="user-search">
                <form name="form1" class="pwd" action="{{URL('5538830c29f8a8e4/excsql/editzhongchou/'.$id)}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="100%" style="text-align:left;font-size:12px; line-height:40px;" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                            <td align="right" width="150">项目名称：</td>
                            <td>
                                <input type="text" class="ipput" name="title" value="{{$data[0]->title}}"  datatype="*" nullmsg="请输入" />
                            </td>
                        </tr>

                        <tr>
                            <td align="right" width="150">众筹总创益币：</td>
                            <td>
                                <input type="text" class="ipput" name="totel" value="{{$data[0]->totel}}"  datatype="n" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">发起方：</td>
                            <td>
                                <input type="text" class="ipput" name="faqi" value="{{$data[0]->faqi}}"  datatype="*" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">每份所需金币：</td>
                            <td>
                                <input type="text" class="ipput" name="jinbi" value="{{$data[0]->jinbi}}"  datatype="n" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">每份所需银币：</td>
                            <td>
                                <input type="text" class="ipput" name="yinbi" value="{{$data[0]->yinbi}}"  datatype="n" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">金币总最大认购份数：</td>
                            <td>
                                <input type="text" class="ipput" name="jinbimax" value="{{$data[0]->jinbimax}}"  datatype="n" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">银币总最大认购份数：</td>
                            <td>
                                <input type="text" class="ipput" name="yinbimax" value="{{$data[0]->yinbimax}}"  datatype="n" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">最大申购份数：</td>
                            <td>
                                <input type="text" class="ipput" name="xiangou" value="{{$data[0]->xiangou}}"  datatype="n" nullmsg="请输入" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">缩略图：</td>
                            <td height="60">
                                <input type="hidden" name="picurl" id="picurl" value="{{$data[0]->pic}}" nullmsg="请上传缩略图！" datatype="*" />
                                <iframe id="upload" name="upload" src="http://pic.mrgzcy.com/49cc320b3e4feee660ea64ca3f833b14/up.php?do=md5" width="200" height="60" scrolling="no" frameborder="0" style="float:left;"></iframe>
                                <img src="{{$data[0]->pic}}" class="pic" id="picurl1" name="picurl1" width="100" height="80"/>
                                <div id="t"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">&nbsp;幻灯片：</td>
                            <td align="left">
                                <div id="pictureUpload" style="width:640px;height:260px;background:#fbfbfb;border:solid 1px #e1e1e1;margin-top:10px;" oncontextmenu="window.event.returnValue=0">
                                    <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="640" height="250" id="update" align="middle">
                                        <param name="allowFullScreen" value="false" />
                                        <param name="allowScriptAccess" value="always" />
                                        <param name="movie" value="{{asset('admin/js/update1.swf')}}" />
                                        <param name="quality" value="high" />
                                        <param name="bgcolor" value="#ffffff" />
                                        <param name="wmode" value="transparent" />
                                        <embed src="{{asset('admin/js/update1.swf')}}" quality="high" bgcolor="#ffffff" width="640" height="250" name="update" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" />
                                    </object>
                                    <div style="width:200px; height:20px; background:#fbfbfb; margin-top:-20px; position:absolute; z-index:999; padding-left:20px;"></div>
                                </div>
                                <div id="show">{!! $img !!}</div>
                                <input type="hidden" name="pic" id="pic" value="{{$imgurl}}" style="width:800px; margin-bottom: 20px;" />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">项目介绍：</td>
                            <td>
                                <textarea name="intro" id="intro" style="height:300px; width:700px;">{{$data[0]->intro}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" width="150">众筹方案：</td>
                            <td>
                                <textarea name="fangan" id="fangan" style="height:300px; width:700px;">{{$data[0]->fangan}}</textarea> <br />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" class="sub" name="sub" value="修改" />
                                <input type="button" class="sub" value="返回上一页" onclick="javascript:history.go(-1)" />

                            </td>
                        </tr>
                    </table>

                </form>
                <br /><br />
            </div>
        @elseif($do=='toubiao')
            <div class="title"><span></span>投标列表</div>
            <div class="user-search">
                <form name="formsea" action="{{URL('5538830c29f8a8e4/zhongchou/toubiao')}}" method="get">
                    &nbsp;会员帐号：<input type="text" class="text" name="user" value="{{$user}}" />
                    姓名：<input type="text" class="text" name="orderid" value="{{$orderid}}" />
                    状态:<select name="station">
                        @if($station=='0')
                        <option value="0">已提交</option>
                        <option value="">全部</option>
                        <option value="1">已完成</option>
                        @elseif($station=='1')
                        <option value="1">已完成</option>
                        <option value="">全部</option>
                        <option value="0">已提交</option>
                        @else
                        <option value="">全部</option>
                        <option value="0">已提交</option>
                        <option value="1">已完成</option>
                        @endif
                    </select>
                    下单时间：<input type="text" name="start" value="{{$start}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    至 &nbsp;<input type="text" name="end" value="{{$end}}" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                    <br>
                    &nbsp; 众筹项目：
                    <select name="sid">
                        {!! $keyword !!}
                        <option value="">全部</option>
                        @foreach($shangpin as $e)
                            <option value="{{$e->id}}">{{$e->title}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="查找" class="button" />
                    <a href="{{URL('5538830c29f8a8e4/shop/order')}}">清除搜索条件</a>
                    <a href="{{URL('execl/toubiao')}}?user={{$user}}&station={{$station}}&sid={{$sid}}&orderid={{$orderid}}&start={{$start}}&end={{$end}}">导出execl</a>
                    </form>
            </div>
            <div class="titlebg"></div>
            <div class="title"><span></span>统计</div>
            <div class="user-search">

                &nbsp;创益币:<font color="#ff0000" size="+3">@if($totel1=='')0 @else{{$totel1}}@endif</font>
                &nbsp;金币投标数量:<font color="#ff0000" size="+3">@if($totel2=='')0 @else{{$totel2}}@endif</font>
                &nbsp;银币投标数量:<font color="#ff0000" size="+3">@if($totel3=='')0 @else{{$totel3}}@endif</font>
                &nbsp;创益金币:<font color="#ff0000" size="+3">@if($totel4=='')0 @else{{$totel4}}@endif</font>
                &nbsp; 创益银币:<font color="#ff0000" size="+3">@if($totel5=='')0 @else{{$totel5}}@endif</font>
            </div>
            <form name="form2" method="post">
                <div class="user-list">
                    <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                        <tr class="tr">
                            <td width="20"></td>
                            <td width="50">ID</td>
                            <td>项目名称</td>
                            <td>会员帐号</td>
                            <td>价格</td>
                            <td>投标数量</td>
                            <td>总价</td>
                            <td>投标人姓名</td>
                            <td>投标人电话</td>
                            <td>投标人地址</td>
                            <td width="130">投标时间</td>
                            <td>支付类型</td>
                            <td>状态</td>
                            <td>操作</td>
                        </tr>
                        @foreach($data as $e)
                            <tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                                <td width="20"><input type='checkbox' value='{{$e->id}}' name='groupid[]' /></td>
                                <td width="50">{{$count--}}</td>
                                <td>{{\App\Http\Controllers\AdminzhongchouController::zhongchoutitle($e->sid)}}</td>
                                <td>{{$e->user}}</td>
                                <td>{{$e->jiage}}</td>
                                <td>{{$e->num}}</td>
                                <td>{{$e->jine}}</td>
                                <td>{{$e->name}}</td>
                                <td>{{$e->phone}}</td>
                                <td>{{$e->dizhi}}</td>
                                <td>{{$e->shijian}}</td>
                                <td>
                                    @if($e->type=='1')
                                        <font color='#ff0000'>创益金币</font>
                                    @else
                                        <font color='#0000ff'>创益银币</font>
                                    @endif
                                </td>
                                <td>
                                    @if($e->station=='0')
                                        <a href="{{URL('5538830c29f8a8e4/excsql/wanchengtoubiao/'.$e->id)}}"  onclick='return confirm("你确定要已达成订单吗？")'>已提交</a>
                                    @else
                                        <font color='#ff0000'>已达成</font>
                                    @endif

                                </td>
                                <td><a href="{{URL('5538830c29f8a8e4/excsql/deltoubiao/'.$e->id)}}" onclick="delcfm()">删除</a></td>
                            </tr>
                        @endforeach
                    </table>

                </div>
                <div class="user-page">
                    <span id="chk_noall" name="chk_noall" style="cursor:pointer; float:left; margin-left:20px;">全选/反选</span>
                    <input type="submit" value="已完成" style="cursor:pointer; float:left; width:50px; height:30px; line-height:30px;"  onClick="queren()" />
                    <div align="center">{{$data->appends(['user'=>$user,'orderid'=>$orderid,'station'=>$station,'start'=>$start,'end'=>$end,'sid'=>$sid])->links()}}</div>
                    <input class="text" type="text" name="page" id="page" value="" />
                    <input type="button" class="sub" value="GO" onclick="gotopage()" />

                </div>
            </form>

        @endif
    </div>
</div>

<script type="text/javascript">
    var cb = function(json){
        document.getElementById("picurl").value="http://pic.mrgzcy.com/upload/"+json;
        document.getElementById("picurl1").src="http://pic.mrgzcy.com/upload/"+json;
        document.getElementById("t").innerHTML="http://pic.mrgzcy.com/upload/"+json;
    };
    jCrossDomain.initParent(cb, 'upload');
    function send(){
        var val = document.getElementById('data').value;
        jCrossDomain.sendMessage(val);
    }

</script>
<script type="text/javascript">
    $("#chk_noall").click(function() {
        $("input[name='groupid[]']").each(function(idx, item) {
            $(item).attr("checked", !$(item).attr("checked"));
        })
    });
</script>

<script type="text/javascript" src="{{asset('admin/js/jquery-1.6.2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".pwd").Validform({
            tiptype:3,
        });
    })
</script>
<script type="text/javascript">var ue = UE.getEditor('content');</script>
<script type="text/javascript">var ue = UE.getEditor('intro');</script>
<script type="text/javascript">var ue = UE.getEditor('fangan');</script>
</body>
</html>

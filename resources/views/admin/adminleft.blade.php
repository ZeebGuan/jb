<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript">
        function gotopage()
        {
            page=document.getElementById("page").value;
            var url="{{URL('jb_admin/adminleft/list/')}}?keyword={{$keyword}}}&page="+page;
            if(page=="")
            {
                alert("请输入页数！");
            }
            else
            {
                window.location.href=url;
            }

        }
        function check(id){
            var checkbox = document.getElementById(id);//
            if(checkbox.checked){
                //选中了
            }else{
                checkbox.checked=true;
            }
        }

    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">

    <div class="user">

        @if($do=='list')
        <div class="title"><span></span>角色管理</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/adminleft/list')}}">
                关键字：<input type="text" name="keyword" class="text" value="{{$keyword}}" />
                <input type="submit" value="查找" class="button" />
                <input type="button" value="添加" class="button" onclick="window.location.href='{{URL('jb_admin/adminleft/add')}}';" />
            </form>
        </div>
        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:30px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td width="100">序号</td>
                    <td width="300">角色名称</td>
                    <td>权限</td>
                    <td width="200">添加时间</td>
                    <td width="80">操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{{$count--}}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->title,$keyword,$color = "red") !!}</td>
                        <td>
                                @if(strstr($e->flag,'a'))订单管理,@endif
                                @if(strstr($e->flag,'a1'))订单列表,@endif
                                @if(strstr($e->flag,'a2'))订单统计,@endif
                                @if(strstr($e->flag,'a3'))订单审核,@endif

                                @if(strstr($e->flag,'b'))库存管理,@endif
                                @if(strstr($e->flag,'b1'))产品管理,@endif
                                @if(strstr($e->flag,'b4'))系列管理,@endif
                                @if(strstr($e->flag,'b3'))原料管理,@endif

                                @if(strstr($e->flag,'c'))客户管理,@endif
                                @if(strstr($e->flag,'c1'))客户列表,@endif
                                @if(strstr($e->flag,'c1'))添加客户,@endif

                                @if(strstr($e->flag,'d'))业务员管理,@endif
                                @if(strstr($e->flag,'d1'))业务员列表,@endif
                                @if(strstr($e->flag,'d2'))添加业务员,@endif

                                    @if(strstr($e->flag,'k'))设备管理,@endif
                                    @if(strstr($e->flag,'k1'))设备列表,@endif
                                    @if(strstr($e->flag,'k2'))添加设备,@endif

                                    @if(strstr($e->flag,'e'))模具管理,@endif
                                    @if(strstr($e->flag,'e1'))模具列表,@endif
                                    @if(strstr($e->flag,'e2'))添加模具,@endif

                                    @if(strstr($e->flag,'f'))工序管理,@endif
                                    @if(strstr($e->flag,'f1'))工序列表,@endif
                                    @if(strstr($e->flag,'f2'))添加工序,@endif

                                    @if(strstr($e->flag,'g'))员工管理,@endif
                                    @if(strstr($e->flag,'g1'))员工列表,@endif
                                    @if(strstr($e->flag,'g2'))添加员工,@endif

                                    @if(strstr($e->flag,'m'))任务管理,@endif
                                    @if(strstr($e->flag,'m1'))任务列表,@endif
                                    @if(strstr($e->flag,'m1'))添加任务,@endif

                                    @if(strstr($e->flag,'i'))供应商管理,@endif
                                    @if(strstr($e->flag,'i1'))供应商列表,@endif
                                    @if(strstr($e->flag,'i2'))添加供应商,@endif

                                    @if(strstr($e->flag,'k'))采购管理,@endif
                                    @if(strstr($e->flag,'k1'))采购列表,@endif


                                @if(strstr($e->flag,'g'))网站配置,@endif
                                @if(strstr($e->flag,'g1'))网站配置,@endif

                                @if(strstr($e->flag,'h'))管理员管理,@endif
                                @if(strstr($e->flag,'h1'))管理员列表,@endif
                                @if(strstr($e->flag,'h2'))添加管理员,@endif
                                @if(strstr($e->flag,'h3'))帐号角色,@endif
                                @if(strstr($e->flag,'h4'))添加角色,@endif

                                @if(strstr($e->flag,'j'))日志管理,@endif
                                @if(strstr($e->flag,'j1'))操作日志,@endif
                                @if(strstr($e->flag,'j2'))系统登录日志,@endif
                                @if(strstr($e->flag,'j3'))客户登录日志,@endif

                        </td>
                        <td>{{date('Y-m-d H:i:s')}}</td>
                        <td>
                            <a href='{{URL('jb_admin/adminleft/edit/'.$e->id)}}'>修改</a>
                            | <a href='{{URL('jb_admin/excsql/deladminleft/'.$e->id)}}' onclick='delcfm()'>删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['keyword'=>$keyword])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" />
        </div>
        @elseif($do=='add')
        <div class="title"><span></span>角色添加</div>
        <div class="user-search"><br />
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addadminleft')}}">
                &nbsp;角色名称：<input type="text" name="title" nullmsg="请输入角色名称！" datatype="*"  class="ipput" value="" /><br />
                &nbsp;功能选择：<input type="checkbox" name="flag[]" value="a" id="flag1"/>订单管理
                【
                <input type="checkbox" name="flag[]" value="a1"  onclick="check('flag1')"/>订单列表
                <input type="checkbox" name="flag[]" value="a2" onclick="check('flag1')" />订单统计
                <input type="checkbox" name="flag[]" value="a3" onclick="check('flag1')" />订单审核
                】<br />

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="b" id="flag2"/>库存管理
                【
                <input type="checkbox" name="flag[]" value="b1"  onclick="check('flag2')"/>产品管理
                <input type="checkbox" name="flag[]" value="b4"  onclick="check('flag2')"/>系列管理
                <input type="checkbox" name="flag[]" value="b3" onclick="check('flag2')" />原料管理
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="c" id="flag3"/>客户管理
                【
                <input type="checkbox" name="flag[]" value="c1"  onclick="check('flag3')"/>客户列表
                <input type="checkbox" name="flag[]" value="c2" onclick="check('flag3')" />添加客户
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="d" id="flag4"/>业务员管理
                【
                <input type="checkbox" name="flag[]" value="d1"  onclick="check('flag4')"/>业务员列表
                <input type="checkbox" name="flag[]" value="d2" onclick="check('flag4')" />添加业务员
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="k" id="flag11"/>设备管理
                【
                <input type="checkbox" name="flag[]" value="k1"  onclick="check('flag11')"/>设备列表
                <input type="checkbox" name="flag[]" value="k2" onclick="check('flag11')" />添加设备
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="e" id="flag5"/>模具管理
                【
                <input type="checkbox" name="flag[]" value="e1"  onclick="check('flag5')"/>模具列表
                <input type="checkbox" name="flag[]" value="e2" onclick="check('flag5')" />添加模具
                】<br />

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="f" id="flag6"/>工序管理
                【
                <input type="checkbox" name="flag[]" value="f1"  onclick="check('flag6')"/>工序列表
                <input type="checkbox" name="flag[]" value="f2" onclick="check('flag6')" />添加工序
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="g" id="flag7"/>员工管理
                【
                <input type="checkbox" name="flag[]" value="g1"  onclick="check('flag7')"/>员工列表
                <input type="checkbox" name="flag[]" value="g2" onclick="check('flag7')" />添加员工
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="m" id="flag8"/>任务管理
                【
                <input type="checkbox" name="flag[]" value="m1"  onclick="check('flag8')"/>任务列表
                <input type="checkbox" name="flag[]" value="m2" onclick="check('flag8')" />添加任务
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="i" id="flag9"/>供应商管理
                【
                <input type="checkbox" name="flag[]" value="i1"  onclick="check('flag9')"/>供应商列表
                <input type="checkbox" name="flag[]" value="i2" onclick="check('flag9')" />添加供应商
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="k" id="flag10"/>采购管理
                【
                <input type="checkbox" name="flag[]" value="k1"  onclick="check('flag10')"/>采购列表
                <input type="checkbox" name="flag[]" value="k2" onclick="check('flag10')" />采购申请
                】<br />

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="g" id="flag7"/>网站配置
                【
                <input type="checkbox" name="flag[]" value="g1"  onclick="check('flag7')"/>网站配置
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="h" id="flag8"/>管理员管理
                【
                <input type="checkbox" name="flag[]" value="h1"  onclick="check('flag8')"/>管理员列表
                <input type="checkbox" name="flag[]" value="h2" onclick="check('flag8')" />添加管理员
                <input type="checkbox" name="flag[]" value="h3" onclick="check('flag8')" />账户角色
                <input type="checkbox" name="flag[]" value="h4" onclick="check('flag8')" />添加角色
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="j" id="flag10"/>日志管理
                【
                <input type="checkbox" name="flag[]" value="j1"  onclick="check('flag10')"/>操作日志
                <input type="checkbox" name="flag[]" value="j2"  onclick="check('flag10')"/>系统登录日志
                <input type="checkbox" name="flag[]" value="j3"  onclick="check('flag10')"/>客户登录日志
                】<br />

                <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" value="添加" class="goback" />
                <a href="javascript:history.go(-1);">返回上一页</a>
            </form>
            <br /><br /><br /><br /><br /><br />
        </div>
        @elseif($do=='edit')
        <div class="title"><span></span>角色修改</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editadminleft/'.$id)}}">
                &nbsp;角色名称：<input type="text" name="title" nullmsg="请输入角色名称！" datatype="*"  class="ipput" value="{{$keyword}}" /><br />
                &nbsp;功能选择：<input type="checkbox" name="flag[]" value="a" id="flag1" @if(strstr($type,'a')) checked @endif/>订单管理
                【
                <input type="checkbox" name="flag[]" value="a1"  onclick="check('flag1')" @if(strstr($type,'a1')) checked @endif/>订单列表
                <input type="checkbox" name="flag[]" value="a2" onclick="check('flag1')"  @if(strstr($type,'a2')) checked @endif/>订单统计
                <input type="checkbox" name="flag[]" value="a3" onclick="check('flag1')"  @if(strstr($type,'a3')) checked @endif/>订单审核
                】<br />

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="b" id="flag2" @if(strstr($type,'b')) checked @endif/>库存管理
                【
                <input type="checkbox" name="flag[]" value="b1"  onclick="check('flag2')" @if(strstr($type,'b1')) checked @endif/>产品管理
                <input type="checkbox" name="flag[]" value="b4"  onclick="check('flag2')" @if(strstr($type,'b4')) checked @endif/>系列管理
                <input type="checkbox" name="flag[]" value="b3" onclick="check('flag2')"  @if(strstr($type,'b3')) checked @endif/>原料管理
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="c" id="flag3" @if(strstr($type,'c')) checked @endif/>客户管理
                【
                <input type="checkbox" name="flag[]" value="c1"  onclick="check('flag3')" @if(strstr($type,'c1')) checked @endif/>客户列表
                <input type="checkbox" name="flag[]" value="c2" onclick="check('flag3')" @if(strstr($type,'c2')) checked @endif />添加客户
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="d" id="flag4" @if(strstr($type,'d')) checked @endif/>业务员管理
                【
                <input type="checkbox" name="flag[]" value="d1"  onclick="check('flag4')" @if(strstr($type,'d1')) checked @endif/>业务员列表
                <input type="checkbox" name="flag[]" value="d2" onclick="check('flag4')"  @if(strstr($type,'d2')) checked @endif/>添加业务员
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="k" id="flag11" @if(strstr($type,'k')) checked @endif/>设备管理
                【
                <input type="checkbox" name="flag[]" value="k1"  onclick="check('flag11')" @if(strstr($type,'k1')) checked @endif/>设备列表
                <input type="checkbox" name="flag[]" value="k2" onclick="check('flag11')"  @if(strstr($type,'k2')) checked @endif/>添加设备
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="e" id="flag5" @if(strstr($type,'e')) checked @endif/>模具管理
                【
                <input type="checkbox" name="flag[]" value="e1"  onclick="check('flag5')" @if(strstr($type,'e1')) checked @endif/>模具列表
                <input type="checkbox" name="flag[]" value="e2" onclick="check('flag5')"  @if(strstr($type,'e2')) checked @endif/>添加模具
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="f" id="flag6" @if(strstr($type,'f')) checked @endif/>工序管理
                【
                <input type="checkbox" name="flag[]" value="f1"  onclick="check('flag6')" @if(strstr($type,'f1')) checked @endif/>工序列表
                <input type="checkbox" name="flag[]" value="f2" onclick="check('flag6')"  @if(strstr($type,'f2')) checked @endif/>添加工序
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="g" id="flag7" @if(strstr($type,'g')) checked @endif/>员工管理
                【
                <input type="checkbox" name="flag[]" value="g1"  onclick="check('flag7')" @if(strstr($type,'g1')) checked @endif/>员工列表
                <input type="checkbox" name="flag[]" value="g2" onclick="check('flag7')"  @if(strstr($type,'g2')) checked @endif/>添加员工
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="m" id="flag8" @if(strstr($type,'m')) checked @endif/>任务管理
                【
                <input type="checkbox" name="flag[]" value="m1"  onclick="check('flag8')" @if(strstr($type,'m1')) checked @endif/>任务列表
                <input type="checkbox" name="flag[]" value="m2" onclick="check('flag8')"  @if(strstr($type,'m2')) checked @endif/>添加任务
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="i" id="flag9" @if(strstr($type,'i')) checked @endif/>供应商管理
                【
                <input type="checkbox" name="flag[]" value="i1"  onclick="check('flag9')" @if(strstr($type,'i1')) checked @endif/>供应商列表
                <input type="checkbox" name="flag[]" value="i2" onclick="check('flag9')"  @if(strstr($type,'i2')) checked @endif/>添加供应商
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="k" id="flag10" @if(strstr($type,'k')) checked @endif/>采购管理
                【
                <input type="checkbox" name="flag[]" value="k1"  onclick="check('flag10')" @if(strstr($type,'k1')) checked @endif/>采购列表
                <input type="checkbox" name="flag[]" value="k2" onclick="check('flag10')"  @if(strstr($type,'k2')) checked @endif/>采购申请
                】<br />

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="g" id="flag7" @if(strstr($type,'g')) checked @endif/>网站配置
                【
                <input type="checkbox" name="flag[]" value="g1"  onclick="check('flag7')" @if(strstr($type,'g1')) checked @endif/>网站配置
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="h" id="flag8" @if(strstr($type,'h')) checked @endif />管理员管理
                【
                <input type="checkbox" name="flag[]" value="h1"  onclick="check('flag8')" @if(strstr($type,'h1')) checked @endif/>管理员列表
                <input type="checkbox" name="flag[]" value="h2"  onclick="check('flag8')" @if(strstr($type,'h2')) checked @endif/>添加管理员
                <input type="checkbox" name="flag[]" value="h3"  onclick="check('flag8')" @if(strstr($type,'h3')) checked @endif/>账户角色
                <input type="checkbox" name="flag[]" value="h4"  onclick="check('flag8')" @if(strstr($type,'h4')) checked @endif/>添加角色
                】<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="flag[]" value="j" id="flag10" @if(strstr($type,'j')) checked @endif/>日志管理
                【
                <input type="checkbox" name="flag[]" value="j1" onclick="check('flag10')" @if(strstr($type,'j1')) checked @endif/>操作日志
                <input type="checkbox" name="flag[]" value="j2" onclick="check('flag10')" @if(strstr($type,'j2')) checked @endif/>系统登录日志
                <input type="checkbox" name="flag[]" value="j3" onclick="check('flag10')" @if(strstr($type,'j3')) checked @endif/>客户登录日志
                】<br />


                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                <br />
                <input type="submit" value="修改" class="edit" /><a href="javascript:history.go(-1);">返回上一页</a>
            </form>
            <br /><br /><br /><br /><br /><br />
        </div>
        @endif

    </div>
</div>
<script language="javascript" src="js/Validform_v5.3.2.js"></script>
<script type="text/javascript">
    $(".myform").Validform({
        tiptype:3,
    });
</script>
</body>
</html>

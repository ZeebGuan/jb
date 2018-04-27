<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/update.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/func.js')}}"></script>
    <script language="javascript" src="{{asset('ueditor/ueditor.config.js')}}"></script>
    <script language="javascript" src="{{asset('ueditor/ueditor.all.min.js')}}"></script>
    <script language="javascript" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pagination.css')}}"/>
    <script type="text/javascript" src="{{asset('js/pagination.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#closeproduct").click(function(){
                $("#productlist").hide(1000);
            });
            $("#liulan").click(function(){
                $("#productlist").show(1000);
                loadData1(1,10);
            });
            $("#liulangx").click(function(){
                $("#gongxulist").show(1000);
                loadData2(1,10);
            });
            $("#closegongxulist").click(function(){
                $("#gongxulist").hide(1000);
            });
            $("#closepeijianlist").click(function(){
                $("#pplist").hide(1000);
            });
        });
    </script>
    <script language="javascript">
        function queren(msg)
        {
            if(!confirm(msg))
            {
                window.event.returnValue = false;
            }
        }

        function loadData2(currPage, pageSize) {
            var title=$("#gongxu_title").val();
            $.ajax({
                type: "POST",
                url: "/jb_admin/product/gongxulist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#list_gx').html('加载中');
                },
                success: function(res){
                    var str="";
                    str+="<table width=\"400\" style=\"text-align:center;border: 1px solid #99bce8;background-color:#fff; margin-top:30px;float:left; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td  width=50>工序编号</td><td>工序名称</td><td width=50>选择</td></tr>";
                    for(var i in res.content){
                        str+="<tr><td>"+res.content[i].id+"</td><td>"+res.content[i].title+"</td><td><img src='{{asset('images/jplugin.png')}}' name='"+res.content[i].title+"' id='addgongxuImg_"+res.content[i].id+"' onclick='addgongxu("+res.content[i].id+")'></td></tr>";
                    }
                    str+="</table>";
                    $('#list_gx').html(str);
                    $("#pagination2").whjPaging("setPage", res.currPage, res.totalPage);
                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }
        function loadData3(currPage, pageSize) {
            var title=$("#pp_title").val();
            $.ajax({
                type: "POST",
                url: "/jb_admin/product/peijianlist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title,"pid":{{$id}}},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#pp_list_gx').html('加载中');
                },
                success: function(res){
                    var str="";
                    str+="<table width=\"400\" style=\"text-align:center;border: 1px solid #99bce8;background-color:#fff; margin-top:30px;float:left; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td align=left>&nbsp;&nbsp;配件和产品名称</td><td width=50>选择</td></tr>";
                    for(var i in res.content){
                        str+="<tr><td align=left>&nbsp;&nbsp;"+res.content[i].title+"</td><td><img src='{{asset('images/jplugin.png')}}' name='"+res.content[i].title+"' id='addpeijianImg_"+res.content[i].id+"'  onclick='addpeijian("+res.content[i].id+")'></td></tr>";
                    }
                    str+="</table>";
                    $('#pp_list_gx').html(str);
                    $("#pagination3").whjPaging("setPage", res.currPage, res.totalPage);
                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }
        function delpeijian(id){$("#pj"+id).remove();}
        function delorder(id){$("#p"+id).remove();}
        function delgongxu(id){$("#gx"+id).remove();}


        function addpeijian(id){
            var flag = $("#peijianlistitem").find("#pj"+id).length;
            if(!(flag > 0)){
                var title = $("#addpeijianImg_"+id).attr("name");
                var str="";
                str+="<p id='pj"+id+"'><span onclick='delpeijian("+id+")'></span>"+title+"<input type='hidden' name='peijian_id' value='"+id+"'></p>";
                $('#peijianlistitem').append(str);
            }
        }
        function addgongxu(id){
            var flag = $("#gxlistitem").find("#gx"+id).length;
            if(!(flag > 0)){
                var title = $("#addgongxuImg_"+id).attr("name");
                var str="";
                str+="<p id='gx"+id+"'><span onclick='delgongxu("+id+")'></span>"+title+"<input type='hidden' name='gongxu_id' value='"+id+"'></p>";

                $('#gxlistitem').append(str);
            }
        }

        function getgongxuid(){
            var str="";
            $("input[name='gongxu_id']").each(function(){
                str+=$(this).val()+"|";}
            );
            if(str.length==0){alert('请选择工序！')}else{
                $.ajax({
                    type: "GET",
                    url: "/jb_admin/product/gongxuadd",
                    data: {"str":str},
                    datatype: "json",
                    async:false,
                    success: function(res){
                        var tr="";
                        for(var i in res.content){
                            tr+="<tr><td>"+res.content[i].title+"</td><td width='300'><input type='text' class='input' value='请选择' onclick='choosegx("+res.content[i].id+")' name='[]' id='gxtitle"+res.content[i].id+"' datatype='*' style='width: 300px; text-align: center;' ><input type='hidden'  name='gongxu_id[]' value='"+res.content[i].id+"'><input type='hidden' id='gxid"+res.content[i].id+"' name='p_id[]' value=''></td></td><td><a href='javascript:;' id='a"+res.content[i].id+"' onclick='removep("+res.content[i].id+")'>删除</a></td></tr>";
                        }
                        $("#gongxulist").hide(1000);
                        $('#gongxu_list table').append(tr);
                    },
                    error: function(response){
                        alert(response);
                    }
                });
            }}

        function getppid(){
            var str="";
            $("input[name='peijian_id']").each(function(){
                str+=$(this).val()+"|";}
            );
            var id=$("#ppid").val();
            if(str.length==0){alert('请选择配件！')}else{
                $.ajax({
                    type: "GET",
                    url: "/jb_admin/product/choosepp",
                    data: {"str":str},
                    datatype: "json",
                    async:false,
                    success: function(res){
                        $("#gxtitle"+id).val(res.title);
                        $("#gxid"+id).val(res.id);
                        $("#pplist").hide(1000);
                    },
                    error: function(response){
                        alert(response);
                    }
                });
            }}
        function quxiaoproductid(){$("#productlist").hide(1000);}
        function quxiaogongxuid(){$("#gongxulist").hide(1000);}
        function quxiaoppid(){$("#pplist").hide(1000);}
        function removep(id){$('#a'+id).parent().parent().remove();}
        //选中的配件绑定到工序
        function choosegx(id){
            loadData3(1,10);
            $("#gxtitle"+id).val('');
            $("#pplist").show(1000);
            $("#ppid").val(id);
            $("#peijianlistitem").html('');
        }

    </script>
    <script src="{{asset('layer/layer.js')}}"></script>

</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<input type="hidden" name="ppid" id="ppid" value="0"/>
<div id="main">
    <div class="user">

        @if($do=='addnext')
            <div class="title"><span></span>添加工序</div>
            <div class="user-search">
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addproductgx/'.$id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="200">产品名称：</td>
                            <td>
                                <input type="text" class="input" name="title" value="{{$title}}" readonly nullmsg="请输入产品名称！" datatype="*"  />
                                <input type="hidden" name="type" value="{{$type}}"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">选择工序:</td>
                            <td>
                                <span id="liulangx" style="width:150px; float: left; height:30px; display: block; text-align: center; line-height:30px; border:none; background:#333; color:#fff; font-size:14px; float: left; cursor:pointer; margin:20px 0px;">点击选择工序</span>
                                <div id="gongxu_list">
                                    <table width='700' style='line-height:40px;border: 1px solid #99bce8;text-align: center;' align='center' border='0' cellspacing='0' cellpadding='0'>
                                        <tr style='background:url(/images/title_top_bg_03.png);'>
                                            <td> &nbsp;工序名称</td>
                                            <td> &nbsp;配件</td>
                                            <td> 操作</td>
                                        </tr>
                                        {!! $pgxinfo !!}
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="添加工序" style="width:180px; height:50px; line-height:50px; border:none; background:#333; color:#fff; font-size:18px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                    <br /> <br /> <br /> <br />
                </form>
            </div>
        @elseif($do=='addproduct')
            <div class="title"><span></span>添加产品</div>
            <div class="user-search" style="padding: 300px 0px; color: #ff0000; text-align: center; font-size: 32px;">
                添加产品成功，下一步添加工序
            </div>
        @elseif($do=='fuzhiproduct')
            <div class="title"><span></span>复制产品</div>
            <div class="user-search" style="padding: 300px 0px; color: #ff0000; text-align: center; font-size: 32px;">
                复制产品成功，下一步复制工序
            </div>
        @elseif($do=='editproduct')
            <div class="title"><span></span>更新产品</div>
            <div class="user-search" style="padding: 300px 0px; color: #ff0000; text-align: center; font-size: 32px;">
                更新产品成功，下一步更新工序工序
            </div>
        @endif
    </div>
</div>

<div id="gongxulist" style="z-index: 99999999;">
    <div class="chuli">
        <div class="title"><span id="closegongxulist" class="close"></span>工序列表</div>
        <div class="addorder">
            <div class="pleft">
                <table width="500" style="line-height: 32px; float: left;" border="0" cellspacing="0" align="center" cellpadding="0">
                    <tr>
                        <td>
                            <input type="text" class="input" style="margin-right: 5px; width:150px;" name="gongxu_title" id="gongxu_title" value="" >
                            <span class="kehu_search" onclick="loadData2(1,10)"></span>
                        </td>
                </table>
                <div class="user-list" id="list_gx">加载中</div>

            </div>
            <div class="pright" id="gxright">
                <b>已选择：</b>
                <div id="gxlistitem"></div>
            </div>
            <div id="pagination2" style="padding: 30px 10px; float: left;"></div>
            <div class="subquyu">
                <input type="button" class="button" onclick="getgongxuid()" value="确 认"/>
                <input type="button" class="button delete" onclick="quxiaogongxuid()" value="取 消"/>
            </div>
            <script language="JavaScript">
                //设置分页插件显示
                $("#pagination2").whjPaging({
                    //可选，每页显示条数下拉框，默认下拉框5条/页(默认)、10条/页、15条/页、20条/页
                    pageSizeOpt: [
                        {'value': 10, 'text': '10条/页', 'selected': true},
                    ],
                    //可选，css设置，可设置值：css-1，css-2，css-3，css-4，css-5，默认css-1，可自定义样式
                    css: 'css-5',
                    //可选，总页数
                    totalPage:{{$gxcount}},
                    //可选，展示页码数量，默认5个页码数量
                    showPageNum: 5,
                    //可选，首页按钮展示文本，默认显示文本为首页
                    firstPage: '首页',
                    //可选，上一页按钮展示文本，默认显示文本为上一页
                    previousPage: '上一页',
                    //可选，下一页按钮展示文本，默认显示文本为下一页
                    nextPage: '下一页',
                    //可选，尾页按钮展示文本，默认显示文本为尾页
                    lastPage: '尾页',
                    //可选，跳至展示文本，默认显示文本为跳至
                    skip: '跳至',
                    //可选，确认按钮展示文本，默认显示文本为确认
                    confirm: '确认',
                    //可选，刷新按钮展示文本，默认显示文本为刷新
                    refresh: '刷新',
                    //可选，共{}页展示文本，默认显示文本为共{}页，其中{}会在js具体转化为数字
                    totalPageText: '共{}页',
                    //可选，是否展示首页与尾页，默认true
                    isShowFL: true,
                    //可选，是否展示每页N条下拉框，默认true
                    isShowPageSizeOpt: false,
                    //可选，是否展示跳到指定页数，默认true
                    isShowSkip: false,
                    //可选，是否展示刷新，默认true
                    isShowRefresh: false,
                    //可选，是否展示共{}页，默认true
                    isShowTotalPage: true,
                    //可选，是否需要重新设置当前页码及总页数，默认false，如果设为true，那么在请求服务器返回数据时，需要调用setPage方法
                    isResetPage: false,
                    //必选，回掉函数，返回参数：第一个参数为页码，第二个参数为每页显示N条
                    callBack: function (currPage, pageSize) {
                        loadData2(currPage, pageSize);
                    }
                });

            </script>
            <br /> <br /> <br /> <br />

        </div>
    </div>
</div>

<div id="pplist" style="z-index: 99999999;">
    <div class="chuli">
        <div class="title"><span id="closepeijianlist" class="close"></span>{{$title}}配件列表</div>
        <div class="addorder">
            <div class="pleft">
                <table width="500" style="line-height: 32px; float: left; margin-top: 10px;" border="0" cellspacing="0" align="center" cellpadding="0">
                    <tr>
                        <td>
                            <input type="text" class="input" style="margin-right: 5px; width:150px;" name="pp_title" id="pp_title" value="" >
                            <span class="kehu_search" onclick="loadData3(1,10)"></span>
                        </td>
                </table>
                <div class="user-list" id="pp_list_gx">加载中</div>

            </div>
            <div class="pright" id="ppright">
                <b>已选择：</b>
                <div id="peijianlistitem"></div>
            </div>
            <div id="pagination3" style="padding: 30px 10px; float: left;"></div>
            <div class="subquyu">
                <input type="button" class="button" onclick="getppid()" value="确 认"/>
                <input type="button" class="button delete" onclick="quxiaoppid()" value="取 消"/>
            </div>
            <script language="JavaScript">
                //设置分页插件显示
                $("#pagination3").whjPaging({
                    //可选，每页显示条数下拉框，默认下拉框5条/页(默认)、10条/页、15条/页、20条/页
                    pageSizeOpt: [
                        {'value': 10, 'text': '10条/页', 'selected': true},
                    ],
                    //可选，css设置，可设置值：css-1，css-2，css-3，css-4，css-5，默认css-1，可自定义样式
                    css: 'css-5',
                    //可选，总页数
                    totalPage:{{$ppcount}},
                    //可选，展示页码数量，默认5个页码数量
                    showPageNum: 5,
                    //可选，首页按钮展示文本，默认显示文本为首页
                    firstPage: '首页',
                    //可选，上一页按钮展示文本，默认显示文本为上一页
                    previousPage: '上一页',
                    //可选，下一页按钮展示文本，默认显示文本为下一页
                    nextPage: '下一页',
                    //可选，尾页按钮展示文本，默认显示文本为尾页
                    lastPage: '尾页',
                    //可选，跳至展示文本，默认显示文本为跳至
                    skip: '跳至',
                    //可选，确认按钮展示文本，默认显示文本为确认
                    confirm: '确认',
                    //可选，刷新按钮展示文本，默认显示文本为刷新
                    refresh: '刷新',
                    //可选，共{}页展示文本，默认显示文本为共{}页，其中{}会在js具体转化为数字
                    totalPageText: '共{}页',
                    //可选，是否展示首页与尾页，默认true
                    isShowFL: true,
                    //可选，是否展示每页N条下拉框，默认true
                    isShowPageSizeOpt: false,
                    //可选，是否展示跳到指定页数，默认true
                    isShowSkip: false,
                    //可选，是否展示刷新，默认true
                    isShowRefresh: false,
                    //可选，是否展示共{}页，默认true
                    isShowTotalPage: true,
                    //可选，是否需要重新设置当前页码及总页数，默认false，如果设为true，那么在请求服务器返回数据时，需要调用setPage方法
                    isResetPage: false,
                    //必选，回掉函数，返回参数：第一个参数为页码，第二个参数为每页显示N条
                    callBack: function (currPage, pageSize) {
                        loadData3(currPage, pageSize);
                    }
                });

            </script>
            <br /> <br /> <br /> <br />

        </div>
    </div>
</div>

<script language="javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform({
            tiptype:3,
        });
    })
</script>
<script type="text/javascript">var ue = UE.getEditor('content');</script>
</body>
</html>

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
        function queren()
        {
            if(!confirm('确定要删除吗?'))
            {
                window.event.returnValue = false;
            }
        }
        function loadData(currPage, pageSize) {
            var title=$("#title").val();
            var type=$("#type").val();
                $.ajax({
                    type: "POST",
                    url: "/jb_admin/product/backproductxilie",
                    data: {"currPage":currPage,"pageSize":pageSize,"title":title,"type":type},
                    datatype: "json",
                    async:false,
                    beforeSend: function () {
                        $('#productxilie').html('加载中');
                    },
                    success: function(res){
                        var str="";
                        str+="<table width=\"100%\" style=\"text-align:center;background-color:#fff; margin-top:30px; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                        str+="<tr class=\"tr\"><td >系列编号</td><td>系列名称</td><td>操作</td></tr>";
                        for(var i in res.content){
                            str+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'><td>"+res.content[i].id+"</td><td>"+res.content[i].title+"</td><td><a href='{{URL('jb_admin/xilie/edit')}}/"+res.content[i].id+"'> 修改</a> | <a href='{{URL('jb_admin/excsql/delproductxilie')}}/"+res.content[i].id+"' onclick='queren()'> 删除</a></td></tr>";
                        }
                        str+="</table>";
                        $('#productxilie').html(str);
                        $("#pagination").whjPaging("setPage", res.currPage, res.totalPage);

                    },
                    error: function(response){
                       alert(response);
                    }
                });
        }
    </script>
    <script src="{{asset('layer/layer.js')}}"></script>

</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<input type="hidden" name="ppid" id="ppid" value="0"/>
<div id="main">
    <div class="user">
        @if($do=='list')
            <div class="bigTitleName">产品系列搜索</div>
            <div class="smallEngTitleName">SEARCH PRODUCT SERIES</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="get" action="{{URL('jb_admin/xilie/list')}}">
                    &nbsp;系列名称：<input type="text" name="title" id="title" class="text" value="" />
                    类型：
                    <select name="type" id="type">
                        <option value="">全部</option>
                        <option value="1">产品系列</option>
                        <option value="2">子配件系列</option>
                        <option value="3">原料系列</option>
                    </select>
                    <input type="button" value="查找" class="button" onclick="loadData(1,10)" />
                    <input type="button" value="添加" class="button" id="productxilieadd" />
                    <a href="{{URL('jb_admin/xilie/list')}}">清除搜索条件</a>
                </form>
            </div>
            <div class="user-list" id="productxilie">加载中</div>
            <div id="pagination" style="padding: 30px 10px; float: left;"></div>
            <script language="JavaScript">
                //设置分页插件显示
                $("#pagination").whjPaging({
                    //可选，每页显示条数下拉框，默认下拉框5条/页(默认)、10条/页、15条/页、20条/页
                    pageSizeOpt: [
                        {'value': 10, 'text': '10条/页', 'selected': true},
                        {'value': 20, 'text': '20条/页'},
                        {'value': 50, 'text': '50条/页'},
                        {'value': 100, 'text': '100条/页'}
                    ],
                    //可选，css设置，可设置值：css-1，css-2，css-3，css-4，css-5，默认css-1，可自定义样式
                    css: 'css-1',
                    //可选，总页数
                    totalPage:{{$totelpage}},
                    //可选，展示页码数量，默认5个页码数量
                    showPageNum: 8,
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
                    isShowPageSizeOpt: true,
                    //可选，是否展示跳到指定页数，默认true
                    isShowSkip: true,
                    //可选，是否展示刷新，默认true
                    isShowRefresh: true,
                    //可选，是否展示共{}页，默认true
                    isShowTotalPage: true,
                    //可选，是否需要重新设置当前页码及总页数，默认false，如果设为true，那么在请求服务器返回数据时，需要调用setPage方法
                    isResetPage: false,
                    //必选，回掉函数，返回参数：第一个参数为页码，第二个参数为每页显示N条
                    callBack: function (currPage, pageSize) {
                        loadData(currPage, pageSize);
                    }
                });
                loadData(1,10);
            </script>
        @elseif($do=='add')
            <div class="bigTitleName">新增产品系列</div>
            <div class="smallEngTitleName">ADD PRODUCT SERIES</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search" style="width:100%;height:350px;">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addproductxilie')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="200">产品系列名称:</td>
                            <td><input type="text" class="input" name="title" value="" nullmsg="请输入产品系列名称！" datatype="*" ></td>
                        </tr>
                        <tr>
                            <td align="right">类型:</td>
                            <td>
                                <select name="type" class="input">
                                    <option value="1">产品系列</option>
                                    <option value="2">子配件系列</option>
                                    <option value="3">原料系列</option>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="添 加" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"   /></td>
                        </tr>
                    </table>
                </form>
            </div>
        @elseif($do=='edit')
            <div class="bigTitleName">更新系列</div>
            <div class="smallEngTitleName">UPDATE SERIES</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editproductxilie/'.$data[0]->id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 30px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="200">系列名称:</td>
                            <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入系列名称！" datatype="*" ></td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="更 新" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"   /></td>
                        </tr>
                    </table>
                </form>
            </div>
        @endif
    </div>
</div>
<script>
    //弹出一个iframe层
    $('#productxilieadd').on('click', function(){
        layer.open({
            type: 2,
            title: '新增产品系列',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['1000px' , '500px'],
            content: '{{URL('jb_admin/xilie/add')}}'
        });
    });
</script>

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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pagination.css')}}"/>
    <script type="text/javascript" src="{{asset('js/pagination.min.js')}}"></script>
    <script language="javascript">
        function queren(msg)
        {
            if(!confirm(msg))
            {
                window.event.returnValue = false;
            }
        }
        function loadData(currPage, pageSize) {
            var title=$("#p_title").val();
            var gongxu=$("#gongxu").val();
            $.ajax({
                type: "POST",
                url: "/jb_admin/shebei/shebeilist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title,"gongxu":gongxu},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#list').html('加载中');
                },
                success: function(res){
                    var str="";
                    str+="<table width=\"100%\" style=\"text-align:center;background-color:#fff; margin-top:30px; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td >设备编号</td><td >设备名称</td><td>工序</td><td>操作</td></tr>";
                    for(var i in res.content){
                        str+="<tr><td>"+res.content[i].id+"</td><td>"+res.content[i].title+"</td><td>"+res.content[i].gongxu+"</td>";
                        str+="<td><a href='{{URL('jb_admin/shebei/edit')}}/"+res.content[i].id+"'>修改</a> | <a onclick=\"queren('确定要删除吗?')\" href='{{URL('jb_admin/excsql/delshebei')}}/"+res.content[i].id+"'>删除</a> </td></tr>";
                    }
                    str+="</table>";
                    $('#list').html(str);
                    $("#pagination").whjPaging("setPage", res.currPage, res.totalPage);

                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }
    </script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<div id="main">
    <div class="user">
        @if($do=='list')
        <div class="title"><span></span>设备搜索</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/shebei/list')}}">
                &nbsp;
                设备名称：<input type="text" name="title" id="p_title" class="text" value="" />
                工序：<input type="text" name="gongxu" id="gongxu" class="text" value="" />
                <input type="button" value="查找" onclick="loadData(1,10)" class="button" /> <a href="{{URL('jb_admin/shebei/list')}}">清楚搜索条件</a>
            </form>
        </div>
        <div class="user-list">
            <div id="list">加载中</div>
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
                    css: 'css-5',
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
        </div>


        @elseif($do=='edit')
            <div class="title"><span></span>更新设备资料</div>
            <div class="user-search">
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editshebei/'.$data[0]->id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="400">设备编号：</td>
                            <td><input type="text" class="input" name="id" value="{{$data[0]->id}}" readonly /><font color="#f00">* 不可编辑</font></td>
                        </tr>
                        <tr>
                            <td align="right" width="400">设备名称：</td>
                            <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入设备名称" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right">工序:</td>
                            <td>
                                @foreach($gongxu as $e)
                                    <input type="checkbox" name="beizhu[]" value="{{$e->id}}" {{\App\Http\Controllers\AdminyuangongController::checkgongxu($data[0]->gongxu,$e->id)}}/>{{$e->title}}
                                @endforeach

                            </td>
                        </tr>

                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="更新设备" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                    <br /> <br /> <br /> <br />
                </form>
            </div>
            <div class="user-list">
            </div>

        @elseif($do=='add')
        <div class="title"><span></span>添加设备</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addshebei')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right" width="400">设备编号：</td>
                        <td><input type="text" class="input" name="idcard" value="{{$id}}" readonly />系统生成，仅供参考</td>
                    </tr>
                    <tr>
                        <td align="right">设备名称:</td>
                        <td><input type="text" class="input" name="title" value="" nullmsg="请输入设备名称！" datatype="*" ajaxurl="{{URL('checkkehu')}}"></td>
                    </tr>

                    <tr>
                        <td align="right">工序：</td>
                        <td>
                            @foreach($data as $e)
                                <input type="checkbox" name="beizhu[]" value="{{$e->id}}"/>{{$e->title}}
                            @endforeach
                        </td>
                    </tr>

                    <tr>
                        <td align="right"></td>
                        <td><input type="submit" value="添加设备" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                    </tr>
                </table>
                <br /> <br /> <br /> <br />
            </form>
        </div>
        <div class="user-list">
        </div>
        @endif
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
</body>
</html>

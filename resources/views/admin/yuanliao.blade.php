<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>后台管理系统</title>
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    <script language="javascript" src="{{asset('admin/laydate/laydate.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/jquery.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/index.js')}}"></script>
    <link href="{{asset('css/jquery.searchableSelect.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.PrintArea.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pagination.css')}}"/>
    <script type="text/javascript" src="{{asset('js/pagination.min.js')}}"></script>
    <script language="javascript" src="{{asset('admin/js/update.js')}}"></script>
    <script language="javascript">
        function loadDataorder(currPage, pageSize){
            var title=$("#o_title").val();
            var bianhao=$("#o_bianhao").val();
            var picihao=$("#o_picihao").val();
            var guige=$("#o_guige").val();
            var start=$("#o_start").val();
            var end=$("#o_end").val();
            var typeid=$("#o_typeid").val();
            $.ajax({
                type: "GET",
                url: "/jb_admin/yuanliao/yuanliaolist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title,"typeid":typeid,"guige":guige,"bianhao":bianhao,"picihao":picihao,"start":start,"end":end},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#list_product').html('加载中');
                },
                success: function(res){
                    $('#productordera table').html();
                    var str="";
                    str+="<table width='100%' style='text-align:center;background-color:#fff; margin-top:30px; line-height:30px;' cellpadding='0' cellspacing='0'>";
                    str+="<tr class='tr'><td >ID</td><td>原料名称</td><td>缩略图</td><td>编号</td><td>批次号</td><td>规格</td><td>单位</td><td>入库时间</td><td>添加时间</td><td>库存</td><td>操作</td></tr>";
                    for(var i in res.content){
                        str+="<tr><td> "+res.content[i].id+"</td><td> "+res.content[i].title+"</td><td><img src="+res.content[i].pic+" alt='"+res.content[i].title+"' style='max-height: 100px; max-width: 100px; margin: 10px;'/></td><td>"+res.content[i].bianhao+"</td><td>"+res.content[i].picihao+"</td><td>"+res.content[i].guige+"</td><td>"+res.content[i].danwei+"</td><td>"+res.content[i].rukutime+"</td><td>"+res.content[i].shijian+"</td><td>"+res.content[i].kucun+"</td><td><a href='{{URL('jb_admin/yuanliao/edit')}}/"+res.content[i].id+"'> 修改</a></td></tr>";
                    }
                    str+="</table>";
                    $('#list_order').html(str);
                    $("#paginationorder").whjPaging("setPage", res.currPage, res.totalPage);
                    $('#totelprice').html(res.totelprice);
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
    @if($do=='list')
    <div class="user">
        <div class="title"><span></span>原料列表</div>
        <div class="user-search">
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/order/list')}}">
                &nbsp;
                原料名称：<input type="text" name="o_title" id="o_title" class="text" value="" />
                编号：<input type="text" name="o_bianhao" id="o_bianhao" class="text" value="" />
                批次号：<input type="text" name="o_picihao" id="o_picihao" class="text" value="" />
                规格：<input type="text" name="o_guige" id="o_guige" class="text" value="" /><br>
                &nbsp;原料系列：<select name="o_typeid" id="o_typeid">
                    @foreach($xilie as $e)
                        <option value="{{$e->id}}">{{$e->title}}</option>
                    @endforeach
                </select>

                &nbsp;入库时间：<input type="text" name="o_start" id="o_start" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="o_end" id="o_end" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  /> <!-- 两个时间同时选择-->
                <input type="button" value="查找" class="button" onclick="loadDataorder(1,10)" />
                <input type="button" value="新增原料" class="button" onclick="window.location.href='{{URL('jb_admin/yuanliao/add')}}'" />
                <a href="{{URL('jb_admin/yuanliao/list')}}">清楚搜索条件</a>
            </form>
        </div>

        <div class="user-list">
            <div id="list_order">加载中</div>
            <div id="paginationorder" style="padding: 30px 10px; float: left;"></div>
        </div>
        <script language="JavaScript">
            //设置分页插件显示
            $("#paginationorder").whjPaging({
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
                    loadDataorder(currPage, pageSize);
                }
            });
            loadDataorder(1,10);
        </script>
    </div>
    @elseif($do=='add')
    <div class="user">
        <div class="title"><span></span>添加原料</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addyuanliao')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right" width="200">原料名称：</td>
                        <td><input type="text" class="input" name="title" value="" nullmsg="请输入产品名称！" datatype="*"  /></td>
                    </tr>
                    <tr>
                        <td align="right">系列：</td>
                        <td>
                            <select name="typeid" class="input">
                                @foreach($xilie as $e)
                                    <option value="{{$e->id}}">{{$e->title}}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>
                    <tr>
                        <td align="right">原料图片:</td>
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
                                <div style="width:200px; height:20px; background:#fbfbfb; margin-top:-20px; position:absolute; z-index:1; padding-left:20px;"></div>
                            </div>
                            <div id="show" style=" width:640px;line-height:18px;font-size:12px;text-align:left;margin:0 auto; margin-bottom: 20px;"></div>
                            <input type="hidden" name="pic" id="pic" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td align="right">原料编号:</td>
                        <td><input type="text" class="input" name="bianhao" value="" nullmsg="请输入原料编号！" datatype="*" ></td>
                    </tr>
                    <tr>
                        <td align="right">入库时间：</td>
                        <td><input type="text" class="input" value="{{date('Y-m-d H:i:s')}}" name="rukutime" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" nullmsg="请输入入库时间！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">批次号：</td>
                        <td><input type="text" class="input" name="picihao" value="{{date('YmdHis').rand(1000,9999)}}"  nullmsg="请输入批次号！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">规格：</td>
                        <td><input type="text" class="input" name="guige" value=""  nullmsg="请输入规格！" datatype="*"   /></td>
                    </tr>
                    <tr>
                        <td align="right">单位：</td>
                        <td>
                            <select name="danwei" class="input">
                                <option value="KG">KG</option>
                                <option value="件">件</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">库存：</td>
                        <td><input type="text" class="input" name="kucun" value="0"  nullmsg="请输入库存！" datatype="n"  /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><input type="submit" value="添加原料" style="width:180px; height:50px; line-height:50px; border:none; background:#333; color:#fff; font-size:18px; cursor:pointer; margin:20px 0px;"  /></td>
                    </tr>
                </table>
                <br /> <br /> <br /> <br />
            </form>
        </div>
        <div class="user-list">
        </div>

    @elseif($do=='edit')
    <div class="user">
        <div class="title"><span></span>更新原料</div>
        <div class="user-search">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/edityuanliao/'.$id)}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="855" style="margin-top: 100px;" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="right" width="400">原料名称：</td>
                        <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入产品名称！" datatype="*"  /></td>
                    </tr>
                    <tr>
                        <td align="right" width="400">系列：</td>
                        <td>
                            <select name="typeid" class="input">
                                <option value="{{$data[0]->typeid}}">{{$typename}}</option>
                                @foreach($xilie as $e)
                                    <option value="{{$e->id}}">{{$e->title}}</option>
                                @endforeach
                            </select>

                        </td>
                    </tr>

                    <tr>
                        <td align="right">原料图片:</td>
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
                            <div id="show">{!! $img !!}</div>
                            <input type="hidden" name="pic" id="pic" value="{{$imgurl}}" style="width:800px; margin-bottom: 20px;" />
                        </td>
                    </tr>

                    <tr>
                        <td align="right">原料编号：</td>
                        <td><input type="text" class="input" name="bianhao" value="{{$data[0]->bianhao}}" nullmsg="请输入原料编号！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">入库时间：</td>
                        <td><input type="text" class="input" name="rukutime" value="{{date('Y-m-d H:i:s',$data[0]->rukutime)}}"  nullmsg="请输入统一VIP折扣！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">批次号：</td>
                        <td><input type="text" class="input" name="picihao" value="{{$data[0]->picihao}}" nullmsg="请输入批次号！" datatype="*" /></td>
                    </tr>
                    <tr>
                        <td align="right">规格：</td>
                        <td><input type="text" class="input" name="guige" value="{{$data[0]->guige}}"  nullmsg="请输入规格！" datatype="*"   /></td>
                    </tr>
                    <tr>
                        <td align="right">单位：</td>
                        <td>
                            <select name="danwei" class="input">
                                @if($data[0]->danwei=='KG')
                                    <option value="KG">KG</option>
                                    <option value="件">件</option>
                                @else
                                    <option value="件">件</option>
                                    <option value="KG">KG</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">库存：</td>
                        <td><input type="text" class="input" name="kucun" value="{{$data[0]->kucun}}" nullmsg="请输入库存！" datatype="n" /></td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td><input type="submit" value="下一步" style="width:100px; height:40px; line-height:40px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                    </tr>
                </table>
                <br /> <br /> <br /> <br />
            </form>
        </div>
        <div class="user-list">
        </div>










        @endif
</div>

<script type="text/javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform();  //就这一行代码！;
        tiptype:3
    })
</script>

</body>
</html>

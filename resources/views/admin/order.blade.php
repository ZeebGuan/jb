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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#addorder").click(function(){
                $("#chuli").show(1000);
            });
            $("#close").click(function(){
                $("#chuli").hide(1000);
            });
            $("#liulan").click(function(){
                $("#choosekehu").show(1000);
                $("#kehutype").val('1');
                loadData(1,10);
            });
            $("#p_liulan").click(function(){
                $("#choosekehu").show(1000);
                $("#kehutype").val('2');
                loadData(1,10);
            });
            $("#closekehu").click(function(){
                $("#choosekehu").hide(1000);
            });
            $("#addproduct").click(function(){
                $("#productlist").show(1000);
                $("#ordertype").val('1');
                loadData1(1,10);
            });
            $("#addorderlist").click(function(){
                $("#productlist").show(1000);
                $("#ordertype").val('2');
                loadData1(1,10);
                $("#productlistitem").html('');
            });

            $("#closeproduct").click(function(){
                $("#productlist").hide(1000);
            });
            $("#reset").click(function(){
                $("#chuli").hide(1000);
            });
            $("#closedetail").click(function(){
                $("#showorder").hide(1000);
            });
            $("#closemoni").click(function(){
                $("#monilist").hide(1000);
            });
        });
    </script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/pagination.css')}}"/>
    <script type="text/javascript" src="{{asset('js/pagination.min.js')}}"></script>
    <script language="javascript">
        function delorder(id){$("#p"+id).remove();}
        function selectall(){
            //获取全选复选框
            var root = document.getElementById("checkall");
            //获取全选复选框的状态
            var status = root.checked;
            // alert(status);
            //获取其他复选框集合
            var elem = document.getElementsByName("oid");
            //如果全选复选框状态为真则全选其他按钮,否则选不选其他按钮
            if(status){
                for(var i = 0;i<elem.length;i++){
                    elem[i].checked =  true;
                }
            }else{
                for(var i = 0;i<elem.length;i++){
                    elem[i].checked =  false;
                }
            }
        }
        function checkItem(ele){
            var root = document.getElementById("checkall");
            if(!ele.checked){
                //当在全选状态去除某个非全选复选框时，全选复选框checked属性要设为false
                root.checked = false;
            }else{
                //当在全不选状态时，补全剩下的非全选复选框时，全选复选框checked属性设为true
                var elem = document.getElementsByName(ele.name);
                for(var i = 0;i<elem.length;i++){
                    if(!elem[i].checked){
                        return;
                    }
                }
                root.checked = true;
            }
        }
        function getprice(){
            var num = new Array();
            var price = new Array();
            var i=0;j=0;
            $("input[name='num[]']").each(function(){
                num[i]=$(this).val();i++;}
            );
            $("input[name='price[]']").each(function(){
                price[j]=$(this).val();j++;}
            );
            var totel=0;
            for(var i in num){
                totel=num[i]*price[i]+totel;
            }
            var type=$('#ordertype').val();
            if(type=='1'){
                $('#jine').val(totel);
            }else {
                $('#p_jine').val(totel);
            }
        }
        function getproductid(){
            var str="";
            $("input[name='product_id']").each(function(){
                str+=$(this).val()+"|";}
            );
            if(str.length==0){alert('请选择产品！')}else{
                $.ajax({
                    type: "POST",
                    url: "/jb_admin/order/productitem",
                    data: {"str":str},
                    datatype: "json",
                    async:false,
                    success: function(res){
                        var tr="";
                        for(var i in res.content){
                            tr+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#f2f5f7'><td><input type='checkbox' value='"+res.content[i].id+"' name='oid' onclick='checkItem(this)' /></td><td>"+res.content[i].title+"</td><td>"+res.content[i].guige+"</td><td><input type='text' class='input' value='1' name='num[]' datatype='n' onkeyup='getprice(1)'></td><td><input readonly class='input' name='price[]' value='"+res.content[i].jine+"'><input type='hidden' name='pid[]' value='"+res.content[i].id+"'></td></tr>";
                        }
                        $("#productlist").hide(1000); $('#productlistitem').html('');
                        if($('#ordertype').val()=='1'){
                            $('#productordera table').html('');
                            $('#productorder table').append(tr);
                            $('#jine').val(parseInt(res.totelprice)+parseInt($('#jine').val()));
                        }else {
                            $('#productorder table').html('');
                            $('#productordera table').append(tr);
                            $('#p_jine').val(parseInt(res.totelprice)+parseInt($('#p_jine').val()));
                        }
                    },
                    error: function(response){
                        alert(response);
                    }
                });
        }}
        function quxiaoproductid(){$("#productlist").hide(1000);}
        function choosekehu(id){
            $.ajax({
                type: "GET",
                url: "/jb_admin/order/kehuinfo",
                data: {"id":id},
                datatype: "json",
                async:false,
                success: function(res){
                    if($("#kehutype").val()=='1'){
                        document.getElementById('kehu_id').value=res.id;
                        document.getElementById('kehu_title').value=res.title;
                        document.getElementById('kehu_name').value=res.name;
                        document.getElementById('kehu_phone').value=res.phone;
                        document.getElementById('kehu_didian').value=res.dizhi;
                    }else {
                        document.getElementById('p_id').value=res.id;
                        document.getElementById('p_title').value=res.title;
                        document.getElementById('p_name').value=res.name;
                        document.getElementById('p_phone').value=res.phone;
                        document.getElementById('p_didian').value=res.dizhi;
                    }

                    $("#choosekehu").hide(1000);
                },
                error: function(response){
                    alert(response);
                }
            });
        }
        function addorder(id){
            var flag = $("#pright").find("#p"+id).length;
            if(!(flag > 0)){
                var title = $("#addorderImg_"+id).attr("name");
                var str="";
                str+="<p id='p"+id+"'><span onclick='delorder("+id+")'></span>"+title+"<input type='hidden' name='product_id' value='"+id+"'></p>";

                $('#productlistitem').append(str);
            }
        }
        function loadData(currPage, pageSize) {
            var title=$("#title").val();
            $.ajax({
                type: "POST",
                url: "/jb_admin/order/kehulist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#productxilie').html('加载中');
                },
                success: function(res){
                    var str="";
                    str+="<table width=\"100%\" style=\"text-align:center;background-color:#fff; margin-top:30px; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td >选择</td><td >客户名称</td><td>联系人</td><td>电话</td></tr>";
                    for(var i in res.content){
                        str+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'><td><input type=\"radio\" value=\""+res.content[i].id+"\" onclick=\"choosekehu("+res.content[i].id+")\" name=\"id\"/></td><td>"+res.content[i].title+"</td><td>"+res.content[i].name+"</td><td>"+res.content[i].phone+"</td></tr>";
                    }
                    str+="</table>";
                    $('#productxilie').html(str);
                    $("#pagination").whjPaging("setPage", res.currPage, res.totalPage);

                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }
        function loadData1(currPage, pageSize) {
            var title=$("#product_title").val();
            var typeid=$("#typeid").val();
            var sell_station=1;
            $.ajax({
                type: "POST",
                url: "/jb_admin/order/productlist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title,"typeid":typeid,"sell_station":sell_station},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#list_product').html('加载中');
                },
                success: function(res){
                    var str="";
                    str+="<table width=\"400\" style=\"text-align:center;border: 1px solid #99bce8;background-color:#fff; margin-top:30px;float:left; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td >产品名称</td><td>规格</td></tr>";
                    for(var i in res.content){
                        str+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'><td align=left>&nbsp;&nbsp;<img src='{{asset('images/jplugin.png')}}'  name='"+res.content[i].title+"' id='addorderImg_"+res.content[i].id+"' onclick='addorder("+res.content[i].id+")'> "+res.content[i].title+"</td><td>"+res.content[i].guige+"</td></tr>";
                    }
                    str+="</table>";
                    $('#list_product').html(str);
                    $("#pagination1").whjPaging("setPage", res.currPage, res.totalPage);

                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }

        function delproduct(){
            $("input[name='oid']").each(function(){
                if($(this).is(':checked')){
                    $(this).parent().parent().remove();
                }
            });
            if($('#ordertype').val()=='1'){
                getprice(1);
            }else {
                getprice(2);
            }
        }
        function moni(type){
            var num="";
            var pid="";
            var orderid="";
            if(type==1){
                orderid=$("#orderid").val();
            }else {
                orderid=$("#p_orderid").val();
            }
            $("input[name='num[]']").each(function(){
                num+=$(this).val()+"|";}
            );
            $("input[name='pid[]']").each(function(){
                pid+=$(this).val()+"|";}
            );
            $.ajax({
                type: "GET",
                url: "/jb_admin/moni/gettime",
                data: {"num":num,"pid":pid,"orderid":orderid},
                datatype: "json",
                async:false,
                success: function(res){
                    document.getElementById('monitime').value=res.shijian;
                    document.getElementById('beizhu').value=res.msg;
                    var str="";
                    str+="<table width='630' style='line-height:30px;border: 1px solid #99bce8;text-align: center; margin-top: 10px;' align='center' border='0' cellspacing='0' cellpadding='0'>";
                    str+="<tr style='background:url(/images/title_top_bg_03.png);'><td> &nbsp;产品名称</td><td> &nbsp;产品库存</td><td> &nbsp;订单需要总数</td></tr>";
                    for(var i in res.content){
                        str+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'><td>"+res.content[i].title+"</td><td>"+res.content[i].kucun+" "+res.content[i].danwei+"</td><td>"+res.content[i].num+" "+res.content[i].danwei+"</td></tr>";
                    }
                    str+="</table>";
                    $('#moniorder').html(str);
                    $("#monilist").show();
                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }
        function loadDataorder(currPage, pageSize){
            var orderid=$("#o_orderid").val();
            var title=$("#o_kehu").val();
            var station=$("#o_station").val();
            var type=$("#o_type").val();
            var start=$("#o_start").val();
            var end=$("#o_end").val();
            var paixu=$("#o_paixu").val();
            var fangshi=$("#o_fangshi").val();
            $.ajax({
                type: "GET",
                url: "/jb_admin/order/orderlist",
                data: {"currPage":currPage,"pageSize":pageSize,"orderid":orderid,"title":title,"station":station,"type":type,"start":start,"end":end,"paixu":paixu,"fangshi":fangshi},
                datatype: "json",
                async:false,
                beforeSend: function () {
                    $('#list_product').html('加载中');
                },
                success: function(res){
                    $('#productordera table').html();
                    var str="";
                    str+="<table width='100%' style='text-align:center;background-color:#fff; margin-top:30px; line-height:30px;' cellpadding='0' cellspacing='0'>";
                    str+="<tr class='tr'><td >订单号</td><td>客户</td><td>订单金额</td><td>下单时间</td><td>最迟交货时间</td><td>状态</td><td>订单类型</td><td>操作</td></tr>";
                    for(var i in res.content){
                        str+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'><td> "+res.content[i].orderid+"</td><td> "+res.content[i].title+"</td><td>"+res.content[i].jine+"</td><td>"+res.content[i].shijian+"</td><td>"+res.content[i].endtime+"</td><td>"+res.content[i].station+"</td><td>"+res.content[i].type+"</td>";
                        @if($shenhe=='1')
                                str+="<td><a href='javascript:;' onclick='showorder("+res.content[i].id+")'> 查看</a> | <a href='javascript:;' onclick='shenhe("+res.content[i].id+")'>审核</a></td></tr>";
                        @else
                                str+="<td><a href='javascript:;' onclick='showorder("+res.content[i].id+")'> 查看</a></td></tr>";
                        @endif


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
        function showorder(id){
            $.ajax({
                type: "GET",
                url: "/jb_admin/order/orderdetail",
                data: {"id":id},
                datatype: "json",
                async:false,
                success: function(res){
                    $('#productordera table').html('');
                    $('#productorder table').html('');
                    $('#showorder').show(1000);
                    document.getElementById('p_id').value=res.o_kehuid;
                    document.getElementById('p_title').value=res.o_kehutitle;
                    document.getElementById('p_name').value=res.o_name;
                    document.getElementById('p_phone').value=res.o_phone;
                    document.getElementById('p_didian').value=res.o_dizhi;
                    document.getElementById('p_endtime').value=res.o_endtime;
                    document.getElementById('p_monitime').value=res.o_monitime;
                    document.getElementById('p_jine').value=res.o_jine;
                    document.getElementById('p_didian').value=res.o_didian;
                    document.getElementById('p_beizhu').value=res.o_beizhu;
                    document.getElementById('p_orderid').value=res.o_orderid;
                    var tr="<tr style='background:url(/images/title_top_bg_03.png);'><td width='40'></td><td> &nbsp;产品名称</td><td> &nbsp;产品规格</td><td> &nbsp;数量</td><td> &nbsp;单价</td></tr>";
                    for(var i in res.content){
                        tr+="<tr><td><input type='checkbox' value='"+res.content[i].id+"'   name='oid' /></td><td>"+res.content[i].title+"</td><td>"+res.content[i].guige+"</td><td><input type='text' class='input' value='"+res.content[i].num+"' name='num[]' datatype='n' onkeyup='getprice(2)'></td><td><input readonly class='input' name='price[]' value='"+res.content[i].jine+"'><input type='hidden' name='pid[]' value='"+res.content[i].pid+"'></td></tr>";
                    }
                    $('#productordera table').append(tr);
                },
                error: function(response){
                    alert('数据解析异常！');
                }
            });
        }
    </script>
    <script src="{{asset('layer/layer.js')}}"></script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<input name="ordertype" id="ordertype" value="0" type="hidden"/>
<div id="main">
    @if($do=='list')
    <div class="user">
        <div class="bigTitleName">订单列表</div>
        <div class="smallEngTitleName">ORDER LIST</div>
        <div class="smallTitleBottomDiv"></div>
        <div class="user-search">
            <div class="title"><span></span></div>
            <form name="form1" class="myform" method="get" action="{{URL('jb_admin/order/list')}}">
                &nbsp;
                订单号：<input type="text" name="o_orderid" id="o_orderid" class="text" value="{{$orderid}}" />
                客户：<input type="text" name="o_kehu" id="o_kehu" class="text" value="{{$kehu}}" />
                订单状态：<select name="o_station" id="o_station" class="text">
                    <option value="">全部</option>
                    <option value="1">待审核</option>
                    <option value="2">待付款</option>
                    <option value="3">已付款</option>
                    <option value="4">生产中</option>
                    <option value="5">已发货</option>
                    <option value="6">已完成</option>
                    <option value="7">审核不通过</option>
                </select>
                订单类型
                <select name="o_type" id="o_type">
                    <option value="">全部</option>
                    <option value="1">客户订单</option>
                    <option value="2">内部订单</option>
                </select>
                <br>
                &nbsp; 下单时间：<input type="text" name="o_start" id="o_start" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  />
                至 &nbsp;<input type="text" name="o_end" id="o_end" value="" class="time laydate-icon" size="10" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"  /> <!-- 两个时间同时选择-->
                &nbsp;排序类型：
                <select name="o_paixu" id="o_paixu">
                        <option value="shijian">时间</option>
                        <option value="jine">金额</option>
                </select>
                排序方式
                <select name="o_fangshi" id="o_fangshi">
                        <option value="desc">降序</option>
                        <option value="asc">升序</option>
                </select>

                <input type="button" value="查找" class="button" onclick="loadDataorder(1,10)" />
                <input type="button" value="新增订单" class="button" id="addorder" name="addorder" />
                <a href="{{URL('jb_admin/order/list')}}">清楚搜索条件</a>
                <a href="{{URL('execl/order')}}">导出execl</a>
            </form>
        </div>
        <div class="titlebg"></div>
        <div class="user-search">
            <div class="countNum" style="">金额统计</div>
            <div class="countDetail">
                总金额：<font color="#ff0000" id="totelprice">...</font>
            </div>
        </div>
        <div class="titlebg"></div>
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
                    loadDataorder(currPage, pageSize);
                }
            });
            loadDataorder(1,10);
        </script>
    </div>
        @endif
</div>
<div id="chuli">
    <div class="chuli">
        <div class="title"><span id="close" class="close"></span>新增订单</div>
        <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addorder')}}">
        <div class="addorder">
                        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <table width="800" style="line-height: 30px;" border="0" cellspacing="0" align="center" cellpadding="0">
                            <tr>
                                <td align="right" width="150">客户:</td>
                                <td width="200">
                                    <input type="text" class="input" name="kehu_title" id="kehu_title" value=""  nullmsg="请选择客户名称！" datatype="*"> <span class="liulan" id="liulan">浏览</span>
                                    <input type="hidden" name="kehu_id" id="kehu_id" value="">

                                </td>
                                <td align="right" width="150">联系人:</td>
                                <td width="300"><input type="text" class="input" id="kehu_name" name="name" value="" nullmsg="请输入联系人！" datatype="*" ></td>
                            </tr>
                            <tr>
                                <td align="right">联系电话:</td>
                                <td><input type="text" class="input" name="kehu_phone" id="kehu_phone" value="" nullmsg="请输入电话！" datatype="*" ></td>
                                <td align="right">要求交期:</td>
                                <td><input type="text" class="input" name="endtime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="{{date('Y-m-d H:i:s')}}" nullmsg="请输入下单时间！" datatype="*" ></td>


                            </tr>
                            <tr>
                                <td align="right" width="100">订单金额:</td>
                                <td width="300">
                                    <input type="text" class="input" name="jine" id="jine" value="0"  nullmsg="请输入订单金额！" datatype="n">
                                    <input type="hidden" class="input" name="orderid" id="orderid" value="JBO{{time().rand(1000,9999)}}">
                                </td>
                                <td align="right">交货地点:</td>
                                <td><input type="text" class="input" name="kehu_didian" id="kehu_didian" value="" nullmsg="请输入地址！" datatype="*" ></td>
                            </tr>
                            <tr>
                                <td align="right">预计交货时间:</td>
                                <td colspan="3">
                                    <input type="text" class="input" name="monitime" id="monitime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="" nullmsg="请输入下单时间！" datatype="*" >
                                    点击下方模拟排产
                                </td>

                            </tr>
                            <tr>
                                <td align="right">备注:</td>
                                <td colspan="3">
                                    <textarea name="beizhu" id="beizhu" class="input" style="width: 300px; height: 50px; margin-top: 5px;"></textarea>
                                </td>
                            </tr>
                        </table>
                        <table width="800" style="line-height: 30px; margin-top: 20px; border-top:4px solid #192d5b;border-radius:4px;padding:0px 4px 0px 4px;" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" > &nbsp;订单明细</td>
                                <td align="right"><span class="add del" onclick="delproduct()">减少</span><span class="add" id="addproduct">增加</span></td>
                            </tr>
                            {{--<tr>--}}
                            {{--<td align="left"><span class="add" id="addproduct">增加</span>  <span class="add del" onclick="delproduct()">减少</span> <span class="add all" onclick="selectall()">全选</span></td>--}}
                            {{--</tr>--}}
                        </table>
                        <div id="productorder" style="height: 180px; overflow-y: scroll;">
                            <table width="800" style="line-height:30px;border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;text-align: center;" align="center" border="0" cellspacing="0" cellpadding="0">
                                <tr style="">
                                    <td width="40" class="all" ><input type="checkbox" id="checkall" onclick="selectall()">全选/不全选</td>
                                    <td> &nbsp;产品名称</td>
                                    <td> &nbsp;产品规格</td>
                                    <td> &nbsp;数量</td>
                                    <td> &nbsp;单价</td>
                                </tr>
                            </table>
                        </div>
        </div>
        <div class="subquyu">
            <input type="button" class="button reset" id="reset" value="取 消"/>
            <input type="submit" class="button queren" value="确 认"/>
            <input type="submit" class="button queren" value="保 存"/>
            <input type="button" class="button" onclick="moni(1)" value="模拟排产"/>
        </div>

        </form>
    </div>
</div>

<div id="showorder">
    <div class="chuli">
        <div class="title"><span id="closedetail" class="close"></span>订单详情</div>
        <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/editorder')}}">
            <div class="addorder">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="800" style="line-height: 30px;" border="0" cellspacing="0" align="center" cellpadding="0">
                    <tr>
                        <td align="right" width="150">客户:</td>
                        <td width="200">
                            <input type="text" class="input" name="p_title" id="p_title" value=""  nullmsg="请选择客户名称！" datatype="*"> <span class="liulan" id="p_liulan">浏览</span>
                            <input type="hidden" name="p_id" id="p_id" value="">

                        </td>
                        <td align="right" width="150">联系人:</td>
                        <td width="300"><input type="text" class="input" id="p_name" name="p_name" value="" nullmsg="请输入联系人！" datatype="*" ></td>
                    </tr>
                    <tr>
                        <td align="right">联系电话:</td>
                        <td><input type="text" class="input" name="p_phone" id="p_phone" value="" nullmsg="请输入电话！" datatype="*" ></td>
                        <td align="right">要求交期:</td>
                        <td><input type="text" class="input" name="p_endtime" id="p_endtime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="{{date('Y-m-d H:i:s')}}" nullmsg="请输入下单时间！" datatype="*" ></td>


                    </tr>
                    <tr>
                        <td align="right" width="100">订单金额:</td>
                        <td width="300">
                            <input type="text" class="input" name="p_jine" id="p_jine" value="0"  nullmsg="请输入订单金额！" datatype="n">
                            <input type="hidden" class="input" name="p_orderid" id="p_orderid" value="">
                        </td>
                        <td align="right">交货地点:</td>
                        <td><input type="text" class="input" name="p_didian" id="p_didian" value="" nullmsg="请输入地址！" datatype="*" ></td>
                    </tr>
                    <tr>
                        <td align="right">预计交货时间:</td>
                        <td colspan="3">
                            <input type="text" class="input" name="p_monitime" id="p_monitime" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})" value="" nullmsg="请输入下单时间！" datatype="*" >
                            点击下方模拟排产
                        </td>

                    </tr>
                    <tr>
                        <td align="right">备注:</td>
                        <td colspan="3">
                            <textarea name="p_beizhu" id="p_beizhu" class="input" style="width: 300px; height: 50px; margin-top: 5px;"></textarea>
                        </td>
                    </tr>
                </table>
                <table width="800" style="line-height: 30px; margin-top: 20px; border-top:4px solid #192d5b;border-radius:4px;padding:0px 4px 0px 4px;" align="center" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left"> &nbsp;订单明细</td>
                        <td align="right"><span class="add del" onclick="delproduct()">减少</span><span class="add" id="addorderlist">增加</span></td>
                    </tr>
                </table>
                <div id="productordera" style="height: 180px; overflow-y: scroll;">
                    <table width="800" style="line-height:30px;border-bottom: 1px solid #ccc;border-top: 1px solid #ccc;text-align: center;" align="center" border="0" cellspacing="0" cellpadding="0">

                    </table>
                </div>
            </div>
            <div class="subquyu">
                <input type="button" class="button reset" id="reset" value="取 消"/>
                <input type="submit" class="button queren" value="确 认"/>
                <input type="button" class="button" onclick="moni(2)" value="模拟排产"/>
                <input type="button" class="button dayin" value="打印订单"/>
                <input type="button" class="button add" value="再来一单"/>
            </div>

        </form>
    </div>
</div>
<div id="choosekehu">
    <div class="chuli">
        <div class="title"><span id="closekehu" class="close"></span>客户列表</div>
        <div class="addorder">
            <form name="form1" class="myform" method="post" action="{{URL('jb_admin/excsql/addpeijianxilie')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <table width="800" style="line-height: 32px;" border="0" cellspacing="0" align="center" cellpadding="0">
                    <tr>
                        <td width="200" align="left">
                            <input type="text" class="input" name="title" id="title" value="客户名称/联系人/电话" > <span class="kehu_search" onclick="loadData(1,10)"></span>
                            <input type="hidden" name="kehutype" id="kehutype" value=""/>
                        </td>
                </table>
                <div id="productxilie">加载中</div>
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
                </script>
            </form>

        </div>
    </div>
</div>

<div id="productlist">
    <div class="chuli">
        <div class="title"><span id="closeproduct" class="close"></span>产品列表</div>
        <div class="addorder">
            <div class="pleft">
                <table width="500" style="line-height: 32px; float: left;" border="0" cellspacing="0" align="center" cellpadding="0">
                    <tr>
                        <td>

                            <input type="text" class="input" style="margin-right: 5px; width:150px;" name="product_title" id="product_title" value="名称/规格" >
                            <select name="typeid" id="typeid" class="input" style="margin-right: 5px;width:150;height: 32px;">
                                <option value="">全部</option>
                                @foreach($xilie as $e)
                                    <option value="{{$e->id}}">{{$e->title}}</option>
                                @endforeach
                            </select>
                            <span class="kehu_search" onclick="loadData1(1,10)"></span>
                        </td>
                </table>
                <div class="user-list" id="list_product">加载中</div>

            </div>
            <div class="pright" id="pright">
                <b>已选择：</b>
                <div id="productlistitem"></div>
            </div>
            <div id="pagination1" style="padding: 30px 10px; float: left;"></div>
            <div class="subquyu">
                <input type="button" class="button" onclick="getproductid()" value="确 认"/>
                <input type="button" class="button delete" onclick="quxiaoproductid()" value="取 消"/>
            </div>
                <script language="JavaScript">
                    //设置分页插件显示
                    $("#pagination1").whjPaging({
                        //可选，每页显示条数下拉框，默认下拉框5条/页(默认)、10条/页、15条/页、20条/页
                        pageSizeOpt: [
                            {'value': 10, 'text': '10条/页', 'selected': true},
                        ],
                        //可选，css设置，可设置值：css-1，css-2，css-3，css-4，css-5，默认css-1，可自定义样式
                        css: 'css-1',
                        //可选，总页数
                        totalPage:{{$count}},
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
                            loadData1(currPage, pageSize);
                        }
                    });
                    loadData1(1,10);
                </script>


        </div>
    </div>
</div>

<div id="monilist">
    <div class="chuli">
        <div class="title"><span id="closemoni" class="close"></span>清单列表</div>
        <div class="addorder" id="moniorder">

        </div>
    </div>
</div>

<script>
    function shenhe(id){
        layer.open({
            type: 2,
            title: '订单审核',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['1000px' , '600px'],
            content: '{{URL('jb_admin/doorder/shenhe')}}/'+id
        });
    }
</script>


<script type="text/javascript" src="{{asset('admin/js/Validform_v5.3.2.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".myform").Validform();  //就这一行代码！;
        tiptype:3
    })
</script>

</body>
</html>

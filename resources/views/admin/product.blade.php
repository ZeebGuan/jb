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
                $("#productlistitem").html('');
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
        function loadData1(currPage, pageSize) {
            var title=$("#product_title").val();
            var typeid=$("#typeid").val();
            var sell_station=2;
            $.ajax({
                type: "POST",
                url: "/jb_admin/order/productlist",
                data: {"currPage":currPage,"pageSize":pageSize,"title":title,"typeid":typeid,"sell_station":sell_station},
                datatype: "json",
                async:false,
                success: function(res){
                    var str="";
                    str+="<table width=\"400\" style=\"text-align:center;border: 1px solid #99bce8;background-color:#fff; margin-top:30px;float:left; line-height:30px;\" cellpadding=\"0\" cellspacing=\"0\">";
                    str+="<tr class=\"tr\"><td >产品名称</td><td>规格</td></tr>";
                    for(var i in res.content){
                        str+="<tr onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'><td align=left>&nbsp;&nbsp;<img src='{{asset('images/jplugin.png')}}' onclick='addorder("+res.content[i].id+")' name='"+res.content[i].title+"' id='addorderImg_"+res.content[i].id+"' > "+res.content[i].title+"</td><td>"+res.content[i].guige+"</td></tr>";
                    }
                    str+="</table>";
                    $('#list_product').html(str);
                    $("#pagination").whjPaging("setPage", res.currPage, res.totalPage);

                },
                error: function(response){
                    alert('数据解析异常！');
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
        function delorder(id){$("#p"+id).remove();}
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
                            tr+="<tr><td>"+res.content[i].title+"</td><td>"+res.content[i].guige+"</td><td width='200'><input type='text' class='input num_input_flag' value='1' name='num[]' datatype='*' style='width: 200px; text-align: center;' ></td><input type='hidden' name='pid[]' value='"+res.content[i].id+"'></td><td><a href='javascript:;' id='a"+res.content[i].id+"' onclick='removep("+res.content[i].id+")'>删除</a></td></tr>";
                        }
                        $("#productlist").hide(1000);
                        $('#peijianlist table').append(tr);
                    },
                    error: function(response){
                        alert(response);
                    }
                });
            }}

        function quxiaoproductid(){$("#productlist").hide(1000);}
        function removep(id){$('#a'+id).parent().parent().remove();}
        function getlx(id){
            //单位
            whatdanwei();
            var  str="";
            if(id==1){
                str+="长度：<input type='text' class='input' style='width: 80px;' id='one_chang' name='chang' value='1' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />";
                str+="宽度：<input type='text' class='input' style='width: 80px;' id='one_kuan' name='kuan' value='1' nullmsg='请输入宽度！' datatype='*'  oninput='getchanneng(this.id)'  onchange='' />";
                str+="厚度：<input type='text' class='input' style='width: 80px;' id='one_houdu' name='houdu' value='1' nullmsg='请输入厚度！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />&nbsp;单位：毫米";
            }else if(id==2){
                str+="直径：<input type='text' class='input' style='width: 80px;' id='two_zhijing' name='zhijing' value='1' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />";
                str+="长度：<input type='text' class='input' style='width: 80px;' id='two_chang' name='chang' value='1' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />&nbsp;单位：毫米";
            }else if(id==3){
                str+="直径：<input type='text' class='input' style='width: 80px;' id='three_zhijing' name='zhijing' value='1' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />&nbsp;单位：毫米";
            }else if(id==4){
                str+="直径：<input type='text' class='input' style='width: 80px;' id='four_zhijing' name='zhijing' value='1' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />";
                str+="厚度：<input type='text' class='input' style='width: 80px;' id='four_houdu' name='houdu' value='1' nullmsg='请输入厚度！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />";
                str+="长度：<input type='text' class='input' style='width: 80px;' id='four_chang' name='chang' value='1' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  onchange='' />&nbsp;单位：毫米";
            }else{
                str="";
            }
            $("#leixing").html(str);
        }//判断产品的单位是重量还是数量
        function whatdanwei(){
            var val = $('input:radio[name="leixing"]:checked').val();
            if (val == 0) {
                $('#peijianlist .this_flag').html("&nbsp;数量(单位:件)");
            }
            else if(val > 0){
                $('#peijianlist .this_flag').html("&nbsp;重量(单位:kg)");
            }
        }
        function getchanneng(id){
            var s = $("#peijianlist").find(".num_input_flag").length;
            if(s == 0){
                return false;
            }
            var channeng = "";
            var leixing = id.substring(0,id.indexOf("_"));
            var chang = $("#"+leixing+"_chang").val()?$("#"+leixing+"_chang").val():1;
            var kuan = $("#"+leixing+"_kuan").val()?$("#"+leixing+"_kuan").val():1;
            var houdu = $("#"+leixing+"_houdu").val()?$("#"+leixing+"_houdu").val():1;
            var zhijing = $("#"+leixing+"_zhijing").val()?$("#"+leixing+"_zhijing").val():1;
            if(leixing == "one"){
                chang=chang/10;
                kuan=kuan/10;
                houdu=houdu/10;
                channeng=chang*kuan*houdu*7.85;
            }
            else if(leixing == "two"){
                zhijing=zhijing/20;
                chang=chang/10;
                channeng=zhijing*chang*zhijing*24.65;
            }
            else if(leixing == "three"){
                zhijing=zhijing/20;
                channeng=zhijing*zhijing*zhijing*32.87;
            }
            else if(leixing == "four"){
                zhijing=zhijing*0.314;
                houdu=houdu/10;
                chang=chang/10;
                channeng=zhijing*houdu*chang*7.85;
            }
            else{
                channeng=channeng;
            }
            var count = 0;
            var num = "";
            var num2 = "";
            var temp = channeng.toString().split('.');
            if(temp.length > 1){
                var decimal = temp[1];
                count = decimal.length;
                if(count > 2){
                    num = channeng*100;
                    var temp2 = num.toString().split('.');
                    num2 =(parseInt(temp2[0]) + 1)/100;
                }
                else{
                    num2 = channeng;
                }
            }
            else{
                num2 = channeng;
            }
            num2=num2/1000;
            $(".num_input_flag").val(num2);
        }
        function sale_ifhidden() {
            var val = $('input:radio[name="sell_station"]:checked').val();
            if (val == 0) {
                $(".sale_ifhidden").css({"display": "none",});
            }
            else if(val == 1){
                $(".sale_ifhidden").css({"display":"table-row",});
            }
        }
    </script>
    <script src="{{asset('layer/layer.js')}}"></script>

</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<input type="hidden" name="ppid" id="ppid" value="0"/>
<div id="main">
    <div class="user">
        @if($do=='list')
            <div class="bigTitleName">产品搜索</div>
            <div class="smallEngTitleName">SEARCH PRODUCT</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="get" action="{{URL('jb_admin/product/list')}}">
                    &nbsp;
                    产品编号：<input type="text" name="id" class="text" value="{{$id}}" />
                    产品名称：<input type="text" name="title" class="text" value="{{$title}}" />
                    产品规格：<input type="text" name="guige" class="text" value="{{$guige}}" />
                    产品系列：
                    <select name="typeid">
                    @if($typeid!='')
                            <option value="{{$typeid}}">{{$typename}}</option>
                    @endif
                        <option value="">全部</option>
                    @foreach($xilie as $e)
                        <option value="{{$e->id}}">{{$e->title}}</option>
                    @endforeach
                    </select>
                    排序类型：
                    <select name="paixu">
                        @if($fangshi=='jine')
                            <option value="jine">价格</option>
                            <option value="shijian">时间</option>
                        @else
                            <option value="shijian">时间</option>
                            <option value="jine">价格</option>
                        @endif

                    </select>
                    排序方式
                    <select name="fangshi">
                        @if($fangshi=='asc')
                            <option value="asc">升序</option>
                            <option value="desc">降序</option>
                        @else
                            <option value="desc">降序</option>
                            <option value="asc">升序</option>
                        @endif
                    </select>
                    <input type="submit" value="查 找" class="button" />
                    <input type="button" value="添 加" class="button" onclick="window.location.href='{{URL('jb_admin/product/add')}}'" />
                    <a href="{{URL('jb_admin/product/list')}}">清除搜索条件</a>
                </form>
            </div>

        <div class="user-list">
            <table width="100%" style="text-align:center;background-color:#fff; margin-top:0px; line-height:30px;" cellpadding="0" cellspacing="0">
                <tr class="tr">
                    <td>产品编号</td>
                    <td>产品名称</td>
                    <td>缩略图</td>
                    <td>规格</td>
                    <td>价格</td>
                    <td>库存</td>
                    <td>产能</td>
                    <td>操作</td>
                </tr>
                @foreach($data as $e)
                    <tr  onmousemove=style.backgroundColor='#e8edf1' onmouseout=style.backgroundColor='#FFFFFF'>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->id,$id,$color = "red") !!}</td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->title,$title,$color = "red") !!}</td>
                        <td>
                            <img src="{{\App\Http\Controllers\FunctionController::getpic($e->id,1)}}" alt="" style="max-height: 100px; max-width: 100px; margin: 10px;"/>
                        </td>
                        <td>{!! \App\Http\Controllers\FunctionController::highLight($e->guige,$guige,$color = "red") !!}</td>
                        <td>{!! $e->jine.' '.$e->danwei !!}/元</td>
                        <td>{!! $e->kucun !!}</td>
                        <td>{!! $e->channeng.' '.$e->danwei !!}/小时</td>
                        <td>
                            <a href="{{URL('jb_admin/product/edit/'.$e->id)}}">查看详细</a> |
                            <a href="{{URL('jb_admin/product/fuzhi/'.$e->id)}}">复制产品</a> |
                            <a href="{{URL('jb_admin/excsql/delproduct/'.$e->id)}}" onclick="queren('确定要删除该产品吗？')">删除</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="user-page">
            <div align="center">{{$data->appends(['id'=>$id,'title'=>$title,'typeid'=>$typeid,'guige'=>$guige,'paixu'=>$paixu,'fangshi'=>$fangshi])->links()}}</div>
            <input class="text" type="text" name="page" id="page" value="" />
            <input type="submit" class="sub" value="GO" onclick="gotopage()" /><br><br><br><br><br><br><br><br><br>
        </div>
        @elseif($do=='add')
            <div class="bigTitleName">添加产品</div>
            <div class="smallEngTitleName">ADD PRODUCT</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search" style="margin-bottom:30px;">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/addnext/addproduct')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 30px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="200">产品名称：</td>
                            <td><input type="text" class="input" name="title" value="" nullmsg="请输入产品名称！" datatype="*"  /></td>
                        </tr>
                        <tr>
                            <td align="right">产品系列：</td>
                            <td>
                                <select name="typeid" class="input">
                                    @foreach($xilie as $e)
                                        <option value="{{$e->id}}">{{$e->title}}</option>
                                    @endforeach
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td align="right">产品图片:</td>
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
                            <td align="right">选择子配件:</td>
                            <td>
                                <span id="liulan" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;padding:4px 12px;">浏览</span>
                                <div id="peijianlist">
                                    <table width='700' style='line-height:40px;border: 1px solid #99bce8;text-align: center;' align='center' border='0' cellspacing='0' cellpadding='0'>
                                        <tr style='background:url(/images/title_top_bg_03.png);'>
                                            <td> &nbsp;产品名称</td>
                                            <td> &nbsp;产品规格</td>
                                            <td class="this_flag"> &nbsp;数量(单位:件)</td>
                                            <td>操作</td>
                                        </tr>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">材料:</td>
                            <td>
                                <input type="radio" value="0" name="leixing"  onclick="getlx(0)" checked/>其他
                                <input type="radio" value="1" name="leixing" onclick="getlx(1)"/>板金
                                <input type="radio" value="2" name="leixing" onclick="getlx(2)"/>线材
                                <input type="radio" value="3" name="leixing" onclick="getlx(3)"/>球
                                <input type="radio" value="4" name="leixing" onclick="getlx(4)"/>管材
                                &nbsp; &nbsp;<br>
                                <div id="leixing"></div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">产品规格:</td>
                            <td><input type="text" class="input" name="guige" value="" nullmsg="请输入产品规格！" datatype="*" ></td>
                        </tr>
                        <tr>
                            <td align="right">是否出售:</td>
                            <td>
                                <input type="radio" value="0" name="sell_station" checked  onclick="sale_ifhidden()"/>否
                                <input type="radio" value="1" name="sell_station" onclick="sale_ifhidden()"/>是

                            </td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">产品价格：</td>
                            <td><input type="text" class="input" name="jine" value="0" nullmsg="请输入产品价格！" datatype="*" /></td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">统一VIP折扣：</td>
                            <td><input type="text" class="input" name="vip_zhekou" value="0"  nullmsg="请输入统一VIP折扣！" datatype="*" /></td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">单独VIP折扣：</td>
                            <td><input type="text" class="input" name="dandu_zhekou" value="0" nullmsg="请输入单独VIP折扣！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right">单位：</td>
                            <td>
                                <select name="danwei" class="input">
                                    <option value="件">件</option>
                                    <option value="KG">KG</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">库存：</td>
                            <td><input type="text" class="input" name="kucun" value="" nullmsg="请输入库存！" datatype="n" /></td>
                        </tr>
                        <tr>
                            <td align="right">产能：</td>
                            <td><input type="text" class="input" name="channeng" value="" nullmsg="请输入产能！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right" width="150">产品介绍：</td>
                            <td>
                                <textarea name="content" id="content" style="height:300px; width:700px;"></textarea> <br />
                            </td>
                        </tr>

                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="下一步选择工序" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="user-list">
            </div>
        @elseif($do=='edit')
            <div class="bigTitleName">更新产品</div>
            <div class="smallEngTitleName">UPDATE PRODUCT</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search" style="margin-bottom:30px;">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/addnext/editproduct')}}?id={{$id}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 30px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="400">产品名称：</td>
                            <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入产品名称！" datatype="*"  /></td>
                        </tr>
                        <tr>
                            <td align="right" width="400">产品系列：</td>
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
                            <td align="right">产品图片:</td>
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
                            <td align="right">选择子配件:</td>
                            <td>
                                <span id="liulan" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;padding:4px 12px;">浏览</span>
                                <div id="peijianlist">
                                    <table width='700' style='line-height:40px;border: 1px solid #99bce8;text-align: center;' align='center' border='0' cellspacing='0' cellpadding='0'>
                                        <tr style='background:url(/images/title_top_bg_03.png);'>
                                            <td> &nbsp;产品名称</td>
                                            <td> &nbsp;产品规格</td>
                                            <td class="this_flag"> &nbsp;数量(单位:件)</td>
                                            <td>操作</td>
                                        </tr>
                                        {!! $peijianlist !!}
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">材料:</td>
                            <td>
                                <input type="radio" value="0" name="leixing"  onclick="getlx(0)" @if($data[0]->leixing=='0') checked @endif/>其他
                                <input type="radio" value="1" name="leixing" onclick="getlx(1)"  @if($data[0]->leixing=='1') checked @endif/>板金
                                <input type="radio" value="2" name="leixing" onclick="getlx(2)"  @if($data[0]->leixing=='2') checked @endif/>线材
                                <input type="radio" value="3" name="leixing" onclick="getlx(3)"  @if($data[0]->leixing=='3') checked @endif/>球
                                <input type="radio" value="4" name="leixing" onclick="getlx(4)"  @if($data[0]->leixing=='4') checked @endif/>管材&nbsp; &nbsp;<br>
                                <div id="leixing">
                                    @if($data[0]->leixing=='1')
                                        长度：<input type='text' class='input' style='width: 80px;' id='one_chang' name='chang' value='{{$data[0]->chang}}' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        宽度：<input type='text' class='input' style='width: 80px;' id='one_kuan'  name='kuan' value='{{$data[0]->kuan}}' nullmsg='请输入宽度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        厚度：<input type='text' class='input' style='width: 80px;' id='one_houdu'  name='houdu' value='{{$data[0]->houdu}}' nullmsg='请输入厚度！' datatype='*' oninput='getchanneng(this.id)' />
                                        &nbsp;单位：毫米
                                    @endif
                                    @if($data[0]->leixing=='2')
                                        直径：<input type='text' class='input' style='width: 80px;' id='two_zhijing'  name='zhijing' value='{{$data[0]->zhijing}}' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)' />
                                        长度：<input type='text' class='input' style='width: 80px;' id='two_chang'  name='chang' value='{{$data[0]->chang}}' nullmsg='请输入长度！' datatype='*'  oninput='getchanneng(this.id)' />
                                        &nbsp;单位：毫米
                                    @endif
                                    @if($data[0]->leixing=='3')
                                        直径：<input type='text' class='input' style='width: 80px;' id='three_zhijing'  name='zhijing' value='{{$data[0]->zhijing}}' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  />
                                        &nbsp;单位：毫米
                                    @endif
                                    @if($data[0]->leixing=='4')
                                        直径：<input type='text' class='input' style='width: 80px;' id='four_zhijing'  name='zhijing' value='{{$data[0]->zhijing}}' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  />
                                        厚度：<input type='text' class='input' style='width: 80px;' id='four_houdu'  name='houdu' value='{{$data[0]->houdu}}' nullmsg='请输入厚度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        长度：<input type='text' class='input' style='width: 80px;' id='four_chang'  name='chang' value='{{$data[0]->chang}}' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        &nbsp;单位：毫米
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">产品规格:</td>
                            <td><input type="text" class="input" name="guige" value="{{$data[0]->guige}}" nullmsg="请输入产品规格！" datatype="*" ></td>
                        </tr>
                        <tr>
                            <td align="right">是否出售:</td>
                            <td>
                                <input type="radio" value="0" name="sell_station" onclick="sale_ifhidden()" @if($data[0]->sell_station=='0') checked @endif/>否
                                <input type="radio" value="1" name="sell_station" onclick="sale_ifhidden()" @if($data[0]->sell_station=='1') checked @endif/>是
                            </td>
                        </tr>

                        <tr class="sale_ifhidden">
                            <td align="right">产品价格：</td>
                            <td><input type="text" class="input" name="jine" value="{{$data[0]->jine}}" nullmsg="请输入产品价格！" datatype="*" /></td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">统一VIP折扣：</td>
                            <td><input type="text" class="input" name="vip_zhekou" value="{{$data[0]->vip_zhekou}}"  nullmsg="请输入统一VIP折扣！" datatype="*" /></td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">单独VIP折扣：</td>
                            <td><input type="text" class="input" name="dandu_zhekou" value="{{$data[0]->dandu_zhekou}}" nullmsg="请输入单独VIP折扣！" datatype="*" /></td>
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
                            <td align="right">产能：</td>
                            <td><input type="text" class="input" name="channeng" value="{{$data[0]->channeng}}" nullmsg="请输入产能！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right" width="150">产品介绍：</td>
                            <td>
                                <textarea name="content" id="content" style="height:300px; width:700px;">{{$data[0]->content}}</textarea> <br />
                            </td>
                        </tr>

                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="下一步" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="user-list">
            </div>
        @elseif($do=='fuzhi')
            <div class="bigTitleName">复制产品</div>
            <div class="smallEngTitleName">PRODUCT COPY</div>
            <div class="smallTitleBottomDiv"></div>
            <div class="user-search" style="margin-bottom:30px;">
                <div class="title"><span></span></div>
                <form name="form1" class="myform" method="post" action="{{URL('jb_admin/addnext/fuzhiproduct/'.$id)}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <table width="855" style="margin-top: 30px;" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="right" width="400">产品名称：</td>
                            <td><input type="text" class="input" name="title" value="{{$data[0]->title}}" nullmsg="请输入产品名称！" datatype="*"  /></td>
                        </tr>
                        <tr>
                            <td align="right" width="400">产品系列：</td>
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
                            <td align="right">产品图片:</td>
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
                            <td align="right">选择子配件:</td>
                            <td>
                                <span id="liulan" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;padding:4px 12px;">浏览</span>
                                <div id="peijianlist">
                                    <table width='700' style='line-height:40px;border: 1px solid #99bce8;text-align: center;' align='center' border='0' cellspacing='0' cellpadding='0'>
                                        <tr style='background:url(/images/title_top_bg_03.png);'>
                                            <td> &nbsp;产品名称</td>
                                            <td> &nbsp;产品规格</td>
                                            <td class="this_flag"> &nbsp;数量(单位:件)</td>
                                            <td>操作</td>
                                        </tr>
                                        {!! $peijianlist !!}
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">材料:</td>
                            <td>
                                <input type="radio" value="0" name="leixing"  onclick="getlx(0)" @if($data[0]->leixing=='0') checked @endif/>其他
                                <input type="radio" value="1" name="leixing" onclick="getlx(1)"  @if($data[0]->leixing=='1') checked @endif/>板金
                                <input type="radio" value="2" name="leixing" onclick="getlx(2)"  @if($data[0]->leixing=='2') checked @endif/>线材
                                <input type="radio" value="3" name="leixing" onclick="getlx(3)"  @if($data[0]->leixing=='3') checked @endif/>球
                                <input type="radio" value="4" name="leixing" onclick="getlx(4)"  @if($data[0]->leixing=='4') checked @endif/>管材&nbsp; &nbsp;<br>
                                <div id="leixing">
                                    @if($data[0]->leixing=='1')
                                        长度：<input type='text' class='input' style='width: 80px;' id='one_chang' name='chang' value='1' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        宽度：<input type='text' class='input' style='width: 80px;' id='one_kuan'  name='kuan' value='1' nullmsg='请输入宽度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        厚度：<input type='text' class='input' style='width: 80px;' id='one_houdu'  name='houdu' value='1' nullmsg='请输入厚度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        &nbsp;单位：毫米
                                    @endif
                                    @if($data[0]->leixing=='2')
                                        直径：<input type='text' class='input' style='width: 80px;' id='two_zhijing'  name='zhijing' value='1' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  />
                                        长度：<input type='text' class='input' style='width: 80px;' id='two_chang'  name='chang' value='1' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        &nbsp;单位：毫米
                                    @endif
                                    @if($data[0]->leixing=='3')
                                        直径：<input type='text' class='input' style='width: 80px;' id='three_zhijing'   name='zhijing' value='1' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  />
                                        &nbsp;单位：毫米
                                    @endif
                                    @if($data[0]->leixing=='4')
                                        直径：<input type='text' class='input' style='width: 80px;' id='four_zhijing'   name='zhijing' value='1' nullmsg='请输入直径！' datatype='*' oninput='getchanneng(this.id)'  />
                                        厚度：<input type='text' class='input' style='width: 80px;' id='four_houdu'   name='houdu' value='1' nullmsg='请输入厚度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        长度：<input type='text' class='input' style='width: 80px;' id='four_chang'   name='chang' value='1' nullmsg='请输入长度！' datatype='*' oninput='getchanneng(this.id)'  />
                                        &nbsp;单位：毫米
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">产品规格:</td>
                            <td><input type="text" class="input" name="guige" value="{{$data[0]->guige}}" nullmsg="请输入产品规格！" datatype="*" ></td>
                        </tr>
                        <tr>
                            <td align="right">是否出售:</td>
                            <td>
                                <input type="radio" value="0" onclick="sale_ifhidden()" name="sell_station" @if($data[0]->sell_station=='0') checked @endif/>否
                                <input type="radio" value="1" onclick="sale_ifhidden()" name="sell_station" @if($data[0]->sell_station=='1') checked @endif/>是

                            </td>
                        </tr>

                        <tr class="sale_ifhidden">
                            <td align="right">产品价格：</td>
                            <td><input type="text" class="input" name="jine" value="{{$data[0]->jine}}" nullmsg="请输入产品价格！" datatype="*" /></td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">统一VIP折扣：</td>
                            <td><input type="text" class="input" name="vip_zhekou" value="{{$data[0]->vip_zhekou}}"  nullmsg="请输入统一VIP折扣！" datatype="*" /></td>
                        </tr>
                        <tr class="sale_ifhidden">
                            <td align="right">单独VIP折扣：</td>
                            <td><input type="text" class="input" name="dandu_zhekou" value="{{$data[0]->dandu_zhekou}}" nullmsg="请输入单独VIP折扣！" datatype="*" /></td>
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
                            <td align="right">产能：</td>
                            <td><input type="text" class="input" name="channeng" value="{{$data[0]->channeng}}" nullmsg="请输入产能！" datatype="*" /></td>
                        </tr>
                        <tr>
                            <td align="right" width="150">产品介绍：</td>
                            <td>
                                <textarea name="content" id="content" style="height:300px; width:700px;">{{$data[0]->content}}</textarea> <br />
                            </td>
                        </tr>

                        <tr>
                            <td align="right"></td>
                            <td><input type="submit" value="下一步" class="button" style="height:30px; border:none; background:#333; color:#fff; font-size:14px; cursor:pointer; margin:20px 0px;"  /></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="user-list">
            </div>
        @endif
    </div>
</div>

<div id="productlist" style="z-index: 99999999;">
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
                <div class="user-list" id="list_product">加载中...</div>

            </div>
            <div class="pright" id="pright">
                <b>已选择：</b>
                <div id="productlistitem"></div>
            </div>
            <div id="pagination" style="padding: 30px 10px; float: left;"></div>
            <div class="subquyu">
                <input type="button" class="button" onclick="getproductid()" value="确 认"/>
                <input type="button" class="button delete" onclick="quxiaoproductid()" value="取 消"/>
            </div>
            <script language="JavaScript">
                //设置分页插件显示
                $("#pagination").whjPaging({
                    //可选，每页显示条数下拉框，默认下拉框5条/页(默认)、10条/页、15条/页、20条/页
                    pageSizeOpt: [
                        {'value': 10, 'text': '10条/页', 'selected': true},
                    ],
                    //可选，css设置，可设置值：css-1，css-2，css-3，css-4，css-5，默认css-1，可自定义样式
                    css: 'css-1',
                    //可选，总页数
                    totalPage:{{$ptotelpage}},
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
                <div id="peijianlistitem">
                    <table width='700' style='line-height:40px;border: 1px solid #99bce8;text-align: center;' align='center' border='0' cellspacing='0' cellpadding='0'><tr style='background:url(/images/title_top_bg_03.png);'><td> &nbsp;产品名称</td><td> &nbsp;产品规格</td><td> &nbsp;数量</td><td> 操作</td></tr></table>
                </div>
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
                    css: 'css-1',
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
        //识别是否出售，再判断是否显示有关的输入框
        sale_ifhidden();
        //单位
        whatdanwei();
    })
</script>
<script type="text/javascript">var ue = UE.getEditor('content');</script>
</body>
</html>

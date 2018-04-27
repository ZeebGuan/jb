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
    <script src="{{asset('layer/layer.js')}}"></script>
</head>
<body bgcolor="#ecf0f1" topmargin="0" leftmargin="0" rightmargin="0">
<input name="ordertype" id="ordertype" value="0" type="hidden"/>
<div id="main">
    @if($do=='shenhe')
        <div id="showorder" style="display: block;">
            <div class="chuli">
                <div class="title"><span id="closedetail" class="close"></span>订单审核</div>
                    <div class="addorder">
                        <table width="800" style="line-height: 30px;" border="0" cellspacing="0" align="center" cellpadding="0">
                            <tr>
                                <td align="right" width="150">客户:</td>
                                <td width="200">{{$data[0]->kehutitle}}</td>
                                <td align="right" width="150">联系人:</td>
                                <td width="300">{{$data[0]->name}}</td>
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
                        <table width="800" style="line-height: 30px; margin-top: 20px; border: 1px solid #99bce8;" align="center" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="left" style="background:url(/images/title_top_bg_03.png);"> &nbsp;订单明细</td>
                            </tr>
                            <tr>
                                <td align="left"><span class="add" id="addorderlist">增加</span>  <span class="add del" onclick="delproduct()">减少</span> <span class="add all" onclick="selectall()">全选</span></td>
                            </tr>
                        </table>
                        <div id="productordera" style="height: 180px; overflow-y: scroll;">
                            <table width="780" style="line-height:30px;border: 1px solid #99bce8;text-align: center;" align="center" border="0" cellspacing="0" cellpadding="0">

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
            </div>
        </div>
    @endif
</div>


<script>
    function shenhe(id){
        layer.open({
            type: 2,
            title: '订单审核',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['1000px' , '500px'],
            content: '{{URL('jb_admin/order/shenhe')}}/id'
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

$(document).ready(function(){
	
	page3_jContainer1_acc=new Array("page3_jAccordion1");
	page3_jContainer1_obj=$('#page3_jContainer1_container').layout({
		onresize:function(){
			Vjjq.refreshContainer('',page3_jContainer1_acc);
			page3_jContainer2_obj.resizeAll();},
		center__paneSelector:'.page3_jContainer1_center'
		,north__paneSelector:'.page3_jContainer1_north'
		,north__size:	124
		,north__spacing_open:	0
		,west__paneSelector:'.page3_jContainer1_west'
		,west__size:	264
		,maskIframesOnResize: true
	});
	
	page3_jContainer2_DataGrids=new Array("page3_jDataGrid1","49");
	page3_jContainer2_obj=$('#page3_jContainer2_container').layout({
		onresize:function(){
			Vjjq.resizegrid(page3_jContainer2_DataGrids);},
		center__paneSelector:'.page3_jContainer2_center'
		,north__paneSelector:'.page3_jContainer2_north'
		,north__size:	31
		,north__spacing_open:	0
		,maskIframesOnResize: true
	});
	
	$("#page3_jAccordion1_body").accordion({
		heightStyle:"fill"
	});
	
	var page3_jTreeView2_setting = {
	};
	var page3_jTreeView2_zNodes =[
		{ name:'全部订单', open: true,
			children: [
			{ name:'订货单',
				children: [
					{ name:'未完成'},
					{ name:'已完成'},
					{ name:'已失效'}
				]},
			{ name:'退货单',
				children: [
					{ name:'未完成'},
					{ name:'已完成'}
				]}
			]},
		{ name:'订单统计', open: true,
			children: [
			{ name:'按客户', url:'page6.htm', target:'_self'},
			{ name:'按商品'}
			]}
	]
	$.fn.zTree.init($('#page3_jTreeView2_ztree'), page3_jTreeView2_setting, page3_jTreeView2_zNodes);
	
	var page3_jTreeView3_setting = {
	};
	var page3_jTreeView3_zNodes =[
		{ name:'客户列表', url:'page5.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page3_jTreeView3_ztree'), page3_jTreeView3_setting, page3_jTreeView3_zNodes);
	
	var page3_jTreeView4_setting = {
	};
	var page3_jTreeView4_zNodes =[
		{ name:'产品列表', url:'page7.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page3_jTreeView4_ztree'), page3_jTreeView4_setting, page3_jTreeView4_zNodes);
});

jQuery().ready(function(){
	jQuery('#page3_jDataGrid1_table').jqGrid({
		datatype: 'local',
		multiselect: true,
		rownumbers: true,
		viewrecords: true,
		colNames:['订单编号','下单时间','客户名','联系人','状态','备注'],
		colModel:[
			{name:'A0',index:'A0', width:93},
			{name:'A1',index:'A1', width:141},
			{name:'A2',index:'A2', width:137},
			{name:'A3',index:'A3', width:94},
			{name:'A4',index:'A4', width:76},
			{name:'A5',index:'A5', width:127}
		],
		width: '100%',
		height: '100%',
		rowNum:20,
		pager: jQuery('#page3_jDataGrid1_pager')
	}).navGrid('#page3_jDataGrid1_pager',{edit:false,add:false,del:false});
	$('#page3_jDataGrid1_table').closest('.ui-jqgrid-bdiv').css({'overflow-y': 'auto'});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',1,{A0:'jb20180101',A1:'2018-1-1 12:00:00',A2:'梅州市吉星科技有限公司',A3:'DLC',A4:'已完成',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',2,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',3,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',4,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',5,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',6,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',7,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',8,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',9,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',10,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',11,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',12,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',13,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',14,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',15,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',16,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',17,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',18,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').jqGrid('addRowData',19,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page3_jDataGrid1_table').trigger('reloadGrid');
})

$(function(){
	$("#page3_jDateTimePicker1_edit").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "yy-mm-dd"
	});
});

jQuery().ready(function(){
	jQuery('#page3_jDataGrid2_table').jqGrid({
		datatype: 'local',
		multiselect: true,
		rownumbers: true,
		viewrecords: true,
		colNames:['产品型号','产品名称','数量','单价(元)'],
		colModel:[
			{name:'A0',index:'A0', width:115},
			{name:'A1',index:'A1', width:177},
			{name:'A2',index:'A2', width:64},
			{name:'A3',index:'A3', width:64}
		],
		width: 661,
		height: 161,
		rowNum:20,
		pager: jQuery('#page3_jDataGrid2_pager')
	}).navGrid('#page3_jDataGrid2_pager',{edit:false,add:false,del:false});
	$('#page3_jDataGrid2_table').closest('.ui-jqgrid-bdiv').css({'overflow-y': 'auto'});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',1,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',2,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',3,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',4,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',5,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',6,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',7,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',8,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',9,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',10,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',11,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',12,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',13,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',14,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',15,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',16,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',17,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',18,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').jqGrid('addRowData',19,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid2_table').trigger('reloadGrid');
})

$(function(){
	$("#page3_jDialog1").dialog({
		autoOpen:false
		,height:561
		,width:687
		,modal:true
		,resizable:false
	});
});

$(function(){
	$("#page3_jDialog2").dialog({
		autoOpen:false
		,height:598
		,width:686
		,modal:true
		,resizable:false
	});
});

jQuery().ready(function(){
	jQuery('#page3_jDataGrid3_table').jqGrid({
		datatype: 'local',
		multiselect: true,
		rownumbers: true,
		viewrecords: true,
		colNames:['产品型号','产品名称','数量','单价(元)'],
		colModel:[
			{name:'A0',index:'A0', width:115},
			{name:'A1',index:'A1', width:177},
			{name:'A2',index:'A2', width:64},
			{name:'A3',index:'A3', width:64}
		],
		width: 661,
		height: 192,
		rowNum:20,
		pager: jQuery('#page3_jDataGrid3_pager')
	}).navGrid('#page3_jDataGrid3_pager',{edit:false,add:false,del:false});
	$('#page3_jDataGrid3_table').closest('.ui-jqgrid-bdiv').css({'overflow-y': 'auto'});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',1,{A0:'JB-336',A1:'上网四方管 5钩 斜 350#',A2:'1000',A3:'10'});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',2,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',3,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',4,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',5,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',6,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',7,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',8,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',9,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',10,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',11,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',12,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',13,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',14,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',15,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',16,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',17,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',18,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').jqGrid('addRowData',19,{A0:'',A1:'',A2:'',A3:''});
	$('#page3_jDataGrid3_table').trigger('reloadGrid');
})

$(function(){	
	$("#page3_jButton12").click(function(){
		$("#page3_jDialog2").dialog("open");
	});
	
	$("#page3_jButton4").click(function(){
		$("#page3_jDialog1").dialog("open");
	});
	
	$("#page3_jButton6").click(function(){
		$("#page3_jDialog1").dialog("close");
	});
	
	$("#page3_jButton13").click(function(){
		$("#page3_jDialog2").dialog("close");
	});
});
$(document).ready(function(){
	page3_jContainer1_obj.resizeAll();
});

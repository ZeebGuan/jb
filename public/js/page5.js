$(document).ready(function(){
	
	page5_jContainer1_acc=new Array("page5_jAccordion1");
	page5_jContainer1_obj=$('#page5_jContainer1_container').layout({
		onresize:function(){
			Vjjq.refreshContainer('',page5_jContainer1_acc);
			page5_jContainer2_obj.resizeAll();},
		center__paneSelector:'.page5_jContainer1_center'
		,north__paneSelector:'.page5_jContainer1_north'
		,north__size:	124
		,north__spacing_open:	0
		,west__paneSelector:'.page5_jContainer1_west'
		,west__size:	264
		,maskIframesOnResize: true
	});
	
	page5_jContainer2_DataGrids=new Array("page5_jDataGrid1","49");
	page5_jContainer2_obj=$('#page5_jContainer2_container').layout({
		onresize:function(){
			Vjjq.resizegrid(page5_jContainer2_DataGrids);},
		center__paneSelector:'.page5_jContainer2_center'
		,north__paneSelector:'.page5_jContainer2_north'
		,north__size:	31
		,north__spacing_open:	0
		,maskIframesOnResize: true
	});
	
	$("#page5_jAccordion1_body").accordion({
		heightStyle:"fill"
	});
	
	var page5_jTreeView2_setting = {
	};
	var page5_jTreeView2_zNodes =[
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
			{ name:'按客户'},
			{ name:'按商品'}
			]}
	]
	$.fn.zTree.init($('#page5_jTreeView2_ztree'), page5_jTreeView2_setting, page5_jTreeView2_zNodes);
	
	var page5_jTreeView3_setting = {
	};
	var page5_jTreeView3_zNodes =[
		{ name:'客户列表', url:'page5.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page5_jTreeView3_ztree'), page5_jTreeView3_setting, page5_jTreeView3_zNodes);
	
	var page5_jTreeView4_setting = {
	};
	var page5_jTreeView4_zNodes =[
		{ name:'产品列表', url:'page7.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page5_jTreeView4_ztree'), page5_jTreeView4_setting, page5_jTreeView4_zNodes);
});

jQuery().ready(function(){
	jQuery('#page5_jDataGrid1_table').jqGrid({
		datatype: 'local',
		multiselect: true,
		rownumbers: true,
		viewrecords: true,
		colNames:['客户编号','客户名称','联系人','联系电话','状态','备注'],
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
		pager: jQuery('#page5_jDataGrid1_pager')
	}).navGrid('#page5_jDataGrid1_pager',{edit:false,add:false,del:false});
	$('#page5_jDataGrid1_table').closest('.ui-jqgrid-bdiv').css({'overflow-y': 'auto'});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',1,{A0:'JBKH001',A1:'梅州市吉星科技有限公司',A2:'DLC',A3:'13579246810',A4:'已冻结',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',2,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',3,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',4,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',5,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',6,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',7,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',8,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',9,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',10,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',11,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',12,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',13,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',14,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',15,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',16,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',17,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',18,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').jqGrid('addRowData',19,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page5_jDataGrid1_table').trigger('reloadGrid');
})

$(function(){
	$("#page5_jDialog1").dialog({
		autoOpen:false
		,height:361
		,width:530
		,modal:true
		,resizable:false
	});
});

$(function(){
	$("#page5_jDialog2").dialog({
		autoOpen:false
		,height:337
		,width:564
		,modal:true
		,resizable:false
	});
});

$(function(){	
	$("#page5_jButton12").click(function(){
		$("#page5_jDialog2").dialog("open");
	});
	
	$("#page5_jButton4").click(function(){
		$("#page5_jDialog1").dialog("open");
	});
	
	$("#page5_jButton13").click(function(){
		$("#page5_jDialog2").dialog("close");
	});
	
	$("#page5_jButton6").click(function(){
		$("#page5_jDialog1").dialog("close");
	});
});
$(document).ready(function(){
	page5_jContainer1_obj.resizeAll();
});

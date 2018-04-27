$(document).ready(function(){
	
	page7_jContainer1_acc=new Array("page7_jAccordion1");
	page7_jContainer1_obj=$('#page7_jContainer1_container').layout({
		onresize:function(){
			Vjjq.refreshContainer('',page7_jContainer1_acc);
			page7_jContainer2_obj.resizeAll();},
		center__paneSelector:'.page7_jContainer1_center'
		,north__paneSelector:'.page7_jContainer1_north'
		,north__size:	124
		,north__spacing_open:	0
		,west__paneSelector:'.page7_jContainer1_west'
		,west__size:	264
		,maskIframesOnResize: true
	});
	
	page7_jContainer2_DataGrids=new Array("page7_jDataGrid1","49");
	page7_jContainer2_obj=$('#page7_jContainer2_container').layout({
		onresize:function(){
			Vjjq.resizegrid(page7_jContainer2_DataGrids);},
		center__paneSelector:'.page7_jContainer2_center'
		,north__paneSelector:'.page7_jContainer2_north'
		,north__size:	31
		,north__spacing_open:	0
		,maskIframesOnResize: true
	});
	
	$("#page7_jAccordion1_body").accordion({
		heightStyle:"fill"
	});
	
	var page7_jTreeView2_setting = {
	};
	var page7_jTreeView2_zNodes =[
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
	$.fn.zTree.init($('#page7_jTreeView2_ztree'), page7_jTreeView2_setting, page7_jTreeView2_zNodes);
	
	var page7_jTreeView3_setting = {
	};
	var page7_jTreeView3_zNodes =[
		{ name:'客户列表', url:'page5.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page7_jTreeView3_ztree'), page7_jTreeView3_setting, page7_jTreeView3_zNodes);
	
	var page7_jTreeView4_setting = {
	};
	var page7_jTreeView4_zNodes =[
		{ name:'产品列表', url:'page7.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page7_jTreeView4_ztree'), page7_jTreeView4_setting, page7_jTreeView4_zNodes);
});

jQuery().ready(function(){
	jQuery('#page7_jDataGrid1_table').jqGrid({
		datatype: 'local',
		multiselect: true,
		rownumbers: true,
		viewrecords: true,
		colNames:['产品编号','系列','产品名称','规格','参考库存','状态','图片'],
		colModel:[
			{name:'A0',index:'A0', width:93},
			{name:'A1',index:'A1', width:110},
			{name:'A2',index:'A2', width:137},
			{name:'A3',index:'A3', width:94},
			{name:'A4',index:'A4', width:76},
			{name:'A5',index:'A5', width:127},
			{name:'A6',index:'A6', width:64}
		],
		width: '100%',
		height: '100%',
		rowNum:20,
		pager: jQuery('#page7_jDataGrid1_pager')
	}).navGrid('#page7_jDataGrid1_pager',{edit:false,add:false,del:false});
	$('#page7_jDataGrid1_table').closest('.ui-jqgrid-bdiv').css({'overflow-y': 'auto'});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',1,{A0:'JB-336',A1:'四方管',A2:'上网四方管 5钩 斜 350#',A3:' 5钩 斜 350#',A4:'500',A5:'已下架',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',2,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',3,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',4,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',5,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',6,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',7,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',8,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',9,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',10,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',11,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',12,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',13,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',14,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',15,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',16,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',17,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',18,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').jqGrid('addRowData',19,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:'',A6:''});
	$('#page7_jDataGrid1_table').trigger('reloadGrid');
})

$(function(){
	$("#page7_jDialog2").dialog({
		autoOpen:false
		,height:388
		,width:578
		,modal:true
		,resizable:false
	});
});

$(function(){	
	$("#page7_jButton12").click(function(){
		$("#page7_jDialog2").dialog("open");
	});
});
$(document).ready(function(){
	page7_jContainer1_obj.resizeAll();
});

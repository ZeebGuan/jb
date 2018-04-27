$(document).ready(function(){
	
	page6_jContainer1_acc=new Array("page6_jAccordion1");
	page6_jContainer1_obj=$('#page6_jContainer1_container').layout({
		onresize:function(){
			Vjjq.refreshContainer('',page6_jContainer1_acc);
			page6_jContainer2_obj.resizeAll();},
		center__paneSelector:'.page6_jContainer1_center'
		,north__paneSelector:'.page6_jContainer1_north'
		,north__size:	124
		,north__spacing_open:	0
		,west__paneSelector:'.page6_jContainer1_west'
		,west__size:	264
		,maskIframesOnResize: true
	});
	
	page6_jContainer2_DataGrids=new Array("page6_jDataGrid1","49");
	page6_jContainer2_obj=$('#page6_jContainer2_container').layout({
		onresize:function(){
			Vjjq.resizegrid(page6_jContainer2_DataGrids);},
		center__paneSelector:'.page6_jContainer2_center'
		,north__paneSelector:'.page6_jContainer2_north'
		,north__size:	31
		,north__spacing_open:	0
		,maskIframesOnResize: true
	});
	
	$("#page6_jAccordion1_body").accordion({
		heightStyle:"fill"
	});
	
	var page6_jTreeView2_setting = {
	};
	var page6_jTreeView2_zNodes =[
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
	$.fn.zTree.init($('#page6_jTreeView2_ztree'), page6_jTreeView2_setting, page6_jTreeView2_zNodes);
	
	var page6_jTreeView3_setting = {
	};
	var page6_jTreeView3_zNodes =[
		{ name:'客户列表', url:'page5.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page6_jTreeView3_ztree'), page6_jTreeView3_setting, page6_jTreeView3_zNodes);
	
	var page6_jTreeView4_setting = {
	};
	var page6_jTreeView4_zNodes =[
		{ name:'产品列表', url:'page7.htm', target:'_self'}
	]
	$.fn.zTree.init($('#page6_jTreeView4_ztree'), page6_jTreeView4_setting, page6_jTreeView4_zNodes);
});

jQuery().ready(function(){
	jQuery('#page6_jDataGrid1_table').jqGrid({
		datatype: 'local',
		rownumbers: true,
		viewrecords: true,
		colNames:['客户编号','客户名称','下单次数','交易金额','平均每单金额','最后下单时间'],
		colModel:[
			{name:'A0',index:'A0', width:93},
			{name:'A1',index:'A1', width:141},
			{name:'A2',index:'A2', width:137},
			{name:'A3',index:'A3', width:94},
			{name:'A4',index:'A4', width:95},
			{name:'A5',index:'A5', width:127}
		],
		width: '100%',
		height: '100%',
		rowNum:20,
		pager: jQuery('#page6_jDataGrid1_pager')
	}).navGrid('#page6_jDataGrid1_pager',{edit:false,add:false,del:false});
	$('#page6_jDataGrid1_table').closest('.ui-jqgrid-bdiv').css({'overflow-y': 'auto'});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',1,{A0:'JBKH001',A1:'梅州市吉星科技有限公司',A2:'1',A3:'10,000',A4:'10,000',A5:'2018-1-1 12:00:00'});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',2,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',3,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',4,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',5,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',6,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',7,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',8,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',9,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',10,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',11,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',12,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',13,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',14,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',15,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',16,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',17,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',18,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').jqGrid('addRowData',19,{A0:'',A1:'',A2:'',A3:'',A4:'',A5:''});
	$('#page6_jDataGrid1_table').trigger('reloadGrid');
})

$(document).ready(function(){
	page6_jContainer1_obj.resizeAll();
});

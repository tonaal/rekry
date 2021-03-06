<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="keywords" content="jquery,ui,easy,easyui,web">
	<meta name="description" content="easyui help you build your web page easily!">
	<title>K&auml;ytt&auml;j&auml;hallinta</title>
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
        <link rel="stylesheet" type="text/css" href="../assets/css/toolbar.css">
	<style type="text/css">
		form{
			margin:0;
			padding:0;
		}
		.dv-table td{
			border:0;
		}
		.dv-table input{
			border:1px solid #ccc;
		}
	</style>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
	<script type="text/javascript">
$(function(){$('#dg').datagrid({
  onClickRow: function(index,row){
    
    $(this).datagrid('expandRow', index);
  }
});});
		$(function(){
			$('#dg').datagrid({
				view: detailview,
				detailFormatter:function(index,row){
					return '<div class="ddv"></div>';
				},
				onExpandRow: function(index,row){
					var ddv = $(this).datagrid('getRowDetail',index).find('div.ddv');
					ddv.panel({
						border:false,
						cache:true,
						href:'http://176.58.125.202/rekryadmin/crud/show_form.php?index='+index,
						onLoad:function(){
							$('#dg').datagrid('fixDetailRowHeight',index);
							$('#dg').datagrid('selectRow',index);
							$('#dg').datagrid('getRowDetail',index).find('form').form('load',row);
						}
					});
					$('#dg').datagrid('fixDetailRowHeight',index);
				}
			});
		});
		function saveItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			var url = row.isNewRecord ? 'http://176.58.125.202/rekryadmin/crud/save_user.php' : 'http://176.58.125.202/rekryadmin/crud/update_user.php?id='+row.id;
			$('#dg').datagrid('getRowDetail',index).find('form').form('submit',{
				url: url,
				onSubmit: function(){
					return $(this).form('validate');
				},
				success: function(data){
					data = eval('('+data+')');
					data.isNewRecord = false;
					$('#dg').datagrid('collapseRow',index);
					$('#dg').datagrid('updateRow',{
						index: index,
						row: data
					});
				}
			});
		}
		function cancelItem(index){
			var row = $('#dg').datagrid('getRows')[index];
			if (row.isNewRecord){
				$('#dg').datagrid('deleteRow',index);
			} else {
				$('#dg').datagrid('collapseRow',index);
			}
		}
		function destroyItem(){
			var row = $('#dg').datagrid('getSelected');
			if (row){
				$.messager.confirm('Confirm','Oletko varma poistosta?',function(r){
					if (r){
						var index = $('#dg').datagrid('getRowIndex',row);
						$.post('http://176.58.125.202/rekryadmin/crud/destroy_user.php',{id:row.id},function(){
							$('#dg').datagrid('deleteRow',index);
						});
					}
				});
			}
		}
		function newItem(){
			$('#dg').datagrid('appendRow',{isNewRecord:true});
			var index = $('#dg').datagrid('getRows').length - 1;
			$('#dg').datagrid('expandRow', index);
			$('#dg').datagrid('selectRow', index);
		}
	</script>
</head>
<body>
  <ul class="glossymenu" >
	<li><a href="<?php echo base_url();?>"><b>Dashboard</b></a></li>
	<li><a href="<?php echo base_url();?>index.php/crud_greenwalls"><b>Vihersein&auml;t</b></a></li>
	<li><a href="<?php echo base_url();?>index.php/crud_maintenance"><b>Huolto</b></a></li>	
	<li class="current"><a href="<?php echo base_url();?>index.php/crud_users"><b>K&auml;ytt&auml;j&auml;hallinta</b></a></li>
         <li><a href="http://176.58.125.202/rekryadmin/index.php/wateringtimers"><b>Timereiden hallinta</b></a></li>
         <li><a href="<?php echo base_url(); ?>index.php/testcases/shrinker"><b>Kuvapienennin</b></a></li>
	
</ul>
<br/>
	
   
	<table id="dg" title="K&auml;ytt&auml;j&auml;hallinta (oAuth)" style="width:850px;height:600px; margin-left: 20px;"
			url="<?php echo site_url('crud_users/index2'); ?>"
			toolbar="#toolbar" pagination="true"
			fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="firstname" width="50" sortable="true">Etunimi</th>
				<th field="lastname" width="50" sortable="true">Sukunimi</th>
				<th field="phone" width="50" sortable="true">Puhelin</th>
				<th field="email" width="50" sortable="true">Email</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newItem()">Luo uusi k&auml;ytt&auml;j&auml;</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyItem()">Poista valittu</a>
	</div>
  
    
</body>
</html>

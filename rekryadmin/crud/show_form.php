<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>
<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
			<td>Etunimi</td>
			<td><input name="firstname" class="easyui-validatebox" required="true"></input></td>
			<td>Sukunimi</td>
			<td><input name="lastname" class="easyui-validatebox" required="true"></input></td>
		</tr>
		<tr>
			<td>Puhelin</td>
			<td><input name="phone"></input></td>
			<td>Email</td>
			<td><input name="email" class="easyui-validatebox" validType="email"></input></td>
		</tr>
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Tallenna</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>


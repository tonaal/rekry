<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>
<form method="post">
	<table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
		<tr>
			<td>Sein&auml;ID</td>
			<td><input name="wallId" class="easyui-validatebox" required="true"></input></td>
			<td>Osoite</td>
			<td><input name="address" class="easyui-validatebox" ></input></td>
		</tr>
		<tr>
			<td>Ryhm&auml;</td>
			<td><input name="groupid"></input></td>
			<td>Huone</td>
			<td><input name="roominfo" class="easyui-validatebox"></input></td>
		</tr>
                <tr>
			<td>Aikavy&ouml;hyke</td>
			<td><input name="timezone"></input></td>
			<td>Asennusajankohta</td>
			<td><input name="installationdate" class="easyui-validatebox"></input></td>
		</tr>
                  <tr>
			<td>Kasteluajastin 1</td>
			<td colspan="3"><input name="wateringtimer1" size="79"></input></td>
			
		</tr>
                 <tr>
			<td>Kasteluajastin 2</td>
			<td colspan="3"><input name="wateringtimer2" size="79"></input></td>
			
		</tr>
                <tr>
			<td>Kasteluajastin 3</td>
			<td colspan="3"><input name="wateringtimer3" size="79"></input></td>
			
		</tr>
                 <tr><td>Tuuletinajastin 1</td>
			<td><input name="ventilationtimer1" class="easyui-validatebox"></input></td>
			<td>Valaisuajastin 1</td>
			<td><input name="lighttimer1"></input></td>
			<td></td>
			<td></td>
		</tr>
                  <tr>
			<td>Valaisuajastin 2</td>
			<td><input name="lighttimer2"></input></td>
			<td></td>
			<td></td>
		</tr>
                <tr>
                    
                <tr>
                    <td>Tuuletinajastin 3</td>
			<td><input name="ventilationtimer3" class="easyui-validatebox"></input></td>
                        <td>Tuuletinajastin 2</td>
			<td><input name="ventilationtimer2" class="easyui-validatebox"></input></td>
                </tr>
                 <td>Muita tietoja</td>
                    <td ><textarea name="other"></textarea></td>
                    <td></td>
			<td></td>
                    </tr>
	</table>
	<div style="padding:5px 0;text-align:right;padding-right:30px">
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index'];?>)">Tallenna</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index'];?>)">Cancel</a>
	</div>
</form>


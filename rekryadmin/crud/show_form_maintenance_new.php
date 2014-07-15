<script type="text/javascript">
    $.getJSON('getGreenwallIdList', function(data){
        var html = '';
        var len = data.length;
//        alert(data[1].id);
        for (var i = 0; i< len; i++) {
            html += '<option value="' + data[i].id + '">' + data[i].wallId + '</option>';
        }
        $('#greenwallid').append(html);
    });
</script>
<form method="post">
    <table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
        <tr>
            <td>Sein&auml;ID</td>
            <td>
                <select id ="greenwallid" name="greenwallid">
                    <option value="0">Valitse</option>

                </select> 
            </td>



            <td>PVM</td>
            <td><input name="date" class="easyui-validatebox" ></input></td>
        </tr>

        <tr>
            <td>Henkil&ouml;</td>
            <td><input name="person"></input></td>
            <td>Raportti</td>
            <td><textarea name="report" class="easyui-validatebox"></textarea></td>
        </tr>
        <tr>
            <td>Kasveja vaihdettu kpl</td>
            <td><input name="replacedplants"></input></td>
            <td>Lamppuja vaihdettu kpl</td>
            <td><input name="replacedlamps" class="easyui-validatebox"></input></td>
        </tr>
        <tr>
            <td>Kuva ennen huoltoa</td>
            <td><input name="picturebefore"></input></td>
            <td>Kuva huollon j&auml;lkeen </td>
            <td><input name="pictureafter" class="easyui-validatebox"></input></td>
        </tr>
        <tr>
            <td>Ravinteita lis&auml;tty (grammaa/litraa)</td>
            <td><input name="nutritionadded"></input></td>
            <td>Veden johtavuus ennen huoltoa (µS)</td>
            <td><input name="waterconductivitybefore" class="easyui-validatebox"></input></td>
        </tr>
        <tr>
            <td>Veden johtavuus huollon j&auml;lkeen (µS)</td>
            <td><input name="waterconductivityafter"></input></td>
            <td> </td>
            <td></td>
        </tr>

    </table>
    <div style="padding:5px 0;text-align:right;padding-right:30px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index']; ?>)">Tallenna</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index']; ?>)">Cancel</a>
    </div>
</form>

<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>
<style type="text/css">
    #loader {
        display:none;
    }
    #preview {
        display:none;
    }
    #base64 {
        display:none;
    }
    #maxx {
        display: none;
    }
    #maxy {
        display: none;
    }
    #piiloon{
        display: none;
    }
</style>
<script type="text/javascript">


    function upload() {
        var photo = document.getElementById("photo");
        var file = photo.files[0];

        var preview = document.getElementById("preview");
        preview.src = file.getAsDataURL();
        return _resize(preview);
    }

    function _resize(img, maxWidth, maxHeight)
    {
        var ratio = 1;

        var canvas = document.createElement("canvas");
        canvas.style.display="none";
        document.body.appendChild(canvas);

        var canvasCopy = document.createElement("canvas");
        canvasCopy.style.display="none";
        document.body.appendChild(canvasCopy);

        var ctx = canvas.getContext("2d");
        var copyContext = canvasCopy.getContext("2d");

        if(img.width > maxWidth)
            ratio = maxWidth / img.width;
        else if(img.height > maxHeight)
            ratio = maxHeight / img.height;

        canvasCopy.width = img.width;
        canvasCopy.height = img.height;
        try {
            copyContext.drawImage(img, 0, 0);
        } catch (e) {
            document.getElementById('loader').style.display="none";
            // alert("There was a problem - please reupload your image");
            return false;
        }

        canvas.width = img.width * ratio;
        canvas.height = img.height * ratio;
        // the line to change
        //ctx.drawImage(canvasCopy, 0, 0, canvasCopy.width, canvasCopy.height, 0, 0, canvas.width, canvas.height);
        // the method signature you are using is for slicing
        ctx.drawImage(canvasCopy, 0, 0, canvas.width, canvas.height);

        var dataURL = canvas.toDataURL("image/png");

        document.body.removeChild(canvas);
        document.body.removeChild(canvasCopy);
        return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");


    };

    function resize() {
        var photo = document.getElementById("photo");
      

        if(photo.files!=undefined){

            var loader = document.getElementById("loader");
            loader.style.display = "inline";

            var file = photo.files[0];
            document.getElementById("orig").value = file.fileSize;
            
            var preview = document.getElementById("preview");
            var r = new FileReader();
            r.onload = (function(previewImage) {
                return function(e) {
                    var maxx = document.getElementById('maxx').value;
                    var maxy = document.getElementById('maxy').value;
                    previewImage.src = e.target.result;
                    previewImage.onload = function() {
                        var k = _resize(previewImage, maxx, maxy);
                        if (k != false) {
                            document.getElementById('base64').value= k;
                            //document.getElementById('upload').submit();
                        } else {
                            alert('problem - please attempt to upload again');
                        }
                    }
                };
            })(preview);
            r.readAsDataURL(file);
        } else {
            alert("Seems your browser doesn't support resizing");
        }
        return false;
    }



</script>
<form method="post">
    <table class="dv-table" style="width:100%;background:#fafafa;padding:5px;margin-top:5px;">
        <tr>
            <td>Sein&auml;ID</td>
            <td><input name="greenwallid" class="easyui-validatebox" ></input></td>


            <td>PVM</td>
            <td><input name="date" class="easyui-validatebox" ></input></td>
        </tr>

        <tr>
            <td>Henkil&ouml;</td>
            <td><input name="person"></input></td>
            <td></td>
            <td></td>
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
            <td>Ravinteita a lis&auml;tty </td>
            <td><input name="nutritionadded1"></input></td>
            <td>Ravinteita b lis&auml;tty </td>
            <td><input name="nutritionadded2"></input></td>
        </tr>
        <tr>
            <td>Ravinteita c lis&auml;tty )</td>
            <td><input name="nutritionadded3"></input></td>
            <td>Veden johtavuus ennen huoltoa (µS)</td>
            <td><input name="waterconductivitybefore" class="easyui-validatebox"></input></td>
        </tr>
        <tr>
            <td>Veden johtavuus huollon j&auml;lkeen (µS)</td>
            <td><input name="waterconductivityafter"></input></td>
            <td> </td>
            <td></td>
        </tr>
        <tr>
            <td>Raportti</td>
            <td colspan="3"><textarea name="report" class="easyui-validatebox" cols="67" rows="4"></textarea></td>
        </tr>
    </table>
<!--    Kuvan uploadiin liittyvää. TODO
<textarea name="base64" id="base64" rows='10' cols='90'></textarea>
        <input type="hidden" id="orig" name="orig" value=""/>
    <input type="file" name="photo" id="photo"><input type="button" onClick="resize();" value="Shrink">
  <p><input type='text' name='maxx' id='maxx' value='200'/></p>
    <p><input type='text' name='maxy' id='maxy' value='200'/></p>-->
    
<!--   <img src="http://176.58.125.202/rekryadmin/assets/img/loader.gif" id="loader" class="piiloon"/>
    <img src="" alt="Image preview" id="preview">-->
    <!--<img name="picturebefore" src="picturebefore"/>-->
    <div style="padding:5px 0;text-align:right;padding-right:30px">
        <a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="saveItem(<?php echo $_REQUEST['index']; ?>)">Tallenna</a>
        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="cancelItem(<?php echo $_REQUEST['index']; ?>)">Cancel</a>
    </div> 
    
     
</form>

 
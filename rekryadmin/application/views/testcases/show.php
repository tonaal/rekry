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
        <title>Kuvapienennin</title>
        <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
        <link rel="stylesheet" type="text/css" href="http://176.58.125.202/rekryadmin/assets/css/toolbar.css">
        
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
body {
font-size: 16px;
font-family: Arial;
}
#preview {
display:none;
}
#base64 {
display:none;
}
</style>
</head>
<body>
    <ul class="glossymenu" >
        <li><a href="<?php echo base_url(); ?>"><b>Dashboard</b></a></li>
        <li><a href="<?php echo base_url(); ?>index.php/crud_greenwalls"><b>Vihersein&auml;t</b></a></li>
        <li><a href="<?php echo base_url(); ?>index.php/crud_maintenance"><b>Huolto</b></a></li>	
        <li><a href="<?php echo base_url(); ?>index.php/crud_users"><b>K&auml;ytt&auml;j&auml;hallinta</b></a></li>
        <li><a href="http://176.58.125.202/rekryadmin/index.php/wateringtimers"><b>Timereiden hallinta</b></a></li>
        <li class="current"><a href="<?php echo base_url(); ?>index.php/testcases/shrinker"><b>Kuvapienennin</b></a></li>	
            
    </ul>
<br/>
    
<?php
$base64size = strlen($_POST['base64']);
$f = base64_decode($_POST['base64']);
$name = microtime(true).".png";

file_put_contents("/var/www/rekryadmin/assets/upload/$name", $f);

?>

<img src="http://176.58.125.202/rekryadmin/assets/upload/<?php echo $name;?>"/>

</body>


</html>
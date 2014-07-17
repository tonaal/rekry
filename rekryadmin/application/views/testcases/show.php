<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
<title>Kuvapienennin</title>
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
<?php
$base64size = strlen($_POST['base64']);
$f = base64_decode($_POST['base64']);
$name = microtime(true).".png";

file_put_contents("/var/www/rekryadmin/assets/upload/$name", $f);

?>

<img src="http://176.58.125.202/rekryadmin/assets/upload/<?php echo $name;?>"/>

</body>


</html>
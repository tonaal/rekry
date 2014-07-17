<?php

$conn = @mysql_connect('localhost','rekryuser','mustikk4');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('rekryadmin', $conn) or die();
if(function_exists("mysql_set_charset")){
        mysql_set_charset('utf8', $conn);
    }else{
        mysql_query("SET NAMES $charset");   
    }
?>






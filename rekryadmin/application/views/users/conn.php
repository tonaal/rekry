<?php

$conn = @mysql_connect('localhost','rekryuser','mustikk4');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('rekryadmin', $conn) or die();

?>






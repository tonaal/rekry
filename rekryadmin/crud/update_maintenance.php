<?php


?>
<?php
if (isset($_POST['base64']) && $_POST['base64']!="") {
    $base64size = strlen($_POST['base64']);
    $f = base64_decode($_POST['base64']);
    $name = microtime(true) . ".png";

    file_put_contents("/var/www/rekryadmin/assets/upload/$name", $f);
}
@$id = intval($_REQUEST['id']);
@$greenwallid = $_REQUEST['greenwallid'];
@$date = $_REQUEST['date'];
@$person = $_REQUEST['person'];
@$report = $_REQUEST['report'];
@$replacedplants = $_REQUEST['replacedplants'];
@$replacedlamps = $_REQUEST['replacedlamps'];
@$picturebefore = $_REQUEST['picturebefore'];
@$pictureafter = $_REQUEST['pictureafter'];
@$nutritionadded1 = $_REQUEST['nutritionadded1'];
@$nutritionadded2 = $_REQUEST['nutritionadded2'];
@$nutritionadded3 = $_REQUEST['nutritionadded3'];
@$waterconductivitybefore = $_REQUEST['waterconductivitybefore'];
@$waterconductivityafter = $_REQUEST['waterconductivityafter'];

include 'conn.php';
//$rs = mysql_query("select wallId from greenwall where id=".$greenwallid);
//	$row = mysql_fetch_array($rs);
//       $greenwallid = $row['wallId'];

$sql = "update maintenance set greenwallid='$greenwallid',date='$date',person='$person',report='$report',replacedplants='$replacedplants',replacedlamps='$replacedlamps',picturebefore='$picturebefore',pictureafter='$pictureafter',nutritionadded1='$nutritionadded1',nutritionadded2='$nutritionadded2',nutritionadded3='$nutritionadded3',waterconductivitybefore='$waterconductivitybefore',waterconductivityafter='$waterconductivityafter' where id=$id";
mysql_query($sql);

echo json_encode(array(
    'id' => mysql_insert_id(),
    'greenwallid' => $greenwallid,
    'date' => $date,
    'person' => $person,
    'report' => $report,
    'replacedplants' => $replacedplants,
    'replacedlamps' => $replacedlamps,
    'picturebefore' => "http://176.58.125.202/rekryadmin/assets/upload/$name",
    'pictureafter' => $pictureafter,
    'nutritionadded1' => $nutritionadded1,
    'nutritionadded2' => $nutritionadded2,
    'nutritionadded3' => $nutritionadded3,
    'waterconductivitybefore' => $waterconductivitybefore,
    'waterconductivityafter' => $waterconductivityafter
    
));
?>
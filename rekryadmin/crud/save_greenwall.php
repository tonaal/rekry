<?php

@$wallId = $_REQUEST['wallId'];
@$groupid = $_REQUEST['groupid'];
@$address = $_REQUEST['address'];
@$roominfo = $_REQUEST['roominfo'];
@$timezone = $_REQUEST['timezone'];
@$installationdate = $_REQUEST['installationdate'];
@$wateringtimer1 = $_REQUEST['wateringtimer1'];
@$wateringtimer2 = $_REQUEST['wateringtimer2'];
@$wateringtimer3 = $_REQUEST['wateringtimer3'];
@$lighttimer1 = $_REQUEST['lighttimer1'];
@$lighttimer2 = $_REQUEST['lighttimer2'];
@$ventilationtimer1 = $_REQUEST['ventilationtimer1'];
@$ventilationtimer2 = $_REQUEST['ventilationtimer2'];
@$ventilationtimer3 = $_REQUEST['ventilationtimer3'];
@$other = $_REQUEST['other'];


include 'conn.php';
$sql = "INSERT INTO greenwall(wallId, groupid, address, roominfo) values('$wallId', '$groupid', '$address', '$roominfo')";




@mysql_query($sql);
echo json_encode(array(
    'id' => mysql_insert_id(),
    'wallId' => $wallId,
    'groupid' => $groupid,
    'address' => $address,
    'roominfo' => $roominfo,
    'timezone' => $timezone,
    'installationdate' => $installationdate,
    'wateringtimer1' => $wateringtimer1,
    'wateringtimer2' => $wateringtimer2,
    'wateringtimer3' => $wateringtimer3,
    'lighttimer1' => $lighttimer1,
    'lighttimer2' => $lighttimer2,
    'ventilationtimer1' => $ventilationtimer1,
    'ventilationtimer2' => $ventilationtimer2,
    'ventilationtimer3' => $ventilationtimer3,
    'other' => $other
));
?>
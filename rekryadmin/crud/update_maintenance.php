<?php

@$id = intval($_REQUEST['id']);
@$greenwallid = $_REQUEST['greenwallid'];
@$date = $_REQUEST['date'];
@$person = $_REQUEST['person'];
@$report = $_REQUEST['report'];
@$replacedplants = $_REQUEST['replacedplants'];
@$replacedlamps = $_REQUEST['replacedlamps'];
@$picturebefore = $_REQUEST['picturebefore'];
@$pictureafter = $_REQUEST['pictureafter'];
@$nutritionadded = $_REQUEST['nutritionadded'];
@$waterconductivitybefore = $_REQUEST['waterconductivitybefore'];
@$waterconductivityafter = $_REQUEST['waterconductivityafter'];

include 'conn.php';

$sql = "update maintenance set greenwallid='$greenwallid',date='$date',person='$person',report='$report',replacedplants='$replacedplants',replacedlamps='$replacedlamps',picturebefore='$picturebefore',pictureafter='$pictureafter',nutritionadded='$nutritionadded',waterconductivitybefore='$waterconductivitybefore',waterconductivityafter='$waterconductivityafter' where id=$id";
mysql_query($sql);

echo json_encode(array(
    'id' => mysql_insert_id(),
    'greenwallid' => $greenwallid,
    'date' => $date,
    'person' => $person,
    'report' => $report,
    'replacedplants' => $replacedplants,
    'replacedlamps' => $replacedlamps,
    'picturebefore' => $picturebefore,
    'pictureafter' => $pictureafter,
    'nutritionadded' => $nutritionadded,
    'waterconductivitybefore' => $waterconductivitybefore,
    'waterconductivityafter' => $waterconductivityafter
));
?>
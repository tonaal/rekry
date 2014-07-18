<?php



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

$sql = "INSERT INTO maintenance (greenwallid, date, person, report, replacedplants, replacedlamps, picturebefore, pictureafter, nutritionadded1, waterconductivitybefore, waterconductivityafter,nutritionadded2, nutritionadded3 ) VALUES('$greenwallid', '$date', '$person', '$report', '$replacedplants', '$replacedlamps', '$picturebefore', '$pictureafter', '$nutritionadded1', '$waterconductivitybefore', '$waterconductivityafter','$nutritionadded2', '$nutritionadded3')";




@mysql_query($sql);
echo json_encode(array(
    'id' => mysql_insert_id(),
    'greenwallid' => $greenwallid,
    'date' => mysql_error(),
    'person' => $person,
    'report' => $report,
    'replacedplants' => $replacedplants,
    'replacedlamps' => $replacedlamps,
    'picturebefore' => $picturebefore,
    'pictureafter' => $pictureafter,
    'nutritionadded1' => $nutritionadded1,
    'nutritionadded2' => $nutritionadded2,
    'nutritionadded3' => $nutritionadded3,
    'waterconductivitybefore' => $waterconductivitybefore,
    'waterconductivityafter' => $waterconductivityafter
));
?>
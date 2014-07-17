<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
<link rel="stylesheet" type="text/css" href="http://176.58.125.202/rekryadmin/assets/css/toolbar.css">
<script type="text/javascript">
    /*get all greenwallIDs from database*/
    $.getJSON('crud_maintenance/getGreenwallIdList', function(data){
        var html = '';
        var len = data.length;
        //        alert(data[1].id);
        for (var i = 0; i< len; i++) {
            html += '<option value="' + data[i].id + '">' + data[i].wallId + '</option>';
        }
        $('#greenwallid').append(html);
    });
</script>


</head>
<body>
    <ul class="glossymenu" >
        <li><a href="<?php echo base_url(); ?>"><b>Dashboard</b></a></li>
        <li><a href="<?php echo base_url(); ?>index.php/crud_greenwalls"><b>Vihersein&auml;t</b></a></li>
        <li><a href="<?php echo base_url(); ?>index.php/crud_maintenance"><b>Huolto</b></a></li>	
        <li><a href="<?php echo base_url(); ?>index.php/crud_users"><b>K&auml;ytt&auml;j&auml;hallinta</b></a></li>
        <li class="current"><a href="http://176.58.125.202/rekryadmin/index.php/wateringtimers"><b>Timereiden hallinta</b></a></li>

    </ul>
    <form method="post" action="http://176.58.125.202/rekryadmin/index.php/wateringtimers">
        <table >
            <tr>
                <td>Sein&auml;ID</td>
                <td>
                    <select id ="greenwallid" name="greenwallid">
                        <option value="0">Valitse</option>
                    </select> 
                </td>
            </tr>
            <tr>
                <td>Valitse kasteluv&auml;li</td>
                <td>
                    <input type="text" name="intervall" id="intervall" size="7" value="<?php if(isset($intervall)) echo @$intervall; else echo "8";?>"> (tuntia)
                </td>
            </tr>
              <tr>
                <td>Hiljaisuuväli 1</td>
                <td>
                    <input type="text" name="hiljaisuusvali1" size="17" readonly="readonly" value="not implemented" >  (hh:mm-hh:mm)

                </td>
            </tr>
            <tr>
                <td>Hiljaisuuväli 2</td>
                <td>
                <input type="text" name="hiljaisuusvali2" size="17" readonly="readonly" value="not implemented">  (hh:mm-hh:mm)


                </td>
            </tr>
            <tr>
                <td>Hiljaisuuväli 3</td>
                <td>
                    <input type="text" name="hiljaisuusvali3" size="17" readonly="readonly" value="not implemented">  (hh:mm-hh:mm)

                </td>
            </tr>
        </table>

        <input type="submit" name="submit" value="Refresh">
        <br/>
                <!--<table style="line-height: 50%">-->

        <?php
        //setup array for weekdays and their 3 timers
        //20=SU, 21=MA, 22=TI, 23=KE, 24=TO, 25=PE, 26=LA
        $alltimers = array(
            '20' => array(),
            '21' => array(),
            '22' => array(),
            '23' => array(),
            '24' => array(),
            '25' => array(),
            '26' => array()
        );
        if (!isset($intervall))
            $intervall = 8; //8h
        echo "<br/>Valittu kasteluv&auml;li: " . $intervall . "<br/>";
        if($intervall <8) {
            echo "<font color='red'>Huom: Olet valinnut pienemm&auml;n kasteluv&auml;lin kuin 8 tuntia.
                <br/> Otathan huomioon, ett&auml; p&auml;iv&auml;&auml; kohden voidaan hyv&auml;ksy&auml; vain kolme ajastusta!</font> <br/>";
        }
        $starttime = "20.07.2014 12:00";
        echo "Kasteluv&auml;li alkaa: " . $starttime . "<br/><br/>";
        $pumpuptime = 2;
        $hoursallweek = 168;
        $timesperweek = round($hoursallweek / $intervall);

        $nexttime = $starttime; //for first run
        //gathers all timestamps from week
        $weektimestamps = array();
        for ($i = 0; $i < $timesperweek; $i++) {
            if ($i == 0) { //make sure that first time = start time
                echo $i . " | ";
                echo $starttime . " - ";
                $date = new DateTime($starttime);
                $date->add(new DateInterval('PT' . $pumpuptime . 'M'));
                echo $date->format('d.m.Y H:i');
                echo "<br/>";
                $weektimestamps[$i] = $starttime;
            } else {
                echo $i . " | ";
                $date = new DateTime($starttime);
                $date->add(new DateInterval('PT' . $intervall * $i . 'H'));

                $nexttime = $date->format('d.m.Y H:i');

                echo $nexttime;
                echo " - ";
                $date = new DateTime($nexttime);
                $date->add(new DateInterval('PT' . $pumpuptime . 'M'));
                echo $date->format('d.m.Y H:i');
                echo "<br/>";
                $weektimestamps[$i] = $nexttime;
            }
        }
        echo "<hr>";
        echo "weektimestamps: <br/>";
        var_export($weektimestamps);
        echo "<hr>";

        // ######################## MAIN ##############################################

        $rollingday = 0;
        //loop all timers and check which day they belong to
        for ($i = 0; $i < sizeof($weektimestamps); $i++) {
            if ($i != 0) {
                //if day number is bigger than last one, we have a new day info coming in
                if (strcmp(substr($weektimestamps[$i], 0, 2), substr($weektimestamps[$i - 1], 0, 2)) > 0) {
                    $rollingday++;
                }
            }
            //week has only 7 days, so if we have one more, we have to roll it to first day (sunday)
            if ($rollingday == 7) {
                $rollingday = 0;
            }

            //determine the day of week
            $pushindex = substr($weektimestamps[$i], 0, 2);
            //if day is next monday, roll it back to first sunday
            if ($pushindex == 27)
                $pushindex = 20;
            //if zero, create an array that array_push can work
            if (sizeof($alltimers[$pushindex]) == 0) {
                $alltimers[$pushindex] = array(getTimerString($weektimestamps[$i], getEndtime($weektimestamps[$i], $pumpuptime)));
            } else {
                array_push($alltimers[$pushindex], getTimerString($weektimestamps[$i], getEndtime($weektimestamps[$i], $pumpuptime)));
            }
        }
        //######################## END MAIN #################################################
        //######################## PRESENTATION FOR DEMO #################################################

        echo "<hr>";
        var_export($alltimers);
        echo "<hr>";
       $result = getAll3Timers($alltimers);
        //and finally print all 3 timers, if there is some data
        echo "<hr> And finally all 3 timers: <br/>";
        echo "Wateringtimer 1: " . $wtimer1 = (!strcmp($result[0], "00010000-00010000-00010000-00010000-00010000-00010000-00010000")) ? "-" : "$result[0]";
        echo "<br/>";
        echo "Wateringtimer 2: " . $wtimer1 = (!strcmp($result[1], "00010000-00010000-00010000-00010000-00010000-00010000-00010000")) ? "-" : "$result[1]";
        echo "<br/>";
        echo "Wateringtimer 3: " . $wtimer1 = (!strcmp($result[2], "00010000-00010000-00010000-00010000-00010000-00010000-00010000")) ? "-" : "$result[2]";
        echo "<br/>";

        //######################## END PRESENTATION FOR DEMO #################################################
        //
        //returns the time when pump stops
        function getEndtime($timefrom, $pumpuptime) {
            $date = new DateTime($timefrom);
            $date->add(new DateInterval('PT' . $pumpuptime . 'M'));
            return $date->format('H:i');
        }

        //creates watering timer coded string
        function getTimerString($timefrom_in, $timeto_in) {
            $timefrom = explode(" ", $timefrom_in);
            $timeto = explode(" ", $timeto_in);
            $timefrom = str_replace(':', '', $timefrom[1]);
            $timeto = str_replace(':', '', $timeto[0]);
            return $timefrom . $timeto;
        }

        //function takes weekday assosiated array and sorts 3 watering timers for the week
        function getAll3Timers($alltimers_in) {
            $alltimersout = array();
            $rollingtimer = 0;
            for ($i = 20; $i < 27; $i++) {
                for ($j = 0; $j < 3; $j++) {
                    //if there is a value..
                    if (@$alltimers_in[$i][$j]) {
                        @$alltimersout[$j] .= $alltimers_in[$i][$j] . "-";
                        //else fillup the cap with "pump not active code"                        
                    } else {
                        @ $alltimersout[$j] .= "00010000-";
                    }
                }
            }
            //strip out last "-" mark
            for ($i = 0; $i < 3; $i++) {
                $alltimersout[$i] = substr($alltimersout[$i], 0, strlen($alltimersout[$i]) - 1);
            }
            return $alltimersout;
        }
        ?>
        <!--</table>-->

    </form>
</body>
</html>
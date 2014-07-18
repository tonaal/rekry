<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>
<head>
    <title>Ajastimet</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <link rel="stylesheet" type="text/css" href="http://176.58.125.202/rekryadmin/assets/css/toolbar.css">
    <link rel="stylesheet" type="text/css"  href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
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
        <li><a href="<?php echo base_url(); ?>index.php/testcases/shrinker"><b>Kuvapienennin</b></a></li>
    </ul>

    <?php echo " <h2>Kasteluajastimet</h2>"; ?>
    <form method="post" action="http://176.58.125.202/rekryadmin/index.php/timers/watering">
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
                    <input type="text" name="intervall" id="intervall" size="7" value="<?php if (isset($intervall)) echo @$intervall; else echo "8"; ?>"> (tuntia)
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
        if ($intervall < 8) {
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
//        echo "<hr>";
//        echo "weektimestamps: <br/>";
//        var_export($weektimestamps);
//        echo "<hr>";
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
//        echo "<hr>";
//        var_export($alltimers);
//        echo "<hr>";
        $result = getAll3Timers($alltimers);
        //and finally print all 3 timers, if there is some data
//        echo "<hr> And finally all 3 timers: <br/>";

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

        function getTimerString_for_hour($timefrom_in, $timeto_in) {
            $timefrom = explode(" ", $timefrom_in);
            $timeto = explode(" ", $timeto_in);
            $timefrom = str_replace(':', '', $timefrom[0]);
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

        //this function is for lighting timers. returns 2 full timers
        function getAll2Timers($alltimers_in) {
            $alltimersout = array();
            $rollingtimer = 0;
            for ($i = 20; $i < 27; $i++) {
                for ($j = 0; $j < 2; $j++) {
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
            for ($i = 0; $i < 2; $i++) {
                $alltimersout[$i] = substr($alltimersout[$i], 0, strlen($alltimersout[$i]) - 1);
            }
            return $alltimersout;
        }
        ?>
    </form>
    <!--------- LIGHTTIMERS STARTS HERE-->
    <br/>
    <h2>Valaisinajastimet</h2>
    <form method="post" action="http://176.58.125.202/rekryadmin/index.php/timers/lighting">
        <!--tämä linkki ei vielä johda mihinkään!-->
        <table >

            <tr>
                <td>Valot sytytet&auml;&auml;n klo:</td>
                <td>
                    <input type="text" name="lightson" id="lightson" size="7" value="<?php
        if (isset($lightson) && $lightson != "") {
            echo $lightson;
        } else {
            echo "07:00";
            $lightson = "07:00";
        }
        ?>"> (hh:mm)
                </td>
            </tr>
            <tr>
                <td>Valojakson pituus/vuorokausi:</td>
                <td>
                    <input type="text" name="lightsoff" id="lightsoff" size="7" value="<?php if (isset($lightsoff) && $lightsoff != "") echo @$lightsoff; else echo "15"; $lightsoff = 15; ?>"> (tuntia)
                </td>
            </tr>
        </table>
        Voit antaa yhden aikav&auml;lin per p&auml;iv&auml;, jolloin valot on pois p&auml;&auml;lt&auml; (hh:mm - hh:mm):
        <table class="tg">
            <tr>
                <th class="tg-031e">SU</th>
                <th class="tg-031e">MA</th>
                <th class="tg-031e">TI</th>
                <th class="tg-031e">KE</th>
                <th class="tg-031e">TO</th>
                <th class="tg-031e">PE</th>
                <th class="tg-031e">LA</th>
            </tr>
            <tr>
                <td class="tg-031e"><input id="su_block_start" name="su_block_start" size="6" value="<?php if (isset($su_block_start) && $su_block_start != "") echo $su_block_start; ?>">-<input id="su_block_stop" name="su_block_stop" size="6" value="<?php if (isset($su_block_stop) && $su_block_stop != "") echo $su_block_stop; ?>"></td>
                <td class="tg-031e"><input id="ma_block_start" name="ma_block_start" size="6" value="<?php if (isset($ma_block_start) && $ma_block_start != "") echo $ma_block_start; ?>">-<input id="ma_block_stop" name="ma_block_stop" size="6" value="<?php if (isset($ma_block_stop) && $ma_block_stop != "") echo $ma_block_stop; ?>"></td>
                <td class="tg-031e"><input id="ti_block_start" name="ti_block_start" size="6" value="<?php if (isset($ti_block_start) && $ti_block_start != "") echo $ti_block_start; ?>">-<input id="ti_block_stop" name="ti_block_stop" size="6" value="<?php if (isset($ti_block_stop) && $ti_block_stop != "") echo $ti_block_stop; ?>"></td>
                <td class="tg-031e"><input id="ke_block_start" name="ke_block_start" size="6" value="<?php if (isset($ke_block_start) && $ke_block_start != "") echo $ke_block_start; ?>">-<input id="ke_block_stop" name="ke_block_stop" size="6" value="<?php if (isset($ke_block_stop) && $ke_block_stop != "") echo $ke_block_stop; ?>"></td>
                <td class="tg-031e"><input id="to_block_start" name="to_block_start" size="6" value="<?php if (isset($to_block_start) && $to_block_start != "") echo $to_block_start; ?>">-<input id="to_block_stop" name="to_block_stop" size="6" value="<?php if (isset($to_block_stop) && $to_block_stop != "") echo $to_block_stop; ?>"></td>
                <td class="tg-031e"><input id="pe_block_start" name="pe_block_start" size="6" value="<?php if (isset($pe_block_start) && $pe_block_start != "") echo $pe_block_start; ?>">-<input id="pe_block_stop" name="pe_block_stop" size="6" value="<?php if (isset($pe_block_stop) && $pe_block_stop != "") echo $pe_block_stop; ?>"></td>
                <td class="tg-031e"><input id="la_block_start" name="la_block_start" size="6" value="<?php if (isset($la_block_start) && $la_block_start != "") echo $la_block_start; ?>">-<input id="la_block_stop" name="la_block_stop" size="6" value="<?php if (isset($la_block_stop) && $la_block_stop != "") echo $la_block_stop; ?>"></td>
            </tr>
<!--            <tr>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>
                <td class="tg-031e"><input id="" name="" size="6">-<input id="" name="" size="6"></td>

            </tr>-->
        </table>

        <input type="submit" name="submit" value="Refresh">
        <br/>
        <?php
//        echo "Ensimm&auml;inen valojakso: ";
//        echo $starttime = "20.07.2014 " . $lightson;
//        echo " - ";
        $date = new DateTime($starttime);
        $date->add(new DateInterval('PT' . $lightsoff . 'H'));
        $endtime = $date->format('H:i');
        //first light series starts:
        $starttime = "20.07.2014 " . $lightson;
        //setup array for weekdays and their 2 timers
        //20=SU, 21=MA, 22=TI, 23=KE, 24=TO, 25=PE, 26=LA
        $alltimers_lighting = array(
            '20' => array(),
            '21' => array(),
            '22' => array(),
            '23' => array(),
            '24' => array(),
            '25' => array(),
            '26' => array()
        );
        $alltimers_lighting_block = array(
            '20' => array(
                'block_start' => @$su_block_start,
                'block_stop' => @$su_block_stop),
            '21' => array(
                'block_start' => @$ma_block_start,
                'block_stop' => @$ma_block_stop),
            '22' => array(
                'block_start' => @$ti_block_start,
                'block_stop' => @$ti_block_stop),
            '23' => array(
                'block_start' => @$ke_block_start,
                'block_stop' => @$ke_block_stop),
            '24' => array(
                'block_start' => @$to_block_start,
                'block_stop' => @$to_block_stop),
            '25' => array(
                'block_start' => @$pe_block_start,
                'block_stop' => @$pe_block_stop),
            '26' => array(
                'block_start' => @$la_block_start,
                'block_stop' => @$la_block_stop)
        );

        for ($pushindex = 20; $pushindex < 27; $pushindex++) {
            //if there is no block for day, use given timeframe
            if (($alltimers_lighting_block[$pushindex]['block_start'] == "" && $alltimers_lighting_block[$pushindex]['block_stop'] == "") || ($alltimers_lighting_block[$pushindex]['block_start'] == "" || $alltimers_lighting_block[$pushindex]['block_stop'] == "")) {
                if (sizeof($alltimers_lighting[$pushindex]) == 0) {
                    //get timers per day
                    $alltimers_lighting[$pushindex] = array(getTimerString($starttime, getEndtime($starttime, $lightsoff * 60)));
                    //print final light timer rule                   
                } else {
                    
                }
            } else { //if there IS block time given, calculate proper timers
                //at this point, do nothing
                //next todo: calculate proper start and end time for 2 timers (since block time is given)
                if (sizeof($alltimers_lighting[$pushindex]) == 0) {
                    //get timers per day
                    $alltimers_lighting[$pushindex] = array(
                        getTimerString($starttime, $alltimers_lighting_block[$pushindex]['block_start']),
                        getTimerString_for_hour($alltimers_lighting_block[$pushindex]['block_stop'], getEndtime($starttime, $lightsoff * 60))
//                       
                    );
//                    echo getTimerString_for_hour("13:00", "22:00");
                    //print final light timer rule                   
                } else {
                    
                }
            }
        }
        $result_lighting_timers = getAll2Timers($alltimers_lighting);
        echo "Lightingtimer 1: " . $wtimer1 = (!strcmp($result_lighting_timers[0], "00010000-00010000-00010000-00010000-00010000-00010000-00010000")) ? "-" : "$result_lighting_timers[0]";
        echo "<br/>";
        echo "Lightingtimer 2: " . $wtimer1 = (!strcmp($result_lighting_timers[1], "00010000-00010000-00010000-00010000-00010000-00010000-00010000")) ? "-" : "$result_lighting_timers[1]";
        echo "<br/>";
        echo "<br>";
//        var_export($alltimers_lighting);
        ?>
        <?php
//        echo "<hr>";
//        echo "DEBUG-> valojakso: ";
//        echo $starttime = "20.07.2014 " . $lightson;
//        echo " - ";
//        $date = new DateTime($starttime);
//        $date->add(new DateInterval('PT' . $lightsoff . 'H'));
//        echo $date->format('d.m.Y H:i');
//
//        $to_time = strtotime($date->format('d.m.Y H:i'));
//        $from_time = strtotime($starttime);
//        echo "<br/>".round(abs($to_time - $from_time) / 60/60, 0) . " tuntia";
        ?>     
    </form>
    <!-- HTML --> 

</body>
</html>
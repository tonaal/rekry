<?php
header('Content-Type: text/html; charset=UTF-8');
mb_internal_encoding('UTF-8');
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
<link rel="stylesheet" type="text/css" href="assets/css/toolbar.css">

<body>   
         
<ul class="glossymenu" >
	<li class="current"><a href="<?php echo base_url();?>"><b>Dashboard</b></a></li>
	<li><a href="<?php echo base_url();?>index.php/crud_greenwalls"><b>Vihersein&auml;t</b></a></li>
	<li><a href="<?php echo base_url();?>index.php/crud_maintenance"><b>Huolto</b></a></li>	
	<li><a href="<?php echo base_url();?>index.php/crud_users"><b>K&auml;ytt&auml;j&auml;hallinta</b></a></li>
        <li><a href="http://176.58.125.202/rekryadmin/index.php/wateringtimers"><b>Timereiden hallinta</b></a></li>
        <li><a href="<?php echo base_url(); ?>index.php/testcases/shrinker"><b>Kuvapienennin</b></a></li>
	
</ul>
          
    <div id="login" style="margin-left:20px;">
       <?php
			 //echo anchor('auth/archive/' . $currentGroups[0]->id, 'Katso lomakearkistoa') 
		?>



        <h1>Etusivu </h1>
        <div id="container" style="width: 95%;">
            <p>Varataan dashboardin etusivu erilaisten raporttien ja muistutuksien tuomiseen.<br/> Esim. jotain p&auml;ivitt&auml;in katsottavaa
            kaaviota voidaan piirt&auml;&auml; t&auml;h&auml;n</p>
            <img src="assets/img/google-chart-tool.png">
            <p>Huollon kavereiden omille tunnuksille voidaan t&auml;h&auml;n tuoda <br/>vaikka muutaman seuraavan p&auml;iv&auml;n huoltokeikat.</p>
<!--          
             
 <table style="width:40%">
          <tr>
              <td style='vertical-align:middle; width:50%'>
		<img src="<?php echo base_url();?>assets/img/ico_pdf.png"/>
                 
              </td>
               <td style='vertical-align:middle; width:50%'>
		<img src="<?php echo base_url();?>assets/img/ico_pdf.png"/>
                 
              </td>
              <td style='vertical-align:middle; width:50%; padding-left: 10px;'>
                <img src="<?php echo base_url();?>assets/img/ico_pdf.png"/>
              </td>
          </tr>
          <tr>
              <td>
 		 <?php echo anchor('crud_users', 'K&auml;ytt&auml;j&auml;t') ?>
              </td>
              <td>
 		 <?php echo anchor('crud_greenwalls', 'Vihersein&auml;t') ?>
              </td>
              <td>
		<?php echo anchor('crud_maintenance', 'Huoltok&auml;ynnit') ?>
              </td>
          </tr>
          
      </table>
         -->

        </div>

    </div>
</body>
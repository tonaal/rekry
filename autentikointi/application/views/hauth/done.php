<?php
	var_dump($user_profile);
?>
<div>
<p> Jos koodi olisi rekryadmin tuotantopalvelimella, jatkaisin autentikoinnin k&auml;ytt&ouml;&ouml;nottoa siten, ett&auml; jokaisen sivun (CodeIgniterin controller-luokan) alussa 
tarkistaisin, ett&auml; k&auml;ytt&auml;j&auml; on kirjautunut sis&auml;&auml;n ja ett&auml; k&auml;ytt&auml;j&auml; l&ouml;ytyy meid&auml;n k&auml;ytt&auml;j&auml;hallinnasta.</p>

<p>Googlen API rekister&ouml;inti ei hyv&auml;ksy pelk&auml;ll&auml; IP-osoitteella redirect-urlia, joten koodi ei voi olla annetulla virtuaalipalvelimella.</p>
</div>

<?php  //echo anchor('hauth/logout','Kirjaudu ulos!').'<br />';?>


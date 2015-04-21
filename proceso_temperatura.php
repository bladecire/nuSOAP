<?php 
header("Content-type: text/xml"); 
if(isset($_POST['submit'])){ 
	require_once 'lib/nusoap.php';
	$client = new nusoap_client('http://www.webservicex.net/globalweather.asmx?WSDL','wsdl');	
	$datos = array('CityName'=>$_POST['ciudad'],'CountryName'=>$_POST['pais']);
	$result = $client->call('GetWeather', $datos);
	$result = end($result);
	$result = mb_convert_encoding($result, "UTF-16", "UTF-8");

	$err = $client->getError();
	if ($err) {
		echo '<p><b>Error: '.$err.'</b></p>';
	} else {
		$result = simplexml_load_string($result);
		echo $result->asXML();
	}
}

?>
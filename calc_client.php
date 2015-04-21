<?php
 
require_once ('lib/nusoap.php');

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calculadora</title>
</head>
<body>
	<form action="#" method="POST">
		Num 1 <input type="text" name="n1">
		Num 2 <input type="text" name="n2">
		<select name="operacion" id="operacion">
			<option value="suma">Sumar</option>
			<option value="resta">Restar</option>
			<option value="multiplicacion">Multiplicar</option>
			<option value="division">División</option>
		</select>
		<button>Calcular</button>
		<input type="hidden" value="1" name="submit">
	</form>
</body>
</html>

<?php

if(isset($_POST['submit'])){

$wsdl="http://localhost/m7_local/UF3/nusoap/calc_server.php?wsdl";
$client = new nusoap_client($wsdl,'wsdl');
$params = array('a' => $_POST['n1'], 'b'=>$_POST['n2']);

switch ($_POST['operacion']) {
	case 'suma':
		$result= $client->call('Add', $params);
		echo "<h2>Operacion: ".$_POST['operacion']."</h2>";
		break;

	case 'resta':
		$result= $client->call('Restar', $params);
		echo "<h2>Operacion: ".$_POST['operacion']."</h2>";
		break;

	case 'multiplicacion':
		$result= $client->call('Multiplicar', $params);
		echo "<h2>Operacion: ".$_POST['operacion']."</h2>";
		break;

	case 'division':
		$result= $client->call('Dividir', $params);
		echo "<h2>Operacion: ".$_POST['operacion']."</h2>";
		break;

	default:
		# code...
		break;
}


echo '<h2>Resultat</h2><pre>';
$err = $client->getError();
if ($err) {	echo '<p><b>Error: '.$err.'</b></p>';} else {print_r($result);}
}




?>




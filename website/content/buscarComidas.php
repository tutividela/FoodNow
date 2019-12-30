<?php
require("conectarBD.php");
$data=$_GET['t'];
$datos=explode(',', $data);
$IdRest=$datos[0];
$IdCom=$datos[1];
$conn=conectarBD();
$conn->set_charset('utf8');
if($IdRest=='0'&& $IdCom=='0'){
$sql="SELECT restaurant.nombre AS restaurant , comida.nombre AS comida , comida.precio AS precio FROM restaurant INNER JOIN comidaxrestaurant ON comidaxrestaurant.idRestaurant=restaurant.id INNER JOIN comida ON comidaxrestaurant.idComida=comida.id WHERE comida.id !='$IdCom'";
}else{
	if($IdRest=='0'&& $IdCom!='0'){
$sql="SELECT restaurant.nombre AS restaurant , comida.nombre AS comida , comida.precio AS precio FROM restaurant INNER JOIN comidaxrestaurant ON comidaxrestaurant.idRestaurant=restaurant.id INNER JOIN comida ON comidaxrestaurant.idComida=comida.id INNER JOIN tipocomida ON tipocomida.id=comida.idTipoComida WHERE comida.idTipoComida ='$IdCom'";
	}else{
		if($IdRest!='0'&& $IdCom!='0'){
$sql="SELECT restaurant.nombre AS restaurant , comida.nombre AS comida , comida.precio AS precio FROM restaurant INNER JOIN comidaxrestaurant ON comidaxrestaurant.idRestaurant=restaurant.id INNER JOIN comida ON comidaxrestaurant.idComida=comida.id INNER JOIN tipocomida ON tipocomida.id=comida.idTipoComida WHERE comida.idTipoComida ='$IdCom' AND restaurant.id='$IdRest'";
		}else{
			if($IdRest!='0'&& $IdCom=='0'){
$sql="SELECT restaurant.nombre AS restaurant , comida.nombre AS comida , comida.precio AS precio FROM restaurant INNER JOIN comidaxrestaurant ON comidaxrestaurant.idRestaurant=restaurant.id INNER JOIN comida ON comidaxrestaurant.idComida=comida.id WHERE restaurant.id ='$IdRest'";
			}
		}
	}
}
$datos=consultaSQL($conn,$sql);
$i=0;
while ($i<count($datos)) {
	$rest=$datos[$i]['restaurant'];
	$com=$datos[$i]['comida'];
	$precio=$datos[$i]['precio'];
	$registro=<<<EOT
	<tr>
	<td>$rest</td>
	<td>$com</td>
	<td>$precio</td>
	<td>
	<button class="e_n_button" onclick="agregar_a_PedActual(this);">Agregar</button>
	</td>
	</tr>
EOT;
	echo "$registro";
	$i++;
}
//$sql="SELECT restaurant.nombre AS restaurant , comida.nombre AS comida , comida.precio AS precio";
//echo "<tr><td>'$nomRest'</td><td>'$nomCom'</td></tr>";
desconectarBD($conn);
?>
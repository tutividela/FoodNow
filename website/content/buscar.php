<?php
	require("conectarBD.php");
	header('Content-Type: text/html; charset=utf-8');
	$strCriterios=$_GET["q"];
	$datos=explode(",", $strCriterios);
	
	$conn=conectarBD();
	$conn->set_charset('UTF-8');
	if($datos[0]=="0" && $datos[1]=="0"){
		$sql="SELECT restaurant.nombre AS restaurant, comida.nombre AS comida, comida.descripcion, comida.precio FROM restaurant INNER JOIN comidaxrestaurant ON restaurant.id = comidaxrestaurant.idRestaurant INNER JOIN comida ON comida.id = comidaxrestaurant.idComida";
	}else if ($datos[0]!='0' && $datos[1]=='0'){
		$sql="SELECT restaurant.nombre AS restaurant, comida.nombre AS comida, comida.descripcion, comida.precio FROM restaurant INNER JOIN comidaxrestaurant ON restaurant.id = comidaxrestaurant.idRestaurant INNER JOIN comida ON comida.id = comidaxrestaurant.idComida INNER JOIN tipocomida ON tipocomida.id=comida.idTipoComida WHERE restaurant.id='$datos[0]'";
	}else if ($datos[0]=='0' && $datos[1]!='0'){
		$sql="SELECT restaurant.nombre AS restaurant, comida.nombre AS comida, comida.descripcion, comida.precio FROM restaurant INNER JOIN comidaxrestaurant ON restaurant.id = comidaxrestaurant.idRestaurant INNER JOIN comida ON comida.id = comidaxrestaurant.idComida INNER JOIN tipocomida ON tipocomida.id=comida.idTipoComida WHERE tipocomida.id='$datos[1]'";
	}else if ($datos[0]!='0' && $datos[1]!='0'){
		$sql="SELECT restaurant.nombre AS restaurant, comida.nombre AS comida, comida.descripcion, comida.precio FROM restaurant INNER JOIN comidaxrestaurant ON restaurant.id = comidaxrestaurant.idRestaurant INNER JOIN comida ON comida.id = comidaxrestaurant.idComida INNER JOIN tipocomida ON tipocomida.id=comida.idTipoComida WHERE tipocomida.id='$datos[1]' AND restaurant.id='$datos[0]'";
	}
	if($datos[2]=='true'){
		$sql=$sql . " ORDER BY comida.precio";
	}
	$res=consultaSQL($conn, $sql);
	desconectarBD($conn);
	$i=0;
	while($i<count($res)){
		$filaComida[0]="<td class=\"campo\">" . utf8_encode($res[$i]['restaurant']) . "</td>";
		$filaComida[1]="<td class=\"campo\">" . utf8_encode($res[$i]['comida']) . "</td>";
		$filaComida[2]="<td class=\"campo\" id=\"desc\">" . utf8_encode($res[$i]['descripcion']) . "</td>";
		$filaComida[3]="<td class=\"campo\">$" . utf8_encode($res[$i]['precio']) . "</td>";
		$filaComida[4]="<td><button type=\"button\" class=\"botones\" onclick=\"crearCarrito($i);\">Agregar</button></td>";
		$filaComidaStr=implode("", $filaComida);
		echo "<tr class=\"agregados\">$filaComidaStr</tr>";
		$i++;
	}					
?>
<?php
	session_start();
	require('conectarBD.php');
	$usuario=$_SESSION['userlog'];
	$trs=$_GET["q"];
	$trs=explode(",",$trs);
	$i=0;
	while($i<count($trs)){
		$trsStr[$i]=strip_tags($trs[$i],"<td>");
		$i++;
	}
	$i=0;
	while($i<count($trsStr)){
		$aux[$i]=explode("</td>",$trsStr[$i]);
		$i++;
	}
	$i=0;
	while($i<count($aux)){
		$aux2[$i]=explode("<td class=\"campo\">",implode($aux[$i]));
		$i++;
	}
	$i=0;
	while($i<count($aux2)){
		$aux2[$i][5]=substr($aux2[$i][2],count($aux2[$i][2])-2);
		$aux2[$i][2]=substr($aux2[$i][2],0,count($aux2[$i][2])-31);
		$i++;
	}
	$i=0;
	while($i<count($aux2)){
		unset($aux2[$i][4]);
		unset($aux2[$i][0]);
		$aux2[$i][3]=substr($aux2[$i][3],1);
		$i++;
	}
	$conn=conectarBD();
	$conn->set_charset('utf8');
	$i=0;
	while($i<count($aux2)){
		$res=$aux2[$i][1];
		$com=$aux2[$i][2];
		$precio=$aux2[$i][3];
		$cant=$aux2[$i][5];
		$sql="INSERT INTO pedidoPendiente (idCliente,restaurante,comida,cantidad,precio) 
		VALUES ('$usuario','$res','$com','$cant','$precio')";
		$conn->query($sql);
		$i++;
	}
	desconectarBD($conn);
?>

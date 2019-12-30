<?php
	require("conectarBD.php");
	$posiUsuario=$_GET["q"];
	$conn=conectarBD();
	$sql="SELECT usuario FROM cliente";
	$datos=consultaSQL($conn, $sql);
	desconectarBD($conn);
	function comparar($data, $str){
		$i=0;
		while($i<count($data)){
			if ($data[$i][0]==$str)
				return "true"; /* significa que es usuario*/
			$i=$i+1;
		}
		return "false"; /* significa que no esta registrado en la base de datos*/
	}
	$resultado=comparar($datos, $posiUsuario);
	echo $resultado;
?>
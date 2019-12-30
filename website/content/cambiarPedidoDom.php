<?php
require("conectarBD.php");
$ids=$_GET['t'];
$datos=explode(',', $ids);
$iddom=$datos[0];
$idped=$datos[1];
$conn=conectarBD();
$conn->set_charset('utf8');
$sql="SELECT domicilio.calle AS calle , domicilio.numero AS numero FROM domicilio WHERE domicilio.id='$iddom'";
$data=consultaSQL($conn,$sql);

$calle=$data[0]['calle'];
$numero=$data[0]['numero'];
$sql="UPDATE pedidos SET pedidos.calle='$calle' , pedidos.numeroCalle='$numero' WHERE pedidos.id='$idped'";
$conn->query($sql);
desconectarBD($conn);
echo "Domicilio Actual: $calle $numero";
?>
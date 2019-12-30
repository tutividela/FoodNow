<?php
session_start();
require("conectarBD.php");
$data=$_GET['t'];
$datos=explode(',', $data);
$calle=$datos[0];
$numero=$datos[1];
$idped=$datos[2];
$idcli=$_SESSION['userlog'];
$conn=conectarBD();
$sql="UPDATE pedidos SET pedidos.calle='$calle' , pedidos.numeroCalle='$numero' WHERE pedidos.id='$idped'";
$conn->query($sql);
$sql="INSERT INTO domicilio (domicilio.idcliente, domicilio.calle, domicilio.numero) VALUES ('$idcli','$calle','$numero')";
$conn->query($sql);
desconectarBD($conn);
echo "Domicilio Actual:$calle $numero";
?>
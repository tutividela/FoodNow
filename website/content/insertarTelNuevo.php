<?php
session_start();
require("conectarBD.php");
$data=$_GET['t'];
$datos=explode(',', $data);
$tel=$datos[0];
$idped=$datos[1];
$idcli=$_SESSION['userlog'];
$conn=conectarBD();
$sql="UPDATE pedidos SET pedidos.telefono='$tel' WHERE pedidos.id='$idped'";
$conn->query($sql);
$sql="INSERT INTO telefono (telefono.idcliente, telefono.telefono) VALUES ('$idcli', '$tel')";
$conn->query($sql);
desconectarBD($conn);
echo "Telefono Actual:$tel";
?>
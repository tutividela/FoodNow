<?php
require("conectarBD.php");
$data=$_GET['t'];
$datos=explode(',', $data);
$idtel=$datos[0];
$idped=$datos[1];
$conn=conectarBD();
$conn->set_charset('utf8');
$sql="SELECT telefono.telefono AS telefono FROM telefono WHERE telefono.id='$idtel'";
$datos=consultaSQL($conn,$sql);
$telefono=$datos[0]['telefono'];
$sql="UPDATE pedidos SET pedidos.telefono='$telefono' WHERE pedidos.id='$idped'";
$conn->query($sql);
desconectarBD($conn);
echo "<p class=\"txt\" id=\"telactual\">Telefono Actual: $telefono</p>";
?>
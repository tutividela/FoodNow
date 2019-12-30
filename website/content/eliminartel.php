<?php
session_start();
require("conectarBD.php");
header('Content-Type: text/html; charset=utf-8');
$idcli=$_SESSION['userlog'];
$tel=$_GET["t"];
//$tel=explode(",", $data);
$conn=conectarBD();
$sql="DELETE FROM telefono WHERE telefono='$tel' AND idcliente='$idcli'";
$conn->query($sql);
desconectarBD($conn);
echo "<td>Telefono Eliminado</td>";
?>
<?php
session_start();
require("conectarBD.php");
header('Content-Type: text/html; charset=utf-8');
$idcli=$_SESSION['userlog'];
$data=$_GET["t"];
$datos=explode(",", $data);
$calle=$datos[0];
$numero=$datos[1];
//echo "calle:'$calle' domicilio:'$numero'";
$conn=conectarBD();
$sql="DELETE FROM domicilio WHERE calle='$calle' AND numero='$numero' AND idcliente='$idcli'";
$conn->query($sql);
desconectarBD($conn);
echo "<td>Domiclio Eliminado</td>";
?>
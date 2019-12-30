<?php
session_start();
require("conectarBD.php");
header('Content-Type: text/html; charset=utf-8');
$idped=$_GET['t'];
$conn=conectarBD();
$sql="DELETE FROM pedidos WHERE id='$idped'";
$conn->query($sql);
$sql="DELETE FROM comidaxpedidos WHERE idPedido='$idped'";
$conn->query($sql);
desconectarBD($conn);
echo "<p>PEDIDO ELIMINADO</p>"; 
?>
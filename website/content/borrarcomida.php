<?php
session_start();
require("conectarBD.php");

$data=$_GET['t'];
$datos=explode(',', $data);
$rest=$datos[0];
$com=$datos[1];
$precio=$datos[2];
$cant=$datos[3];
$idped=$datos[4];
$conn=conectarBD();
$conn->set_charset('utf8');
$sql="SELECT * FROM comida WHERE comida.nombre='$com'";
/*$sql="SELECT restaurant.id AS idrest , comida.id AS idcom FROM comidaxpedidos INNER JOIN restaurant ON comidaxpedidos.idRestaurant=restaurant.id INNER JOIN comida ON comidaxpedidos.idComida=comida.id INNER JOIN tipocomida ON comida.idTipoComida=tipocomida.id WHERE comidaxpedidos.idPedido=$idped AND restaurant.nombre=$rest AND comida.nombre=$com";*/
$data=consultaSQL($conn,$sql);
$idcom=$data[0]['id'];
$sql="SELECT * FROM restaurant WHERE restaurant.nombre='$rest'";
$data=consultaSQL($conn,$sql);
$idrest=$data[0]['id'];
$sql="DELETE FROM comidaxpedidos WHERE comidaxpedidos.idRestaurant=$idrest AND comidaxpedidos.idComida=$idcom AND comidaxpedidos.idPedido=$idped LIMIT 1";
$conn->query($sql);

//echo "$idcom $idrest";
//echo "$idrest $idcom $precio $cant $idped";

$sql="SELECT pedidos.subtotal AS subtotal , pedidos.precioTotal AS precioTotal FROM pedidos WHERE pedidos.id='$idped'";
$data=consultaSQL($conn,$sql);
$subtotal=$data[0]['subtotal'];
$precioTotal=$data[0]['precioTotal'];

if($precioTotal==0 && $subtotal==0){
$sql="UPDATE pedidos SET pedidos.subtotal=0, pedidos.precioTotal=0 WHERE pedidos.id='$idped'";
$conn->query($sql);
}else{
	$porecentaje=($precioTotal/$subtotal);
	$subtotalNuevo=$subtotal-$precio;
	$precioTotalNuevo=$precioTotal-($porecentaje*$precio);
	$sql="UPDATE pedidos SET pedidos.subtotal='$subtotalNuevo', pedidos.precioTotal='$precioTotalNuevo' WHERE pedidos.id='$idped'";
    $conn->query($sql);
}
echo "<td>Comida Eliminada</td>";
//echo "$subtotalNuevo $precioTotalNuevo";
desconectarBD($conn);
?>
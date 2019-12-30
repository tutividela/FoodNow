<?php
require("conectarBD.php");
$data=$_GET['t'];
$datos=explode(',', $data);
$com=$datos[1];
$res=$datos[0];
$precio=$datos[2];
$cant=$datos[3];
$idped=$datos[4];
//echo "$data";
$conn=conectarBD();
$conn->set_charset('utf8');
$sql="SELECT comida.id AS idcom FROM comida WHERE comida.nombre='$com'";
$idcom=consultaSQL($conn,$sql);
$idcomida=$idcom[0]['idcom'];
//echo "$idcomida";
$sql="SELECT restaurant.id AS idrest FROM restaurant WHERE restaurant.nombre='$res'";
$idres=consultaSQL($conn,$sql);
$idrest=$idres[0]['idrest'];
//echo "$idrest";

$sql="INSERT INTO comidaxpedidos (idComida,idPedido,idRestaurant,cantidad) VALUES ('$idcomida','$idped','$idrest','$cant')";
$conn->query($sql);
$sql="SELECT pedidos.subtotal AS subtotal , pedidos.precioTotal AS precioTotal FROM pedidos WHERE pedidos.id='$idped'";
$data=consultaSQL($conn,$sql);
$subtotal=$data[0]['subtotal'];
$precioTotal=$data[0]['precioTotal'];

if($precioTotal==0 && $subtotal==0){
$sql="UPDATE pedidos SET pedidos.subtotal=0, pedidos.precioTotal=0 WHERE pedidos.id='$idped'";
$conn->query($sql);
}else{
	$porecentaje=($precioTotal/$subtotal);
	$subtotalNuevo=$subtotal+$precio;
	$precioTotalNuevo=$precioTotal+($porecentaje*$precio);
	$sql="UPDATE pedidos SET pedidos.subtotal='$subtotalNuevo', pedidos.precioTotal='$precioTotalNuevo' WHERE pedidos.id='$idped'";
    $conn->query($sql);
}
//echo "$subtotalNuevo $precioTotalNuevo";
desconectarBD($conn);
?>
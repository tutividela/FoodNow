<?php 
	session_start();
	require("conectarBD.php");
	$_SESSION['precio']=0.0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Estado Pedido</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="../css/estilos1.css">
	<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
<div id="envolturaPrincipal">
<?php
	$idUsuario=$_SESSION['userlog'];
	$nuevaDir="";
	$dir=$_POST["direccion"];
	$direccion=strip_tags($dir);
	if($direccion=="addDirec"){
		$nuevaDir=array($_POST['addDireccionCalle'],$_POST['addDireccionNum']);
		$calle=trim($nuevaDir[0]);
		$num=trim($nuevaDir[1]);
		$conn=conectarBD();
		$conn->set_charset('utf8');
		$sql="INSERT INTO domicilio (idcliente, calle, numero) VALUES ('$idUsuario', '$calle', '$num')";
		$conn->query($sql);
		$sql="SELECT id FROM domicilio WHERE idCliente='$idUsuario' AND calle='$calle' AND numero='$num'";
		$datos=consultaSQL($conn,$sql);
		desconectarBD($conn);
		$direccion=$datos[0][0];
	}else{
		$conn=conectarBD();
		$conn->set_charset('utf8');
		$sql="SELECT calle, numero FROM domicilio WHERE id='$direccion'";
		$datos=consultaSQL($conn,$sql);
		desconectarBD($conn);
		$calle=$datos[0][0];
		$num=$datos[0][1];
	}

	$nuevoTel="";
	$tel=$_POST["telefono"];
	$telefono=strip_tags($tel);
	if($telefono=="addTelef"){
		$nuevoTel=trim($_POST['addTelefono']);
		$conn=conectarBD();
		$conn->set_charset('utf8');
		$sql="INSERT INTO telefono (idcliente, telefono) VALUES ('$idUsuario', '$nuevoTel')";
		$conn->query($sql);
		$sql="SELECT id FROM telefono WHERE idCliente='$idUsuario' AND telefono='$nuevoTel'";
		$datos=consultaSQL($conn,$sql);
		desconectarBD($conn);
		$telefono=$datos[0][0];
	}else{
		$conn=conectarBD();
		$conn->set_charset('utf8');
		$sql="SELECT telefono FROM telefono WHERE id='$telefono'";
		$datos=consultaSQL($conn,$sql);
		desconectarBD($conn);
		$nuevoTel=$datos[0][0];
	}

	$foPa=$_POST["formaPago"];
	$formaPago=strip_tags($foPa);

	$promo=$_POST["promociones"];
	$promociones=strip_tags($promo);

	$conn=conectarBD();
	$conn->set_charset('utf8');
	$sql="SELECT restaurante, comida, cantidad, precio FROM pedidoPendiente WHERE idCliente='$idUsuario'";
	$datos=consultaSQL($conn,$sql);
	desconectarBD($conn);
	$i=0;
	while($i<count($datos)){
		$filaComida[$i][0]=$datos[$i]['restaurante'];
		$filaComida[$i][1]=$datos[$i]['comida'];
		$filaComida[$i][2]=$datos[$i]['cantidad'];
		$filaComida[$i][3]=$datos[$i]['precio'];
		$_SESSION['precio']=$_SESSION['precio']+(int)$datos[$i]['precio'] * (int) $datos[$i]['cantidad'];
		$i++;
	}

	$subtotal=$_SESSION['precio'];

	$precioTotal=(1-((float)$promociones)/100) * (float)$subtotal;

	$conn=conectarBD();
	$conn->set_charset('utf8');
	$i=0;
	$sql="INSERT INTO pedidos (idCliente, telefono, calle, numeroCalle, formadepago, subtotal, precioTotal) 
	VALUES ('$idUsuario','$nuevoTel','$calle','$num','$formaPago','$subtotal','$precioTotal')";
	$conn->query($sql);
	$sql="SELECT id FROM pedidos WHERE idCliente='$idUsuario' ORDER BY id DESC";
	$datos=consultaSQL($conn,$sql);
	$idPed=$datos[0]['id'];
	while($i<count($filaComida)){
		$nombreCom=trim($filaComida[$i][1]);
		$sql="SELECT id FROM comida WHERE nombre='$nombreCom' LIMIT 1";
		$datos=consultaSQL($conn,$sql);
		$idCom=$datos[0]['id'];
		$nombreRes=trim($filaComida[$i][0]);
		$sql="SELECT id FROM restaurant WHERE nombre='$nombreRes' LIMIT 1";
		$datos=consultaSQL($conn,$sql);
		$idRes=$datos[0]['id'];
		$cantidad=trim($filaComida[$i][2]);
		$sql="INSERT INTO comidaxpedidos (idComida, idPedido, idRestaurant, cantidad) VALUES ('$idCom','$idPed','$idRes','$cantidad')";
		$conn->query($sql);
		$i++;
	}
	$sql="DELETE FROM pedidoPendiente WHERE idCliente='$idUsuario'";
	$conn->query($sql);
	$sql="DELETE FROM promociones WHERE idcliente='$idUsuario' AND promo='$promociones' LIMIT 1";
	$conn->query($sql);
	$posiPromo[0]=100;
	$posiPromo[1]=0;
	$posiPromo[2]=0;
	$posiPromo[3]=25;
	$posiPromo[4]=0;
	$posiPromo[5]=15;
	$posiPromo[6]=0;
	$posiPromo[7]=0;
	$posiPromo[8]=10;
	$posiPromo[9]=10;
	$posiPromo[10]=0;
	$posiPromo[11]=15;
	$posiPromo[12]=0;
	$posiPromo[13]=10;
	$posiPromo[14]=25;
	$posiNuevaPromo=rand(0,14);
	if($posiPromo[$posiNuevaPromo]==0){
		$promoMsj="Lamentablemente no obtuvo ninguna nueva promoción.";
	}else{
		$promoMsj="Felicidades, obtuvo una nueva promoción. Es un descuento del " . $posiPromo[$posiNuevaPromo] . "%";
		$numPromo=$posiPromo[$posiNuevaPromo];
		$sql="INSERT INTO promociones (idcliente, promo) VALUES ('$idUsuario', '$numPromo')";
		$conn->query($sql);
	}
	desconectarBD($conn);
	$mensaje=<<<EOT
		<div id=header>
			<img src="../img/logo.png" id="logo">
			<div id="titulo">
				<span>FoodNow</span>
			</div>
		</div>
		<div id="contenido">
			<p id="msjconfirma">Su pedido ha sido confirmado por los Restaurantes. Estará en 30 minutos.</p>
			<p id="msjPromo">$promoMsj</p>
			<img src="../img/imgfondo.png" id="imgfondo">
 			<button onclick="window.open('principal.php','_self');" id="botonPedido">INICIO</button>
 		</div>
EOT;
	echo $mensaje;
?>
</div>
</body>
</html>

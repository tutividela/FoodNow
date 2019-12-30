<?php 
	session_start();
	require("conectarBD.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Usuario Creado</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<link rel="stylesheet" type="text/css" href="../css/estilos1.css">
	<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
<div id="envolturaPrincipal">
<?php
	$usuar=$_POST["usuario"];
	$usuario=strip_tags($usuar);
	$carUsuario=strlen($usuario);
	
	$em=$_POST["email"];
	$email=strip_tags($em);
	$carEmail=strlen($email);

	$contra=$_POST["pass"];
	$pass=strip_tags($contra);
	$carPass=strlen($pass);

	$contra2=$_POST["pass2"];
	$pass2=strip_tags($contra2);
	$carPass2=strlen($pass2);

	$totalCar= $carUsuario * $carEmail * $carPass * $carPass2;
	if ($totalCar >= 1){
		$conn=conectarBD();
		$sql="INSERT INTO cliente (usuario, contrasenia, email) VALUES ('$usuario','$pass','$email')";
		$conn->query($sql);
		$sql="SELECT id FROM cliente where usuario='$usuario'";
		$datos=consultaSQL($conn,$sql);
		$idUsuario=$datos[0]['id'];
		$sql="INSERT INTO promociones (idcliente, promo) VALUES ('$idUsuario',25)";
		$conn->query($sql);
		desconectarBD($conn);
		$mensaje=<<<EOT
			<div id=header>
				<img src="../img/logo.png" id="logo">
				<div id="titulo">
					<span>FoodNow</span>
				</div>
			</div>
			<div id="contenido">
				<p id="msjconfirma">Los datos han sido guardados con exito.</p>
				<img src="../img/imgfondo.png" id="imgfondo">
     			<button onclick='javascript:history.go(-1)' id="botonPedido">INICIO</button>
     		</div>
EOT;
		echo $mensaje;
	}
?>
</div>
</body>
</html>

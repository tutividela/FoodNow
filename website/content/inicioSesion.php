<?php
	session_start();
	require("conectarBD.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Estado de Sesión</title>
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

	$contra=$_POST["pass"];
	$pass=strip_tags($contra);
	$carPass=strlen($pass);

	$totalCar= $carUsuario * $carPass;
	if ($totalCar >= 1){
		$conn=conectarBD();
		$sql="SELECT * FROM cliente WHERE usuario='$usuario' AND contrasenia='$pass'";
		$datos=consultaSQL($conn,$sql);
		desconectarBD($conn);
		if($datos==NULL) unset($datos);
		if(isset($datos)){
			$_SESSION['userlog']=$datos[0]['id'];
			header('Location: principal.php');
		}
		else{
			$msj="Error al iniciar sesión. Usuario o contraseña incorrecto.";
			$msjbot="INICIO";
			unset($_SESSION['userlog']);
			$mensaje=<<<EOT
				<div id=header>
					<img src="../img/logo.png" id="logo">
					<div id="titulo">
						<span>FoodNow</span>
					</div>
				</div>
				<div id="contenido">
					<p id="msjconfirma">$msj</p>
					<img src="../img/imgfondo.png" id="imgfondo">
					<form action="principal.php">
	     			<input type="submit" id="botonPedido" value='$msjbot'>
	     			</form>
	     		</div>
EOT;
			echo $mensaje;
		}
	}
?>
</div>
</body>
</html>

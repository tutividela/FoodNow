<?php
session_start();
require("conectarBD.php"); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Configurar Cuenta</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device−width, initial−scale=1.0" />
<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="../css/general.css">
<link rel="stylesheet" type="text/css" href="../css/datosexitosos.css">

</head>
<body>
<div id="envolturaPrincipal">
	<div id="header">
		<span id="titulo">FoodNow</span>
	</div>
	<div id="contenido">
		<?php
		$pas=$_POST['pass'];
		$pass=strip_tags($pas);
		
		$idcli=$_SESSION['userlog'];
		$conn=conectarBD();
		$sql="UPDATE cliente SET contrasenia='$pass' WHERE id='$idcli'";
		$conn->query($sql);
		/*$sql="SELECT * FROM cliente WHERE id='$idcli'";
		$registro=consultaSQL($conn,$sql);
		$id=$registro[0]['id'];
		$nombre=$registro[0]['usuario'];
		$contra=$pass;
		$email=$registro[0]['email'];

		//echo "'$id' '$nombre' '$contra' '$email'";
		$sql="DELETE FROM cliente WHERE id='$idcli'";
		$conn->query($sql);
		$sql="INSERT INTO cliente VALUES ('$id','$nombre','$contra','$email')";
		$conn->query($sql);*/
		desconectarBD($conn);
		echo "<p id=\"nombre\">Sus datos han sido modificados con exito!<span><button onclick='javascript:history.go(-1)' class=\"e_n_button\">Volver</button></span></p>";
		?>

	</div>
</div>
</body>
</html>
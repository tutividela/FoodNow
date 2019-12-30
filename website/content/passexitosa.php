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
		desconectarBD($conn);
		echo "<p id=\"nombre\">Sus datos han sido modificados con exito!<span><button onclick='javascript:history.go(-1)' class=\"e_n_button\">Volver</button></span></p>";
		?>

	</div>
</div>
</body>
</html>
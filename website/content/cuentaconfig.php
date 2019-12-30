<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require("conectarBD.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Configurar Cuenta</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device−width, initial−scale=1.0" />
<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="../js/script4.js"></script>
<link rel="stylesheet" type="text/css" href="../css/estilos4.css">
</head>
<body>
	<div id="envolturaPrincipal">
		<div id="header">
			<a href="principal.php"><button id="header_button">Atras</button></a>

			<span id="titulo">FoodNow</span>

		</div>
		<div id="contenido">
			
			<div class="content_data">
				<?php
			$idcli=$_SESSION['userlog'];
			$conn=conectarBD();
			$conn->set_charset('utf8');
			$sql="SELECT usuario FROM cliente WHERE id='$idcli'";
			$datos=consultaSQL($conn,$sql);
			desconectarBD($conn);
			$nombre=$datos[0]['usuario'];
			echo "<p id=\"nombre\">Sesion actual: $nombre</p>";
			?>
				<div class="botones">
					<button onclick="showPass()" class="buttonconfig">Cambiar Contrasenia</button><br>
					<form style="display: none;" id="passform" method="post" action="passexitosa.php">
						<label class="textconfig">Contrasenia:</label><br>
						<input type="password" class="passdata" name="pass"><br>
						<label class="textconfig">Reescribir Contrasenia:</label><br>
						<input type="password" class="passdata" name="pass2" onkeyup="validarpass()"><br>
						<input type="submit" value="Confirmar" id="passsubmit" disabled>
					</form>
				</div>
				
				<div class="botones">
					<button onclick="showEmail()" class="buttonconfig">Cambiar Email:</button><br>
					<form style="display: none;" id="emailform" method="post" action="emailexitoso.php">
						<label class="textconfig">Email:</label><br>
						<input type="text" class="emaildata" name="email" onkeyup="validaremail()"><br>
						<label class="textconfig">Reescribir Email:</label><br>
						<input type="text" class="emaildata" onkeyup="validaremail()"><br>
						<input type="submit" value="Confirmar" id="emailsubmit" disabled>
					</form>	
				</div>
			</div>
			<div class="content_data">
				<!--Domicilios-->
				<table class="domicilios">
					<thead>
					<tr>
						<th>Domicilio</th>
						<th>Numero</th>
						<th></th>
					</tr>
					</thead>
					<tbody id="domregis">
					<?php
					 $idcli=$_SESSION['userlog'];
					 $conn=conectarBD();
					 $conn->set_charset('utf8');
					 $sql="SELECT calle , numero FROM domicilio WHERE idcliente='$idcli'";
					 $datos=consultaSQL($conn,$sql);
					 desconectarBD($conn);
					 if($datos==NULL){
					 	unset($datos);
					 }else{
					 	$i=0;
					 	
					 while($i<count($datos)){
					 	$domString[$i]=$datos[$i]['calle'];
					 	$i++;
					 }
					 $i=0;
					 while($i<count($datos)){
					 	$numString[$i]=$datos[$i]['numero'];
					 	$i++;
					 }
					 $i=0;
					 while($i<count($datos)){
					 	$d=$domString[$i];
					 	$n=$numString[$i];
					 	$regis=<<<EOT
					 	<tr>
					 	<td>$d</td>
					 	<td>$n</td>
					 	  <td>
                             <button type="button" class="e_n_button" onclick="eliminarRegis(this);">Eliminar</button>
					 	  </td>
					 	</tr>
EOT;
					 	echo "'$regis'";
					 	/*echo "<tr class=\"$i\"><td>$d</td><td>$n</td><td><button class=\"e_n_button\" onclick=\"eliminarRegis(this);\">Eliminar</button></td></tr>";*/
					 	$i++;
					 }
					}
					?>
				</tbody>
				</table>
			</div>
			<div class="content_data">
				<!--Telefonos-->
				<table class="telefonos">
					<th>Telefonos</th><th></th>
					<?php
					 $idcli=$_SESSION['userlog'];
					 $conn=conectarBD();
					 $conn->set_charset('utf8');
					 $sql="SELECT telefono FROM telefono WHERE idcliente='$idcli'";
					 $datos=consultaSQL($conn,$sql);
					 desconectarBD($conn);
					 if($datos==NULL){
					 	unset($datos);
					 }else{
					 	$i=0;
					 	while ($i<count($datos)) {
					 		$telefono[$i]=$datos[$i]['telefono'];
					 		$i++;
					 	}
					 	$i=0;
					 	while ($i<count($datos)) {
					 		$n=$telefono[$i];
					 		$tel=<<<EOT
					 		<tr>
					 		<td>$n</td>
					 		<td>
					 		<button class="e_n_button" onclick="eliminartel(this);">Eliminar</button>
					 		</td>
					 		</tr>
EOT;
					 		echo "'$tel'";
					 		
					 		$i++;
					 	}
					 }
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
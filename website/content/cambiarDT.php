<?php
session_start();
require("conectarBD.php");
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<title>Configurar Pedido</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device−width, initial−scale=1.0" />
<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
<script src="../js/script7.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/layoutcambiarDT.css">
<link rel="stylesheet" type="text/css" href="../css/cambiarDT.css">
<link rel="stylesheet" type="text/css" href="../css/general.css">
</head>
<body>
	<div id="envolturaPrincipal">
		<div id="header">
			<a href="pedidoconfig.php"><button id="header_button">Atras</button></a>
            <span id="header_title">FoodNow</span>
		</div>
		<div id="contenido">
			<div id="DTconfig">
				<?php
				$idped=$_GET['idped'];
				$conn=conectarBD();
				$conn->set_charset('utf8');
				$sql="SELECT pedidos.calle AS calle , pedidos.numeroCalle AS numero FROM pedidos WHERE pedidos.id='$idped'";
				$data=consultaSQL($conn,$sql);
				$calle=$data[0]['calle'];
				$num=$data[0]['numero'];
				desconectarBD($conn);
				echo "<p class=\"txt\" id=\"domactual\">Domicilio Actual: $calle $num</p>"
				?>
				<!--<p class="txt">Domicilio Actual:</p>-->
				<div id="Dconfig">
					
					
						<label class="DTitulo">Cambiar Domicilio</label>
						<select class="DTlist" onchange="cambiardom(<?php $idped=$_GET['idped'];echo "'$idped'";?>);" id="Dlist">
							<option value="0">Seleccionar</option>
							<option value="ND">Nuevo Domicilio</option>
							<?php
							$idped=$_GET['idped'];
							$idCli=$_SESSION['userlog'];
							$conn=conectarBD();
							$conn->set_charset('utf8');
							$sql="SELECT domicilio.id AS iddom , domicilio.calle AS calle , domicilio.numero AS numero FROM domicilio WHERE domicilio.idcliente='$idCli'";
							$data=consultaSQL($conn,$sql);
							$i=0;
							while ($i<count($data)) {
								$calle=$data[$i]['calle'];
								$id=$data[$i]['iddom'];
								$num=$data[$i]['numero'];
							echo"<option value=\"" . $id . "\">" . $calle,$num . "</option>";

							$i++;
							}
							desconectarBD($conn);
							?>
						</select>
						<div id="Dcambio" style="display: none;">
							<label class="DTitulo">Calle:</label>
							<input type="text" class="DTdata" id="newcalle"><br>
							<label class="DTitulo">Numero:</label>
							<input type="text" class="DTdata" size="8" id="newnumero"><br>
							<button class="DTbutton" id="Dbutton" onclick="insertarDomNuevo(<?php $idped=$_GET['idped'];echo "'$idped'";?>);">Guardar</button>
						</div>
					
				</div>
				<div id="DTconfig">
					<?php
				$idped=$_GET['idped'];
				$conn=conectarBD();
				$conn->set_charset('utf8');
				$sql="SELECT pedidos.telefono AS telefono FROM pedidos WHERE pedidos.id='$idped'";
				$data=consultaSQL($conn,$sql);
				$tel=$data[0]['telefono'];
				
				desconectarBD($conn);
				echo "<p class=\"txt\" id=\"telactual\">Telefono Actual: $tel</p>"
				?>
					<!--<p class="txt">Telefono Actual:</p>-->
					<div id="Tconfig">
						<label class="DTitulo">Cambiar Telefono</label>
						<select class="DTlist" onchange="cambiarTel(<?php $idped=$_GET['idped'];echo "'$idped'";?>);" id="Tlist">
							<option value="0">Seleccionar</option>

							<option value="NT">Nuevo Telefono</option>
							<?php
							$idped=$_GET['idped'];
							$idCli=$_SESSION['userlog'];
							$conn=conectarBD();
							$conn->set_charset('utf8');
							$sql="SELECT telefono.id AS idtel , telefono.telefono AS numero FROM telefono WHERE telefono.idcliente='$idCli'";
							$data=consultaSQL($conn,$sql);
							$i=0;
							while ($i<count($data)) {
								$tel=$data[$i]['numero'];
								$id=$data[$i]['idtel'];
								
							echo"<option value=\"" . $id . "\">" . $tel . "</option>";

							$i++;
							}
							desconectarBD($conn);
							?>
						</select>
						<div id="Tcambio" style="display: none;">
							<label class="DTitulo">Telefono:</label>
							<input type="text" class="DTdata" size="10" id="newtel"><br>
							<button class="DTbutton" onclick="insertarTelNuevo(<?php $idped=$_GET['idped'];echo "'$idped'";?>);">Guardar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
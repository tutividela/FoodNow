<?php
session_start();
require("conectarBD.php");
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<title>Arma tu Pedido</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device−width, initial−scale=1.0" />
<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
<script src="../js/script6.js" type="text/javascript"></script>
<link type="text/css" href="../css/estilos6.css" rel="stylesheet">
</head>
<body>
<div id="envolturaPrincipal">
	<div id="header">
		<a href="pedidoconfig.php"><button id="header_button">Atras</button></a>
        <span id="titulo">FoodNow</span>
	</div>
	<div id="contenido">
		<!--PHP del usuario -->
		<?php
		$idcli=$_SESSION['userlog'];
		$conn=conectarBD();
		$conn->set_charset('utf8');
		$sql="SELECT usuario FROM cliente WHERE id='$idcli'";
		$datos=consultaSQL($conn,$sql);
		desconectarBD($conn);
		$nombre=$datos[0]['usuario'];
		echo "<p class=\"txt\">Sesion Actual: $nombre</p>";
		?>
		<p class="txt">Pedido Actual:</p>
		<div id="pedactual">
            <?php
            $idped=$_GET["idped"];
            $conn=conectarBD();
            $conn->set_charset('utf8');

            $sql="SELECT restaurant.nombre AS restaurant , comida.nombre AS comida , comida.precio AS precio , comidaxpedidos.cantidad AS cantidad FROM pedidos INNER JOIN comidaxpedidos ON pedidos.id=comidaxpedidos.idPedido INNER JOIN comida ON comida.id=comidaxpedidos.idComida INNER JOIN restaurant ON restaurant.id=comidaxpedidos.idRestaurant WHERE pedidos.id='$idped'";
            $datos=consultaSQL($conn,$sql);
            desconectarBD($conn);
            $cabecera=<<<EOT
            <table>
				<thead>
					<tr>
						<th>Restaurant</th>
						<th>Comida</th>
						<th>Precio</th>
						<th>Cantidad</th>
						<th id="idped" style="display:none;">$idped</th>
					</tr>
				</thead>
				<tbody class="tablas" id="ComActuales">
EOT;
				echo "$cabecera";
				$i=0;
				while ($i<count($datos)) {
					$rest=$datos[$i]['restaurant'];
					$com=$datos[$i]['comida'];
					$prc=$datos[$i]['precio'];
					$cant=$datos[$i]['cantidad'];
					$i++;
					$row=<<<EOT
					<tr>
					<td>$rest</td>
					<td>$com</td>
					<td>$prc</td>
					<td>$cant</td>
					<td>
					<button class="e_n_button" onclick="eliminarregis(this);">Quitar</button>
					</td>
					</tr>
EOT;
					echo "$row";
		}
		$foot=<<<EOT
		</tbody>
		</table>
EOT;
		echo "$foot";

            ?>
			
		</div>
		
		<p class="txt">Configurar Pedido:</p>
		<div id="pedconfig">
			
			<div id="buscadores">
				<!--<form>-->
					<label>Restaurant:</label>
					<select id="ResSel" class="lista">
						<option value="0">Cualquiera</option>
						<?php
						$conn=conectarBD();
				      	$conn->set_charset('utf8');
				      	$sql="SELECT * FROM restaurant";
				      	$datos=consultaSQL($conn, $sql);
				      	desconectarBD($conn);
				      	$i=0;
				      	while($i<count($datos)){
				      		$idRest[$i]=$datos[$i]['id'];
				      		$nomRest[$i]=$datos[$i]['nombre'];
				      		$i++;
				      	}
				      	$i=0;
				      	$opciones="";
				      	while($i<count($datos)){
				      		echo "<option value=\"" . $idRest[$i] . "\">" . $nomRest[$i] . "</option>";
				      		$i++;
				      	}
						?>
					</select>
					<label style="margin-left: 2cm;">Tipo Comida:</label>
					<select id="ComSel" class="lista">
						<option value="0">Cualquiera</option>
						<?php
				      	$conn=conectarBD();
				        $conn->set_charset('utf8');
				      	$sql="SELECT * FROM tipocomida";
				      	$datos=consultaSQL($conn, $sql);
				      	desconectarBD($conn);
				      	$i=0;
				      	while($i<count($datos)){
				      		$idTipoCom[$i]=$datos[$i]['id'];
				      		$nomTipoCom[$i]=$datos[$i]['tipo'];
				      		$i++;
				      	}
				      	$i=0;
				      	$opciones="";
				      	while($i<count($datos)){
				      		echo "<option value=\"" . $idTipoCom[$i] . "\">" . $nomTipoCom[$i] . "</option>";
				      		$i++;
				      	}
				      	?>
					</select>
					
				<!--</form>-->
				<button class="e_n_button" style="margin-left: 2cm;" onclick="buscar();">Buscar</button>
			</div>
			<div id="resultado">
				<table>
					<thead>
						<tr>
							<th>Restaurant</th>
							<th>Comida</th>
							<th>Precio</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="tablas" id="rtasComidas">
						<!--<tr>
							<td>Angies</td>
							<td>Fideos</td>
							<td>120</td>
							<td>
								<button class="e_n_button">Agregar</button>
							</td>
						</tr>-->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>
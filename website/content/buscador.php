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
    <link type="text/css" href="../css/estilos2.css" rel="stylesheet">
    <script src="../js/script2.js" type="text/javascript"></script>
    <link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
	<div id="envolturaPrincipal">
		<div id="header">
			<span id="titulo">Arma tu Pedido</span>
			<a href="principal.php"><button type="button" class="botones" id="atras">Atras</button></a>
			<?php
				$idCli=$_SESSION['userlog'];
				$conn=conectarBD();
				$conn->set_charset('utf8');
				$sql="SELECT usuario FROM cliente WHERE id='$idCli'";
				$datos=consultaSQL($conn,$sql);
				desconectarBD($conn);
				$usuario=$datos[0]['usuario'];
				echo "<button class=\"botones\" id=\"botCarrito\" onclick=\"mostrarCarr();\">Carrito: $usuario</button>";
			?>
		</div>
		<div id="contenido">
			<div id="buscadores">
				<div class="tipo_busc">
					<label class="Rst">Restaurant</label>
					<select class="caja" id="name_restaurant">
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
				</div>
				<div class="tipo_busc">
				    <label >Tipo de Comida</label>
					<select class="caja" class="TdC" id="sel_comida">
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
					<script type="application/javascript">
					  document.getElementById('sel_comida').selectedIndex=0;
				    </script>
                </div>
				<div class="tipo_busc">
					<label >Ordenar por Precio</label>
					<input type="checkbox" id="ordPrec">
				</div>
				<div class="tipo_busc">
					<button type="button" id="boton_busc" onclick="buscador();">Buscar</button>
				</div>
			</div>
			<div id="resultados">
				<label class="parte_buscador">Resultado de Busqueda</label>
				<div id="espacio_de_busqueda" class="parte_buscador">
					<table class="t_resultados">
						<thead>
							<tr>
								<th class="encabezado">Restaurant</th>
								<th class="encabezado">Comida</th>
								<th class="encabezado">Descripción</th>
								<th class="encabezado">Precio</th>
								<th class="encabezado"></th>
							</tr>
						</thead>
						<tbody id="busquedaRes">
							<?php
								$conn=conectarBD();
								$conn->set_charset('utf8');
								$sql="SELECT restaurant.nombre AS restaurant, comida.nombre AS comida, comida.descripcion, comida.precio FROM restaurant INNER JOIN comidaxrestaurant ON restaurant.id = comidaxrestaurant.idRestaurant INNER JOIN comida ON comida.id = comidaxrestaurant.idComida ORDER BY restaurant.nombre";
								$datos=consultaSQL($conn,$sql);
								desconectarBD($conn);
								$i=0;
								while($i<count($datos)){
									$filaComida[0]="<td class=\"campo\">" . $datos[$i]['restaurant'] . "</td>";
									$filaComida[1]="<td class=\"campo\">" . $datos[$i]['comida'] . "</td>";
									$filaComida[2]="<td class=\"campo\" id=\"desc\">" . $datos[$i]['descripcion'] . "</td>";
									$filaComida[3]="<td class=\"campo\">$" . $datos[$i]['precio'] . "</td>";
									$filaComida[4]="<td><button type=\"button\" class=\"botones\" onclick=\"crearCarrito($i);\">Agregar</button></td>";
									$filaComidaStr=implode("", $filaComida);
									echo "<tr class=\"agregados\">$filaComidaStr</tr>";
									$i++;
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="list_ped" class="fade">
			<label class="parte_pedido">Lista de Pedido</label>
				<div id="espacio_de_pedido" class="parte_pedido">
					<table>
						<thead>
							<tr>
								<th>Restaurant</th>
								<th>Comida</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody id="carro">
							<?php
								$usuario=$_SESSION['userlog'];
								$_SESSION['precio']=0.0;
								$conn=conectarBD();
								$conn->set_charset('utf8');
								$sql="SELECT restaurante, comida, cantidad, precio FROM pedidoPendiente WHERE idCliente='$usuario'";
								$datos=consultaSQL($conn,$sql);
								$sql="DELETE FROM pedidoPendiente WHERE idCliente='$usuario'";
								$conn->query($sql);
								desconectarBD($conn);
								$i=0;
								while($i<count($datos)){
									$filaComida[0]="<td class=\"campo\">" . $datos[$i]['restaurante'] . "</td>";
									$filaComida[1]="<td class=\"campo\">" . $datos[$i]['comida'] . "</td>";
									$filaComida[2]="<td class=\"campo\">x" . $datos[$i]['cantidad'] . "</td>";
									$filaComida[3]="<td class=\"campo\">$" . $datos[$i]['precio'] . "</td>";
									$filaComida[4]="<td class=\"campo\"><button class=\"botones\" onclick=\"quitarCarro($i);\">Quitar</button></td>";
									$filaComidaStr=implode("", $filaComida);
									$_SESSION['precio']=$_SESSION['precio']+(int)$datos[$i]['precio'] * (int) $datos[$i]['cantidad'];
									echo "<tr class=\"agregados\" id=\"$i\">$filaComidaStr</tr>";
									$i++;
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td class="campo"></td>
								<td class="campo"></td>
								<th class="campo">Total</th>
								<th class="campo" id="precTot">$<?php echo $_SESSION['precio']; unset($_SESSION['precio']);?></th>
								<td></td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="parte_pedido">
					<button type="button" class="botones" id="bot_listo" onclick="enviarCarrito();" >Listo!</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

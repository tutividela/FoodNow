<?php
	session_start();
	$_SESSION['precio']=0.0;
	require('conectarBD.php');
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Confirmación del Pedido</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device−width, initial−scale=1.0" />
		<link type="text/css" href="../css/estilos3.css" rel="stylesheet"></link>
		<script src="../js/script3.js" type="text/javascript"></script>
		<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div id="envolturaPrincipal">
			<div id="header">
				<img src="../img/logo.png" id="logo">
				<p id="titulo">Confirmación del Pedido</p>
				<?php
					$idCli=$_SESSION['userlog'];
					$conn=conectarBD();
					$conn->set_charset('utf8');
					$sql="SELECT usuario FROM cliente WHERE id='$idCli'";
					$datos=consultaSQL($conn,$sql);
					desconectarBD($conn);
					$usuario=$datos[0]['usuario'];
					echo "<span id=\"sesion\">Usuario: $usuario</span>";
				?>
			</div>
			<div id="contenido">
				<div id="ladoIzq">
					<div id="divConfirm">
						<form id="formConfirm" name="formConfirm" method="post" action="realizarPedido.php">
							<div class="inputsConfirm">
								<label>Dirección</label>
								<select name="direccion" id="direccion" onchange="addDir(this);" required>
									<option value="0">Seleccionar..</option>
									<?php
										$idUsuario=$_SESSION['userlog'];
										$conn=conectarBD();
										$conn->set_charset('utf8');
										$sql="SELECT id, calle, numero FROM domicilio WHERE idcliente='$idUsuario'";
										$datos=consultaSQL($conn,$sql);
										desconectarBD($conn);
										$i=0;
										while($i<count($datos)){
											$nroDom=$datos[$i]['numero'];
											$calleDom=$datos[$i]['calle'];
											$idDom=$datos[$i]['id'];
											$i++;
											echo "<option value=\"" . $idDom . "\">" . $calleDom . " " . $nroDom . "</option>";
										}
									?>
									<option value="addDirec">Añadir Otra Dirección</option>
								</select>
								<script type="application/javascript">
									document.getElementById("direccion").selectedIndex=0;
								</script>
							</div>
							<div class="inputsConfirm" id="anadirDireccion">
								<label>Calle</label>
								<input type="text" name="addDireccionCalle" id="nuevaDir" onblur="validarDir();">
								<label>Número</label>
								<input type="text" name="addDireccionNum" id="nuevoNum" onblur="validarDir();">
							</div>
							<div class="inputsConfirm">
								<label>Teléfono</label>
								<select name="telefono" id="telefono" onchange="addTel(this);" required>
									<option value="0">Seleccionar..</option>
									<?php
										$idUsuario=$_SESSION['userlog'];
										$conn=conectarBD();
										$conn->set_charset('utf8');
										$sql="SELECT id, telefono FROM telefono WHERE idcliente='$idUsuario'";
										$datos=consultaSQL($conn,$sql);
										desconectarBD($conn);
										$i=0;
										while($i<count($datos)){
											$nroTel=$datos[$i]['telefono'];
											$idTel=$datos[$i]['id'];
											$i++;
											echo "<option value=\"" . $idTel . "\">" . $nroTel . "</option>";
										}
									?>
									<option value="addTelef">Añadir Otro Teléfono</option>
								</select>
								<script type="application/javascript">
									document.getElementById("telefono").selectedIndex=0;
								</script>
							</div>
							<div class="inputsConfirm" id="anadirTelefono">
								<label>Nuevo Teléfono</label>
								<input type="number" name="addTelefono" onblur="validarTel(this);">
							</div>
							<div class="inputsConfirm">
								<label>Promociones</label>
								<select name="promociones" id="promociones" onchange="calcularTotal(this);">
									<option value="0">Ninguna</option>
									<?php
										$idUsuario=$_SESSION['userlog'];
										$conn=conectarBD();
										$conn->set_charset('utf8');
										$sql="SELECT promo FROM promociones WHERE idcliente='$idUsuario'";
										$datos=consultaSQL($conn,$sql);
										desconectarBD($conn);
										$i=0;
										while($i<count($datos)){
											$promoTipo=$datos[$i]['promo'];
											if($promoTipo==25)
												$desc="25% descuento";
											else if($promoTipo==10)
												$desc="10% descuento";
											else if($promoTipo==100)
												$desc="Pedido Gratis";
											else if($promoTipo==15)
												$desc="15% descuento";
											$i++;
											echo "<option value=\"" . $promoTipo . "\">" . $desc . "</option>";
										}
									?>
								</select>
								<script type="application/javascript">
									document.getElementById("promociones").selectedIndex=0;
								</script>
							</div>
							<div class="inputsConfirm">
								<label>Forma de Pago</label>
								<select name="formaPago" id="formaPago" onchange="addFormaPago(this);" required>
									<option value="0">Seleccionar..</option>
									<option value="efectivo">Efectivo en Entrega</option>
									<option value="tarjeta">Tarjeta</option>
								</select>
								<script type="application/javascript">
									document.getElementById("formaPago").selectedIndex=0;
								</script>
							</div>
							<div class="inputsConfirm" id="efect">
								<label>¿Con cuánto va a pagar?</label>
								<input type="text" id="cantEfec" onblur="validarPago(this);">
							</div>
							<div id="botoneraConfirm">
								<input type="button" value="Atras" class="botones" onclick="history.back();">
								<input type="button" value="Confirmar" class="botones" onclick="validarFormulario();">
							</div>
						</form>
					</div>
				</div>
				<div id="ladoDer">
					<table>
						<thead>
							<tr>	
								<th>Restaurante</th>
								<th>Comida</th>
								<th>Cantidad</th>
								<th>Precio</th>
							</tr>
						</thead>
						<tbody id="carro">
							<?php
								$usuario=$_SESSION['userlog'];
								$conn=conectarBD();
								$conn->set_charset('utf8');
								$sql="SELECT restaurante, comida, cantidad, precio FROM pedidoPendiente WHERE idCliente='$usuario'";
								$datos=consultaSQL($conn,$sql);
								desconectarBD($conn);
								$i=0;
								while($i<count($datos)){
									$filaComida[0]="<td class=\"campo\">" . $datos[$i]['restaurante'] . "</td>";
									$filaComida[1]="<td class=\"campo\">" . $datos[$i]['comida'] . "</td>";
									$filaComida[2]="<td class=\"campo\">" . $datos[$i]['cantidad'] . "</td>";
									$filaComida[3]="<td class=\"campo\">$" . $datos[$i]['precio'] . "</td>";
									$filaComidaStr=implode("", $filaComida);
									$_SESSION['precio']=$_SESSION['precio']+(int)$datos[$i]['precio'] * (int) $datos[$i]['cantidad'];
									echo "<tr class=\"agregados\">$filaComidaStr</tr>";
									$i++;
								}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th>Subtotal</th>
								<th id="subtot">$<?php $precioTot=$_SESSION['precio'];echo $precioTot;?></th>
								<th>Total</th>
								<th id="pagoTot">$<?php $precioTot=$_SESSION['precio'];unset($_SESSION['precio']);echo $precioTot;?></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>

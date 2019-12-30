<?php
session_start();
require("conectarBD.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>Configurar Pedidos</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device−width, initial−scale=1.0" />
<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
<script type="text/javascript" src="../js/script5.js"></script>
<link rel="stylesheet" type="text/css" href="../css/estilos5.css">
</head>
<body>
	<div id="envolturaPrincipal">
		<div id="header">
			<a href="principal.php"><button id="header_button">Atras</button></a>

			<span id="titulo">FoodNow</span>
		</div>
		<div id="contenido">
			<?php
			$idcli=$_SESSION['userlog'];
			$conn=conectarBD();
			$conn->set_charset('utf8');
			$sql="SELECT cliente.usuario AS nombre FROM cliente WHERE cliente.id='$idcli'";
			$nombre=consultaSQL($conn,$sql);
			desconectarBD($conn);
			$usuario=$nombre[0]['nombre'];
			echo "<p class=\"txt\">Sesion actual: $usuario</p>"; 
			?>
			<p class="txt">Pedidos:</p>
			<div id="pedidoslist">
			<?php
			$idcli=$_SESSION['userlog'];
			$conn=conectarBD();
			$conn->set_charset('utf8');
			$sql="SELECT pedidos.id AS idpedidos FROM pedidos WHERE pedidos.idCliente='$idcli'";
			$pedidosID=consultaSQL($conn,$sql);
			$i=0;
			while ($i<count($pedidosID)) {
				$idped=$pedidosID[$i]['idpedidos'];
				$tblhead=<<<EOT
				<div class="pedido">
					<table>
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Restaurant</th>
								<th>Precio($)</th>
								<th>Cantidad</th>
							</tr>
						</thead>
						<tbody>
EOT;
						echo "'$tblhead'";
				$pID=$pedidosID[$i]['idpedidos'];
				$sql="SELECT comida.nombre AS comida , restaurant.nombre AS restaurant , comida.precio AS precio , comidaxpedidos.cantidad AS cantidad FROM pedidos INNER JOIN comidaxpedidos ON pedidos.id= comidaxpedidos.idPedido INNER JOIN comida ON comidaxpedidos.idComida=comida.id INNER JOIN  restaurant ON restaurant.id=comidaxpedidos.idRestaurant WHERE pedidos.id='$pID'";
				$datos=consultaSQL($conn,$sql);
				

				$j=0;
				while ($j<count($datos)) {
					$comida=$datos[$j]['comida'];
					$rest=$datos[$j]['restaurant'];
					$precio=$datos[$j]['precio'];
					$cantidad=$datos[$j]['cantidad'];
					
					$cuadroPedido=<<<EOT
					<tr>
					<td class="regis">$comida</td>
					<td class="regis">$rest</td>
					<td class="regis">$precio</td>
					<td class="regis">$cantidad</td>
					</tr>
EOT;
					echo "$cuadroPedido";
					$j++;
				}
				
				
                $tblfoot=<<<EOT
                </tbody>
                <tfoot>
						<tr>
							<td>
							<button class="e_n_button" onclick="eliminarpedido2(this,$idped);">Cancelar Pedido</button>
							</td>
							<td>
							<a href="cambiarpedido.php?idped=$idped"><button class="e_n_button">Cambiar Pedido</button></a>
							</td>
							<td>
							<a href="cambiarDT.php?idped=$idped"><button class="e_n_button">Cambiar Datos de Entrega</button></a>
							</td>
							<td style="display:none" id="idped">$idped</td>
						</tr>
				</tfoot>
				</table>
				</div>
EOT;
				echo "'$tblfoot'";
				$i++;
				
			}
			desconectarBD($conn);

			?>
		    </div>
		</div>
			
		</div>
	
</body>
</html>
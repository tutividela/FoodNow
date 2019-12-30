<?php 
	session_start();
	//session_destroy();
	require("conectarBD.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device−width, initial−scale=1.0" />
		<title>FoodNow: Pida su Comida Ya</title>
		<link type="text/css" href="../css/estilos1.css" rel="stylesheet"></link>
		<script src="../js/script1.js" type="text/javascript"></script>
		<link href="../img/logo.png" rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		<div id="envolturaPrincipal">
			<div id="header">
				<img src="../img/logo.png" id="logo">
				<div id="titulo">
					<span>FoodNow</span>
				</div>
				<div id="slogan">
					<span>Pedí lo que quieras para comer!</span>
				</div>
				<div id="botoneraLogin">
				<?php
					if(isset($_SESSION['userlog'])){
						$idUsuar=$_SESSION['userlog'];
						$conn=conectarBD();
						$sql="SELECT cliente.usuario, cliente.contrasenia, cliente.email FROM cliente WHERE cliente.id='$idUsuar'";
						$datos=consultaSQL($conn,$sql);
						if($datos==NULL) unset($datos);
						if(isset($datos)){
							$i=0;
							$usuario=utf8_encode($datos[$i]['usuario']);
							$contra=utf8_encode($datos[$i]['contrasenia']);
							$email=$datos[$i]['email'];
							if($email=="")$email="NO REGISTRADO";
							$sql="SELECT domicilio.calle, domicilio.numero FROM domicilio WHERE domicilio.idcliente='$idUsuar'";
							$datos=consultaSQL($conn,$sql);
							if($datos==NULL) unset($datos);
							if(isset($datos)){
								while($i<count($datos)){
									$domicilio[$i]=utf8_encode($datos[$i]['calle']) . " " . $datos[$i]['numero'];
									$i++;
								}
								$domString=implode('</li><li>', $domicilio);
							}else{
								$domString="NO REGISTRADO";
							}
							$i=0;
							$sql="SELECT telefono.telefono FROM telefono WHERE telefono.idcliente='$idUsuar'";
							$datos=consultaSQL($conn,$sql);
							desconectarBD($conn);
							if($datos==NULL) unset($datos);
							if(isset($datos)){
								while($i<count($datos)){
									$telefono[$i]=$datos[$i]['telefono'];
									$i++;
								}
								$telString=implode('</li><li>', $telefono);
							}else{
								$telString="NO REGISTRADO";
							}
							$formularios=<<<EOT
								<span id="sesion" onclick="addList();" class="ajuste">Sesión Iniciada: $usuario</span>
								
EOT;
							$lista=<<<EOT
								<div id="seslist" class="fade">
									<ul style="list-style-type:none;">
										<div class="inputsLogin">
											<li class="titulis">Contrasenia:</li>
											<li>$contra</li>
										</div>
										<div class="inputsLogin">
										    <li class="titulis">Email:</li>
										    <li>$email</li>
										</div>
										<div class="inputsLogin">
										    <li class="titulis">Telefono:</li>
										    <li>$telString</li>
										</div>

										<div class="inputsLogin">
											<li class="titulis">Domicilio:</li>
											<li>$domString</li>
										</div>
									</ul>
									<div class="inputsLogin">
										<form method="post" action="cerrarSesion.php">
											<input id="loguear" type="submit" value="Cerrar Sesión">
											
										</form>
										<a href="cuentaconfig.php"><button id="loguear" class="buttonconfig">Configurar Cuenta</button></a>
											<a href="pedidoconfig.php"><button id="loguear" class="buttonconfig">Modificar Pedidos</button></a>
									</div>
								</div>
EOT;
						}
					}
					else{
						unset($_SESSION['userlog']);
						$formularios=<<<EOT
							<button id="registrar" onclick="activarRegis();">Registrar</button>
							<button id="login" onclick="activarLogin();">Iniciar</button>
							
EOT;
					$lista="";
					}
					echo $formularios;
					echo $lista;
				?>
				</div>
			</div>
			<div id="contenido">
				<div id="formLogin">
					<form id="formularioLogin" class="fade" method="POST" action="inicioSesion.php">
						<div class="inputsLogin">
							<label>Usuario</label>
							<input type="text" name="usuario" class="usuario" onblur="validarUsuarioLogin(this);">
						</div>
						<div class="inputsLogin">
							<label>Contraseña</label>
							<input type="password" name="pass" class="pass" onblur="validarPassLogin(this);">
						</div>
						<input type="button" name="loguear" id="loguear" value="Iniciar" onclick="validarLogin();">
					</form>
				</div>
				<div id="formRegis">
					<form id="formularioRegis" class="fade" method="post" action="newUser.php">
						<div class="inputsLogin">
							<label>Usuario</label>
							<input type="text" name="usuario" class="usuario" onblur="validarUsuario(this);">
						</div>
						<div class="inputsLogin">
							<label id=pruebaAJAX style="display: none;"></label>
						</div>
						<div class="inputsLogin">
							<label>E-mail</label>
							<input type="text" name="email" id="email" onblur="validarEmail(this);">
						</div>
						<div class="inputsLogin">
							<label>Contraseña</label>
							<input type="password" name="pass" class="pass" id="pass" onblur="validarPass();">
						</div>
						<div class="inputsLogin">
							<label>Confirmar Contraseña</label>
							<input type="password" name="pass2" class="pass" id="passConfirma" onblur="validarPass();">
						</div>
						<input type="button" name="regis" id="regis" value="Registrar" onclick="validarRegistro();">
					</form>
				</div>
				<img id="imgfondo" src="../img/imgfondo.png">
				<a href="buscador.php"><button id="botonPedido">Comenzar el pedido</button></a>
				<div id="slideshows1">
					<div class="slideshow-container">
						<div class="mySlides fade">
						  <img id="imagen" src="../img/promo2x1/hamburguesa.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides fade">
						  <img id="imagen" src="../img/promo2x1/milanesa.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides fade">
						  <img id="imagen" src="../img/promo2x1/pizza.jpg" style="width:100%">
						  <div class="text"></div>
						</div>
					</div>
					<br>
					<div style="text-align:center">
					  <span class="dot"></span> 
					  <span class="dot"></span> 
					  <span class="dot"></span> 
					</div>
				</div>
				<div id="slideshows2">
					<div class="slideshow-container">
						<div class="mySlides2 fade">
						  <img id="imagen" src="../img/promoFree/ravioles.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides2 fade">
						  <img id="imagen" src="../img/promoFree/lasagna.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides2 fade">
						  <img id="imagen" src="../img/promoFree/gnocci.jpg" style="width:100%">
						  <div class="text"></div>
						</div>
					</div>
					<br>
					<div style="text-align:center">
					  <span class="dot2"></span> 
					  <span class="dot2"></span> 
					  <span class="dot2"></span> 
					</div>
				</div>
				<div id="slideshows3">
					<div class="slideshow-container">
						<div class="mySlides3 fade">
						  <img id="imagen" src="../img/promo25/helados.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides3 fade">
						  <img id="imagen" src="../img/promo25/tiramisu.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides3 fade">
						  <img id="imagen" src="../img/promo25/cheesecake.jpg" style="width:100%">
						  <div class="text"></div>
						</div>
					</div>
					<br>
					<div style="text-align:center">
					  <span class="dot3"></span> 
					  <span class="dot3"></span> 
					  <span class="dot3"></span> 
					</div>
				</div>
				<div id="slideshows4">
					<div class="slideshow-container">
						<div class="mySlides4 fade">
						  <img id="imagen" src="../img/promo10/sushi.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides4 fade">
						  <img id="imagen" src="../img/promo10/sanguchazo.jpg" style="width:100%">
						  <div class="text"></div>
						</div>

						<div class="mySlides4 fade">
						  <img id="imagen" src="../img/promo10/coca-cola.jpg" style="width:100%">
						  <div class="text"></div>
						</div>
					</div>
					<br>
					<div style="text-align:center">
					  <span class="dot4"></span> 
					  <span class="dot4"></span> 
					  <span class="dot4"></span> 
					</div>
				</div>
			</div>
		</div>
		<script>
			var slideIndex = 0;
			showSlides();

			function showSlides() {
			    var i;
			    var slides = document.getElementsByClassName("mySlides");
			    var dots = document.getElementsByClassName("dot");
			    var slides2 = document.getElementsByClassName("mySlides2");
			    var dots2 = document.getElementsByClassName("dot2");
			    var slides3 = document.getElementsByClassName("mySlides3");
			    var dots3 = document.getElementsByClassName("dot3");
			    var slides4 = document.getElementsByClassName("mySlides4");
			    var dots4 = document.getElementsByClassName("dot4");
			    for (i = 0; i < slides.length; i++) {
			       slides[i].style.display = "none"; 
			       slides2[i].style.display = "none"; 
			       slides3[i].style.display = "none";
			       slides4[i].style.display = "none";  
			    }
			    slideIndex++;
			    if (slideIndex > slides.length) {slideIndex = 1}    
			    for (i = 0; i < dots.length; i++) {
			        dots[i].className = dots[i].className.replace(" active", "");
			       // dots4[i].className = dots[i].className.replace(" active", "");
			    }
			    slides[slideIndex-1].style.display = "block";  
			    dots[slideIndex-1].className += " active";
			    slides2[slideIndex-1].style.display = "block";  
			    dots2[slideIndex-1].className += " active";
			    slides3[slideIndex-1].style.display = "block";  
			    dots3[slideIndex-1].className += " active";
			    slides4[slideIndex-1].style.display = "block";  
			    dots4[slideIndex-1].className += " active";
			    var x=document.getElementById("botonPedido");
				var y=document.getElementById("sesion");
				if(y==null){
					x.style.cursor='not-allowed';
					x.disabled=true;
				}else{
					x.style.cursor='pointer';
					x.disabled=false;
				}
			    setTimeout(showSlides, 3000); // Change image every 2 seconds
			}
		</script>
	</body>
</html>

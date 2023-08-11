<?php

require_once("modelos/clientes.php");


session_start();
unset($_SESSION['usuario']);
session_destroy();

$nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
$clave = isset($_POST['passClave']) ? $_POST['passClave'] : "";

$mensaje = "";
$respuesta = "";

if ($nombre != "" && $clave != "") {

	$objCliente = new clientes();
	$respuesta = $objCliente->login($nombre, $clave);


	if ($respuesta != true) {
		$mensaje = "Error en las credenciales";
	} else {
		session_start();
		$_SESSION['usuario'] = $objCliente->nombre;
		$_SESSION['email'] 	= $objCliente->email;
		$_SESSION['id'] 	= $objCliente->id;

		header("location: sistema_cliente.php");
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="estilos.css">
</head>

<body>
	<main>
			<form method="POST" action="login_cliente.php" autocomplete="off">
				<div class="row">
					<?php
					if ($respuesta == false && $mensaje != "") {
					?>
						<div class="valign-wrapper red lighten-4 col s6 offset-s3" style="height: 60; font-size:15px">
							<div class="center-align col s12">
								<?= $mensaje ?>
							</div>
						</div>
					<?php
					}
					?><br><br><br><br><br><br>
				
					<div class="wrapper fadeInDown">
						<div id="formContent">
							<!-- Tabs Titles -->
							<h2 class="active"> </h2>
							<h2 class="inactive underlineHover">Iniciar sesion</h2>

							<!-- Icon -->
							<div class="fadeIn first">
								<img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="" />
							</div>

							<!-- Login Form -->
							<form>
								<input type="text" id="nombre" for="nombre" class="fadeIn second" name="txtNombre" placeholder="Nombre o Mail">
								<input type="password" id="clave" for="clave" class="fadeIn third" name="passClave" placeholder="password">
								<input type="submit" class="fadeIn fourth" name="boton" value="ingresar">								
							</form>

							<!-- Remind Passowrd -->
							<div id="formFooter">
								<!--<a class="underlineHover" href="sistema_cliente.php?r=cambioClave_cliente">Olvide mi contraseña</a>-->
								<a class="underlineHover" href="sistema_cliente.php?r=registro_cliente">Registrarse</a>

							</div>
							
						</div>
					</div>
				</div>	
			</form>		
	</main>
</body>

</html>
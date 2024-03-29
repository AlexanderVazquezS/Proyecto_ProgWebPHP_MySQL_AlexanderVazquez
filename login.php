<?php


	require_once("modelos/administradores.php");

	session_start();
	unset($_SESSION['usuario']);
	session_destroy();

	$nombre = isset($_POST['txtNombre'])?$_POST['txtNombre']:"";
	$clave = isset($_POST['passClave'])?$_POST['passClave']:"";

	$mensaje = "";
	$respuesta = "";

	if($nombre != "" && $clave != ""){

		$objAdministradores = new administradores();
		$respuesta = $objAdministradores->login($nombre, $clave);
		

		if($respuesta != true){
			$mensaje = "Error en las credenciales";

		}else{
			session_start();
			$_SESSION['usuario']	  = $objAdministradores->nombre;
			$_SESSION['mail'] 		  = $objAdministradores->mail;
			$_SESSION['id'] 		  = $objAdministradores->id;
			$_SESSION['tipo_usuario'] = $objAdministradores->tipo_usuario;

			header("location: sistema.php?r=layout");
		}


	}
	

?>


<!DOCTYPE html>
<html>

<head>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="web/css/materialize.min.css" media="screen,projection" />

	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<style>
		body {
			display: flex;
			min-height: 100vh;
			flex-direction: column;
		}
		main {
			flex: 1 0 auto;
		}
		

	</style>

</head>

<body>
	<nav>
		<div class="nav-wrapper  light-blue lighten-3">
			<a href="#!" class="brand-logo black-text text-darken-4">
            Login de Administradores
			</a>
		</div>
	</nav>
	<main>
		<div class="container">
		        
		<form method="POST" action="login.php" autocomplete="off">
			<div class="row">					
			<?php
				if($respuesta == false && $mensaje != ""){
			?>		
					<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
						<div class = "center-align col s12">
							<?=$mensaje?>
						</div>				
					</div>
			<?php
				}
			?>

                <br><br><br>
				<div class="input-field col s6 offset-s3">
					<input id="nombre" type="text" class="validate" name="txtNombre">
					<label for="nombre">Nombre o Mail</label>
				</div>
				<div class="input-field col s6 offset-s3">
					<input id="clave" type="password" class="validate" name="passClave">
					<label for="clave">Clave</label>
				</div>
				<div class="col s6 offset-s3">
					<button class="btn waves-effect waves-light light-blue lighten-1" type="submit" name="boton" value="ingresar">Ingresar
						<i class="material-icons right">send</i>			
					</button>
				</div>	
			</div>		
		</form>			
		</div>
	</main>

	<footer class="page-footer light-blue lighten-3">
		<div class="footer-copyright">
			<div class="container black-text">
				© 2014 Copyright Text
				<a class="black-text right" href="#!">More Links</a>
			</div>
		</div>
	</footer>
	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="web/js/materialize.min.js"></script>
	<script>
		//edge 	String 	'left' 	Side of screen on which Sidenav appears.
		document.addEventListener('DOMContentLoaded', function() {
			M.AutoInit();
			var elems = document.querySelectorAll('.sidenav');
			options = {
				"edge": "right",
				"inDuration": 20,
				"outDuration": 2000
			};
			var instances = M.Sidenav.init(elems, options);

			var elems = document.querySelectorAll('.fixed-action-btn');
			var instances = M.FloatingActionButton.init(elems, {
				hoverEnabled: false
			});

		});
	</script>
</body>

</html>
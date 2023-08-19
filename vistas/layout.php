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
			<a href="#!" class="brand-logo indigo-text text-darken-4 center">
				Automotora URUCAR
			</a>
			<a class='dropdown-trigger btn right light-blue darken-4' href='#' data-target='dropdown1' style="margin-top:15px; margin-right:15px">
				<i class="material-icons" style="line-height:34px" title="Perfil">person</i>
			</a>
			<ul class="right hide-on-med-and-down">
				<li>
					<a href="sistema.php?r=listar_alquileresVehiculos_adm" class="btn tooltipped  light-blue darken-4" data-position="bottom" data-tooltip="<h6>Administrar reservas</h6>"><h6>reservas !</h6></a>
				</li>
			</ul>
			<!-- Dropdown Structure -->
			<ul id='dropdown1' class='dropdown-content'">			
				<li>
					<a href=" sistema.php?r=mi_panel">
				<i class="material-icons" title="Editar perfil">settings</i>Conf
				</a>
				</li>
				<li>
					<a href="login.php">
						<i class="material-icons" title="Salir">exit_to_app</i>Salir
					</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="fixed-action-btn">
		<a class="btn-floating btn-large blue">
			<i class="large material-icons" title="Menu">dashboard</i>
		</a>
		<ul>
<?php
			if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] != "vendedor") {
?>
				<li>
					<a href="sistema.php?r=listar_administradores" class="btn-floating red">
						<i class="material-icons" title="Usuarios">supervisor_account</i>
					</a>
				</li>
				<li>
					<a href="sistema.php?r=listar_vehiculos" title="Vehiculos" class="btn-floating yellow darken-1">
						<i class="material-icons">view_list</i>
					</a>
				</li>
<?php
			}
?>
			<li>
				<a href="sistema.php?r=listar_clientes" class="btn-floating green" title="Clientes">
					<i class="material-icons">people</i>
				</a>
			</li>
		</ul>
	</div>
	<main>
		<div class="container">
			<?php include("router.php"); ?>
		</div>
	</main>

	<footer class="page-footer light-blue lighten-3">
		<div class="footer-copyright">
			<div class="container black-text">
				© 2023 Copyright Text
				<a class="black-text right" href="#!">by Alexander Vazquez</a>
			</div>
		</div>
	</footer>
	<!--JavaScript at end of body for optimized loading-->
	<script type="text/javascript" src="web/js/materialize.min.js"></script>

	<!--select-->
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('select');
			var instances = M.FormSelect.init(elems, options);
		});
	</script>

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

		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.tooltipped');
			var instances = M.Tooltip.init(elems, options);
		});
	</script>
</body>

</html>
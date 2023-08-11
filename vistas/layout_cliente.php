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
	<!-- Dropdown Structure -->
	<ul id="dropdown1" class="dropdown-content">		
		<li>
			<a href=" sistema_cliente.php?r=mi_panel_cliente">
				<i class="material-icons" title="Editar perfil">edit</i>Editar
			</a>
		</li>		
		<li class="divider"></li>
		<li>
			<a href="login_cliente.php">
				<i class="material-icons" title="Salir">exit_to_app</i>Salir
			</a>
		</li>
	</ul>
	<nav>
		<div class="nav-wrapper teal lighten-2">
			<a href="#!" class="brand-logo">Automotora URUCAR</a>
			<ul class="right hide-on-med-and-down">
				<li>
					<a href="sistema_cliente.php?r=pagina_principal_cliente" class="waves-effect waves-light btn-small">Pagina Principal</a>
				</li>					
				<!-- Dropdown Trigger -->
				<li>
					<a class="dropdown-trigger" href="#!" data-target="dropdown1">Perfil
						<i class="material-icons right">arrow_drop_down</i>
					</a>
				</li>
			</ul>
		</div>
	</nav>


	<main>
		<div class="container">
			<?php include("router.php"); ?>
		</div>
	</main>
	

	<footer class="page-footer teal lighten-2">
		<div class="footer-copyright">
			<div class="container black-text">
				© 2014 Copyright Text
				<a class="black-text right" href="#!">More Links</a>
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

		$(".dropdown-trigger").dropdown();
	</script>
</body>

</html>
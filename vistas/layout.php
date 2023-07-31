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
		<div class="nav-wrapper  teal lighten-2">
			<a href="#!" class="brand-logo indigo-text text-darken-4 center">
				Automotora URUCAR
			</a>
			<a href="sistema.php?r=listar_vehiculos" class="waves-effect waves-light btn">Vehiculos</a>
			<a class='dropdown-trigger btn right teal accent-3' href='#' data-target='dropdown1' style="margin-top:10px;margin-right:15px">
				<i class="material-icons" style="line-height:34px" title="Perfil">person</i>
			</a>
			<!-- Dropdown Structure -->
			<ul id='dropdown1' class='dropdown-content'">
				<li>
					<a href=" sistema.php?r=mi_panel">
				<i class="material-icons" title="Editar perfil">settings</i>
				</a>
				</li>
				<li>
					<a href="login.php">
						<i class="material-icons" title="Salir">exit_to_app</i>
					</a>
				</li>
			</ul>
		</div>
	</nav>
	
	<div class="fixed-action-btn">
		<a class="btn-floating btn-large blue">
			<i class="large material-icons" title= "Menu">dashboard</i>
		</a>
		<ul>
			<li>
				<a href="sistema.php?r=listar_administradores" class="btn-floating red">
					<i class="material-icons" title= "Listado de usuarios">people</i>
				</a>
			</li>
			<li>
				<a href="" class="btn-floating yellow darken-1">
					<i class="material-icons">format_quote</i>
				</a>
			</li>
			<li>
				<a href="sistema.php?r=lista_directores" class="btn-floating green">
					<i class="material-icons">person</i>
				</a>
			</li>
			<li>
				<a class="btn-floating blue">
					<i class="material-icons">attach_file</i>
				</a>
			</li>
		</ul>
	</div>
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
	</script>
</body>

</html>
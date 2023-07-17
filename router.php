<?php 


		$formulario = isset($_GET['r'])?$_GET['r']:"";

		if($formulario == "lista_usuarios"){

			include("vistas/lista_proveedores.php");	

		}elseif($formulario == "lista_generos"){

			include("vistas/lista_generos.php");	
		
		}elseif($formulario == "lista_directores"){

			include("vistas/lista_directores.php");	

		}else{

			echo("<h1>404 Pagina no existe</h1>");

		}




?>
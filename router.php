<?php 


		$formulario = isset($_GET['r'])?$_GET['r']:"";

		if($formulario == "mi_panel"){

			include("vistas/mi_panel.php");	

		}elseif($formulario == "lista_generos"){

			include("vistas/lista_generos.php");	
		
		}else{

			echo("<h1>404 Pagina no existe</h1>");

		}




?>
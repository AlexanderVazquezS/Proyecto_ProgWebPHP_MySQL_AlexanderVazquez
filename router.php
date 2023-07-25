<?php 


		$formulario = isset($_GET['r'])?$_GET['r']:"";

		if($formulario == "mi_panel"){

			include("vistas/mi_panel.php");	

		}elseif($formulario == "ingresar_administradores"){

			include("vistas/ingresar_administradores.php");	

		}else{

			echo("<h1>404 Pagina no existe</h1>");

		}




?>
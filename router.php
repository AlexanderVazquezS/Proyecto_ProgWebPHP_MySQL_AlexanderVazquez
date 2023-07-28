<?php 


		$formulario = isset($_GET['r'])?$_GET['r']:"";

		if($formulario == "mi_panel"){

			include("vistas/mi_panel.php");	

		}elseif($formulario == "listar_administradores"){

			include("vistas/listar_administradores.php");	

		}elseif($formulario == "ingresar_administradores"){

			include("vistas/ingresar_administradores.php");	
			
		}elseif($formulario == "editar_administradores"){

			include("vistas/editar_administradores.php");	
			
		}elseif($formulario == "borrar_administradores"){

			include("vistas/borrar_administradores.php");	
			
		}elseif($formulario == "listar_vehiculos"){

			include("vistas/listar_vehiculos.php");	
			
		}else{

			echo("<h1>404 Pagina no existe</h1>");

		}




?>
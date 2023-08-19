<?php 


		$formulario = isset($_GET['r'])?$_GET['r']:"";

		if($formulario == "mi_panel"){

			include("vistas/mi_panel.php");	

		}elseif($formulario == "mi_panel_cliente"){

			include("vistas/mi_panel_cliente.php");	

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
			
		}elseif($formulario == "listar_vehiculos_cliente"){

			include("vistas/listar_vehiculos_cliente.php");	
			
		}elseif($formulario == "ingresar_vehiculos"){

			include("vistas/ingresar_vehiculos.php");	
			
		}elseif($formulario == "borrar_vehiculos"){

			include("vistas/borrar_vehiculos.php");	
			
		}elseif($formulario == "editar_vehiculos"){

			include("vistas/editar_vehiculos.php");	
			
		}elseif($formulario == "listar_clientes"){

			include("vistas/listar_clientes.php");	
			
		}elseif($formulario == "editar_cliente"){

			include("vistas/editar_cliente.php");	
			
		}elseif($formulario == "borrar_cliente"){

			include("vistas/borrar_cliente.php");	
			
		}elseif($formulario == ""){

			include("vistas/pagina_principal_cliente.php");	
			
		}elseif($formulario == "ingresar_alquiler"){

			include("vistas/ingresar_alquiler.php");	
			
		}elseif($formulario == "editar_alquiler"){

			include("vistas/editar_alquiler.php");	
			
		}elseif($formulario == "borrar_alquiler"){

			include("vistas/borrar_alquiler.php");	
			
		}elseif($formulario == "listar_alquileresVehiculos_adm"){

			include("vistas/listar_alquileresVehiculos_adm.php");	
			
		}elseif($formulario == "ingresar_alquiler_adm"){

			include("vistas/ingresar_alquiler_adm.php");	
			
		}elseif($formulario == "editar_alquiler_adm"){

			include("vistas/editar_alquiler_adm.php");	
			
		}elseif($formulario == "borrar_alquiler_adm"){

			include("vistas/borrar_alquiler_adm.php");	
			
		}else{

			echo("<h1>404 Pagina no existe</h1>");

		}




?>
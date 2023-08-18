<?php

	require_once("modelos/vehiculos.php");
	require_once("modelos/clientes.php");
	require_once("modelos/alquileres.php");

	$mensaje = "";
	$respuesta = "";
	
	$id = isset($_GET['id'])?$_GET['id']:"";

	if(isset($_POST['id']) && $_POST['id'] > 0 && isset($_POST['boton']) && $_POST['boton'] == "borrar"){

			$id = $_POST['id'];
			$objAlquiler = new alquileres();
			$existe = $objAlquiler->cargar($id);
			if($existe){
			

				$respuesta = $objAlquiler->borrar();

				if($respuesta){

					$mensaje = "El registro se borro correctamete";

				}else{

					$mensaje = "Error no se puedo borrar el registro";
				
				}	
			}else{
				// Entramos aca por que el registro no existe
				$respuesta = false;
				$mensaje = "No existe ese registro";
				
			}

		

	}
	if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
		header("Location: sistema_cliente.php?r=listar_vehiculos_cliente");
	}


?>
<h1>Borrar Reserva </h1>

<form method="POST" action="sistema_cliente.php?r=borrar_alquiler">
	<div class="row">
		
	<?php 
		if($respuesta == true){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema_cliente.php?r=listar_vehiculos_cliente" class="btn blue lighten-2">Regresar</a>
				</div>				
			</div>
	<?php
		}elseif($respuesta == false && $mensaje != ""){
	?>		
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>					
				</div>				
				<a href="sistema_cliente.php?r=listar_vehiculos_cliente" class="btn red lighten-2">Regresar</a>
			</div>
	<?php
		}else{
	?>
		<div class="col s6 offset-s3">
			<h3>Esta seguro que desea borrar el registro</h3>
		</div>
		<div class="col s6 offset-s3">
			<input type="hidden" name="id" value="<?=$id?>">
			<button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="borrar">Borrar
				<i class="material-icons right">send</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	<?php
		}
	?>
	</div>		
</form>
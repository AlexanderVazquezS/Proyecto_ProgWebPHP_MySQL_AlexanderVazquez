<?php

	require_once("modelos/administradores.php");

	$mensaje = "";
	$respuesta = "";

	$boton = isset($_POST['boton'])?$_POST['boton']:"";
	$id = isset($_SESSION['id'])?$_SESSION['id']:"";

	$objAdministrador = new administradores();
	$objAdministrador->cargar($id);

	//boton editar perfil
	if($boton == "guardar" && $id != "" 
		&& isset($_POST['txtNombre']) && $_POST['txtNombre'] != "" 
		&& isset($_POST['txtMail']) && $_POST['txtMail'] != ""
        && isset($_POST['txtEstado']) && $_POST['txtEstado'] !=""){
	
		$objAdministrador->nombre 	= $_POST['txtNombre'];
		$objAdministrador->mail 	= $_POST['txtMail'];
        $objAdministrador->estado   = $_POST['txtEstado'];
		$respuesta = $objAdministrador->editar();

		if($respuesta == true){
			$mensaje = "Se modifico correctamente el registro";
		}else{
			$mensaje = "Error al modificar registro";
		}

	}
	//boton cambiar clave

	$clave = isset($_POST['txtClave'])?$_POST['txtClave']:"";
	$nuevaClave = isset($_POST['txtNuevaClave'])?$_POST['txtNuevaClave']:"";
	$confirmarClave = isset($_POST['txtConfirmarClave'])?$_POST['txtConfirmarClave']:"";

	if($boton == "clave" && $id != "" && $clave != "" && $nuevaClave != "" && $confirmarClave !=""){
	
		$respuesta = $objAdministrador->cambiarClave($clave, $nuevaClave, $confirmarClave);

		if($respuesta === true){
			$mensaje = "Se modifico correctamente el registro";
		}else{
			$mensaje = $respuesta;
			$respuesta = false;
		}

	}


	if(isset($_POST['boton']) && $_POST['boton'] == "cancelar"){
		header("Location: sistema.php");
	}


?>
<h1>Editar Perfil</h1>

<form method="POST" action="sistema.php?r=mi_panel">
	<div class="row">
		
	<?php 
		if($respuesta == true && $boton == "guardar"){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema.php?r=lista_proveedores" class="btn blue lighten-2">Regresar</a>
				</div>				
			</div>
	<?php
		}elseif(($respuesta == false && $mensaje != "") && $boton == "guardar"){
	?>		
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
				</div>				
			</div>
	<?php
		}
	?>


		<div class="input-field col s6 offset-s3">
			<input id="nombre" type="text" class="validate" name="txtNombre" value="<?=$objAdministrador->nombre?>">
			<label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="mail" type="text" class="validate" name="txtMail" value="<?=$objAdministrador->mail?>">
			<label for="mail">Mail</label>
		</div>
        <div class="input-field col s6 offset-s3">
			<input id="estado" type="text" class="validate" name="txtEstado" value="<?=$objAdministrador->estado?>">
			<label for="estado">estado</label>
		</div>
		<div class="col s6 offset-s3">
			<button class="btn waves-effect waves-light teal accent-3" type="submit" name="boton" value="guardar">Guardar
				<i class="material-icons right">save</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>

<h1>Cambiar contraseña</h1>

<form method="POST" action="sistema.php?r=mi_panel">
	<div class="row">
		
	<?php 
		if($respuesta == true && $boton == "clave"){
	?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
					<a href="sistema.php?r=lista_proveedores" class="btn blue lighten-2">Regresar</a>
				</div>				
			</div>
	<?php
		}elseif(($respuesta == false && $mensaje != "") && $boton == "clave"){
	?>		
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class = "center-align col s12">
					<?=$mensaje?>
				</div>				
			</div>
	<?php
		}
	?>


		<div class="input-field col s6 offset-s3">
			<input id="clave" type="password" class="validate" name="txtClave" value="">
			<label for="clave">Clave</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="nuevaClave" type="password" class="validate" name="txtNuevaClave" value="">
			<label for="nuevaClave">Nueva Clave</label>
		</div>
        <div class="input-field col s6 offset-s3">
			<input id="confirmarClave" type="password" class="validate" name="txtConfirmarClave" value="">
			<label for="confirmarClave">Confirmar Clave</label>
		</div>
		<div class="col s6 offset-s3">
			<button class="btn waves-effect waves-light teal accent-3" type="submit" name="boton" value="clave">Guardar
				<i class="material-icons right">save</i>			
			</button>
			<button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
				<i class="material-icons right">cancel</i>			
			</button>
		</div>	
	</div>		
</form>
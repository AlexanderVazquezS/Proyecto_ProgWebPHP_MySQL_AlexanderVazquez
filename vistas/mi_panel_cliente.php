<?php

$nuevaClave = trim("aBcD123@");
$resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaClave);


require_once("modelos/clientes.php");

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$id = isset($_SESSION['id']) ? $_SESSION['id'] : "";

$objCliente = new clientes();
$objCliente->cargar($id);

//boton editar perfil
if (
	$boton == "guardar" && $id != ""
	&& isset($_POST['txtNombre']) 	&& $_POST['txtNombre'] != ""
	&& isset($_POST['txtApellido']) && $_POST['txtApellido'] != ""
	&& isset($_POST['txtDireccion'])&& $_POST['txtDireccion'] != ""
	&& isset($_POST['numTelefono']) && $_POST['numTelefono'] != ""
	&& isset($_POST['txtMail'])   	&& $_POST['txtMail'] != ""
	&& isset($_POST['selEstado'])	&& $_POST['selEstado'] != "") {

	$objCliente->nombre 	= $_POST['txtNombre'];
	$objCliente->apellido 	= $_POST['txtApellido'];
	$objCliente->direccion 	= $_POST['txtDireccion'];
	$objCliente->telefono 	= $_POST['numTelefono'];
	$objCliente->email 		= $_POST['txtMail'];
	$objCliente->estado  	= $_POST['selEstado'];
	

	$respuesta = $objCliente->editar();

	if ($respuesta == true) {
		$mensaje = "Se modifico correctamente el registro";
	} else {
		$mensaje = "Error al modificar registro";
	}
}
//boton cambiar clave

$clave = isset($_POST['txtClave']) ? $_POST['txtClave'] : "";
$nuevaClave = isset($_POST['txtNuevaClave']) ? $_POST['txtNuevaClave'] : "";
$confirmarClave = isset($_POST['txtConfirmarClave']) ? $_POST['txtConfirmarClave'] : "";

if ($boton == "clave" && $id != "" && $clave != "" && $nuevaClave != "" && $confirmarClave != "") {

	$respuesta = $objCliente->cambiarClave($clave, $nuevaClave, $confirmarClave);

	if ($respuesta === true) {
		$mensaje = "Se modifico correctamente el registro";
	} else {
		$mensaje = $respuesta;
		$respuesta = false;
	}
}


if (isset($_POST['boton']) && $_POST['boton'] == "cancelar") {
	header("Location: sistema_cliente.php");
}


?>
<h1>Editar Perfil</h1>

<form method="POST" action="sistema_cliente.php?r=mi_panel_cliente">
	<div class="row">

		<?php
		if ($respuesta == true && $boton == "guardar") {
		?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class="center-align col s12">
					<?= $mensaje ?>
					<a href="sistema_cliente.php?r=pagina_principal_cliente" class="btn blue lighten-2">Regresar</a>
				</div>
			</div>
		<?php
		} elseif (($respuesta == false && $mensaje != "") && $boton == "guardar") {
		?>
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class="center-align col s12">
					<?= $mensaje ?>
				</div>
			</div>
		<?php
		}
		?>


		<div class="input-field col s6 offset-s3">
			<input id="nombre" type="text" class="validate" name="txtNombre" value="<?= $objCliente->nombre?>">
			<label for="nombre">Nombre</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="apellido" type="text" class="validate" name="txtApellido" value="<?= $objCliente->apellido?>">
			<label for="apellido">Apellido</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="direccion" type="text" class="validate" name="txtDireccion" value="<?= $objCliente->direccion?>">
			<label for="direccion">Direccion</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="telefono" type="text" class="validate" name="numTelefono" value="<?= $objCliente->telefono?>">
			<label for="telefono">Telefono</label>
		</div>
		<div class="input-field col s6 offset-s3">
			<input id="email" type="text" class="validate" name="txtMail" value="<?= $objCliente->email?>">
			<label for="email">Mail</label>
		</div>		
		<div class="input-field col s6 offset-s3">
            <label for="estado"></label>
            <select id="estado" name="selEstado">
            <option value="">Elija una opcion</option>
                <option <?= $objCliente->estado ?>>1</option>
                <option <?= $objCliente->estado ?>>2</option>
            </select>
            <label>Estado:   " 1 = Activo - 2 = Desactivado"</label>
        </div>
		<div class=" col s6 offset-s3">
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

<form method="POST" action="sistema_cliente.php?r=mi_panel_cliente">
	<div class="row">

		<?php
		if ($respuesta == true && $boton == "clave") {
		?>
			<div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
				<div class="center-align col s12">
					<?= $mensaje ?>
					<a href="sistema_cliente.php?r=layout_cliente" class="btn blue lighten-2">Regresar</a>
				</div>
			</div>
		<?php
		} elseif (($respuesta == false && $mensaje != "") && $boton == "clave") {
			$altura = "100px";
			if (strlen($mensaje) > 70) {
				$altura = "200px";
			}
		?>
			<div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: <?=$altura?>; font-size:25px">
				<div class="center-align col s12">
					<?= $mensaje ?>
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
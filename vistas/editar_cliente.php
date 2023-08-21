<?php

require_once("modelos/clientes.php");

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : "";

$objCliente = new clientes();
$objCliente->cargar($id);

if (
    isset($_POST['boton']) && $_POST['boton'] == "guardar"
    && isset($_POST['id']) && $_POST['id'] > 0
    && isset($_POST['txtNombre']) && $_POST['txtNombre'] != ""
    && isset($_POST['txtApellido']) && $_POST['txtApellido'] != ""
    && isset($_POST['txtDireccion']) && $_POST['txtDireccion'] != ""
    && isset($_POST['txtTelefono']) && $_POST['txtTelefono'] != ""
    && isset($_POST['txtTipoDocumento']) && $_POST['txtTipoDocumento'] != ""
    && isset($_POST['txtNumDocumento']) && $_POST['txtNumDocumento'] != ""
    && isset($_POST['txtMail']) && $_POST['txtMail'] != ""
    && isset($_POST['selEstado']) && $_POST['selEstado'] != ""
    
) {

    $id = $_POST['id'];
  
    $objCliente->cargar($id);

    $objCliente->nombre         = $_POST['txtNombre'];
    $objCliente->apellido       = $_POST['txtApellido'];
    $objCliente->direccion      = $_POST['txtDireccion'];
    $objCliente->telefono       = $_POST['txtTelefono'];    
    $objCliente->tipo_documento = $_POST['txtTipoDocumento'];
    $objCliente->num_documento  = $_POST['txtNumDocumento'];
    $objCliente->email          = $_POST['txtMail'];
    $objCliente->estado         = $_POST['selEstado'];
    $respuesta                  = $objCliente->editar();

    if ($respuesta == true) {
        $mensaje = "Se modifico correctamente el registro";
    } else {
        $mensaje = "Error al modificar registro";
    }
}


if (isset($_POST['boton']) && $_POST['boton'] == "cancelar") {
    header("Location: sistema.php?r=listar_clientes");
}


?>
<h1>Editar Cliente </h1>

<form method="POST" action="sistema.php?r=editar_cliente">
    <div class="row">

        <?php
        if ($respuesta == true) {
        ?>
            <div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                    <a href="sistema.php?r=listar_clientes" class="btn blue lighten-2">Regresar</a>
                </div>
            </div>
        <?php
        } elseif ($respuesta == false && $mensaje != "") {
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
            <input id="nombre" type="text" class="validate" name="txtNombre" value="<?= $objCliente->nombre ?>">
            <label for="nombre">Nombre</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="apellido" type="text" class="validate" name="txtApellido" value="<?= $objCliente->apellido ?>">
            <label for="apellido">Apellido</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="direccion" type="text" class="validate" name="txtDireccion" value="<?= $objCliente->direccion ?>">
            <label for="direccion">Direccion</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="telefono" type="text" class="validate" name="txtTelefono" value="<?= $objCliente->telefono ?>">
            <label for="telefono">Telefono</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="email" type="text" class="validate" name="txtMail" value="<?= $objCliente->email ?>">
            <label for="email">Correo</label>
        </div>  
        <div class="input-field col s6 offset-s3">
            <label for="tipo_documento"></label>
            <select id="tipo_documento" name="txtTipoDocumento">
                <option <?= $objCliente->tipo_documento ?>>CI</option>
                <option <?= $objCliente->tipo_documento ?>>Doc extranjero</option>                
            </select>
            <label><h6>Seleccione un tipo</h6></label>
        </div>    
        <div class="input-field col s6 offset-s3">
            <input id="num_documento" type="text" class="validate" name="txtNumDocumento" value="<?= $objCliente->num_documento ?>">
            <label for="numb_documento">Documento</label>
        </div>  
        <div class="input-field col s6 offset-s3">
            <label for="estado"></label>
            <select id="estado" name="selEstado">
                <option <?= $objCliente->estado ?>>1</option>
                <option <?= $objCliente->estado ?>>2</option>
            </select>
            <label><h6>Estado:   " 1 = Activo - 2 = Desactivado"</h6></label>
        </div>        
        <div class="col s6 offset-s3">
            <input type="hidden" name="id" value="<?= $objCliente->id ?>">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="guardar">Guardar
                <i class="material-icons right">save</i>
            </button>
            <button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
                <i class="material-icons right">cancel</i>
            </button>
        </div>
    </div>
</form>
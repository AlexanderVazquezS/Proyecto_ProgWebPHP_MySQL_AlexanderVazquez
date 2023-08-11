<?php

require_once("modelos/administradores.php");

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : "";

$objAdministrador = new administradores();
$objAdministrador->cargar($id);

if (
    isset($_POST['boton']) && $_POST['boton'] == "guardar"
    && isset($_POST['id']) && $_POST['id'] > 0
    && isset($_POST['txtNombre']) && $_POST['txtNombre'] != ""
    && isset($_POST['selEstado']) && $_POST['selEstado'] != ""
    && isset($_POST['txtTipoUsuario']) && $_POST['txtTipoUsuario'] != ""
) {

    $id = $_POST['id'];
  
    $objAdministrador->cargar($id);

    $objAdministrador->nombre       = $_POST['txtNombre'];
    $objAdministrador->mail         = $_POST['txtMail'];
    $objAdministrador->estado       = $_POST['selEstado'];
    $objAdministrador->tipo_usuario = $_POST['txtTipoUsuario'];
    $respuesta                      = $objAdministrador->editar();

    if ($respuesta == true) {
        $mensaje = "Se modifico correctamente el registro";
    } else {
        $mensaje = "Error al modificar registro";
    }
}


if (isset($_POST['boton']) && $_POST['boton'] == "cancelar") {
    header("Location: sistema.php?r=listar_administradores");
}


?>
<h1>Editar Usuario </h1>

<form method="POST" action="sistema.php?r=editar_administradores">
    <div class="row">

        <?php
        if ($respuesta == true) {
        ?>
            <div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                    <a href="sistema.php?r=listar_administradores" class="btn blue lighten-2">Regresar</a>
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
            <input id="nombre" type="text" class="validate" name="txtNombre" value="<?= $objAdministrador->nombre ?>">
            <label for="nombre">Nombre</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="mail" type="text" class="validate" name="txtMail" value="<?= $objAdministrador->mail ?>">
            <label for="mail">Correo</label>
        </div>      
        <div class="input-field col s6 offset-s3">
            <label for="estado"></label>
            <select id="estado" name="selEstado">
            <option value="">Elija una opcion</option>
                <option <?= $objAdministrador->estado ?>>1</option>
                <option <?= $objAdministrador->estado ?>>2</option>
            </select>
            <label>Estado:   " 1 = Activo - 2 = Desactivado"</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <label for="tipoUsuario"></label>
            <select id="tipoUsuario" name="txtTipoUsuario">
            <option value="">Elija una opcion</option>
                <option <?= $objAdministrador->tipo_usuario ?>>Administrador</option>
                <option <?= $objAdministrador->tipo_usuario ?>>Encargado</option>
                <option <?= $objAdministrador->tipo_usuario ?>>Vendedor</option>
            </select>
            <label>Seleccione un rol</label>
        </div>
        <div class="col s6 offset-s3">
            <input type="hidden" name="id" value="<?= $objAdministrador->id ?>">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="guardar">Guardar
                <i class="material-icons right">save</i>
            </button>
            <button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
                <i class="material-icons right">cancel</i>
            </button>
        </div>
    </div>
</form>
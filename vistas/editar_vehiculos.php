<?php

require_once("modelos/vehiculos.php");

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$id = isset($_GET['id']) ? $_GET['id'] : "";

$objVehiculo = new vehiculos();
$objVehiculo->cargar($id);

if (
    isset($_POST['boton']) && $_POST['boton'] == "guardar"
    && isset($_POST['id']) && $_POST['id'] > 0
    && isset($_POST['txtModelo']) && $_POST['txtModelo'] != ""
    && isset($_POST['txtColor']) && $_POST['txtColor'] != ""
    && isset($_POST['txtTipoVehiculo']) && $_POST['txtTipoVehiculo'] != ""
    && isset($_POST['txtMarca']) && $_POST['txtMarca'] != ""
    && isset($_POST['txtPrecio']) && $_POST['txtPrecio'] != ""
    && isset($_POST['txtCantPasajeros']) && $_POST['txtCantPasajeros'] != ""
    && isset($_POST['txtMatricula']) && $_POST['txtMatricula'] != ""
    && isset($_POST['txtEstado']) && $_POST['txtEstado'] != ""
) {

    $id = $_POST['id'];
    
    $objVehiculo->cargar($id);

    $objVehiculo->modelo         = $_POST['txtModelo'];
    $objVehiculo->color          = $_POST['txtColor'];
    $objVehiculo->tipo_vehiculo  = $_POST['txtTipoVehiculo'];
    $objVehiculo->marca          = $_POST['txtMarca'];
    $objVehiculo->precio         = $_POST['txtPrecio'];
    $objVehiculo->cant_pasajeros = $_POST['txtCantPasajeros'];
    $objVehiculo->matricula      = $_POST['txtMatricula'];
    $objVehiculo->estado         = $_POST['txtEstado'];

    $respuesta                   = $objVehiculo->editar();

    if ($respuesta == true) {
        $mensaje = "Se modifico correctamente el registro";
    } else {
        $mensaje = "Error al modificar registro";
    }
}


if (isset($_POST['boton']) && $_POST['boton'] == "cancelar") {
    header("Location: sistema.php?r=listar_vehiculos");
}


?>
<h1>Editar vehiculo </h1>

<form method="POST" action="sistema.php?r=editar_vehiculos">
    <div class="row">

        <?php
        if ($respuesta == true) {
        ?>
            <div class=" valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px; font-size:25px">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                    <a href="sistema.php?r=listar_vehiculos" class="btn blue lighten-2">Regresar</a>
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
            <input id="modelo" type="text" class="validate" name="txtModelo" value="<?= $objVehiculo->modelo ?>">
            <label for="modelo">Modelo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="color" type="text" class="validate" name="txtColor" value="<?= $objVehiculo->color ?>">
            <label for="color">Color</label>
        </div>        
        <div class="input-field col s6 offset-s3">
            <label for="tipo_vehiculo"></label>
            <select id="tipo_vehiculo" name="txtTipoVehiculo">
            <option value="" disabled selected></option>
                <option <?= $objVehiculo->tipo_vehiculo ?>>Citycar</option>
                <option <?= $objVehiculo->tipo_vehiculo ?>>Sedan</option>
                <option <?= $objVehiculo->tipo_vehiculo ?>>Deportivo</option>
                <option <?= $objVehiculo->tipo_vehiculo ?>>Utilitarios</option>
                <option <?= $objVehiculo->tipo_vehiculo ?>>camioneta</option>
                <option <?= $objVehiculo->tipo_vehiculo ?>>omnibus</option>
            </select>
            <label>Tipo vehiculo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="marca" type="text" class="validate" name="txtMarca" value="<?= $objVehiculo->marca ?>">
            <label for="marca">Marca:   " 1 = Activo - 2 = Desactivado"</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="precio" type="text" class="validate" name="txtPrecio" value="<?= $objVehiculo->precio ?>">
            <label for="precio">Precio"</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="cant_pasajeros" type="text" class="validate" name="txtCantPasajeros" value="<?= $objVehiculo->cant_pasajeros ?>">
            <label for="cant_pasajeros">Pasajeros"</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="matricula" type="text" class="validate" name="txtMatricula" value="<?= $objVehiculo->matricula ?>">
            <label for="matricula">Matricula"</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="estado" type="text" class="validate" name="txtEstado" value="<?= $objVehiculo->estado ?>">
            <label for="estado">Estado:   " 1 = Activo - 2 = Desactivado"</label>
        </div>
        <div class="col s6 offset-s3">
            <input type="hidden" name="id" value="<?= $objVehiculo->id ?>">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="guardar">Guardar
                <i class="material-icons right">save</i>
            </button>
            <button class="btn waves-effect waves-light lime lighten-3" type="submit" name="boton" value="cancelar">Cancelar
                <i class="material-icons right">cancel</i>
            </button>
        </div>
    </div>
</form>
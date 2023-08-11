<?php

require_once("modelos/vehiculos.php");
$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";

if ($boton == "volver") {

    //aca lo que hacemos es redireccionar a la pantalla inicial
    header('Location: sistema.php?r=listar_vehiculos');
} elseif ($boton == "ingresar") {


    print_r($_FILES);
    $respuesta = copy($_FILES['imgVehiculo']['tmp_name'],"web/archivos/".$_FILES['imgVehiculo']['name']);
    print_r($respuesta);
    
    //en caso de que el boton sea igual a ingresar lo que 
    //hacemos es ingresar el registro.

    $objVehiculos = new vehiculos();
    $arrayDatos = array();

    $arrayDatos['modelo'] = isset($_POST['txtModelo']) ? $_POST['txtModelo'] : "";
    $arrayDatos['color'] = isset($_POST['txtColor']) ? $_POST['txtColor'] : "";
    $arrayDatos['tipo_vehiculo'] = isset($_POST['txtTipoVehiculo']) ? $_POST['txtTipoVehiculo'] : "";
    $arrayDatos['marca'] = isset($_POST['txtMarca']) ? $_POST['txtMarca'] : "";
    $arrayDatos['precio'] = isset($_POST['txtPrecio']) ? $_POST['txtPrecio'] : "";
    $arrayDatos['cant_pasajeros'] = isset($_POST['txtCantPasajeros']) ? $_POST['txtCantPasajeros'] : "";
    $arrayDatos['matricula'] = isset($_POST['txtMatricula']) ? $_POST['txtMatricula'] : "";

    if (
        $arrayDatos['modelo'] != "" && $arrayDatos['color'] != "" && $arrayDatos['tipo_vehiculo'] != ""
        && $arrayDatos['marca'] != "" && $arrayDatos['precio'] != "" && $arrayDatos['cant_pasajeros'] != ""
        && $arrayDatos['matricula'] != ""
    ) {

        $objVehiculos->constructor($arrayDatos);
        $respuesta = $objVehiculos->ingresar();

        if ($respuesta == true) {
            $mensaje = "Se ingreso correctamente el registro";
        } else {
            $mensaje = "Error al ingresar registro";
        }
    } else {
        $mensaje = "Por favor completar todos los campos";
        $respuesta = false;
    }
}


?>

<h1>Ingreso de vehiculo</h1>

<form method="POST" action="sistema.php?r=ingresar_vehiculos" enctype="multipart/form-data">
    <div class="row">

        <?php
        if ($respuesta == true) {
        ?>

            <div class="valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px;">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                </div>
                <a href="sistema.php?r=layout" class="btn blue lighten-2">Regresar</a>
            </div>
        <?php
        } elseif ($respuesta == false && $mensaje != "") {
        ?>
            <div class="valign-wrapper red lighten-4 col s6 offset-s3" style="height: 100px;">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                </div>
            </div>
        <?php
        }
        ?>

        <div class="input-field col s6 offset-s3">
            <input id="modelo" type="text" class="validate" name="txtModelo">
            <label for="modelo">Modelo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="color" type="text" class="validate" name="txtColor">
            <label for="color">Color</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <label for="tip_vehiculo"></label>
            <select id="tipoVehiculo" name="txtTipoVehiculo">
                <option value="" disabled selected></option>
                <option value="citycar">Citycar</option>
                <option value="sedan">Sedan</option>
                <option value="deportivo">Deportivo</option>
                <option value="utilitarios">Utilitarios</option>
                <option value="camioneta">Camioneta</option>
                <option value="omnibus">Omnibus</option>
            </select>
            <label>Tipo vehiculo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="marca" type="text" class="validate" name="txtMarca">
            <label for="marca">Marca</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="precio" type="text" class="validate" name="txtPrecio">
            <label for="precio">Precio</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="cant_pasajeros" type="text" class="validate" name="txtCantPasajeros">
            <label for="cant_pasajeros">Pasajeros</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="matricula" type="text" class="validate" name="txtMatricula">
            <label for="matricula">Matricula</label>
        </div>
        <div class="file-field input-field col s6 offset-s3">
            <div class="btn">
                <span>Archivo</span>
                <input type="file" name="imgVehiculo">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="col s6 offset-s3">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="ingresar">Ingresar
                <i class="material-icons right">send</i>
            </button>
            <button class="btn waves-effect waves-light lime" type="submit" name="boton" value="volver">volver
                <i class="material-icons right">cancel</i>
            </button>
        </div>
    </div>
</form>
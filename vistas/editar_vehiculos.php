<?php

require_once("modelos/vehiculos.php");
$id = isset($_GET['id'])?$_GET['id']:"";

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$objVehiculos = new vehiculos();
$objVehiculos->cargar($id);

if ($boton == "volver") {
    //aca lo que hacemos es redireccionar a la pantalla inicial
    header('Location: sistema.php?r=listar_vehiculos');
} elseif ($boton == "editar") {

    //en caso de que el boton sea igual a ingresar lo que 
    //hacemos es ingresar el registro.
    print_r($_FILES); 

    //$respuesta = copy($_FILES['fileImg']['tmp_name'],"web/archivos/".$_FILES['fileImg']['name']);
    //var_dump($respuesta);
    $img = $objVehiculos->subirImagen($_FILES['fileImg'], 600, 800);

    $arrayDatos = array();

    $arrayDatos['modelo'] = isset($_POST['txtModelo']) ? $_POST['txtModelo'] : "";
    $arrayDatos['color'] = isset($_POST['txtColor']) ? $_POST['txtColor'] : "";    
    $arrayDatos['marca'] = isset($_POST['txtMarca']) ? $_POST['txtMarca'] : "";
    $arrayDatos['precio'] = isset($_POST['txtPrecio']) ? $_POST['txtPrecio'] : "";   
    $arrayDatos['matricula'] = isset($_POST['txtMatricula']) ? $_POST['txtMatricula'] : "";
    $arrayDatos['id'] = isset($_POST['id']) ? $_POST['id'] : "";
    

    if (
        $arrayDatos['modelo'] != "" && $arrayDatos['modelo'] != "" && $arrayDatos['color'] != "" && $arrayDatos['marca'] != "" 
        && $arrayDatos['precio'] != "" && $arrayDatos['matricula'] != ""
    ) {

        $arrayDatos['tipo_vehiculo'] = isset($_POST['txtTipoVehiculo']) ? $_POST['txtTipoVehiculo'] : "";
        $arrayDatos['cant_pasajeros'] = isset($_POST['txtCantPasajeros']) ? $_POST['txtCantPasajeros'] : "";       
        $arrayDatos['imagen'] = $img?$img:"";

        $objVehiculos->constructor($arrayDatos);
        $respuesta = $objVehiculos->editar();

        if ($respuesta == true) {
            $mensaje = "Se edito correctamente el registro";
        } else {
            $mensaje = "Error al editar registro";
        }
    } else {
        $mensaje = "Por favor completar todos los campos";
        $respuesta = false;
    }
}


?>

<h1>Editar de vehiculo</h1>

<form method="POST" action="sistema.php?r=editar_vehiculos" enctype="multipart/form-data">
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
            <input id="modelo" type="text" class="validate" name="txtModelo" value="<?=$objVehiculos->modelo?>">
            <label for="modelo">Modelo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="color" type="text" class="validate" name="txtColor"  value="<?=$objVehiculos->color?>">
            <label for="color">Color</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <label for="tipo_vehiculo"></label>
            <select id="tipo_vehiculo" name="txtTipoVehiculo">
                <option value="" disabled selected></option>
                <option value="<?=$objVehiculos->tipo_vehiculo?>">Citycar</option>
                <option value="<?=$objVehiculos->tipo_vehiculo?>">Sedan</option>
                <option value="<?=$objVehiculos->tipo_vehiculo?>">Deportivo</option>
                <option value="<?=$objVehiculos->tipo_vehiculo?>">Utilitarios</option>
                <option value="<?=$objVehiculos->tipo_vehiculo?>">Camioneta</option>
                <option value="<?=$objVehiculos->tipo_vehiculo?>">Omnibus</option>
            </select>
            <label>Tipo vehiculo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="marca" type="text" class="validate" name="txtMarca" value="<?=$objVehiculos->marca?>">
            <label for="marca">Marca</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="precio" type="text" class="validate" name="txtPrecio" value="<?=$objVehiculos->precio?>">
            <label for="precio">Precio</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="cant_pasajeros" type="text" class="validate" name="txtCantPasajeros" value="<?=$objVehiculos->cant_pasajeros?>">
            <label for="cant_pasajeros">Pasajeros</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="matricula" type="text" class="validate" name="txtMatricula" value="<?=$objVehiculos->matricula?>">
            <label for="matricula">Matricula</label>
        </div>       
        <div class="file-field input-field col s6 offset-s3">
            <div class="btn">
                <span>Archivo</span>
                <input type="file" name="fileImg">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="col s6 offset-s3">
            <input type="hidden" name="id" value="<?=$objVehiculos->id?>">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="editar">Ingresar
                <i class="material-icons right">send</i>
            </button>
            <button class="btn waves-effect waves-light lime" type="submit" name="boton" value="volver">volver
                <i class="material-icons right">cancel</i>
            </button>
        </div>
    </div>
</form>
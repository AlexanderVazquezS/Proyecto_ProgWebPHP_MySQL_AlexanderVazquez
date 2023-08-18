<?php

require_once("modelos/alquileres.php");
require_once("modelos/vehiculos.php");
require_once("modelos/clientes.php");

$id = isset($_GET['id'])?$_GET['id']:"";

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$objAlquiler = new alquileres();
$objAlquiler->cargar($id);

if ($boton == "volver") {
    //aca lo que hacemos es redireccionar a la pantalla inicial
    header('Location: sistema_cliente.php?r=listar_vehiculos_cliente');
} elseif ($boton == "editar") {

    //en caso de que el boton sea igual a ingresar lo que 
    //hacemos es ingresar el registro.

    $arrayDatos = array();

    $arrayDatos['fecha_desde'] = isset($_POST['dateDesde']) ? $_POST['dateDesde'] : "";
    $arrayDatos['fecha_hasta'] = isset($_POST['dateHasta']) ? $_POST['dateHasta'] : "";    
    $arrayDatos['id'] = isset($_POST['id']) ? $_POST['id'] : "";

    if (
        $arrayDatos['fecha_desde'] != "" && $arrayDatos['id'] != "" && $arrayDatos['fecha_hasta'] != "" 
    ) {

        $arrayDatos['id_usuario'] = isset($_POST['txtUsuario']) ? $_POST['txtUsuario'] : "";
        $arrayDatos['id_vehiculo'] = isset($_POST['txtVehiculo']) ? $_POST['txtVehiculo'] : "";       
        

        $objAlquiler->constructor($arrayDatos);
        $respuesta = $objAlquiler->editar();

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

<h1>Editar de Alquiler</h1>

<form method="POST" action="sistema_cliente.php?r=editar_alquiler">
    <div class="row">

        <?php
        if ($respuesta == true) {
        ?>

            <div class="valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px;">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                </div>
                <a href="sistema_cliente.php?r=pagina_principal_cliente" class="btn blue lighten-2">Regresar</a>
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
            <input id="fecha_desde" type="date" class="validate" name="dateDesde" value="<?=$objAlquiler->fecha_desde?>">
            <label for="fecha_desde">Fecha desde</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="fecha_hasta" type="date" class="validate" name="dateHasta" value="<?=$objAlquiler->fecha_hasta?>">
            <label for="fecha_hasta">Fecha hasta</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="id_usuario" type="text" class="validate" name="txtUsuario" value="<?=$objAlquiler->id_usuario?>" readonly>
            <label for="id_usuario">N° Cliente</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="id_vehiculo" type="text" class="validate" name="txtVehiculo" value="<?=$objAlquiler->id_vehiculo?>" readonly>
            <label for="id_vehiculo">N° Vehiculo</label>
        </div>        
        <div class="col s6 offset-s3">
            <input type="hidden" name="id" value="<?=$objAlquiler->id?>">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="editar">Ingresar
                <i class="material-icons right">send</i>
            </button>
            <button class="btn waves-effect waves-light lime" type="submit" name="boton" value="volver">volver
                <i class="material-icons right">cancel</i>
            </button>
        </div>
    </div>
</form>
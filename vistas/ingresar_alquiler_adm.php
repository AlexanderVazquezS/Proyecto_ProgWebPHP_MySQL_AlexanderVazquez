<?php

require_once("modelos/vehiculos.php");
require_once("modelos/clientes.php");
require_once("modelos/alquileres.php");

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";
$objAlquiler = new alquileres();


if ($boton == "volver") {
    //aca lo que hacemos es redireccionar a la pantalla inicial
    header('Location: sistema.php?r=listar_alquileresVehiculos_adm');
} elseif ($boton == "ingresar") {

    //en caso de que el boton sea igual a ingresar lo que 
    //hacemos es ingresar el registro.

    $arrayDatos = array();

    $arrayDatos['fecha_desde'] = isset($_POST['dateDesde']) ? $_POST['dateDesde'] : "";
    $arrayDatos['fecha_hasta'] = isset($_POST['dateHasta']) ? $_POST['dateHasta'] : "";
    $arrayDatos['id_usuario'] = isset($_POST['selUsuario']) ? $_POST['selUsuario'] : "";
    $arrayDatos['id_vehiculo'] = isset($_POST['selVehiculo']) ? $_POST['selVehiculo'] : "";    

    
    if (
        $arrayDatos['fecha_desde'] != "" && $arrayDatos['fecha_hasta'] != ""  
        
    ) {        
        $objAlquiler->constructor($arrayDatos);
        $respuesta = $objAlquiler->ingresar();

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
$objCliente = new clientes();
$listaClientes = $objCliente->listaCorta();
$objVehiculo = new vehiculos();
$listaVehiculos = $objVehiculo->listaCorta();

?>

<h1>Reserva</h1>

<form method="POST" action="sistema.php?r=ingresar_alquiler_adm"">
    <div class="row">

        <?php
        if ($respuesta == true) {
        ?>

            <div class="valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px;">
                <div class="center-align col s12">
                    <?= $mensaje ?>
                </div>
                <a href="sistema.php?r=listar_alquileresVehiculos_adm" class="btn blue lighten-2">Regresar</a>
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
            <input id="fecha_desde" type="date" class="validate" name="dateDesde">
            <label for="fecha_desde">Fecha desde</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="fecha_hasta" type="date" class="validate" name="dateHasta">
            <label for="fecha_hasta">Fecha hasta</label>
        </div>        
        <div class="input-field col s6 offset-s3">
		<select name="selUsuario">
				<option value="" disabled selected>Selecciones un Cliente</option>
<?php
				foreach($listaClientes as $clientes){
?>
					<option value="<?=$clientes['id']?>"><?=$clientes['nombreCompleto']?></option>
<?PHP					
				}
?>

			</select>			
			<label for="id_usuario">Clientes</label>
		</div>
        <div class="input-field col s6 offset-s3">
		<select name="selVehiculo">
				<option value="" disabled selected>Selecciones un Vehiculo</option>
<?php
				foreach($listaVehiculos as $vehiculos){
?>
					<option value="<?=$vehiculos['id']?>"><?=$vehiculos['marcaModelo']?></option>
<?PHP					
				}
?>

			</select>			
			<label for="id_vehiculo">Vehiculos</label>
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
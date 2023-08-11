<?php

require_once("modelos/clientes.php");

$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";

if ($boton == "volver") {

    //aca lo que hacemos es redireccionar a la pantalla inicial
    header('Location: login_cliente.php');
} elseif ($boton == "ingresar") {

    //en caso de que el boton sea igual a ingresar lo que 
    //hacemos es ingresar el registro.
    $objCliente = new clientes();
    $arrayDatos = array();

    $arrayDatos['nombre'] = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : "";
    $arrayDatos['apellido'] = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : "";
    $arrayDatos['direccion'] = isset($_POST['txtDireccion']) ? $_POST['txtDireccion'] : "";
    $arrayDatos['telefono'] = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : "";
    $arrayDatos['tipo_documento'] = isset($_POST['txtTipoDocumento']) ? $_POST['txtTipoDocumento'] : "";
    $arrayDatos['email'] = isset($_POST['txtMail']) ? $_POST['txtMail'] : "";
    $arrayDatos['num_documento'] = isset($_POST['txtDocumento']) ? $_POST['txtDocumento'] : "";
    $arrayDatos['clave'] = isset($_POST['passClave']) ? $_POST['passClave'] : "";

    if (
        $arrayDatos['nombre'] != "" && $arrayDatos['apellido'] != "" && $arrayDatos['direccion'] != ""
        && $arrayDatos['telefono'] != "" && $arrayDatos['tipo_documento'] != "" && $arrayDatos['email'] != ""
        && $arrayDatos['num_documento'] != "" && $arrayDatos['clave'] != ""
    ) {

        $objCliente->constructor($arrayDatos);
        $respuesta = $objCliente->ingresar();

        if ($respuesta == true) {
            $mensaje = "Se ingreso correctamente el registro";
        } else {
            $mensaje = "Error al ingresar registro";
            $respuesta = false;
        }
    } else {
        $mensaje = "Por favor completar todos los campos";
    }
  
} 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registro de cliente</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="estilos_registro.css">
</head>

<body>
    <main>

        <form method="POST" action="registro_cliente.php">
            <div class="row">

                <?php
                if ($respuesta == true) {
                ?>

                    <div class="valign-wrapper blue lighten-4 col s6 offset-s3" style="height: 100px;">
                        <div class="center-align col s12">
                            <?= $mensaje ?>
                        </div>
                        <a href="sistema_cliente.php?r=layout_cliente" class="btn blue lighten-2">Regresar</a>
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

                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <!-- Tabs Titles -->
                        <h2 class="active"> </h2>
                        <h2 class="inactive underlineHover">Registro de cliente</h2>
                        
                        <div class="fadeIn first">
                            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="" />
                        </div>
                        <form>
                            <input type="text" id="nombre" for="nombre" class="fadeIn second" name="txtNombre" placeholder="nombre">
                            <input type="text" id="apellido" for="apellido" class="fadeIn second" name="txtApellido" placeholder="apellido">
                            <input type="text" id="direccion" for="direccion" class="fadeIn second" name="txtDireccion" placeholder="direccion">
                            <input type="text" id="telefono" for="telefono" class="fadeIn second" name="txtTelefono" placeholder="telefono">
                            <input type="text" id="email" for="email" class="fadeIn second" name="txtMail" placeholder="email">
                            <div class="input-field col s6 offset-s3">
                                <label for="tipo_documento"></label>
                                <select id="tipo_documento" name="txtTipoDocumento">
                                    <option value="">Seleccione una opcion</option>
                                    <option value="ci">CI</option>
                                    <option value="doc_extranjero">Doc extranjero</option>
                                </select>
                                <label>Tipo de documento</label>
                            </div>
                            <input type="text" id="num_documento" for="num_documento" class="fadeIn second" name="txtDocumento" placeholder="num_documento">
                            <input type="password" id="clave" for="clave" class="fadeIn third" name="passClave" placeholder="clave">
                            <input type="submit" class="fadeIn fourth" name="boton" value="ingresar">
                            <input type="submit" class="fadeIn fourth" name="boton" value="volver">                            
                        </form>                        
                    </div>
                </div>
        </form>
    </main>
</body>
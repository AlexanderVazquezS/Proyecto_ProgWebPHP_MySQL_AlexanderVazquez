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

?>
<!DOCTYPE html>
<html>

<head>
    <title>Cambio de clave</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="estilos_registro.css">
</head>

<body>
    <main>

        <form method="POST" action="cambioClave_cliente">
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
                    <div class=" valign-wrapper red lighten-4 col s6 offset-s3" style="height: <?= $altura ?>; font-size:25px">
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
                        <h2 class="inactive underlineHover">Cambio clave</h2>

                        <div class="fadeIn first">
                            <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="" />
                        </div>
                        <form>
                            <input type="password" id="clave" for="clave" class="fadeIn second" name="txtClave" placeholder="clave">
                            <input type="password" id="nuevaClave" for="nuevaClave" class="fadeIn second" name="txtNuevaClave" placeholder="Nueva clave">
                            <input type="password" id="confirmarClave" for="confirmarClave" class="fadeIn second" name="txtConfirmarClave" placeholder="Confirmar clave">
                            <input type="submit" class="fadeIn fourth" name="boton" value="clave">
                            <input type="submit" class="fadeIn fourth" name="boton" value="cancelar">
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>
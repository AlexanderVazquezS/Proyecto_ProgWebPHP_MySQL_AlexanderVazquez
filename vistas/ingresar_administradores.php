<?php

require_once("modelos/administradores.php");
$mensaje = "";
$respuesta = "";

$boton = isset($_POST['boton']) ? $_POST['boton'] : "";

if ($boton == "volver") {

    //aca lo que hacemos es redireccionar a la pantalla inicial
    header('Location: sistema.php?r=listar_administradores');
} elseif ($boton == "ingresar") {

    //en caso de que el boton sea igual a ingresar lo que 
    //hacemos es ingresar el registro.
    $objAdministrador = new administradores();
    $arrayDatos = array();

    $arrayDatos['nombre'] = isset($_POST['txtNombre'])? $_POST['txtNombre'] : "";
    $arrayDatos['tipo_usuario'] = isset($_POST['txtTipoUsuario'])? $_POST['txtTipoUsuario'] : "";
    $arrayDatos['mail'] = isset($_POST['txtMail'])? $_POST['txtMail'] : "";
    $arrayDatos['clave'] = isset($_POST['txtClave'])? $_POST['txtClave'] : "";

    if (
        $arrayDatos['nombre'] != "" && $arrayDatos['tipo_usuario'] != "" && $arrayDatos['mail'] != ""
        && $arrayDatos['clave'] != ""
    ) {

        $objAdministrador->constructor($arrayDatos);
        $respuesta = $objAdministrador->ingresar();

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

<h1>Ingreso de usuarios</h1>

<form method="POST" action="sistema.php?r=ingresar_administradores">
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
            <input id="nombre" type="text" class="validate" name="txtNombre">
            <label for="nombre">Nombre</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <select id="tipo_usuario" name="txtTipoUsuario">
                <option value="" disabled selected>Seleccione una opcion</option>
                <option value="administrador">Administrador</option>
                <option value="encargado">Encargado</option>
                <option value="vendedor">Vendedor</option>
            </select>
            <label>Rol</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="mail" type="text" class="validate" name="txtMail">
            <label for="mail">Correo</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="clave" type="password" class="validate" name="txtClave">
            <label for="clave">contraseña</label>
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
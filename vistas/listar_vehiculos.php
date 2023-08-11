<?php

require_once("modelos/vehiculos.php");

$objvehiculo = new vehiculos();

$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : 5;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$totalRegistros = $objvehiculo->totalRegistros();

// Pagina Anterior va a ser igua al maximo entre la pagina actual menos 1 y 1
$paginaAnterior = max(($pagina - 1), 1);

$totalPagina = ceil($totalRegistros / $cantidad);

// Pagina siguente va a ser el menor numero entre la pagina actual + 1 y el total de maximo de paginas
$paginaSiguente = min(($pagina + 1), $totalPagina);

$arrayFiltros = array();
$arrayFiltros['inicio'] = ($pagina - 1) * $cantidad;
$arrayFiltros['cantidad'] = $cantidad;

$listaVehiculos = $objvehiculo->listar($arrayFiltros);

?>
<h1>Nuestra Flota</h1>

<table class="responsive-table">
    <thead>
        <tr>
            <th>
                <a href="sistema.php?r=layout" class="btn waves-effect waves-light lime">
                    <i class="material-icons"></i> Volver
                </a>
            </th>
            <th colspan="8">
                <a href="sistema.php?r=ingresar_vehiculos" class="btn blue lighten-2 right">
                    <i class="material-icons">add</i> Nuevo
                </a>
            </th>
        </tr>
        <tr>
            <th>Modelo</th>
            <th>Color</th>
            <th>Tipo vehiculo</th>
            <th>Marca</th>
            <th>Precio</th>
            <th>Pasajeros</th>
        </tr>
    </thead>

    <tbody>

        <?php foreach ($listaVehiculos as $vehiculo) { ?>

            <tr>
                <td><?= $vehiculo['modelo'] ?></td>
                <td><?= $vehiculo['color'] ?></td>
                <td><?= $vehiculo['tipo_vehiculo'] ?></td>
                <td><?= $vehiculo['marca'] ?></td>
                <td><?= $vehiculo['precio'] ?></td>
                <td><?= $vehiculo['cant_pasajeros'] ?></td>
                <td>
                    <img src="web/img/creta_gris.png" style="width:100%; height:110px;" alt="">
                </td>
                <td>

                    <a href="sistema.php?r=borrar_vehiculos&id=<?= $vehiculo['id'] ?>" class="btn btn-floating red  right align">
                        <i class="material-icons">delete</i>
                    </a>

                    <a href="sistema.php?r=editar_vehiculos&id=<?= $vehiculo['id'] ?>" class="btn btn-floating blue lighten-2  right align">
                        <i class="material-icons">edit</i>
                    </a>
                </td>
            </tr>

        <?php  } ?>

        <tr>

            <td colspan="8">
                <ul class="pagination center-align">
                    <li class="waves-effect">
                        <a href="sistema.php?r=listar_vehiculos&pagina=1">
                            <i class="material-icons">fast_rewind</i>
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="sistema.php?r=listar_vehiculos&pagina=<?= $paginaAnterior ?>">
                            <i class="material-icons">chevron_left</i>
                        </a>
                    </li>
                    <?php
                    for ($i = $pagina - 2; $i <= $pagina + 2; $i++) {
                        // Reviso si $i es menor a 1 o si $i es mayor a total de paginas
                        if ($i < 1 || $i > $totalPagina) {
                            //En caso que se cumpla una de las 2 condiciones lo que hacemos es
                            //omitir el resto del codigo con el comando continue.	
                            continue;
                        }
                        $color = "waves-effect";
                        if ($i == $pagina) {
                            $color = "active";
                        }

                    ?>
                        <li class="<?= $color ?>">
                            <a href="sistema.php?r=listar_vehiculos&pagina=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="waves-effect">
                        <a href="sistema.php?r=listar_vehiculos&pagina=<?= $paginaSiguente ?>">
                            <i class="material-icons">chevron_right</i>
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="sistema.php?r=listar_vehiculos&pagina=<?= $totalPagina ?>">
                            <i class="material-icons">fast_forward</i>
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
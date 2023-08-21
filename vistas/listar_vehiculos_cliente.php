<?php 

    require_once("modelos/alquileres.php");
    require_once("modelos/vehiculos.php");
    

    $objAlquiler = new alquileres();
    $objVehiculo = new vehiculos();

    $cantidad = isset($_GET['cantidad'])?$_GET['cantidad']:5;
    $pagina = isset($_GET['pagina'])?$_GET['pagina']:1;

    $totalRegistros = $objVehiculo->totalRegistros();

    // Pagina Anterior va a ser igua al maximo entre la pagina actual menos 1 y 1
    $paginaAnterior = max(($pagina - 1), 1);
    
    $totalPagina = ceil($totalRegistros/$cantidad);
    
    // Pagina siguente va a ser el menor numero entre la pagina actual + 1 y el total de maximo de paginas
    $paginaSiguente = min( ($pagina + 1) , $totalPagina);

    $arrayFiltros = array();
    $arrayFiltros['inicio'] = ($pagina - 1) * $cantidad;
    $arrayFiltros['cantidad'] = $cantidad;

    $listaAlquiler = $objAlquiler->listar($arrayFiltros);
    
?>
<h1>Nuestra Flota</h1>

<table class="striped">
    <thead>
        <tr>
            <th colspan="8">
                <a href="sistema_cliente.php" class="btn red right">
                    <i class="material-icons">cancel</i> Volver
                </a>            
            </th>
            <th colspan="8">
				<a href="sistema_cliente.php?r=ingresar_alquiler" class="btn blue lighten-2 right">
					<i class="material-icons">add</i> Nuevo
				</a>
                <a href="sistema_cliente.php?r=mail" class="btn tooltipped" data-position="bottom" data-tooltip="Reseteo de contraseña">Mail</a>
				</a>
			</th>
            
        </tr>
        <tr>                            
            <th>Modelo</th>             
            <th>Color</th>      
            <th>Marca</th>
            <th>Precio</th>
            <th>Cant_pasajeros</th>
            <th>Alquilado desde</th>
            <th>Alquilado hasta</th>
            <th style="width:150px"></th>
        </tr>
    </thead>

    <tbody>

<?php  foreach($listaAlquiler as $alquiler){ ?>

        <tr>            
            <td ><?=$alquiler['modelo']?></td>
            <td ><?=$alquiler['color']?></td>           
            <td ><?=$alquiler['marca']?></td>
            <td ><?=$alquiler['precio']?></td>
            <td ><?=$alquiler['cant_pasajeros']?></td>
            <td ><?=$alquiler['fecha_desde']?></td>
            <td ><?=$alquiler['fecha_hasta']?></td>
            <td >
                <img src="web/archivos/<?=$alquiler['imagen']?>" width="100px"/>
            </td>
            <td>
                <a href="sistema_cliente.php?r=ingresar_alquiler&id=<?=$alquiler['id']?>" class="btn btn-floating Green">
                    <i class="material-icons">add</i>
                </a>
                <a href="sistema_cliente.php?r=editar_alquiler&id=<?=$alquiler['id']?>" class="btn btn-floating blue lighten-2">
                    <i class="material-icons">edit</i>
                </a>
                <a href="sistema_cliente.php?r=borrar_alquiler&id=<?=$alquiler['id']?>" class="btn btn-floating red">
                    <i class="material-icons">delete</i>
                </a>
            </td>
        </tr>

<?php  } ?>
<tr>
            <td class="blue lighten-2" colspan="11">
                <ul class="pagination center-align">
                    <li class="waves-effect">
                        <a href="sistema_cliente.php?r=listar_vehiculos_cliente&pagina=1">
                            <i class="material-icons">fast_rewind</i>
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="sistema_cliente.php?r=listar_vehiculos_cliente&pagina=<?=$paginaAnterior?>">
                            <i class="material-icons">chevron_left</i>
                        </a>
                    </li>                   
<?php
                    for($i = ($pagina-2); $i <= ($pagina+2); $i++ ){

                        /*
                            Reviso si $i es menos < 1 o $i es mayor al total de pagina
                        */
                        if($i < 1 || $i > $totalPagina){
                            /*
                                En caso que se cumpla una de las 2 condicion lo que hacemos es 
                                omitir el resto del codigo con el comando continue,
                            */
                            continue;
                        }
                        $color = "waves-effect";
                        if($i == $pagina){
                            $color = "active";
                        }
?>
                    <li class="<?=$color?>">
                        <a href="sistema_cliente.php?r=listar_vehiculos_cliente&pagina=<?=$i?>"><?=$i?></a>
                    </li>
<?php
                    }
?>
                    
                    <li class="waves-effect">
                        <a href="sistema_cliente.php?r=listar_vehiculos_cliente&pagina=<?=$paginaSiguente?>">
                            <i class="material-icons">chevron_right</i>
                        </a>
                    </li>
                    <li class="waves-effect">
                        <a href="sistema_cliente.php?r=listar_vehiculos_cliente&pagina=<?=$totalPagina?>">
                            <i class="material-icons">fast_forward</i>
                        </a>
                    </li>
                </ul>
            </td>   
        </tr>

    </tbody>
</table>
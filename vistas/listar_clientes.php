<?php

require_once("modelos/clientes.php");

$objCliente = new clientes();

$cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : 3;
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

$totalRegistros = $objCliente->totalRegistros();

// Pagina Anterior va a ser igua al maximo entre la pagina actual menos 1 y 1
$paginaAnterior = max(($pagina - 1), 1);

$totalPagina = ceil($totalRegistros / $cantidad);

// Pagina siguente va a ser el menor numero entre la pagina actual + 1 y el total de maximo de paginas
$paginaSiguente = min( ($pagina + 1) , $totalPagina);

$arrayFiltros = array();
$arrayFiltros['inicio'] = ($pagina - 1) * $cantidad;
$arrayFiltros['cantidad'] = $cantidad;

$listaClientes = $objCliente->listar($arrayFiltros);

?>
<h1>Listado de clientes</h1>

<table class="responsive-table">
	<thead>
		<br><br>		
		<tr>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Direccion</th>
			<th>Telefono</th>
			<th>Email</th>
			<th>Tipo documento</th>
			<th>Documento</th>		
			<th>Estado</th>	
			<th style="width: 150px;"></th>
		</tr>
	</thead>

	<tbody>

		<?php foreach ($listaClientes as $cliente) { ?>

			<tr>
				<td><?= $cliente['nombre'] ?></td>
				<td><?= $cliente['apellido'] ?></td>
				<td><?= $cliente['direccion'] ?></td>
				<td><?= $cliente['telefono'] ?></td>
				<td><?= $cliente['email'] ?></td>
				<td style="max-width:150px"><?= $cliente['tipo_documento'] ?></td>
				<td><?= $cliente['num_documento'] ?></td>
				<td><?= $cliente['estado'] ?></td>
				<td>
					<a href="sistema.php?r=editar_cliente&id=<?= $cliente['id'] ?>" title="Editar" class="btn btn-floating blue lighten-2">
						<i class="material-icons">edit</i>
					</a>
					<a href="sistema.php?r=borrar_cliente&id=<?= $cliente['id'] ?>" title="Borrar" class="btn btn-floating red">
						<i class="material-icons">delete</i>
					</a>
				</td>
			</tr>

		<?php  } ?>

		<tr>
			<td colspan="8">
				<ul class="pagination center-align">
					<li class="waves-effect">
                        <a href="sistema.php?r=listar_clientes&pagina=1">
                            <i class="material-icons" title="Pagina inicial">fast_rewind</i>
                        </a>
                    </li>
					<li class="waves-effect">
						<a href="sistema.php?r=listar_clientes&pagina=<?= $paginaAnterior ?>">
							<i class="material-icons"  title="Pagina anterior">chevron_left</i>
						</a>
					</li>
<?php
					for($i = $pagina - 2; $i <=$pagina + 2; $i++){
						// Reviso si $i es menor a 1 o si $i es mayor a total de paginas
						if($i < 1 || $i > $totalPagina){
						//En caso que se cumpla una de las 2 condiciones lo que hacemos es
						//omitir el resto del codigo con el comando continue.	
							continue;
						}
						$color = "waves-effect";
						if($i == $pagina){
							$color = "active";
						}

?>
					<li class="<?=$color?>">
						<a href="sistema.php?r=listar_clientes&pagina=<?=$i?>"><?=$i?></a>
					</li>
<?php						
					}
?>										
					<li class="waves-effect">
						<a href="sistema.php?r=listar_clientes&pagina=<?= $paginaSiguente ?>">
							<i class="material-icons" title="Pagina siguiente">chevron_right</i>
						</a>
					</li>
					<li class="waves-effect">
						<a href="sistema.php?r=listar_clientes&pagina=<?= $totalPagina?>">
							<i class="material-icons" title="Ultima pagina">fast_forward</i>
						</a>
					</li>
				</ul>
			</td>
		</tr>

	</tbody>
</table>
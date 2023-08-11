<?php

	session_start();

	$sessionActiva = isset($_SESSION['usuario'])?true:false;

	if(!$sessionActiva){
		header('Location:login_cliente.php');
		header('Location:registro_cliente.php');
		//header('Location:cambioClave_cliente.php');
	}

	include("vistas/layout_cliente.php");
	
	
	
	

?>
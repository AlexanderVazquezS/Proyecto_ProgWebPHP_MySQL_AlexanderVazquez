<?php

$archivo = isset($_SERVER['argv'][0])?$_SERVER['argv'][0]:"";
$controlador = isset($_SERVER['argv'][1])?$_SERVER['argv'][1]:"";

// Se valida que el archivo que se ejecuta se 1 solo
if($archivo == "comandos.php"  || $archivo == ".\comandos.php"){

    print_r("\n\n Se esta ejecutando correcatamente \n\n");

		/*
			Cargo el array con los parametros de entrada
			y busco que controlador pertece a ese parametro
		*/
    $arrayComando = [];
    $arrayComando['pruebaGenerica'] = "controladorGenerico";
    $arrayComando['instalacion'] = "instalacionBd";

    if(isset($arrayComando[$controlador])){
        /*
            Busco el controlador con el valor del array que lo traigo con el parametro de 
            entrada y ejecuto los metodos basicos 
            __constructor()
            procesar()
            resultado()
		*/

        require_once("comandos/controladores/".$arrayComando[$controlador].".php");
        $objComando = new $arrayComando[$controlador]();
		$objComando->procesar();
		$objComando->resultados();

    }else{
        print_r("\n\n Error en el comando \n\n");

    }

  

}else{
    print_r("\n\n No se esta ejecutando correcatamente \n\n");
}


?>
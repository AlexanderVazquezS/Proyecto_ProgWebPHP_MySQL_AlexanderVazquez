<?php

	class generico {

		// Es el identificador del registro y es autonumerico
		public $id;
				
		protected function traerRegistros($sql, $arrayDatos = array()){

			try{
				if(file_exists("configuracion/db.php")){
					include("configuracion/db.php");
				}
				$host = isset($BASEDATOS['host'])?$BASEDATOS['host']:"localhost";
				$puerto = isset($BASEDATOS['puerto'])?$BASEDATOS['puerto']:"3306";
				$usuario = isset($BASEDATOS['usuario'])?$BASEDATOS['usuario']:"root";
				$clave = isset($BASEDATOS['clave'])?$BASEDATOS['clave']:"";
				$db = isset($BASEDATOS['db'])?$BASEDATOS['db']:"proyecto";
				$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$mysqlPrepare = $conexion->prepare($sql);		
				$mysqlPrepare->execute($arrayDatos);	
				$lista = $mysqlPrepare->fetchAll(PDO::FETCH_ASSOC);		

			}catch(Exception $error){

				print_r($error->getMessage());
				$lista = false;

			}

			return $lista;


		}

		public function ejecutar($sql, $arraySQL = array()){

			try{

				if(file_exists("configuracion/db.php")){
					include("configuracion/db.php");
				}
				$host = isset($BASEDATOS['host'])?$BASEDATOS['host']:"localhost";
				$puerto = isset($BASEDATOS['puerto'])?$BASEDATOS['puerto']:"3306";
				$usuario = isset($BASEDATOS['usuario'])?$BASEDATOS['usuario']:"root";
				$clave = isset($BASEDATOS['clave'])?$BASEDATOS['clave']:"";
				$db = isset($BASEDATOS['db'])?$BASEDATOS['db']:"proyecto";
				$conexion = new PDO("mysql:host=".$host.":".$puerto.";dbname=".$db."",$usuario,$clave);
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
				$stm = $conexion->prepare($sql);
				$respuesta = $stm->execute($arraySQL);

			}catch(Exception $error){

				print_r($error->getMessage());
				$respuesta = false;

			}
			return $respuesta;

		}

		public function constructor($arrayDatos = array()){

		}
	
		public function cargar($id){

		}

		public function listar($filtro = array()){

		}

		public function subirImagen($archivo, $alto, $ancho){

			// Valido si existe el archivo temporal 
			// Y valido si la ruta del archivo es vacia
			if(!isset($archivo['tmp_name']) || $archivo['tmp_name'] == ""){
				// En caso que no exista o sea vacio el archivo temporal retorno un false
				
				return false;
			}

			// Ruta temporal de la subida por php
			$rutaTMP = $archivo['tmp_name'];
			// Generamos un unico nombre al archivo
			$nombre = uniqid();
			// Tipo de archivo que subimos 
			$tipoArchivo = $archivo['type'];
			switch($tipoArchivo){
				case "image/jpeg":
				case "image/JPEG":
				case "image/jpg":
				case "image/JPG":
					$tipo = "jpg";
					break;
				case "image/png":
				case "image/PNG":
					$tipo = "png";
					break;
				default:
					
					return false;
					break;
			}

			// Ruta temporal propia
			$rutaServidorTMP = "tmp/".$nombre.".".$tipo;
			// Ruta fila del archivo 
			$rutaServidorFinal = "web/archivos/".$nombre.".".$tipo;

			$respuesta = copy($rutaTMP, $rutaServidorTMP);
			// Valido si puedo copiar el archivo a mi ruta temporal del proyecto
			if(!$respuesta){
				// En caso de dar error en copiar devuelvo un false 
				
				return false;
			}

			if($tipo == "jpg"){
				$imagen_temporal = imagecreatefromjpeg($rutaServidorTMP);	
			}else{
				$imagen_temporal = imagecreatefrompng($rutaServidorTMP);	
			}

			// obtengo el ancho original
			$ancho_original = imagesx($imagen_temporal);
			// obtengo el alto original 
			$alto_original = imagesy($imagen_temporal);
			// Creo mi imagen con el ancho y el alto que quiero
			$imagen_redimencionada = imagecreatetruecolor($ancho, $alto);
			//Pego la imagen original en la imagen nueva
			imagecopyresampled($imagen_redimencionada, $imagen_temporal, 0,0,0,0,$ancho, $alto, $ancho_original, $alto_original);

			// IDespues de genera la nueva imagen la guardo en el directorio final
			if($tipo == "jpg"){
				imagejpeg($imagen_redimencionada, $rutaServidorFinal);
			}else{
				imagepng($imagen_redimencionada, $rutaServidorFinal);
			}

			// Destruir en memoria las variables de las imagenes
			imagedestroy($imagen_temporal);	
			imagedestroy($imagen_redimencionada);	
			// Elimino mi imagen temporal
			unlink($rutaServidorTMP);

			return $nombre.".".$tipo;  

		}



	}






?>
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

		protected function ejecutar($sql, $arraySQL = array()){

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

		public function constructor($arrayDatos = array()){}
	
		public function cargar($id){}

		public function listar($filtro = array()){}


	}






?>
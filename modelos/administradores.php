<?php

	require_once("modelos/generico.php");

	class administradores extends generico{

		public $nombre;

		public $mail;

		protected $clave;

		public $estado;

		public function construnctor($arrayDatos){

			$this->nombre = $arrayDatos['nombre'];
			$this->mail = $arrayDatos['mail'];
			$this->clave = $arrayDatos['clave'];
			$this->estado = $arrayDatos['estado'];
			

		}

		public function login($usuario, $clave){

			$sql = "SELECT * FROM administradores 
						WHERE (nombre = :nombre OR email = :mail)
							AND clave = :clave AND estado = 1";
			$arraySQL = array("nombre" => $usuario, "mail" => $usuario, "clave"=>md5($clave));

			$registro = $this->traerRegistros($sql, $arraySQL);

			if(isset($registro[0]['id'])){

				$this->id = $registro[0]['id'];
				$this->nombre= $registro[0]['nombre'];
				$this->mail = $registro[0]['email'];
				$this->estado = $registro[0]['estado'];
				$retorno = true;

			}else{
				$retorno = false;
			}

			return $retorno;

		}

		public function cargar($id){

			$sql = "SELECT * FROM administradores WHERE id = :id ";
			$arraySQL = array("id" => $id);
		
			$lista = $this->traerRegistros($sql, $arraySQL);
	
			if(isset($lista[0]['id'])){
	
				$this->nombre 	= $lista[0]['nombre'];
				$this->mail 	= $lista[0]['email'];
				$this->id 		= $lista[0]['id'];		
				$this->estado   = $lista[0]['estado'];
				
				$retorno = true;

			}else{
	
				$retorno = false;
	
			}
	
			return $retorno;
	
		}

		public function editar(){
			/*
				En este metodo se encarga de editar los registros
			*/
			$sql = "UPDATE administradores SET
							nombre   = :nombre,
							email	 = :mail,
							estado   = :estado
					  WHERE id       = :id;
					";	
			$arrayDatos = array(
				"id" 		=> $this->id,
				"nombre"    => $this->nombre,
				"mail"      => $this->mail,
				"estado"    => $this->estado

			);
	
			$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
	
		}
		public function cambiarClave($clave, $nuevaClave, $conClave){

			// Confirmamos si las claves son iguales
			if (!($nuevaClave === $conClave)) {
				$retorno = "La clave nueva y la confirmacion no coinciden";
				return $retorno;
			}
			//Confirmamos si la clave del usuario es correcta
			$sql = "SELECT * FROM administradores 
							WHERE id = ". $this->id ." AND clave = :clave";
			$arraySQL = array("clave" => md5 ($clave));
			$registro = $this->traerRegistros($sql, $arraySQL);
			//Entramos en el if si no existe el registro.
			if (!isset($registro[0]['id'])) {
				$retorno = "La clave no es la correcta";
				return $retorno;
				
			}
			//Si los chequeos de contraseñas estan bien procedo.			
			$sql = "UPDATE administradores SET
						   clave = :clave
						WHERE id = :id;
						";
			$arrayDatos = array(
				"id" 	  => $this->id,
				"clave"   => md5($nuevaClave)
			
			);

			$respuesta = $this->ejecutar($sql, $arrayDatos);
			return $respuesta;

			}



		}








?>
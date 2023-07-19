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



	}








?>
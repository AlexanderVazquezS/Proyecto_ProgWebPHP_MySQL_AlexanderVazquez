<?php
	require_once("modelos/generico.php");

	class clientes extends generico{

		public $apellido;

		public $nombre;

		protected $direccion;

		public $telefono;

		public $email;

        public $clave;

		protected $tipo_documento;

		public $num_documento;

		public $estado;

		public function construnctor($arrayDatos){

			$this->apellido 		= $arrayDatos['apellido'];
			$this->nombre			= $arrayDatos['nombre'];
			$this->direccion 		= $arrayDatos['direccion'];
			$this->telefono         = $arrayDatos['telefono'];
			$this->email			= $arrayDatos['mail'];
			$this->clave 		    = $arrayDatos['clave'];
			$this->tipo_documento   = $arrayDatos['tipoDocumento'];
            $this->num_documento	= $arrayDatos['numDocumento'];
			$this->estado		    = $arrayDatos['estado'];

		}
		public function login($usuario, $clave){

			$sql = "SELECT * FROM usuarios 
						WHERE (nombre = :nombre OR email = :mail)
							AND clave = :clave AND estado = 1";
			$arraySQL = array("nombre" => $usuario, "mail" => $usuario, "clave"=>md5($clave));

			$registro = $this->traerRegistros($sql, $arraySQL);

			if(isset($registro[0]['id'])){

				$this->id = $registro[0]['id'];
				$this->apellido= $registro[0]['apellido'];
				$this->nombre = $registro[0]['nombre'];
				$this->direccion = $registro[0]['direccion'];
				$this->telefono= $registro[0]['nombre'];
				$this->email = $registro[0]['mail'];
				$this->clave = $registro[0]['clave'];
				$this->tipo_documento = $registro[0]['tipoDocumento'];
				$this->num_documento = $registro[0]['numDocumento'];
				$this->estado = $registro[0]['estado'];
				$retorno = true;

			}else{
				$retorno = false;
			}

			return $retorno;

		}

	}


?>
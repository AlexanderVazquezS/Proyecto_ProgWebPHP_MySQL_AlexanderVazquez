<?php

	require_once("modelos/generico.php");

	class administradores extends generico{

		public $nombre;

		public $mail;

		protected $clave;

		public $estado;

		public $tipo_usuario;

		public function constructor($arrayDatos = array()){

			$this->nombre 		= $arrayDatos['nombre'];
			$this->mail			= $arrayDatos['mail'];
			$this->clave 		= $arrayDatos['clave'];
			$this->tipo_usuario = $arrayDatos['tipo_usuario'];
			

		}

		public function login($usuario, $clave){

			$sql = "SELECT * FROM administradores 
						WHERE (nombre = :nombre OR email = :mail)
							AND clave = :clave AND estado = 1";
			$arraySQL = array("nombre" => $usuario, "mail" => $usuario, "clave"=>md5($clave));

			$registro = $this->traerRegistros($sql, $arraySQL);

			if(isset($registro[0]['id'])){

				$this->id 			= $registro[0]['id'];
				$this->nombre		= $registro[0]['nombre'];
				$this->mail 		= $registro[0]['email'];
				$this->estado		= $registro[0]['estado'];
				$this->tipo_usuario = $registro[0]['tipo_usuario'];
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
	
				$this->nombre 		  = $lista[0]['nombre'];
				$this->mail 		  = $lista[0]['email'];
				$this->id 			  = $lista[0]['id'];		
				$this->estado  		  = $lista[0]['estado'];
								
				$retorno = true;

			}else{
	
				$retorno = false;
	
			}
	
			return $retorno;
	
		}

		public function ingresar(){
			/*
				En este metodo se encarga de ingresar los regisros
			*/
				$sql = "INSERT administradores SET
						nombre = :nombre,
						tipo_usuario = :tipo_usuario,
						email = :mail,
						clave = :clave,
						estado = 1;
						
				";
	
				$arrayDatos = array(
					"nombre"	  => $this->nombre,
					"tipo_usuario" => $this->tipo_usuario,
					"mail" 		  => $this->mail,
					"clave"		  => md5($this->clave)
				);
	
				$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
		}

		public function editar(){
			/*
				En este metodo se encarga de editar los registros
			*/
			$sql = "UPDATE administradores SET
							nombre 		 = :nombre,
							email		 = :mail,
							estado  	 = :estado,
							tipo_usuario = :tipo_usuario
					  WHERE id    		 = :id;
					";	
			$arrayDatos = array(
				"id" 		  => $this->id,
				"nombre"  	  => $this->nombre,
				"mail"  	  => $this->mail,
				"estado"   	  => $this->estado,
				"tipo_usuario" => $this->tipo_usuario

			);
	
			$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
	
		}
		public function borrar() {
			
				//En este metodo se encarga de borrar los registros
			
				//la conexion a la base la hago desde el metodo protected ejecutar
				$sql = "UPDATE administradores SET
						estado = 0
						WHERE id = :id;
					";
	
				$arrayDatos = array(
					"id" => $this->id,
				);
	
				$respuesta = $this->ejecutar($sql, $arrayDatos);
			
			return $respuesta;
		}
		public function listar($filtro = array())	{
			/*
				Este metodo se encarga de retornar una lista de registro de la base de datos
			*/
			$sql = "SELECT * FROM administradores
						WHERE estado = 1
						OR 	  estado = 2 
						ORDER BY id
						LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
	
			$lista = $this->traerRegistros($sql);
	
			return $lista;
		}
	
		public function totalRegistros(){
			
			$sql = "SELECT count(*) as total 
					FROM administradores  
					WHERE estado = 1 
					OR estado = 2";
	
			$lista = $this->traerRegistros($sql);
	
			if (isset($lista[0]['total'])) {
				$retorno = $lista[0]['total'];
			} else {
				$retorno = 0;
			}
	
			return $retorno;
		}
		
		public function cambiarClave($clave, $nuevaClave, $conClave){

			$resultado = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $nuevaClave);

			if($resultado == 0){
				$retorno = "La clave no tiene el valor esperado <br>
							La clave tiene que tener un minimo de 8 caracteres.
							Dentro de los 8 tiene que tener mayusculas, minusculas, numeros 
							y alguno de los siguentes caracteres especiales @$!%*#?&
							";
				return $retorno;
			}

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
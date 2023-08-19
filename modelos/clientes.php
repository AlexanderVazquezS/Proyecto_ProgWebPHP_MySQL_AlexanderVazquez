<?php
	require_once("modelos/generico.php");

	class clientes extends generico{

		public $apellido;

		public $nombre;

		public $direccion;

		public $telefono;

		public $email;

        public $clave;

		public $tipo_documento;

		public $num_documento;

		public $estado;

	

		public function constructor($arrayDatos = array()){

			$this->apellido 		= $arrayDatos['apellido'];
			$this->nombre			= $arrayDatos['nombre'];
			$this->direccion 		= $arrayDatos['direccion'];
			$this->telefono         = $arrayDatos['telefono'];
			$this->email			= $arrayDatos['email'];
			$this->clave 		    = $arrayDatos['clave'];
			$this->tipo_documento   = $arrayDatos['tipo_documento'];
            $this->num_documento	= $arrayDatos['num_documento'];
			

		}
		public function login($usuario, $clave){

			$sql = "SELECT * FROM usuarios 
						WHERE (nombre = :nombre OR email = :email)
							AND clave = :clave AND estado = 1";
			$arraySQL = array("nombre" => $usuario, "email" => $usuario, "clave"=>md5($clave));

			$registro = $this->traerRegistros($sql, $arraySQL);

			if(isset($registro[0]['id'])){

				$this->id 		 	  = $registro[0]['id'];
				$this->apellido  	  = $registro[0]['apellido'];
				$this->nombre    	  = $registro[0]['nombre'];
				$this->direccion 	  = $registro[0]['direccion'];
				$this->telefono  	  = $registro[0]['nombre'];
				$this->email     	  = $registro[0]['email'];
				$this->clave 		  = $registro[0]['clave'];
				$this->tipo_documento = $registro[0]['tipo_documento'];
				$this->num_documento  = $registro[0]['num_documento'];
				$this->estado 		  = $registro[0]['estado'];
				$retorno = true;

			}else{
				$retorno = false;
			}

			return $retorno;

		}
		public function cargar($id){

			$sql = "SELECT * FROM usuarios WHERE id = :id ";
			$arraySQL = array("id" => $id);
		
			$lista = $this->traerRegistros($sql, $arraySQL);
	
			if(isset($lista[0]['id'])){
	
				$this->nombre 		  = $lista[0]['nombre'];
				$this->apellido 	  = $lista[0]['apellido'];
				$this->direccion 	  = $lista[0]['direccion'];
				$this->telefono 	  = $lista[0]['telefono'];
				$this->tipo_documento = $lista[0]['tipo_documento'];
				$this->num_documento  = $lista[0]['num_documento'];
				$this->email 		  = $lista[0]['email'];
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
				$sql = "INSERT usuarios SET
						nombre 		   = :nombre,
						apellido	   = :apellido,
						direccion 	   = :direccion,
						telefono	   = :telefono,
						email 		   = :email,		
						clave		   = :clave,	
						tipo_documento = :tipo_documento,	
						num_documento  = :num_documento,											
						estado 		   = 1;
						
				";
	
				$arrayDatos = array(
					"nombre"	     => $this->nombre,
					"apellido"       => $this->apellido,
					"direccion"      => $this->direccion,
					"telefono"   	 => $this->telefono,
					"email" 	     => $this->email,					
					"tipo_documento" => $this->tipo_documento,
					"num_documento"  => $this->num_documento,					
					"clave"		     => md5($this->clave)
				);
	
				$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
		
		}	
		public function borrar() {
			
			//En este metodo se encarga de borrar los registros
		
			//la conexion a la base la hago desde el metodo protected ejecutar
			$sql = "UPDATE usuarios SET
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
		$sql = "SELECT * FROM usuarios
					WHERE estado = 1
					OR 	  estado = 2 
					ORDER BY id
					LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";

		$lista = $this->traerRegistros($sql);

		return $lista;
	}
		public function editar(){
			/*
				En este metodo se encarga de editar los registros
			*/
			$sql = "UPDATE usuarios SET
							apellido		 = :apellido,
							nombre 			 = :nombre,
							telefono 		 = :telefono,
							direccion 		 = :direccion,		
							tipo_documento 	 = :tipo_documento,	
							num_documento 	 = :num_documento,												
							email		 	 = :email,
							estado  		 = :estado							
					  WHERE id    			 = :id;
					";	
			$arrayDatos = array(
				"id" 			  => $this->id,
				"apellido"   	  => $this->apellido,
				"nombre"  	 	  => $this->nombre,
				"direccion" 	  => $this->direccion,
				"telefono"  	  => $this->telefono,
				"tipo_documento"  => $this->tipo_documento,
				"num_documento"   => $this->num_documento,
				"email"  		  => $this->email,
				"estado"   		  => $this->estado
				
			);
	
			$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
	
		}
		public function listaCorta(){
			/*
				Este metodo se encarga de retornar una lista de registro de la base de datos
			*/
			$estado = "1";	
	
			$sql = "SELECT id, CONCAT(apellido, ' ', nombre) as nombreCompleto FROM usuarios
						WHERE estado = :estado 
					";
			
			$arraySQL = array("estado" => $estado);
			$lista = $this->traerRegistros($sql, $arraySQL);
			return $lista;
	
		}
		public function totalRegistros(){
			
			$sql = "SELECT count(*) as total 
					FROM usuarios  
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
		public function mailCliente(){
			/*
				Este metodo se encarga de retornar una lista de registro de la base de datos
			*/
			$estado = "1";	
			
			$sql = "SELECT id,email FROM usuarios
						WHERE estado = :estado 
					ORDER BY email";
			
			$arraySQL = array("estado" => $estado);
			$lista = $this->traerRegistros($sql, $arraySQL);
			return $lista;
	
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
			$sql = "SELECT * FROM usuarios 
							WHERE id = ". $this->id ." AND clave = :clave";
			$arraySQL = array("clave" => md5 ($clave));
			$registro = $this->traerRegistros($sql, $arraySQL);
			//Entramos en el if si no existe el registro.
			if (!isset($registro[0]['id'])) {
				$retorno = "La clave no es la correcta";
				return $retorno;
				
			}
			//Si los chequeos de contraseñas estan bien procedo.			
			$sql = "UPDATE usuarios SET
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
<?php

	require_once("modelos/generico.php");

	class vehiculos extends generico{

		public $modelo;

		public $color;

		public $tipo_vehiculo;

		public $marca;

		public $precio;

        public $cant_pasajeros;

		public $matricula;

		public $estado;

		public $imagen;

		public function constructor($arrayDatos = array()){
			
			$this->id			  = isset($arrayDatos['id'])?$arrayDatos['id']:"";
			$this->modelo		  = $arrayDatos['modelo'];
			$this->color 		  = $arrayDatos['color'];
			$this->tipo_vehiculo  = $arrayDatos['tipo_vehiculo'];
			$this->marca		  = $arrayDatos['marca'];
            $this->precio 		  = $arrayDatos['precio'];
            $this->cant_pasajeros = $arrayDatos['cant_pasajeros'];
            $this->matricula	  = $arrayDatos['matricula'];
			$this->imagen		  = $arrayDatos['imagen'];
			
		}

		public function cargar($id){

			$sql = "SELECT * FROM vehiculos WHERE id = :id ";
			$arraySQL = array("id" => $id);
		
			$lista = $this->traerRegistros($sql, $arraySQL);
	
			if(isset($lista[0]['id'])){
	
				$this->modelo 		  = $lista[0]['modelo'];
				$this->color 		  = $lista[0]['color'];
				$this->id 			  = $lista[0]['id'];		
				$this->tipo_vehiculo  = $lista[0]['tipo_vehiculo'];
               	$this->marca 		  = $lista[0]['marca'];
				$this->precio 		  = $lista[0]['precio'];
				$this->cant_pasajeros = $lista[0]['cant_pasajeros'];
				$this->matricula	  = $lista[0]['matricula'];
				$this->imagen	      = $lista[0]['imagen'];
				$this->estado         = $lista[0]['estado'];
							
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
				$sql = "INSERT vehiculos SET
						modelo		   = :modelo,
                        color 		   = :color,
						tipo_vehiculo  = :tipo_vehiculo,
						marca		   = :marca,
						precio		   = :precio,
                        cant_pasajeros = :cant_pasajeros,    
						matricula	   = :matricula,        
						imagen		   = :imagen,          
						estado		   = 1;
						
				";
	
				$arrayDatos = array(
					"modelo"	     => $this->modelo,
					"color"          => $this->color,
					"tipo_vehiculo"  => $this->tipo_vehiculo,
                    "marca"          => $this->marca,
					"precio"	     => $this->precio,
					"cant_pasajeros" => $this->cant_pasajeros,  
					"matricula"      => $this->matricula,
					"imagen"         => $this->imagen
										        
				);
	
				$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
		}

		public function editar(){
			/*
				En este metodo se encarga de editar los registros
			*/
			$sql = "UPDATE vehiculos SET
							modelo 			 = :modelo,
							color			 = :color,
							tipo_vehiculo	 = :tipo_vehiculo,
                            marca       	 = :marca,
                            precio      	 = :precio,
                            cant_pasajeros	 = :cant_pasajeros,    
							matricula		 = :matricula";																				                 
						
					if($this->imagen){
						$sql .= " ,imagen = '$this->imagen' ";
					}
					$sql .=	" WHERE id = :id; ";
					
			$arrayDatos = array(
				"id" 			 => $this->id,
				"modelo"   		 => $this->modelo,
				"color"   		 => $this->color,
				"tipo_vehiculo"  => $this->tipo_vehiculo,
				"marca"   		 => $this->marca,
				"precio" 		 => $this->precio,
                "cant_pasajeros" => $this->cant_pasajeros, 
				"matricula" 	 => $this->matricula   
									
							                 
			);
			$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
	
		}
		public function borrar() {
			
				//En este metodo se encarga de borrar los registros
			
				$sql = "UPDATE vehiculos SET
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
			$sql = "SELECT * FROM vehiculos
						WHERE estado = 1
						OR 	  estado = 2 
						ORDER BY id
						LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
	
			$lista = $this->traerRegistros($sql);
	
			return $lista;
		}
		public function listaCorta(){
			/*
				Este metodo se encarga de retornar una lista de registro de la base de datos
			*/
			$estado = "1";	
	
			$sql = "SELECT id, CONCAT(marca, ' ', modelo) as marcaModelo FROM vehiculos
						WHERE estado = :estado 
						ORDER BY marcaModelo";
			
			$arraySQL = array("estado" => $estado);
			$lista = $this->traerRegistros($sql, $arraySQL);
			return $lista;
	
		}
	
		public function totalRegistros(){
			
			$sql = "SELECT count(*) as total
                    FROM vehiculos  
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
	
        }
?>
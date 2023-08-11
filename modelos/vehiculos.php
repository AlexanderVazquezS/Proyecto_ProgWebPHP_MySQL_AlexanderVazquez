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

		public function constructor($arrayDatos = array()){

			$this->modelo = $arrayDatos['modelo'];
			$this->color = $arrayDatos['color'];
			$this->tipo_vehiculo = $arrayDatos['tipo_vehiculo'];
			$this->marca = $arrayDatos['marca'];
            $this->precio = $arrayDatos['precio'];
            $this->cant_pasajeros = $arrayDatos['cant_pasajeros'];
            $this->matricula = $arrayDatos['matricula'];
			
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
						estado		   = 1;
						
				";
	
				$arrayDatos = array(
					"modelo"	     => $this->modelo,
					"color"          => $this->color,
					"tipo_vehiculo"  => $this->tipo_vehiculo,
                    "marca"          => $this->marca,
					"precio"	     => $this->precio,
					"cant_pasajeros" => $this->cant_pasajeros,  
					"matricula"      => $this->matricula
										        
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
							matricula		 = :matricula,
							estado			 = :estado														                 
						WHERE id      		 = :id;
					";	
					
			$arrayDatos = array(
				"id" 			 => $this->id,
				"modelo"   		 => $this->modelo,
				"color"   		 => $this->color,
				"tipo_vehiculo"  => $this->tipo_vehiculo,
				"marca"   		 => $this->marca,
				"precio" 		 => $this->precio,
                "cant_pasajeros" => $this->cant_pasajeros, 
				"matricula" 	 => $this->matricula,   
				"estado"		 => $this->estado	
							                 
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
			 $sql = "SELECT 
						a.id,
						a.fecha_desde,
						a.fecha_hasta,
						u.id,
						CONCAT(u.apellido,' ',u.apellido) as Nombre_Completo,
						v.modelo,
						v.color,
						v.tipo_vehiculo,
						v.marca,
						v.precio,
						v.cant_pasajeros,
						v.imagen, 
						v.estado 
						FROM alquileres a
						INNER JOIN usuarios u on u.id = a.id 
						INNER JOIN vehiculos v on v.id = a.id 
						WHERE v.estado = 1 or v.estado = 2
						ORDER BY v.modelo 
						LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";

			/*$sql = "SELECT * FROM vehiculos
						WHERE estado = 1
						OR 	  estado = 2 
						ORDER BY id
						LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";*/
	
			$lista = $this->traerRegistros($sql);
	
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
<?php

	require_once("modelos/generico.php");

	class vehiculos extends generico{

		public $modelo;

		public $color;

		protected $tipo_vehiculo;

		public $marca;

		public $precio;

        public $cant_pasajeros;

        public $estado;
        
       
		public function construnctor($arrayDatos){

			$this->modelo 		         = $arrayDatos['modelo'];
			$this->color			     = $arrayDatos['color'];
			$this->tipo_vehiculo         = $arrayDatos['tipoVehiculo'];
			$this->marca                 = $arrayDatos['marca'];
            $this->precio 		         = $arrayDatos['precio'];
            $this->cant_pasajeros 	     = $arrayDatos['cantPasajeros'];
            $this->estado 		         = $arrayDatos['clave'];
          
           
			

		}

		public function cargar($id){

			$sql = "SELECT * FROM vehiculos WHERE id = :id ";
			$arraySQL = array("id" => $id);
		
			$lista = $this->traerRegistros($sql, $arraySQL);
	
			if(isset($lista[0]['id'])){
	
				$this->modelo 		  = $lista[0]['nombre'];
				$this->marca 		  = $lista[0]['marca'];
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
				$sql = "INSERT vehiculos SET
						modelo = :modelo,
                        color  = :color,
						tipo_vehiculo = :tipoVehiculo,
						marca = :marca,
						precio = :precio,
                        cant_pasajeros = cantPasajeros,                       
						estado = 1;
						
				";
	
				$arrayDatos = array(
					"modelo" => $this->modelo,
					"color" => $this->color,
					"tipoVehiculo" => $this->tipo_vehiculo,
                    "marca" => $this->marca,
					"precio" => $this->precio,
					"cantpasajeros" => $this->cant_pasajeros,                    
                    "esado"=> $this->estado,
					
				);
	
				$respuesta = $this->ejecutar($sql, $arrayDatos);
	
			return $respuesta;
		}

		public function editar(){
			/*
				En este metodo se encarga de editar los registros
			*/
			$sql = "UPDATE vehiculos SET
							modelo 		 = :nombre,
							color		 = :mail,
							tipo_vehiculo = :tipoVehiculo,
                            marca        = :marca,
                            precio       = :precio,
                            cant_pasajeros= :cantPasajeros,                           
							estado = :estado
					  WHERE id       = :id;
					";	
			$arrayDatos = array(
				"id" 		=> $this->id,
				"modelo"    => $this->modelo,
				"tipoVehiculo"      => $this->tipo_vehiculo,
				"marca"    => $this->marca,
				"precio" =>$this->precio,
                "cantPasajeros" => $this->cant_pasajeros,               
                "estado" => $this-> estado

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
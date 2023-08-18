<?php 
require_once("modelos/generico.php");

class alquileres extends generico{

    public $fecha_desde;
    
    public $fecha_hasta;

    public $id_usuario;

    public $id_vehiculo;
    
    public $estado;

    protected $tabla = "alquileres";

    public function constructor($arrayDatos = array()){

        $this->id          = isset($arrayDatos['id'])?$arrayDatos['id']:"";
        $this->fecha_desde = $arrayDatos['fecha_desde'];
        $this->fecha_hasta = $arrayDatos['fecha_hasta'];
        $this->id_usuario  = $arrayDatos['id_usuario'];
        $this->id_vehiculo = $arrayDatos['id_vehiculo'];   
       
    }
    public function cargar($id){

        $sql = "SELECT * FROM alquileres WHERE id = :id ";
        $arraySQL = array("id" => $id);
    
        $lista = $this->traerRegistros($sql, $arraySQL);

        if(isset($lista[0]['id'])){

            $this->id 	          = $lista[0]['id'];
            $this->fecha_desde 	  = $lista[0]['fecha_desde'];
            $this->fecha_hasta 	  = $lista[0]['fecha_hasta'];
            $this->id_usuario 	  = $lista[0]['id_usuario'];
            $this->id_vehiculo 	  = $lista[0]['id_vehiculo']; 
            $this->estado 	      = $lista[0]['estado'];        		
                            
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
            $sql = "INSERT alquileres SET
                    fecha_desde    = :fecha_desde,
                    fecha_hasta	   = :fecha_hasta,   
                    id_usuario     = :id_usuario,                 
                    id_vehiculo	   = :id_vehiculo,                                									
                    estado 		   = 2;

            ";
                        
            $arrayDatos = array(
                
                "fecha_desde"	     => $this->fecha_desde,
                "fecha_hasta"        => $this->fecha_hasta,
                "id_usuario"	     => $this->id_usuario,
                "id_vehiculo"        => $this->id_vehiculo                               
            );
            print_r($arrayDatos);
            $respuesta = $this->ejecutar($sql, $arrayDatos);

        return $respuesta;
    }
    public function borrar() {
			
        //En este metodo se encarga de borrar los registros
    
        //la conexion a la base la hago desde el metodo protected ejecutar
        $sql = "UPDATE alquileres SET
                estado = 0
                WHERE id = :id;
            ";

        $arrayDatos = array(
            "id" => $this->id,
        );
print_r($arrayDatos);
        $respuesta = $this->ejecutar($sql, $arrayDatos);
    
        return $respuesta;
    }    
    public function listar($filtro = array())  {
        /*
            Este metodo se encarga de retornar una lista de registro de la base de datos
        */
        $estado = isset($filtro['estado'])?$filtro['estado']:"1";   

        $sql = "SELECT 
                    v.color,
                    v.tipo_vehiculo,
                    v.marca,
                    v.precio,
                    v.cant_pasajeros,
                    v.imagen,
                    a.id,
                    a.fecha_desde,
                    a.fecha_hasta,                  
                    a.id_usuario,
                    a.id_vehiculo,
                    v.modelo                    
                    FROM alquileres a
                    RIGHT JOIN vehiculos v ON v.id = a.id 
                    WHERE v.estado = :estado 
                ORDER BY a.fecha_desde, a.fecha_hasta ";

        if(isset($filtro['inicio']) && isset($filtro['cantidad'])){
            $sql .= " LIMIT ".$filtro['inicio'].", ".$filtro['cantidad']."";
        }
        
        $arraySQL = array("estado" => $estado);

        $lista = $this->traerRegistros($sql, $arraySQL);

        return $lista;
    }
    public function editar(){
        /*
            En este metodo se encarga de editar los registros
        */
        $sql = "UPDATE alquileres SET
                        fecha_desde		 = :fecha_desde,
                        fecha_hasta 	 = :fecha_hasta,
                        id_usuario 		 = :id_usuario,
                        id_vehiculo 	 = :id_vehiculo                   							
                  WHERE id    			 = :id;
                ";	
        $arrayDatos = array(
            "id" 			  => $this->id,
            "fecha_desde"     => $this->fecha_desde,
            "fecha_hasta"  	  => $this->fecha_hasta,
            "id_usuario" 	  => $this->id_usuario,
            "id_vehiculo"  	  => $this->id_vehiculo  
                
        );
        print_r($arrayDatos);
        $respuesta = $this->ejecutar($sql, $arrayDatos);

        return $respuesta;

    }
    public function totalRegistros(){
			
        $sql = "SELECT count(*) as total 
                FROM  ".$this->tabla."
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
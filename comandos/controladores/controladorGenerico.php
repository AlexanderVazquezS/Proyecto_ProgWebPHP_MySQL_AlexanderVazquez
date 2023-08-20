<?php

class controladorGenerico{

    // Guardamos la hora que se inicio el proceso
    protected $horaInicio;

    // Guradamos la hora que se finalizo el proceso
    protected $horaFin;

    public function __constructor($arrayDatos = array()){


    }

    public function procesar(){
        $this->horaInicio = date("Y-m-d H:i:s");
        
        sleep(5);

        $this->horaFin = date("Y-m-d H:i:s");

    }

    public function resultados(){

        print_r("\nHora de inicio del proceso:" .$this->horaInicio);
        print_r("\nHora finalizacion del proceso:" .$this->horaFin);

    }



}



?>
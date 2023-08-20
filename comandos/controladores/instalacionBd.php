<?PHP	

	require_once("comandos/controladores/controladorGenerico.php");
	require_once("modelos/generico.php");


	class instalacionBd extends controladorGenerico{

		protected $llave = true; //false

		public function procesar (){

			$this->horaInicio = date("Y-m-d H:i:s");

			$arrayTabla = array();

			$arrayTabla [] = "
								SET FOREIGN_KEY_CHECKS = 0;
								DROP TABLE IF EXISTS administradores;
								DROP TABLE IF EXISTS usuarios;
								DROP TABLE IF EXISTS vehiculos;
								DROP TABLE IF EXISTS alquileres;								
								SET FOREIGN_KEY_CHECKS = 1;
							"; 

			$arrayTabla[] = "CREATE TABLE `usuarios` (
								`id` int NOT NULL AUTO_INCREMENT,
								`apellido` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
								`nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
								`direccion` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
								`telefono` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
								`email` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
								`clave` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
								`tipo_documento` enum('ci','doc_extranjero') COLLATE utf8mb4_general_ci DEFAULT NULL,
								`num_documento` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
								`estado` tinyint(1) DEFAULT NULL,
								PRIMARY KEY (`id`),
								UNIQUE KEY `unique_email` (`email`)
							)";

			$arrayTabla [] = "CREATE TABLE `vehiculos` (
								`id` int NOT NULL AUTO_INCREMENT,
								`modelo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
								`color` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
								`tipo_vehiculo` enum('citycar','sedan','deportivo','utilitarios','camioneta','omnibus') COLLATE utf8mb4_general_ci DEFAULT NULL,
								`marca` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
								`precio` int DEFAULT NULL,
								`cant_pasajeros` tinyint DEFAULT NULL,
								`matricula` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
								`estado` tinyint(1) DEFAULT NULL,
								PRIMARY KEY (`id`)
							)";

			$arrayTabla [] = "CREATE TABLE `alquileres` (
								`id` int NOT NULL AUTO_INCREMENT,
								`fecha_desde` date NOT NULL,
								`fecha_hasta` date NOT NULL,
								`id_usuario` int DEFAULT NULL,
								`id_vehiculo` int DEFAULT NULL,
								`estado` tinyint(1) DEFAULT NULL,
								PRIMARY KEY (`id`),
								KEY `id_usuario` (`id_usuario`),
								KEY `id_vehiculo` (`id_vehiculo`),
								CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
								CONSTRAINT `fk_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculos` (`id`)
							)";  

			$arrayTabla [] = "CREATE TABLE `administradores` (
								`id` int NOT NULL AUTO_INCREMENT,
								`nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
								`tipo_usuario` enum('administrador','encargado','vendedor') COLLATE utf8mb4_general_ci DEFAULT NULL,
								`email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
								`clave` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
								`estado` tinyint(1) DEFAULT NULL,
								PRIMARY KEY (`id`)
							)";  

			$arrayTabla [] = "INSERT INTO `administradores` VALUES (1,'admin','administrador','admin@empresa.com','ad81d4d847899c1bc614d64bf2478e8c',1),
								(2,'encargado','encargado','encargado@empresa.com','cf68c7f2105eb7fdba12e9322169f2b5',1),
								(3,'ventas','vendedor','ventas@empresa.com','d6a12d4350e1ae37f6627c27619568b1',1);
							";	
							
			$arrayTabla [] = "INSERT INTO `usuarios` VALUES (1,'Vazquez','Alexander','Atanasio Sierra 354','099887766','lalo@gmail.com.uy','21232f297a57a5a743894a0e4a801fc3','ci','12345678',1),
								(2,'Melo','Juan','18 de julio 354','099123456','toto@gmail.com.uy','21232f297a57a5a743894a0e4a801fc3','ci','31231238',1),
								(4,'Larregui','Ana','Ituzaingo 354','098123123','mila@gmail.com.uy','21232f297a57a5a743894a0e4a801fc3','ci','61231235',1),
								(5,'Mateu','Ana','chieza 897','099318465','mateu@gmail.com.uy','21232f297a57a5a743894a0e4a801fc3','ci','41256329',1),
								(6,'Larregui','Hector','18 de julio 354','097111222','hector@gmail.com.uy','21232f297a57a5a743894a0e4a801fc3','ci','29455644',1),
								(7,'Vaz','Ana','Leandro Gomez 100','096258741','ana@gmail.com.uy','21232f297a57a5a743894a0e4a801fc3','ci','35214587',1);
							";	
			
			$arrayTabla [] = "INSERT INTO `vehiculos` VALUES (1,'Creta','Gris','camioneta','HYUNDAI',5390,5,'RBA123',1),
								(2,'Pulse','Azul','citycar','FIAT',4500,5,'RBA456',1),
								(3,'UP','Blanco','citycar','VOLSWAGEN',3850,4,'RBA789',1),
								(4,'Hb20S','Rojo','sedan','HYUNDAI',5000,5,'RTY123',1),
								(5,'Gol','Verde','deportivo','VOLSWAGEN',3800,5,'RUT857',1),
								(6,'Versa','Rojo','sedan','NISSAN',4000,5,'RUT856',1),
								(7,'Fiorino','Blanco','utilitarios','FIAT',3500,2,'REA222',1),
								(8,'Oroch','Naranja','camioneta','RENAULT',4800,5,'SRA564',1),
								(9,'Tahoe','Gris','camioneta','CHEVROLET',6200,5,'RBA547',1),
								(10,'Wrangler','Blanco','citycar','JEEP',6200,5,'RAA546',1),
								(11,'Camry','Negro','sedan','Toyota',5200,5,'RAA5698',1),
								(12,'Express','Blanco','utilitarios','CHEVROLET',7800,15,'AAA569',1),
								(13,'Edge','Negro','camioneta','Ford',6100,5,'DDG693',1);
							";

			$arrayTabla [] = "INSERT INTO `alquileres` VALUES (7,'2023-06-30','2023-07-05',1,1,1),
								(8,'2023-06-24','2023-07-05',2,2,1),
								(9,'2023-07-01','2023-07-10',4,3,1),
								(10,'2023-07-10','2023-07-15',5,4,1),
								(11,'2023-07-15','2023-07-25',6,5,1),
								(12,'2023-07-08','2023-07-16',7,6,1);
							";				

			$objGenerico = new generico();
			foreach($arrayTabla as $tabla){

				if($this->llave === true){
					$respuesta = $objGenerico->ejecutar($tabla);
					var_dump($respuesta);
				}else{
					print_r("\n La llave esta en false \n");
				}				

			sleep("2");

			}	
			$this->horaFin = date("Y-m-d H:i:s");		
		}



    }

?>
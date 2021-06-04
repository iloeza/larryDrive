<?php
require_once 'Controladores/controlador.php';
require_once 'Modelos/Archivo.php';

class ArchivoController {

	private $archivo;

	public function __CONSTRUCT(){
		$this->archivo = new Archivo();
	}

	public function SubirArchivo(){
		
		$user_dir = "Storage/{$_SESSION['username']}/";
		$file_name = preg_replace("/\s/", "_", $_FILES["file"]["name"]);
  		$file_size=$_FILES["file"]["size"]/1024;
  		$file_type=$_FILES["file"]["type"];
 		$file_tmpName=$_FILES["file"]["tmp_name"];  

		if(! isset($_POST["SubmitBtn"])){
			throw new Exception("Error en el formulario");
		}

		if (! file_exists($user_dir)) {
   	 		if(! mkdir($user_dir, 0777)){
				throw new Exception("Error creado el directorio del usuario");
			}
		}

      	if(! move_uploaded_file($file_tmpName,$user_dir.$file_name)){
			throw new Exception("Error al subir el archivo");
    	}

		try {
			$this->archivo->crear_log($file_name, $_SESSION['username']);
		} catch(Exception $e){
			echo $e->getMessage();
		}
  	}		
 
}


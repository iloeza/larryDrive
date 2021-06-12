<?php
require_once 'Controladores/controlador.php';
require_once 'Modelos/Archivo.php';

class ArchivoController {

	private $archivo;
	private $current_dir;

	public function __CONSTRUCT(){
		$this->archivo = new Archivo();
		$rutas = implode("/", $_SESSION['ruta']);
 		$this->current_dir = $rutas == "" ? "Storage/{$_SESSION['username']}$rutas" : "Storage/{$_SESSION['username']}/$rutas";

		 if (! is_dir("Storage/{$_SESSION['username']}")){
			mkdir("Storage/{$_SESSION['username']}", 0777);
		 }
	}

	public function SubirArchivo(){
		
		$file_name = preg_replace("/\s/", "_", $_FILES["file"]["name"]);
  		$file_size=$_FILES["file"]["size"]/1024;
  		$file_type=$_FILES["file"]["type"];
 		$file_tmpName=$_FILES["file"]["tmp_name"];  
		 echo $this->current_dir;

		if (! file_exists($this->current_dir)) {
			exit;
   	 		if(! mkdir($this->current_dir, 0777)){
				throw new Exception("Error creado el directorio del usuario");
			}
		}

      	if(! move_uploaded_file($file_tmpName,$this->current_dir."/".$file_name)){
			throw new Exception("Error al subir el archivo");
    	}

		try {
			$this->archivo->crear_log($file_name, $_SESSION['username']);
		} catch(Exception $e){
			echo $e->getMessage();
		}
  	}		

	public function GetArchivos(){
		
		$arr = array (
			"files" => array(),
			"dirs" => array()
		);
		if (is_dir($this->current_dir)){
  			if ($dh = opendir($this->current_dir)){
    			while (($file = readdir($dh)) !== false){
					if ($file == '.' || $file == '..'){
						continue;
					}
					else if (is_dir($this->current_dir.'/'.$file)){
						$arr['dirs'][] = array(
							"NombreDir" => $file,
							"Ruta" => $this->current_dir.$file
						);
					} else {
						$arr['files'][] = array(
							"NombreArchivo" => $file,
							"Ruta" =>  $this->current_dir."/".$file
						);
					}
    			}
    			closedir($dh);
  			}		
		}
		return $arr;
	}

	public function crearDirectorio(){
		$dir_name = (isset($_POST['dirname']) && $_POST['dirname'] !== "") ? $_POST['dirname'] : "";
		if ($dir_name !== ""){
			$nuevo_dir = $this->current_dir."/".$dir_name;
			$nuevo_dir = preg_replace('/\s+/', '', $nuevo_dir);
			if(! mkdir($nuevo_dir, 0777)){
				throw new Exception("Error creado el directorio del usuario");
			}
		}
	}
	
	public function actualizarRuta(){
		$point = (isset($_POST['point']) && $_POST['point'] !== "") ? $_POST['point'] : "";
		if ($point == "-1"){ 
			$_SESSION['ruta'] = [];
		} else {
			$nueva_ruta = (isset($_POST['dir']) && $_POST['dir'] !== "") ? $_POST['dir'] : "";
			if ($nueva_ruta !== "" && ! in_array($nueva_ruta, $_SESSION['ruta']) && $nueva_ruta !== "Home"){
				array_push($_SESSION['ruta'], $nueva_ruta);
			}
			if ($point !== ""){
				$array = $_SESSION['ruta'];
				for (end($array); key($array) > $point; prev($array)){
					array_pop($_SESSION['ruta']); 
				}	
			}
		}
	}
}

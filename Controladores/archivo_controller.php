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
		
		$files = $this->GetArchivos();
		$result = "";
		foreach($files as $k => $v){
			$result .= "<a href='{$v['Ruta']}'>{$v['NombreArchivo']}</a><br>";
		}
		echo $result;
  	}		

	public function GetArchivos(){
		
		//$req = $_REQUEST['new_dir'];
		$base_dir = "Storage/{$_SESSION['username']}";
		$files = [];
		//if ($req !== $_SESSION['last_dir']){
		//	$_SESSION['last_dir'] = $req;
		//	$_SESSION['dir'] = "{$_SESSION['dir']}/$req";
		//}
		//$dir = $base_dir.$_SESSION['dir'];
		//echo nl2br ("{$_SESSION['dir']} \n $dir");
		//echo getcwd();
		//chdir("Storage/ivan");
		//chdir("..");
		//echo getcwd();
		if (is_dir($base_dir)){
  			if ($dh = opendir($base_dir)){
    			while (($file = readdir($dh)) !== false){
      				$files[] = array(
						"NombreArchivo" => $file,
						"Ruta" =>  $base_dir."/".$file
					);
    			}
    			closedir($dh);
  			}		
		}	
		return $files;
	}
}

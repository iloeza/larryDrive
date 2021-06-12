<?php
function descargarArchivo(){
    	
	$archivo = $_REQUEST['archivo'];
	if(file_exists($archivo)){

    	//$locacion_archivo = "$this->current_dir/$archivo";
    	$size = filesize($archivo);
    	header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($archivo).'"'); 
		header('Content-Transfer-Encoding: binary');
		header('Connection: Keep-Alive');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . $size);
		readfile($archivo);
		exit;
	}

}


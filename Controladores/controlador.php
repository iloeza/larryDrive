<?php

class Controlador {

	public function redirect($msg){
    	echo "<script>
        	alert('$msg')
        	window.location.replace('index.php');
    		</script>";	
	}

}


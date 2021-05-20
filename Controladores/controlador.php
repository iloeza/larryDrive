<?php

class Controlador {

	public function redirect($msg, $url = ''){
    	echo "<script>
        	alert('$msg')
        	window.location.replace('index.php$url');
    		</script>";	
	}

}


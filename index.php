<?php
require 'Modelos/db.php';  //LarryDrive#1
require 'Controladores/controlador.php';
require_once 'Vistas/partials/layout_head.php';
$controller_request = isset($_REQUEST['c']) ? $_REQUEST['c'] : 'login';


// Todo esta lógica hara el papel de un FrontController
if($controller_request !== 'login') {
    // Obtenemos el controlador que queremos cargar
    //$controller = strtolower($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index';
    // Llama la accion
	session_start();
	if((isset($_SESSION['id']) && $_SESSION['id'] != '') || $controller_request == 'signin' || $accion == 'login' || $accion == 'crear'){

		// Instanciamos el controlador
		require_once "Controladores/{$controller_request}_controller.php";
		$controller_name = ucwords($controller_request) . 'Controller';
		$controller = new $controller_name;

    	call_user_func( array( $controller, $accion ) );

	} else {
		Controlador::redirect("Necesitas loggearte para ver esta pagina");
	}

} else {
	require_once "Controladores/login_controller.php";
	$controller = new LoginController;
	$controller->Index();  
}
require_once 'Vistas/partials/layout_footer.html';

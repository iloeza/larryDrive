<?php
require __DIR__.'/Vistas/partials/layout_head.php';
//require __DIR__.'/Routes/routes.php';
//$router = new \Bramus\Router\Router();

//Rutas del sitio
//Middleware para veriricar si el usuario esta loggeado
//$router->before('GET|POST', '/.*', function() {
//    if (!isset($_SESSION['user'])) {
//		include(__DIR__.'/Vistas/welcome.php');
//   }
//});

//$router->get('/sign-in', function () {
//	include(__DIR__.'/Vistas/login.php');
//});

//$router->run();

if (! isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

} else {
	include(__DIR__.'/Vistas/welcome.php');
} 



require __DIR__.'/Vistas/partials/layout_footer.html';
?>



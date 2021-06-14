<?php
require_once 'Controladores/controlador.php';
require_once 'Modelos/Usuario.php';

class UsuarioController {

	private $usuario;

	public function __CONSTRUCT(){
		$this->usuario = new Usuario();
	}


	public function Crear(){
		$nuevo_usuario = new Usuario();

		$nuevo_usuario->username = $_POST['username'];
		$nuevo_usuario->password = $_POST['password'];

		try {
			if(! $this->usuario->Crear($nuevo_usuario)){
				Controlador::redirect("Ya existe un usuario con ese nombre, intenta con uno diferente", '?c=signin');		
			} else {
				Controlador::redirect("Usuario creado correctamente, prueba iniciando sesion");
			}
		} catch(Exception $e) {
			echo 'Error al crear usuario: ' . $e->getMessage();
		} 
	}

	public function login(){
		$get_usuario = new Usuario();

		$get_usuario->username = $_POST['username'];
		$get_usuario->password = $_POST['password'];

		try {
			$qry = $this->usuario->get_usuario($get_usuario);
			$info_usuario = $qry->fetch_assoc();
			if ($info_usuario['password'] === $get_usuario->password){
				$_SESSION['username'] = $info_usuario['username'];
				$_SESSION['mostrarAdmin'] = "";
				$_SESSION['isAdmin'] = $info_usuario['isAdmin'];
				if ($_SESSION['isAdmin'] == 1){
					$_SESSION['mostrarAdmin'] = false;
				}
				$_SESSION['id'] = $info_usuario['id'];
				$_SESSION['ruta'] = [];
				Controlador::redirect("Inicio de sesion correcto", "?c=usuario&a=home"); 
			} else {
				Controlador::redirect("Credenciales incorrectas, verifiquelas e intente nuevamente");
			}

		} catch (Exception $e){
			echo 'Error al obtener usuario: ' . $e->getMessage();
		}
	}

	public function logout(){
		session_destroy();
		Controlador::redirect("Sesion terminada");

	}

	public function home(){
		require_once 'Vistas/Usuario/home.php';
	}

	public function adminHome(){
		if (isset($_SESSION['mostrarAdmin'])){
			$_SESSION['mostrarAdmin'] = true;
		}
	}

	public function showArchivos(){
		if (isset($_SESSION['mostrarAdmin'])){
			$_SESSION['mostrarAdmin'] = false;
		}
	}

	public function getUsuarios(){

		try {
			$resultado = array();
			$qry = $this->usuario->get_usuarios();
			while ($row = $qry->fetch_assoc()){
				array_push($resultado, $row);
			}
			return $resultado;

		} catch (Exception $e){
			echo 'Error al obtener usuario: ' . $e->getMessage();
		}
	}

	public function cambiarRol(){
		$id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : "";
		$rol = (isset($_POST['rol']) && $_POST['rol'] != "") ? $_POST['rol'] : "";

		if ($id != "" && $rol != ""){
			$this->usuario->cambiar_rol($id, $rol);
		}
	}
}

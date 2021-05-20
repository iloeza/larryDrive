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
				session_start();
				$_SESSION['username'] = $get_usuario->username;
				Controlador::redirect("Inicio de sesion correcto"); 
			} else {
				Controlador::redirect("Credenciales incorrectas, verifiquelas e intente nuevamente");
			}

		} catch (Exception $e){
			echo 'Error al obtener usuario: ' . $e->getMessage();
		}
	}
}

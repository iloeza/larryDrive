<?php

require_once'Modelos/Usuario.php';

class UsuarioController {

	private $model;

	public function __CONSTRUCT(){
		$this->model = new Usuario();
	}


	public function Crear(){
		$usuario = new Usuario();

		$usuario->username = $_POST['username'];
		$usuario->password = $_POST['password'];

		$this->model->Crear($usuario);
		header('Location: index.php');
	}

}

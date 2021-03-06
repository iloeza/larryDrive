<?php

class Usuario {

	public $username;
	public $password;
	private $conn;

	public function __CONSTRUCT(){
		$this->conn = Db::Conn();
		$result = $this->conn->query("SHOW TABLES LIKE 'Usuarios'");
		if($result->num_rows == 0){
			$sql = "CREATE TABLE Usuarios (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR(30) NOT NULL,
				password VARCHAR(30) NOT NULL,
				isAdmin INT(1) NOT NULL 
			)";

			if (! $this->conn->query($sql)) {
		  		echo "Error creating table: " . $this->conn->error;
			}
		}
	}

	public function Crear(Usuario $usuario){
		$username = $usuario->username;
		$password = $usuario->password;
		try {
			$get_usuario = $this->get_usuario($usuario);
			if ($get_usuario->num_rows >= 1) {
				return false; //Regresamos false si ya existe el usuario con ese nombre en la bd
			}
		} catch (Exception $e){
			echo $e->getMessage();
		}

		$sql = $this->conn->prepare("INSERT INTO Usuarios (username, password, isAdmin) VALUES (?, ?, 1)");
		$sql->bind_param("ss", $username, $password);

		if (! $sql->execute()){
			throw new Exception("Error insertando los datos en la bd");
		}
		$sql->close();
		return true; //Regresamos true si no hubo duplicados y se creo correctamente el usuario
	}

	public function get_usuario(Usuario $usuario){
		$username = $usuario->username;

		$sql = $this->conn->prepare("SELECT * FROM Usuarios WHERE username = ?");
		$sql->bind_param("s", $username);
		
		if (! $sql->execute()){
			throw new Exception("Error obteniendo los datos del usuario");
		} else {
			$get_resultados = $sql->get_result();
			return $get_resultados;
		}
		$sql->close();
	}

	public function get_usuarios(){
		
		$sql = $this->conn->prepare("SELECT id, username, isAdmin FROM Usuarios");
		
		if (! $sql->execute()){
			throw new Exception("Error obteniendo los datos de los usuarios");
		} else {
			$get_resultados = $sql->get_result();
			return $get_resultados;
		}
		$sql->close();
	}

	public function cambiar_rol($id, $rol){
		$nuevoRol = $rol == "Admin" ? 0 : 1;
		$sql = $this->conn->prepare("UPDATE Usuarios SET isAdmin = ? WHERE id = ?");
		$sql->bind_param("ii", $nuevoRol, $id);

		if (! $sql->execute()){
			throw new Exception("Error actualizando los datos del usuario");
		} else {
			return true;
		}

		$sql->close();
	}
}

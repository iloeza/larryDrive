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
				password VARCHAR(30) NOT NULL
			)";

			if (! $this->conn->query($sql)) {
		  		echo "Error creating table: " . $this->conn->error;
			}
		}
	}

	public function Crear(Usuario $usuario){
	
		$sql = $this->conn->prepare("INSERT INTO Usuarios (username, password) VALUES (?, ?)");
		$sql->bind_param("ss", $username, $password);

		$username = $usuario->username;
		$password = $usuario->password;
		if (! $sql->execute()){
			echo "Error insertando los datos en la bd";
		}
		$sql->close();
	}
}

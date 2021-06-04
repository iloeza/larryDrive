<?php

class Archivo {

	private $conn;
	
	public function __CONSTRUCT(){
	$this->conn = Db::Conn();
	$result = $this->conn->query("SHOW TABLES LIKE 'Archivos'");
	if($result->num_rows == 0){
		$sql = "CREATE TABLE Archivos (
			Id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Archivo VARCHAR(100) NOT NULL,
			Usuario VARCHAR(30) NOT NULL,
			Fecha datetime
		)";
			if (! $this->conn->query($sql)) {
	  		echo "Error creating table: " . $this->conn->error;
			}
		}
	}
	
	public function crear_log($file, $user){

		$sql = $this->conn->prepare("INSERT INTO Archivos (Archivo, Usuario, Fecha) VALUES (?, ?, now())");
		$sql->bind_param("ss", $file, $user);
		if (! $sql->execute()){
			throw new Exception($this->conn->error);
		}
		$sql->close();
	}
}

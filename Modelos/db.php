<?php

class Db {
	public function Conn (){
		$server = "localhost";
		if($_SERVER['HTTP_HOST'] != 'localhost'){
			$user = "id16836596_root";
			$pass = "Admin-Admin123";
			$db = "id16836596_larrydrive";
		} else {
			$user = "root";
			$pass = "LarryDrive#1";
			$db = "larrydrive";
		}

		//Conexion a la bd
		$conn = new mysqli($server, $user, $pass, $db);
		if ($conn->connect_error){
			die("No se pudo conectar a la bd: " . $conn->connect_error);
		}

		return $conn;
	}
}


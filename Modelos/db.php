<?php

class Db {
	public function Conn (){
		$server = "localhost";
		if($_SERVER['HTTP_HOST'] != 'localhost'){
			$user = "id17032082_uppuser";
			$pass = "|oDZ9{o!]VsrnNy-";
			$db = "id17032082_fastdrive";
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


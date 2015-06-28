<?php		
////////////////////////////////////
///// класс для работы с базой данных

include "defines.php";

class LibUP {

// Подключаемся к базе данных.
// Если таблица не создана, то пытаемся создать таблицу с одной записью.
function NewOpenBaseDataMySQL($pdoSet) {

// блок подключения к базе данных
	try {
		$pdoSet = new PDO(DTBASE_TYPE.':host='.DTBASE_SERVER, DTBASE_USER, DTBASE_PASSWORD);	  
	} catch(PDOException $e) {
		echo 'Error: ' . $e->getMessage();
		return false;
 	}

	$pdoSet->query('SET NAMES utf8;');
// блок инициализации
	$stmt = $pdoSet->query('USE ' . DTBASE_NAME . ';');
	if (!$stmt) {
		$query="CREATE DATABASE IF NOT EXISTS " . DTBASE_NAME . " DEFAULT CHARACTER SET utf8;
				USE " . DTBASE_NAME . ";";
		$pdoSet->query($query);
	}
	$stmt = $pdoSet->query('SELECT * FROM clodo;');
	if ((!$stmt) || ($stmt->rowCount() == 0)) {	
		$query="CREATE TABLE IF NOT EXISTS clodo (id int(5) NOT NULL AUTO_INCREMENT, fio VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, telephone VARCHAR(50) NOT NULL, balance VARCHAR(50) NOT NULL, data_registration DATE NOT NULL, PRIMARY KEY(id));
				CREATE TABLE IF NOT EXISTS clodo_add (id int(5) NOT NULL, data_add DATE NOT NULL, sum_add VARCHAR(50) NOT NULL, FOREIGN KEY (id) REFERENCES clodo(id));
				INSERT INTO clodo (fio, email, telephone, balance, data_registration) VALUES ('Субботин Алексей Николаевич', 'alesu1543@gmail.com', '+7-921-365-65-35', '600', '2015-06-28');
				INSERT INTO clodo_add (id, data_add, sum_add) VALUES (1, '2015-06-28', '350');

		
		
				";
		$pdoSet->query($query);
	}
	return $pdoSet;
}

}

class DataBaseManager extends LibUP {

public $pdo;
	
function __construct() {
	$this->pdo = $this->NewOpenBaseDataMySQL($this->pdo);
}

function __destruct() {
	unset($this->pdo);
}


function GetPassword($auth_id) {
	$query = "SELECT password FROM auth2 WHERE auth_id='".$auth_id."';";
	@ $stmt = $this->pdo->query($query);
	if ($stmt) {
		$row = $stmt->fetch();
		return $row['password'];
		
	}
}

function GetUser(){
if (isset($_COOKIE["ved_php"])) {
		
	$query = "SELECT * FROM auth2 WHERE auth_id='".$_COOKIE["ved_php"]."';";
	@ $stmt = $this->pdo->query($query);
	if ($stmt) {
		$row = $stmt->fetch();

			$worker_out = $row["first_name"];
			if ($row["last_name"] != '') {
				$worker_out .= " ".substr(trim($row["last_name"]), 0, 2).".";
			}
			if ($row["double_last_name"] != '') {
				$worker_out .= substr(trim($row["double_last_name"]), 0, 2).".";
			}
		return $worker_out;
	}
	
		
}

}


}

$db = new DataBaseManager;

	
?>
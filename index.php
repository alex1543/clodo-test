<?php
////////////////////////////////////
///// основной класс
			
include "db.php";
class Main extends LibUP {

private $pdo;
	
function __construct() {
	// подключаемся к базе данных, согласно настройкам в Defines.php
	$this->pdo = $this->NewOpenBaseDataMySQL($this->pdo);
}

function __destruct() {
	unset($this->pdo);
}

//  основной метод для формирования таблицы
function ViewTable(){

	echo "<tr>";

	$query = "SELECT * FROM clodo, clodo_add WHERE clodo.id=clodo_add.id";
	
	if ((isset($_POST["fio"])) && ($_POST["fio"] != '')) {
		$query = $query." AND fio='".$_POST["fio"]."'";
		
		if (isset($_POST["telephone"])) {
		$query = $query." AND telephone!=''"; } Else {
		$query = $query." AND telephone=''";}
	}
	if ((isset($_POST["balance_min"])) && ($_POST["balance_min"] != ''))
		$query = $query." AND balance>='".$_POST["balance_min"]."'";
	if ((isset($_POST["balance_max"])) && ($_POST["balance_max"] != ''))
		$query = $query." AND balance<='".$_POST["balance_max"]."'";
	if ((isset($_POST["registration_in"])) && ($_POST["registration_in"] != ''))
		$query = $query." AND data_registration>='".$_POST["registration_in"]."'";
	if ((isset($_POST["registration_to"])) && ($_POST["registration_to"] != ''))
		$query = $query." AND data_registration<='".$_POST["registration_to"]."'";
	if ((isset($_POST["pice_in"])) && ($_POST["pice_in"] != ''))
		$query = $query." AND sum_add>='".$_POST["pice_in"]."'";
	if ((isset($_POST["pice_to"])) && ($_POST["pice_to"] != ''))
		$query = $query." AND sum_add<='".$_POST["pice_to"]."'";

	
	@ $stmt = $this->pdo->query($query);
	for($i=0; $row = $stmt->fetch(); $i++) {

		echo '<td>'.$row["fio"].'</td>';
		echo '<td>'.$row["email"].'</td>';
		echo '<td>'.$row["telephone"].'</td>';
		echo '<td>'.$row["balance"].'</td>';	
	
	}
	echo "</tr>";
	
}

function ScriptJSSearch() {
	$query = "SELECT * FROM clodo ORDER BY id;";
	@ $stmt = $this->pdo->query($query);
	if (($stmt) && ($stmt->rowCount() > 0)) {
		echo "<script>";
		echo "$(function() {";
		echo "	var availableTags = [";
		
		for($i=0; $row = $stmt->fetch(); $i++) {
			if ($i < $stmt->rowCount() -1) {
				echo "\"". $row["fio"] . "\",";
			} else {
				echo "\"". $row["fio"] . "\"";
			}
		}
		echo "];";
		echo "$( \"#fio\" ).autocomplete({";
		echo "	source: availableTags";
		echo "});";
		echo "});";
		echo "</script>";



	}

}

function ViewFilter() {
	
	echo "<FORM ACTION=\"" . $_SERVER['SCRIPT_NAME'] ."\" METHOD=\"POST\" style=\"width:100%\">";
	echo "<p style='width:100%;'><table style='width:500px;margin:45px;float:left;'>";
	echo "<tr><td colspan=3 style='font-size:24px;'>Фильтр</td></tr>";
	echo "<tr><td style='width:220px;'>ФИО</td><td colspan=2><input type='text' name='fio' id='fio'></td></tr>";
	$this->ScriptJSSearch();
	echo "<tr><td>Наличие/отсутствие телефона</td><td><input type='checkbox' name='telephone' checked=checked></td><td> наличие телефона</td></tr>";
	echo "<tr><td>Баланс больше/меньше</td><td><input type='text' name='balance_min'></td><td><input type='text' name='balance_max'></td></tr>";
	echo "<tr><td>Зарегистрирован в период с/по</td><td><input type='text' name='registration_in'></td><td><input type='text' name='registration_to'></td></tr>";
	echo "<tr><td>Средний платеж от/до</td><td><input type='text' name='pice_in'></td><td><input type='text' name='pice_to'></td></tr>";
	echo "<tr><td colspan=3><input style='float:right;width:130px;margin:20px;' type='submit' value=' Фильтровать '></td></tr>";
	echo "</table></p>";
	echo "</FORM>";
	
}

}

///////////////////////////////////////////////////
////  основной блок
	include "html.php";
	$HTML->Header();

	$MyIndex = new Main;
	$MyIndex->ViewFilter();
	$HTML->TableBegin();
	$MyIndex->ViewTable();
	$HTML->TableEnd();

	
	$HTML->Footer(1);
?>
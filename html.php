<?php		
////////////////////////////////////
///// класс для отображения HTML

class LibHTML {

// формирование заголовка HTML страницы
function Header() {
?>
	<!doctype html>
	<html lang="ru">
	<head>
		<meta charset="UTF-8" />
		<title>Тестовое задание Clodo</title>
		<meta name="description" content="Тестовое задание Clodo" />
		<meta name="Keywords" content="Тестовое задание Clodo" />
		<meta http-equiv="Cache-Control" content="no-cache" />
		<meta http-equiv="Cache-Control" content="max-age=30, must-revalidate" />
		
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link rel="stylesheet" href="css/themes/base/jquery.ui.all.css" type="text/css" />
			
		<script src="js/jquery-1.5.1.js"></script>
		<script src="js/ui/jquery.ui.core.js"></script>
		<script src="js/ui/jquery.ui.widget.js"></script>
		<script src="js/ui/jquery.ui.position.js"></script>
		<script src="js/ui/jquery.ui.autocomplete.js"></script>
	
	</head>
	<body>

	<div id="conteiner">
	<div><h3>Тестовое задание Clodo</h3></div>
<?php
}

// формирование "подвала" HTML страницы
function Footer($modeDivCont) {

	// Copyright - по выбору при значении переменной: 1 - показывать и люб. - не показывать
	if ($modeDivCont == 1) {
		?>
		</div>
		<div id="footer">
		Copyright © 2015<br />
		Тестовое задание Clodo.<br />
		All Rights Reserved.
		</div>
		<?php
	}

?>	
	<link rel="stylesheet" href="css/scrollup.css">
	<div id="scrollup">
	<img src="img/up.png" class="up" alt="Прокрутить вверх" />
	<script src="js/scrollup.js"></script>
	</div>
	</body>
	</html>
<?php
}

// формирование "шапки" таблицы
function TableBegin() {
?>
	<table style="width:70%;text-align:left;margin:auto;">
	<tr><td colspan=4><h2>ТАБЛИЦА ПОЛЬЗОВАТЕЛЕЙ</h2></td></tr>
	<tr class='headerTable'><td>ФИО</td><td>EMail</td><td>Телефон</td><td>Баланс</td></tr>
<?php
}

// формирование окончания таблицы
function TableEnd() {
?>
	</table>
	<p>Для доступа в базу данных, необходимо настроить параметры в defines.php</p>
<?php
}

}
$HTML = new LibHTML;
	
?>
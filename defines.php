<?php		
////////////////////////////////////
///// класс для констант и значений по умолчанию

class Defines {
	
function __construct() {
	//  Значения по умолчанию для подключения к БД
	define('DTBASE_TYPE', 'mysql'); // либо mysql, либо mssql
	define('DTBASE_NAME', 'clodo');
	define('DTBASE_SERVER', 'localhost');
	define('DTBASE_USER', 'root');
	define('DTBASE_PASSWORD', '');
}

}

$setDefines = new Defines;
	
?>
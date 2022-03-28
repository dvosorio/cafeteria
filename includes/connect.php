<?php

$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'cafeteria';

function connect(){

    $connect = new mysqli($GLOBALS["host"], $GLOBALS["user"], $GLOBALS["pass"], $GLOBALS["db"]);
    $connect->set_charset("utf8");

    if($connect->connect_errno){
        printf("Conexión fallida: %s\n", $connect->connect_error);
        exit();
	}

	return $connect;
}
?>
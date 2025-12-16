<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "projeto";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die("Erro de ligação à base de dados: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8");
?>

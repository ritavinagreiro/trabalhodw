<?php
session_start();

if (!isset($_SESSION['ligado']) || $_SESSION['ligado'] !== true) {
    header("Location: login.php");
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "projeto");
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

$idEvento = $_POST['id_evento'] ?? null;
$idSocio = $_SESSION['id_socio'];

if ($idEvento) {
    $stmt = $mysqli->prepare("SELECT * FROM inscricoes_eventos WHERE id_socio = ? AND id_evento = ?");
    $stmt->bind_param("is", $idSocio, $idEvento);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $stmt = $mysqli->prepare("INSERT INTO inscricoes_eventos (id_socio, id_evento) VALUES (?, ?)");
        $stmt->bind_param("is", $idSocio, $idEvento);
        $stmt->execute();
    }
}

header("Location: meus-eventos.php");
exit;
?>

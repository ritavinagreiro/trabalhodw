<?php
session_start();

if (!isset($_SESSION['ligado']) || $_SESSION['ligado'] !== true) {
    header("Location: login.php");
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "projeto");
if ($mysqli->connect_error) {
    die("Erro de ligação à base de dados");
}

$idEvento = $_POST['id_evento'] ?? null;
$idSocio = $_SESSION['id_socio'] ?? null;

if ($idEvento && $idSocio) {
    $stmt = $mysqli->prepare("DELETE FROM inscricoes_eventos WHERE id_socio = ? AND id_evento = ?");
    $stmt->bind_param("is", $idSocio, $idEvento);
    if ($stmt->execute()) {
        $_SESSION['msg_inscricao'] = "Inscrição cancelada com sucesso!";
    } else {
        $_SESSION['msg_inscricao'] = "Erro ao cancelar inscrição.";
    }
} else {
    $_SESSION['msg_inscricao'] = "Evento inválido.";
}

header("Location: meus-eventos.php");
exit;
?>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../403.php");
    exit;
}

if (!isset($_POST["csrf_token"]) || !isset($_SESSION["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
    unset($_SESSION["csrf_token"]);
    $_SESSION["erro_socio"] = "Erro de segurança.";
    header("Location: ../403.php");
    exit;
}
unset($_SESSION["csrf_token"]);

$nome    = trim($_POST["fNome"]);
$email   = trim($_POST["fEmail"]);
$tel     = trim($_POST["fTel"]);
$dataN   = $_POST["fData"] ?: null;
$pass    = $_POST["fPass"];
$consent = isset($_POST["fConsent"]) ? 1 : 0;

$nomePartes = explode(' ', $nome);
$iniciais = strtoupper(substr($nomePartes[0], 0, 1) . substr(end($nomePartes), 0, 1));

$hash = password_hash($pass, PASSWORD_DEFAULT);

$mysqli = new mysqli("localhost", "root", "", "projeto");
if ($mysqli->connect_error) {
    die("Erro de ligação à base de dados: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("
    INSERT INTO socios (nome, email, telemovel, data_nascimento, password, consentimento, iniciais)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param("sssssis", $nome, $email, $tel, $dataN, $hash, $consent, $iniciais);

if ($stmt->execute()) {
    $_SESSION['ligado']   = true;
    $_SESSION['nome']     = $nome;
    $_SESSION['email']    = $email;
    $_SESSION['id_socio'] = $mysqli->insert_id;
    $_SESSION['iniciais'] = $iniciais;
    $_SESSION["sucesso_socio"] = "Bem-vindo à família Ponto de Encontro!";
    
    header("Location: ../bemvindo.php");
    exit;
} else {
    $_SESSION["erro_socio"] = "Erro ao registar sócio (email já existe?).";
    header("Location: ../tornarsocio.php");
    exit;
}
?>

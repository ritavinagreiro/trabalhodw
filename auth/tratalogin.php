<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /Projeto/index.php');
    exit;
}

if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    unset($_SESSION['csrf_token']);
    $_SESSION['erro_login'] = 'Erro de segurança. Requisição inválida.';
    header('Location: /Projeto/index.php');
    exit;
}
unset($_SESSION['csrf_token']); 

$mysqli = new mysqli("localhost", "root", "", "projeto");
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

$email = trim($_POST['email']);
$senha = $_POST['password'];

$stmt = $mysqli->prepare("SELECT id_admin, nome, email, senha FROM administradores WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($admin = $result->fetch_assoc()) {
    if (password_verify($senha, $admin['senha'])) {
        $_SESSION['ligado'] = true;
        $_SESSION['nome'] = $admin['nome'];
        $_SESSION['email'] = $admin['email'];
        $_SESSION['id_admin'] = $admin['id_admin'];
        $_SESSION['role'] = 'Administrador';

        $nomePartes = explode(' ', $admin['nome']);
        $_SESSION['iniciais'] = strtoupper(substr($nomePartes[0],0,1) . substr(end($nomePartes),0,1));

        header('Location: /Projeto/index.php');
        exit;
    }
}

$stmt = $mysqli->prepare("SELECT id_socio, nome, email, password FROM socios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($socio = $result->fetch_assoc()) {
    if (password_verify($senha, $socio['password'])) {
        $_SESSION['ligado'] = true;
        $_SESSION['nome'] = $socio['nome'];
        $_SESSION['email'] = $socio['email'];
        $_SESSION['id_socio'] = $socio['id_socio'];
        $_SESSION['role'] = 'Socio';

        $nomePartes = explode(' ', $socio['nome']);
        $_SESSION['iniciais'] = strtoupper(substr($nomePartes[0],0,1) . substr(end($nomePartes),0,1));

        header('Location: /Projeto/index.php'); 
        exit;
    }
}

$_SESSION['erro_login'] = "Email ou palavra-passe inválidos";
header('Location: /Projeto/login.php');
exit;



<?php
$pageTitle = isset($pageTitle) ? $pageTitle : 'Ponto de Encontro';
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="shortcut icon" href="imgs/logo1.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-white">

<header class="bg-gradient-to-b from-blue-800 to-blue-500 shadow mb-6">
    <div class="inner-content-wrapper flex items-center justify-between py-4 px-4 md:px-8">
        <div class="flex items-center space-x-4">
            <img src="imgs/logo.png" class="h-16 w-auto" alt="Logo">
            <h1 class="text-3xl font-bold text-white">PONTO DE ENCONTRO</h1>
        </div>
        <a href="eventos.php" class="text-white text-sm underline"> ← Voltar </a>
    </div>
</header>

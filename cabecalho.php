<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF']); 
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ponto de Encontro</title>
    <link rel="shortcut icon" href="imgs/logo1.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-white flex flex-col min-h-screen">

<header class="w-full blue-gradient-header">
    <div class="inner-content-wrapper flex flex-col md:flex-row justify-between items-center gap-4 md:gap-0 h-auto md:h-36">
        <div class="w-full flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img class="h-16 md:h-32 w-auto" src="imgs/logo.png" alt="Logo">
                <h1 class="header-title text-3xl md:text-6xl font-extrabold">PONTO DE ENCONTRO</h1>
            </div>

            <div class="md:hidden">
                <button id="menu-btn">
                    <svg width="40" height="40" viewBox="0 0 24 24" stroke="white" fill="none" stroke-width="2" stroke-linecap="round">
                        <line x1="4" y1="6" x2="20" y2="6" />
                        <line x1="4" y1="12" x2="20" y2="12" />
                        <line x1="4" y1="18" x2="20" y2="18" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center space-x-2">
            <?php if(isset($_SESSION['ligado']) && $_SESSION['ligado'] === true): ?>

            <div class="relative">

                <button id="user-btn"
                    class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-indigo-600 text-white font-semibold text-lg ring-2 ring-white ring-offset-2 ring-indigo-500 cursor-pointer focus:outline-none">
                    <?= htmlspecialchars($_SESSION['iniciais']); ?>
                </button>

                <div id="dropdown"
                     class="hidden absolute right-0 mt-3 w-56 bg-white border border-gray-300 rounded-lg shadow-xl p-4 z-50">

                    <p class="mb-3 font-semibold text-blue-900 text-center">
                        Olá, <?= htmlspecialchars($_SESSION['nome']); ?>!
                    </p>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Administrador'): ?>
                        <a href="admin/dashboard.php"
                        class="block w-full text-center px-4 py-2 mb-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition">
                            Administração
                        </a>
                    <?php endif; ?>

                    <a href="meus-eventos.php"
                       class="block w-full text-center px-4 py-2 mb-2 text-blue-700 border border-blue-700 rounded-md hover:bg-blue-700 hover:text-white transition">
                        Ver os meus eventos
                    </a>

                    <a href="auth/tratalogout.php"
                       class="block w-full text-center px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700 transition">
                        Logout
                    </a>

                </div>
            </div>

            <?php else: ?>
                <a href="tornarsocio.php" class="bg-white hover:bg-gray-100 text-blue-700 font-semibold py-1.5 px-6 rounded-md text-sm whitespace-nowrap">
                    Tornar-me sócio
                </a>
                <a href="login.php" class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-1.5 px-4 rounded-md text-sm border border-white whitespace-nowrap">
                    Login
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>

<nav class="w-full border-t border-b border-gray-300 py-4 mb-10">
    <div class="flex justify-center space-x-16 inner-content-wrapper hidden md:flex">
        <a href="index.php" class="text-black text-xl pb-1 <?= ($currentPage=='index.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">Home</a>
        <a href="jogos.php" class="text-black text-xl pb-1 <?= ($currentPage=='jogos.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">Jogos</a>
        <a href="eventos.php" class="text-black text-xl pb-1 <?= ($currentPage=='eventos.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">Eventos</a>
        <a href="clube.php" class="text-black text-xl pb-1 <?= ($currentPage=='clube.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">O Clube</a>
    </div>

    <div id="menu-dropdown" class="hidden md:hidden flex flex-col space-y-4 mt-0 px-4">
        <a href="index.php" class="text-black text-xl pb-1 <?= ($currentPage=='index.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">Home</a>
        <a href="jogos.php" class="text-black text-xl pb-1 <?= ($currentPage=='jogos.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">Jogos</a>
        <a href="eventos.php" class="text-black text-xl pb-1 <?= ($currentPage=='eventos.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">Eventos</a>
        <a href="clube.php" class="text-black text-xl pb-1 <?= ($currentPage=='clube.php') ? 'font-bold border-b border-black' : 'font-medium hover:border-b-2 hover:border-black transition'; ?>">O Clube</a>
    </div>
</nav>

<script src="js/menu.js"></script>

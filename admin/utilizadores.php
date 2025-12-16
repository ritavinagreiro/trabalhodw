<?php
session_start();
require('includes/connection.php'); 

$admins = [
    [
        'id' => 1,
        'nome' => 'Rita Vinagreiro',
        'email' => 'ritavinagreiro@pontodeencontro.pt',
        'role' => 'Administrador',
        'status' => 'Ativo',
    ],
    [
        'id' => 2,
        'nome' => 'Iara Gomes',
        'email' => 'iaragomes@pontodeencontro.pt',
        'role' => 'Administrador',
        'status' => 'Ativo',
    ],
];

$socios = [];
$result = $mysqli->query("SELECT id_socio AS id, nome, email FROM socios");
if($result){
    while($row = $result->fetch_assoc()){
        $socios[] = [
            'id' => $row['id'],
            'nome' => $row['nome'],
            'email' => $row['email'],
            'role' => 'Sócio',
            'status' => 'Ativo',
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel de Administração | Gestão de Utilizadores</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
.overlay-transition { transition: opacity 0.3s ease; }
.table-cell-height { height: 64px; }
</style>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen">

    <?php require('includes/nav.php'); ?>
    
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden md:hidden overlay-transition"></div>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="bg-white shadow-lg p-4 flex justify-between items-center z-30">
            <button id="menu-toggle" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <h1 class="text-2xl font-bold text-gray-700 md:ml-0 ml-4">Gestão de Utilizadores</h1>
            <span class="text-gray-500 hidden md:block">Bem-vindo, Admin</span>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 md:p-8">
            
            <div class="mb-8 flex justify-between items-center">
                <h2 class="text-3xl font-extrabold text-gray-800">Lista de Utilizadores</h2>
                <a href="adicionar-utilizador.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Novo Utilizador
                </a>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold mb-4">Administradores (<?= count($admins) ?>)</h3>
                <div class="bg-white p-4 rounded-xl shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Nível</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($admins as $user): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4"><?= htmlspecialchars($user['nome']) ?></td>
                                <td class="px-6 py-4 hidden md:table-cell"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-6 py-4 hidden sm:table-cell"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800"><?= htmlspecialchars($user['status']) ?></span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="eliminar-utilizador.php?id=<?= $user['id'] ?>" class="text-red-600 hover:text-red-900">Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-8">
                <h3 class="text-xl font-bold mb-4">Sócios (<?= count($socios) ?>)</h3>
                <div class="bg-white p-4 rounded-xl shadow-md overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Nível</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach($socios as $user): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4"><?= htmlspecialchars($user['nome']) ?></td>
                                <td class="px-6 py-4 hidden md:table-cell"><?= htmlspecialchars($user['email']) ?></td>
                                <td class="px-6 py-4 hidden sm:table-cell"><?= htmlspecialchars($user['role']) ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800"><?= htmlspecialchars($user['status']) ?></span>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="eliminar-utilizador.php?id=<?= $user['id'] ?>" class="text-red-600 hover:text-red-900">Eliminar</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
const sidebar = document.getElementById('sidebar');
const toggleButton = document.getElementById('menu-toggle');
const overlay = document.getElementById('overlay');

const toggleSidebar = () => {
    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
};

toggleButton.addEventListener('click', toggleSidebar);
overlay.addEventListener('click', toggleSidebar);
</script>
</body>
</html>



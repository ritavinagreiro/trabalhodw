<?php
session_start();
require('includes/connection.php'); 

$query = "SELECT * FROM eventos ORDER BY data ASC";
$result = $mysqli->query($query);

$eventos = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $eventos[] = [
            'id'        => $row['id_evento'],
            'titulo'    => $row['titulo'],
            'img'       => '../' . $row['img'], 
            'dia'       => date('d/m/Y', strtotime($row['data'])), 
            'hora'      => substr($row['hora'], 0, 5),
            'descricao' => $row['descricao']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gestão de Eventos</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen">

    <?php require('includes/nav.php'); ?>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden md:hidden transition-opacity"></div>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="bg-white shadow-lg p-4 flex justify-between items-center z-30">
            <button id="menu-toggle" class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-2xl font-bold text-gray-700 md:ml-0 ml-4">Gestão de Eventos</h1>
            <span class="text-gray-500 hidden md:block">Bem-vindo, Admin</span>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 md:p-8">

            <div class="mb-8 flex justify-between items-center">
                <h2 class="text-3xl font-extrabold text-gray-800">Lista de Eventos</h2>
                <a href="adicionar-evento.php" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-150 flex items-center">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Novo Evento
                </a>
            </div>

            <?php if(!empty($eventos)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    <?php foreach($eventos as $evento): ?>
                        <div class="bg-white p-5 rounded-xl shadow-lg hover:shadow-xl transition duration-300 border-t-4 border-indigo-500 flex flex-col h-full">
                            
                            <img src="<?= htmlspecialchars($evento['img']) ?>" class="w-full h-40 object-cover rounded mb-3" alt="<?= htmlspecialchars($evento['titulo']) ?>">
                            
                            <h3 class="text-xl font-bold text-gray-800 mb-1"><?= htmlspecialchars($evento['titulo']); ?></h3>
                            
                            <p class="text-gray-500 text-sm mb-2"><?= htmlspecialchars($evento['dia']) ?> às <?= htmlspecialchars($evento['hora']) ?></p>
                            
                            <p class="text-gray-700 text-sm flex-grow">
                                <?= htmlspecialchars(mb_strimwidth($evento['descricao'], 0, 100, "...")); ?>
                            </p>

                            <div class="mt-auto flex space-x-2 justify-end">
                                <a href="editar-evento.php?id=<?= $evento['id']; ?>" class="text-sm text-yellow-600 hover:text-yellow-800 font-medium p-1 rounded hover:bg-yellow-50 transition">
                                    Editar
                                </a>
                                <a href="eliminar-evento.php?id=<?= $evento['id']; ?>" class="text-sm text-red-600 hover:text-red-800 font-medium p-1 rounded hover:bg-red-50 transition">
                                    Eliminar
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php else: ?>
                <div class="text-center p-10 bg-white rounded-xl shadow-lg">
                    <p class="text-2xl text-gray-500">Nenhum evento agendado.</p>
                    <a href="adicionar-evento.php" class="mt-4 inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150">
                        Criar Primeiro Evento
                    </a>
                </div>
            <?php endif; ?>

        </main>
    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('menu-toggle');
    const overlay = document.getElementById('overlay'); 

    const toggleSidebar = () => {
        if(sidebar) sidebar.classList.toggle('-translate-x-full');
        if(overlay) overlay.classList.toggle('hidden');
    };

    if(toggleButton) toggleButton.addEventListener('click', toggleSidebar);
    if(overlay) overlay.addEventListener('click', toggleSidebar);
</script>
</body>
</html>
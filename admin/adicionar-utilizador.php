<?php
session_start();
require('includes/connection.php'); 

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? 'Sócio';
    $status = $_POST['status'] ?? 'Ativo';

    if ($role === 'Sócio') {
        $stmt = $mysqli->prepare("INSERT INTO socios (nome, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $email);
        $stmt->execute();
        $stmt->close();
    } else {
    }

    $success = "Utilizador adicionado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adicionar Novo Utilizador</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen">

    <?php require('includes/nav.php'); ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white shadow-lg p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-700">Adicionar Novo Utilizador</h1>
            <a href="utilizadores.php" class="text-blue-600 hover:underline">Voltar à Lista</a>
        </header>

        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            <?php if ($success): ?>
                <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                    <?= htmlspecialchars($success) ?>
                </div>
            <?php endif; ?>

            <form method="post" class="bg-white p-6 rounded-lg shadow-md space-y-4 max-w-lg">
                <label class="block">
                    Nome:
                    <input type="text" name="nome" required class="border p-2 w-full rounded">
                </label>

                <label class="block">
                    Email:
                    <input type="email" name="email" required class="border p-2 w-full rounded">
                </label>

                <label class="block">
                    Nível:
                    <select name="role" class="border p-2 w-full rounded">
                        <option value="Sócio">Sócio</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </label>

                <label class="block">
                    Status:
                    <select name="status" class="border p-2 w-full rounded">
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                        <option value="Pendente">Pendente</option>
                    </select>
                </label>

                <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700">
                    Adicionar Utilizador
                </button>
            </form>
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

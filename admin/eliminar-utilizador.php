<?php
session_start();
require('includes/connection.php');

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<p>ID inválido. <a href='utilizadores.php'>Voltar</a></p>";
    exit;
}

$adminsFixos = [
    1 => 'Rita Vinagreiro',
    2 => 'Iara Gomes'
];

if (array_key_exists($id, $adminsFixos)) {
    echo "<p>Não é possível eliminar um administrador fixo.
          <a href='utilizadores.php'>Voltar</a></p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['confirm'] === 'sim') {

    $stmt = $mysqli->prepare("DELETE FROM socios WHERE id_socio = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        echo "
        <p class='text-green-600 font-semibold'>
            Utilizador eliminado com sucesso.
        </p>
        <a href='utilizadores.php' class='text-blue-600 underline'>
            Voltar à lista
        </a>";
        exit;
    } else {
        echo "<p>Erro ao eliminar utilizador.
              <a href='utilizadores.php'>Voltar</a></p>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eliminar Utilizador</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-6 rounded-xl shadow-lg max-w-md w-full">
    <h1 class="text-2xl font-bold text-red-600 mb-4">
        Eliminar Utilizador
    </h1>

    <p class="mb-4 text-gray-700">
        Tens a certeza que queres eliminar este utilizador?
    </p>

    <p class="text-sm text-gray-500 mb-6">
        Esta ação não pode ser desfeita.
    </p>

    <form method="post" class="flex justify-between">
        <button type="submit" name="confirm" value="sim"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
            Sim, eliminar
        </button>

        <a href="utilizadores.php"
           class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
           Cancelar
        </a>
    </form>
</div>

</body>
</html>


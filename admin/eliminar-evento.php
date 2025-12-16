<?php
session_start();
require('includes/connection.php'); 

$id_evento = $_GET['id'] ?? null;

if (!$id_evento) {
    header("Location: eventos.php");
    exit;
}

$stmt = $mysqli->prepare("SELECT titulo FROM eventos WHERE id_evento = ?");
$stmt->bind_param("s", $id_evento);
$stmt->execute();
$result = $stmt->get_result();
$evento = $result->fetch_assoc();
$stmt->close();

if (!$evento) {
    echo "<div class='p-8 text-center text-red-600 font-bold'>Erro: Evento não encontrado na base de dados. <a href='eventos.php' class='underline text-blue-600'>Voltar</a></div>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm']) && $_POST['confirm'] === 'sim') {

    $deleteStmt = $mysqli->prepare("DELETE FROM eventos WHERE id_evento = ?");
    $deleteStmt->bind_param("s", $id_evento);

    if ($deleteStmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='pt'>
        <head>
        <meta charset='UTF-8'>
        <title>Sucesso</title>
        <script src='https://cdn.tailwindcss.com'></script>
        </head>
        <body class='bg-gray-100 flex items-center justify-center h-screen'>
            <div class='bg-white p-8 rounded-xl shadow-lg text-center max-w-md'>
                <svg class='w-16 h-16 text-green-500 mx-auto mb-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path></svg>
                <h2 class='text-2xl font-bold text-gray-800 mb-2'>Sucesso!</h2>
                <p class='text-gray-600 mb-6'>O evento foi eliminado permanentemente.</p>
                <a href='eventos.php' class='bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition'>Voltar à lista</a>
            </div>
        </body>
        </html>";
        exit;
    } else {
        $erro = "Erro ao eliminar: " . $deleteStmt->error;
    }
    $deleteStmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eliminar Evento</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

<div class="bg-white p-8 rounded-xl shadow-2xl max-w-md w-full border-t-4 border-red-600">
    
    <div class="text-center mb-6">
        <svg class="w-16 h-16 text-red-100 bg-red-600 rounded-full p-3 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
        </svg>
        <h1 class="text-2xl font-bold text-gray-800">Eliminar Evento</h1>
    </div>

    <?php if(isset($erro)): ?>
        <p class="bg-red-100 text-red-700 p-3 rounded mb-4 text-center"><?= $erro ?></p>
    <?php endif; ?>

    <p class="mb-6 text-gray-600 text-center text-lg">
        Tens a certeza que queres eliminar o evento<br>
        <span class="font-bold text-gray-900 text-xl">"<?= htmlspecialchars($evento['titulo']) ?>"</span>?
    </p>

    <div class="bg-red-50 p-4 rounded-lg mb-8 border border-red-100">
        <p class="text-sm text-red-800 font-semibold flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            Esta ação é irreversível.
        </p>
    </div>

    <form method="post" class="flex flex-col-reverse sm:flex-row sm:justify-between gap-3">
        <a href="eventos.php"
           class="w-full sm:w-auto px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition text-center font-medium">
           Cancelar
        </a>

        <button type="submit" name="confirm" value="sim"
            class="w-full sm:w-auto bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-bold shadow-md hover:shadow-lg">
            Sim, eliminar
        </button>
    </form>
</div>

</body>
</html>


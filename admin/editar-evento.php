<?php
session_start();
require('includes/connection.php'); 

$id_evento = $_GET['id'] ?? null;

if (!$id_evento) {
    header("Location: eventos.php");
    exit;
}

$stmt = $mysqli->prepare("SELECT * FROM eventos WHERE id_evento = ?");
$stmt->bind_param("s", $id_evento);
$stmt->execute();
$result = $stmt->get_result();
$evento = $result->fetch_assoc();
$stmt->close();

if (!$evento) {
    die("Evento não encontrado.");
}

$msg = "";
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $titulo       = trim($_POST['titulo']);
    $data         = $_POST['dia'];
    $hora         = trim($_POST['hora']);
    $participacao = trim($_POST['participacao']);
    $local        = trim($_POST['local']);
    $descricao    = trim($_POST['descricao']);
    $regras       = trim($_POST['regras']);
    
    $updateStmt = $mysqli->prepare("UPDATE eventos SET titulo=?, data=?, hora=?, participacao=?, local=?, descricao=?, regras=? WHERE id_evento=?");
    $updateStmt->bind_param("ssssssss", $titulo, $data, $hora, $participacao, $local, $descricao, $regras, $id_evento);

    if ($updateStmt->execute()) {
        $msg = "Evento atualizado com sucesso!";
        $evento['titulo'] = $titulo;
        $evento['data'] = $data;
        $evento['hora'] = $hora;
        $evento['participacao'] = $participacao;
        $evento['local'] = $local;
        $evento['descricao'] = $descricao;
        $evento['regras'] = $regras;
    } else {
        $erro = "Erro ao atualizar: " . $updateStmt->error;
    }
    $updateStmt->close();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Evento - <?= htmlspecialchars($evento['titulo']) ?></title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <?php include('includes/nav.php'); ?>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Editar Evento: <span class="text-indigo-600"><?= htmlspecialchars($evento['titulo']) ?></span></h1>
                <a href="eventos.php" class="text-gray-600 hover:text-gray-900 font-medium px-4 py-2 bg-white rounded shadow-sm hover:shadow transition">← Voltar à lista</a>
            </div>

            <?php if($msg): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm"><?= $msg ?></div>
            <?php endif; ?>
            
            <?php if($erro): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm"><?= $erro ?></div>
            <?php endif; ?>

            <form method="post" class="bg-white p-8 rounded-xl shadow-lg space-y-6 w-full">
                
                <div class="bg-gray-50 p-4 rounded border border-gray-200 text-gray-500 text-sm mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    A editar evento com ID: <strong class="ml-1 text-gray-700"><?= htmlspecialchars($evento['id_evento']) ?></strong>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Título</label>
                        <input type="text" name="titulo" value="<?= htmlspecialchars($evento['titulo']) ?>" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Data</label>
                        <input type="date" name="dia" value="<?= htmlspecialchars($evento['data']) ?>" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Hora</label>
                        <input type="text" name="hora" value="<?= htmlspecialchars($evento['hora']) ?>" required class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Participação</label>
                        <input type="text" name="participacao" value="<?= htmlspecialchars($evento['participacao']) ?>" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Local</label>
                        <input type="text" name="local" value="<?= htmlspecialchars($evento['local']) ?>" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Descrição</label>
                    <textarea name="descricao" rows="5" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition"><?= htmlspecialchars($evento['descricao']) ?></textarea>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Regras</label>
                    <textarea name="regras" rows="6" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50 focus:bg-white transition font-mono text-sm"><?= htmlspecialchars($evento['regras']) ?></textarea>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <a href="eventos.php" class="mr-4 px-6 py-3 bg-gray-100 text-gray-600 font-bold rounded-lg hover:bg-gray-200 transition">Cancelar</a>
                    <button type="submit" class="bg-indigo-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-indigo-700 transition shadow-md hover:shadow-lg">
                        Salvar Alterações
                    </button>
                </div>
            </form>
            
            <div class="h-10"></div>
        </div>
    </div>
</body>
</html>

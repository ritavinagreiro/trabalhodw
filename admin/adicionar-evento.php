<?php
session_start();
require('includes/connection.php');

$pageTitle = "Adicionar Evento Completo";
$msg_erro = "";
$msg_sucesso = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_evento    = trim($_POST['id_evento']);
    $titulo       = trim($_POST['titulo']);
    $data         = $_POST['dia'];
    $hora         = trim($_POST['hora']);
    $local        = trim($_POST['local']);
    $participacao = trim($_POST['participacao']);
    $descricao    = trim($_POST['descricao']);
    $regras       = trim($_POST['regras']);

    $caminho_bd = "imgs/default.jpg";
    
    if (isset($_FILES['img']) && $_FILES['img']['error'] === 0) {
        $pasta_destino = "../imgs/"; 
        
        $nome_ficheiro = time() . "_" . basename($_FILES["img"]["name"]);
        $caminho_completo = $pasta_destino . $nome_ficheiro;
        
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $caminho_completo)) {
            $caminho_bd = "imgs/" . $nome_ficheiro; 
        } else {
            $msg_erro = "Erro ao fazer upload da imagem. Verifique se a pasta 'imgs' existe.";
        }
    }

    if (empty($id_evento) || empty($titulo) || empty($data) || empty($hora)) {
        $msg_erro = "Preencha pelo menos o ID, Título, Data e Hora.";
    } elseif (empty($msg_erro)) { 
        
        $check = $mysqli->prepare("SELECT id_evento FROM eventos WHERE id_evento = ?");
        $check->bind_param("s", $id_evento);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $msg_erro = "Erro: Já existe um evento com o ID '$id_evento'. Escolha outro.";
        } else {
            $stmt = $mysqli->prepare("INSERT INTO eventos (id_evento, titulo, descricao, data, hora, local, participacao, img, regras) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $id_evento, $titulo, $descricao, $data, $hora, $local, $participacao, $caminho_bd, $regras);

            if ($stmt->execute()) {
                $msg_sucesso = "Evento criado com sucesso!";
                header("refresh:2;url=eventos.php");
            } else {
                $msg_erro = "Erro SQL: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Admin | Adicionar Evento</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans antialiased">

<div class="flex h-screen">

    <?php require('includes/nav.php'); ?>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-40 hidden md:hidden"></div>

    <div class="flex-1 flex flex-col overflow-hidden">
        
        <header class="bg-white shadow-lg p-4 flex justify-between items-center z-30">
            <button id="menu-toggle" class="md:hidden text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <h1 class="text-2xl font-bold text-gray-700">Adicionar Evento Completo</h1>
            <span class="text-gray-500 hidden md:block">Admin</span>
        </header>

        <main class="flex-1 overflow-y-auto p-6 md:p-8">
            <div class="max-w-5xl mx-auto bg-white p-8 rounded-xl shadow-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-800">Novo Evento</h2>
                    <a href="eventos.php" class="text-blue-600 hover:underline">Voltar à lista</a>
                </div>

                <?php if($msg_sucesso): ?><div class="mb-4 p-4 bg-green-100 text-green-700 rounded border-l-4 border-green-500"><?= $msg_sucesso ?></div><?php endif; ?>
                <?php if($msg_erro): ?><div class="mb-4 p-4 bg-red-100 text-red-700 rounded border-l-4 border-red-500"><?= $msg_erro ?></div><?php endif; ?>

                <form method="post" enctype="multipart/form-data" class="space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">ID </label>
                            <input type="text" name="id_evento" required placeholder="ex: torneio-xadrez" 
                                   class="w-full border rounded-lg p-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <p class="text-xs text-gray-500 mt-1">Sem espaços (ex: catan-torneio)</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block font-medium text-gray-700 mb-1">Título</label>
                            <input type="text" name="titulo" required placeholder="ex: Torneio de Catan"
                                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Data</label>
                            <input type="date" name="dia" required 
                                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Hora</label>
                            <input type="text" name="hora" required placeholder="14h30"
                                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Local</label>
                            <input type="text" name="local" value="Sede do Clube Ponto de Encontro"
                                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                        <div class="border-2 border-dashed border-gray-300 p-6 rounded-lg text-center hover:bg-gray-50 transition">
                            <label class="block font-bold text-gray-700 mb-2 cursor-pointer">
                                <span class="text-indigo-600 underline">Carregar Imagem</span>
                                <input type="file" name="img" accept="image/*" class="hidden" onchange="document.getElementById('file-name').innerText = this.files[0].name">
                            </label>
                            <p id="file-name" class="text-sm text-gray-500">Nenhum ficheiro selecionado</p>
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Participação</label>
                            <input type="text" name="participacao" placeholder="ex: Máx 8 pax / Livre"
                                   class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Descrição</label>
                        <textarea name="descricao" rows="3" placeholder="Descrição do evento..."
                                  class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Regras (separadas por Enter)</label>
                        <textarea name="regras" rows="5" placeholder="- Regra 1&#10;- Regra 2&#10;- Regra 3"
                                  class="w-full border rounded-lg p-2 bg-yellow-50 focus:ring-2 focus:ring-yellow-500 focus:outline-none font-mono text-sm"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <a href="eventos.php" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">Cancelar</a>
                        <button type="submit" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition shadow-lg font-bold">Gravar Evento</button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('menu-toggle');
    const overlay = document.getElementById('overlay');
    const toggleSidebar = () => { if(sidebar) sidebar.classList.toggle('-translate-x-full'); if(overlay) overlay.classList.toggle('hidden'); };
    if(toggleButton) toggleButton.addEventListener('click', toggleSidebar);
    if(overlay) overlay.addEventListener('click', toggleSidebar);
</script>
</body>
</html>
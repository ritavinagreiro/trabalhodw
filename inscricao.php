<?php
$pageTitle = "Inscrição no Evento";
include 'cabecalho-eventos.php';
require('admin/includes/connection.php'); 

$id_evento = $_GET['id_evento'] ?? ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = trim($_POST['fNome']);
    $email = trim($_POST['fEmail']);
    $telefone = trim($_POST['fTel']);

    $stmtSocio = $mysqli->prepare("SELECT id_socio FROM socios WHERE email = ?");
    $stmtSocio->bind_param("s", $email);
    $stmtSocio->execute();
    $resultSocio = $stmtSocio->get_result();
    $socio = $resultSocio->fetch_assoc();
    $stmtSocio->close();

    if ($socio) {
        $id_socio = $socio['id_socio'];
    } else {
        $id_socio = null;
    }

    $id_evento = $_GET['id_evento'] ?? '';

    $stmtEvento = $mysqli->prepare("SELECT titulo FROM eventos WHERE id_evento = ?");
    $stmtEvento->bind_param("s", $id_evento); 
    $stmtEvento->execute();
    $resultEvento = $stmtEvento->get_result();
    $evento = $resultEvento->fetch_assoc();
    $stmtEvento->close();

    if ($evento) {
        $stmt = $mysqli->prepare("INSERT INTO inscricoes_eventos (id_socio, id_evento, nome, email, telefone, data_inscricao) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("issss", $id_socio, $id_evento, $nome, $email, $telefone);

        if ($stmt->execute()) {
            $msg_sucesso = "Inscrição realizada com sucesso! ";
        } else {
            $msg_erro = "Erro ao registrar inscrição. Tente novamente.";
        }
        $stmt->close();
    } else {
        $msg_erro = "Evento não encontrado ou inválido.";
    }
}
?>

<main class="inner-content-wrapper bg-white shadow p-8 rounded-lg max-w-2xl mx-auto my-8 flex-grow">
    <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">Inscrição no Evento</h2>

    <?php if(isset($msg_sucesso)): ?>
        <p class="text-green-600 font-semibold text-center mb-6"><?= $msg_sucesso ?></p>
    <?php elseif(isset($msg_erro)): ?>
        <p class="text-red-600 font-semibold text-center mb-6"><?= $msg_erro ?></p>
    <?php endif; ?>

    <form action="?id_evento=<?= htmlspecialchars($id_evento) ?>" method="POST" class="space-y-6">
        <div class="mb-4">
            <label for="f-nome" class="block text-sm font-medium text-gray-700">Nome completo</label>
            <input id="f-nome" type="text" name="fNome" required placeholder="Introduza o seu nome"
            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
        </div>

        <div class="mb-4">
            <label for="f-email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="f-email" type="email" name="fEmail" required placeholder="Introduza o seu email" autocomplete="email"
            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
        </div>

        <div class="mb-4">
            <label for="f-tel" class="block text-sm font-medium text-gray-700">Contacto telefónico</label>
            <input id="f-tel" type="text" name="fTel" maxlength="9" placeholder="9 dígitos" 
            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
            class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
        </div>

        <div class="text-center pt-4">
            <button type="submit"
                    class="bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                Enviar inscrição
            </button>
        </div>
    </form>
</main>

<footer class="absolute bottom-0 w-full bg-gray-800 text-white text-center text-sm py-6">
    © 2025 Ponto de Encontro — Todos os direitos reservados.
</footer>

</body>
</html>


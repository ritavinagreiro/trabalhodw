<?php
session_start();

require('admin/includes/connection.php'); 

$idEventoGet = $_GET['id'] ?? null;
$eventoSelecionado = null;

if ($idEventoGet) {
    $stmt = $mysqli->prepare("SELECT * FROM eventos WHERE id_evento = ?");
    $stmt->bind_param("s", $idEventoGet);
    $stmt->execute();
    $result = $stmt->get_result();
    $eventoDb = $result->fetch_assoc();
    $stmt->close();

    if ($eventoDb) {
        $eventoSelecionado = [
            'id'           => $eventoDb['id_evento'],
            'titulo'       => $eventoDb['titulo'],
            'img'          => $eventoDb['img'],
            'dia'          => date('d/m/Y', strtotime($eventoDb['data'])),
            'hora'         => substr($eventoDb['hora'], 0, 5),
            'participacao' => $eventoDb['participacao'],
            'local'        => $eventoDb['local'],
            'descricao'    => $eventoDb['descricao'],
            'regras'       => !empty($eventoDb['regras']) ? explode("\n", str_replace("\r", "", $eventoDb['regras'])) : []
        ];
    }
}

$pageTitle = ($eventoSelecionado) ? $eventoSelecionado['titulo'] . " - Detalhes" : "Evento Não Encontrado";

include 'cabecalho-eventos.php'; 

if (!$eventoSelecionado) {
    ?>
    <main class="inner-content-wrapper p-8 text-center min-h-[50vh]">
        <h1 class="text-3xl font-bold text-red-600 mb-4">Erro: Evento Não Encontrado</h1>
        <p class="text-xl text-gray-700">O evento que procuras não existe na nossa base de dados.</p>
        <a href="eventos.php" class="mt-8 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
            Voltar à Lista de Eventos
        </a>
    </main>
    <footer class="text-center text-gray-600 text-sm py-6 bg-white mt-10">
        © 2025 Ponto de Encontro — Todos os direitos reservados.
    </footer>
    </body>
    </html>
    <?php
    exit;
}
?>

<main class="space-y-8">
<section class="relative">
    <img src="<?= htmlspecialchars($eventoSelecionado['img']) ?>" class="w-full h-64 md:h-96 object-cover" alt="<?= htmlspecialchars($eventoSelecionado['titulo']) ?>">
    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <h2 class="text-white text-3xl md:text-5xl font-extrabold px-4 text-center"><?= htmlspecialchars($eventoSelecionado['titulo']) ?></h2>
    </div>
</section>

<div class="inner-content-wrapper space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
        <div class="p-4 bg-gray-100 rounded-lg">
            <p class="text-sm text-gray-600">Data</p>
            <p class="text-xl font-semibold"><?= htmlspecialchars($eventoSelecionado['dia']) ?></p> 
        </div>
        <div class="p-4 bg-gray-100 rounded-lg">
            <p class="text-sm text-gray-600">Hora</p>
            <p class="text-xl font-semibold"><?= htmlspecialchars($eventoSelecionado['hora']) ?></p>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg">
            <p class="text-sm text-gray-600">Participação</p>
            <p class="text-xl font-semibold"><?= htmlspecialchars($eventoSelecionado['participacao']) ?></p>
        </div>
    </div>

    <section>
        <h3 class="text-2xl font-bold mb-2">Local</h3>
        <p class="text-lg text-gray-700"><?= htmlspecialchars($eventoSelecionado['local']) ?></p>
    </section>

    <section>
        <h3 class="text-2xl font-bold mb-2">Descrição</h3>
        <p class="text-lg text-gray-700"><?= nl2br(htmlspecialchars($eventoSelecionado['descricao'])) ?></p>
    </section>

    <section>
        <h3 class="text-2xl font-bold mb-2">Regras</h3>
        <?php if(!empty($eventoSelecionado['regras'])): ?>
            <ul class="list-none space-y-2 text-gray-700">
                <?php foreach($eventoSelecionado['regras'] as $regra): ?>
                    <?php if(trim($regra) !== ''): ?>
                        <li><?= htmlspecialchars($regra) ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">Sem regras específicas registadas.</p>
        <?php endif; ?>
    </section>

    <div class="text-center mt-4 pt-6">
    <?php 
        if ($eventoSelecionado['id'] !== "encontros-semanais"): 
    ?>
        <?php 
            $linkInscricao = "inscricao.php?id_evento=" . urlencode($eventoSelecionado['id']);
        ?>
        <?php if(isset($_SESSION['ligado']) && $_SESSION['ligado'] === true): ?>
            <form method="post" action="inscrever-socio.php">
                <input type="hidden" name="id_evento" value="<?= htmlspecialchars($eventoSelecionado['id'] ?? ''); ?>">
                <button type="submit" class="bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                    Inscrever-me 
                </button>
            </form>
        <?php else: ?>
            <a href="<?= $linkInscricao ?>" class="bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                Inscrever-me
            </a>
        <?php endif; ?>
    <?php endif; ?>
    </div>
</div>
</main>

<footer class="text-center text-sm py-6 bg-white mt-10 border-t">
    © 2025 Ponto de Encontro — Todos os direitos reservados.
</footer>
</body>
</html>


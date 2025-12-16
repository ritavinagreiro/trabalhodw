<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ligado']) || $_SESSION['ligado'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['id_socio']) || empty($_SESSION['id_socio'])) {
    die("Erro crítico: id_socio não definido. Por favor, inicia sessão ou regista-te novamente.");
}

$idSocio = $_SESSION['id_socio'];

$mysqli = new mysqli("localhost", "root", "", "projeto");
if ($mysqli->connect_error) {
    die("Erro de ligação à base de dados: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("
    SELECT e.id_evento, e.titulo, e.data, e.hora, e.local
    FROM inscricoes_eventos ie
    INNER JOIN eventos e ON ie.id_evento = e.id_evento
    WHERE ie.id_socio = ?
    ORDER BY e.data ASC, e.hora ASC
");
$stmt->bind_param("i", $idSocio);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include 'cabecalho.php'; ?>

<div class="inner-content-wrapper">

    <h2 class="text-3xl font-bold text-blue-900 mb-8">
        Os meus eventos
    </h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <?php while ($evento = $result->fetch_assoc()): ?>
                <div class="border rounded-xl p-5 shadow-md bg-white">

                    <h3 class="text-xl font-semibold text-blue-800 mb-2">
                        <?= htmlspecialchars($evento['titulo']); ?>
                    </h3>

                    <p class="text-gray-600 flex items-center gap-2 mb-2">
                        <img src="imgs/iconecalendario.webp" alt="Calendário" class="h-5 w-5">
                        <?= htmlspecialchars(date('d/m/Y', strtotime($evento['data']))); ?>
                    </p>

                    <p class="text-gray-600 flex items-center gap-2 mb-2">
                        <img src="imgs/iconerelogio.png" alt="Hora" class="h-5 w-5">
                        <?= htmlspecialchars(date('H:i', strtotime($evento['hora']))); ?>
                    </p>

                    <p class="text-gray-600 flex items-center gap-2 mb-2">
                        <img src="imgs/iconelocal1.png" alt="Local" class="h-5 w-5">
                        <?= htmlspecialchars($evento['local']); ?>
                    </p>

                    <form method="post" action="cancelar-inscricao.php">
                        <input type="hidden" name="id_evento" value="<?= $evento['id_evento']; ?>">
                        <button type="submit"
                            class="w-full text-center px-4 py-2
                                   text-red-600 border border-red-600 rounded-md
                                   hover:bg-red-600 hover:text-white transition">
                            Cancelar inscrição
                        </button>
                    </form>

                </div>
            <?php endwhile; ?>

        </div>
    <?php else: ?>
        <p class="text-gray-600">
            Ainda não estás inscrito em nenhum evento.
        </p>
    <?php endif; ?>

</div>
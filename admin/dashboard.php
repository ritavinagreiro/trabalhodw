<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('includes/connection.php');

$result_socio = $mysqli->query("SELECT COUNT(*) as total FROM socios");
$total_socios = $result_socio->fetch_assoc()['total'];

$result_eventos = $mysqli->query("SELECT COUNT(*) as total FROM eventos");
$total_eventos = $result_eventos->fetch_assoc()['total'];

$result_prox = $mysqli->query("SELECT titulo, data, hora FROM eventos ORDER BY data ASC, hora ASC LIMIT 1");
$prox_evento = $result_prox->fetch_assoc();

$query_inscritos = "
    SELECT e.titulo, e.data, e.hora, COUNT(i.id_evento) as total_inscritos
    FROM eventos e
    LEFT JOIN inscricoes_eventos i ON e.id_evento = i.id_evento
    GROUP BY e.id_evento, e.titulo, e.data, e.hora
    ORDER BY e.data DESC
";
$result_lista = $mysqli->query($query_inscritos);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <?php include(__DIR__ . '/includes/nav.php'); ?>

    <div class="flex-1 min-h-screen p-6 overflow-y-auto">
        
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl shadow border-l-4 border-blue-500">
                <h2 class="text-xl font-bold text-gray-700">Total de Sócios</h2>
                <p class="text-3xl mt-2 font-bold text-blue-600"><?= $total_socios ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-l-4 border-indigo-500">
                <h2 class="text-xl font-bold text-gray-700">Total de Eventos</h2>
                <p class="text-3xl mt-2 font-bold text-indigo-600"><?= $total_eventos ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow border-l-4 border-green-500">
                <h2 class="text-xl font-bold text-gray-700">Próximo Evento</h2>
                <?php if ($prox_evento): ?>
                    <p class="mt-2 font-semibold"><?= htmlspecialchars($prox_evento['titulo']); ?></p>
                    <p class="text-sm text-gray-500">
                        <?= date('d/m/Y', strtotime($prox_evento['data'])) ?> às <?= substr($prox_evento['hora'],0,5) ?>
                    </p>
                <?php else: ?>
                    <p class="mt-2 text-gray-500">Nenhum evento agendado</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-800">Inscrições por Evento</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Evento</th>
                            <th class="py-3 px-6 text-center">Data</th>
                            <th class="py-3 px-6 text-center">Hora</th>
                            <th class="py-3 px-6 text-center">Nº Inscritos</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php if ($result_lista && $result_lista->num_rows > 0): ?>
                            <?php while($row = $result_lista->fetch_assoc()): ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                                    <td class="py-3 px-6 text-left whitespace-nowrap">
                                        <span class="font-medium text-gray-800"><?= htmlspecialchars($row['titulo']) ?></span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <?= date('d/m/Y', strtotime($row['data'])) ?>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <?= substr($row['hora'], 0, 5) ?>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <?php 
                                            // Se tiver inscritos fica verde, se for 0 fica cinzento
                                            $badgeColor = $row['total_inscritos'] > 0 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500';
                                        ?>
                                        <span class="<?= $badgeColor ?> py-1 px-3 rounded-full text-xs font-bold">
                                            <?= $row['total_inscritos'] ?> pessoas
                                        </span>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-6 px-6 text-center text-gray-500">
                                    Ainda não existem eventos registados.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>



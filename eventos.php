<?php 
session_start();
require('admin/includes/connection.php'); 

// Buscar eventos ordenados por data
$query = "SELECT * FROM eventos ORDER BY data ASC";
$result = $mysqli->query($query);

$destaque = null;
$listaEventos = [];

// Separar o destaque (Encontros Semanais) dos outros
if ($result) {
    while ($row = $result->fetch_assoc()) {
        if ($row['id_evento'] === 'encontros-semanais') {
            $destaque = $row;
        } else {
            $listaEventos[] = $row;
        }
    }
}

include 'cabecalho.php'; 
?>

<section class="container mx-auto px-4">

    <?php if ($destaque): ?>
        <div class="relative bg-gray-200 rounded-lg overflow-hidden mb-10">
            <img src="<?= htmlspecialchars($destaque['img']) ?>" alt="<?= htmlspecialchars($destaque['titulo']) ?>" class="w-full h-64 object-cover md:h-96">
            
            <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center items-center text-center p-6">
                <p class="text-white text-xl md:text-3xl font-semibold mb-2">
                    <?= ($destaque['id_evento'] == 'encontros-semanais') ? 'Todos os sábados' : date('d/m/Y', strtotime($destaque['data'])) ?>
                </p>
                <p class="text-white text-lg md:text-2xl mb-2">A partir das <?= substr($destaque['hora'], 0, 5) ?></p>
                <h2 class="text-white text-2xl md:text-5xl font-extrabold mb-4"><?= htmlspecialchars($destaque['titulo']) ?></h2>
                
                <a href="todososeventos.php?id=<?= $destaque['id_evento'] ?>" class="bg-white hover:bg-gray-100 text-blue-700 font-semibold py-2 px-6 rounded-md text-sm shadow-md whitespace-nowrap">
                    Mais Informações
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <?php foreach ($listaEventos as $evento): ?>
            <?php 
                // Formatações
                $diaMes = date('d/m', strtotime($evento['data']));
                $horaF = substr($evento['hora'], 0, 5); 
                $horaF = str_replace(':', 'h', $horaF);
            ?>

            <div class="bg-white rounded-md shadow-md overflow-hidden hover:scale-105 transition-transform duration-300">
                
                <img src="<?= htmlspecialchars($evento['img']) ?>" alt="<?= htmlspecialchars($evento['titulo']) ?>" class="w-full h-40 object-cover">
                
                <div class="p-4">
                    <p class="text-gray-500 text-sm mb-1"><?= $diaMes ?></p> 
                    <p class="text-gray-600 text-sm mb-1"><?= $horaF ?></p> 
                    
                    <h3 class="text-gray-800 text-lg font-semibold mb-2">
                        <?= htmlspecialchars($evento['titulo']) ?>
                    </h3>
                    
                    <a href="todososeventos.php?id=<?= $evento['id_evento'] ?>" class="btn-mais-datas">
                        Mais Informações
                    </a>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</section>

<footer class="mt-10 py-6 text-center w-full">
    <p>E-mail: <a href="mailto:cpontodeencontro@gmail.com">cpontodeencontro@gmail.com</a></p>
    <p>Telemóvel: 961254362</p>
    <p>Endereço: Rua dos Dados, nº 42, Coimbra</p>
</footer>

</body>
</html>
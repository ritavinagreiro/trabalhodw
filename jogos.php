<?php include 'cabecalho.php'; ?>

<main class="flex-grow max-w-6xl mx-auto px-4">
    <h2 class="text-center text-2xl font-extrabold mb-8 border-b-2 border-black inline-block px-4">JOGOS</h2>

    <div class="flex justify-center gap-4 mb-8 flex-wrap">
        <button class="filter-btn px-4 py-2 rounded-md bg-blue-600" data-filter="all">Todos</button>
        <button class="filter-btn px-4 py-2 rounded-md bg-gray-200" data-filter="classicos">Clássicos</button>
        <button class="filter-btn px-4 py-2 rounded-md bg-gray-200" data-filter="estrategia">Estratégia</button>
        <button class="filter-btn px-4 py-2 rounded-md bg-gray-200" data-filter="criativos">Criativos</button>
        <button class="filter-btn px-4 py-2 rounded-md bg-gray-200" data-filter="familiares">Familiares</button>
        <button class="filter-btn px-4 py-2 rounded-md bg-gray-200" data-filter="grupos">Grupos Maiores</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-10 justify-items-center text-center">
        <?php
        $jogos = [
            ["img"=>"imgs/xadrez.webp","titulo"=>"Xadrez","categoria"=>"classicos"],
            ["img"=>"imgs/damas.jpeg","titulo"=>"Damas","categoria"=>"classicos"],
            ["img"=>"imgs/domino.jpg","titulo"=>"Dominó","categoria"=>"classicos"],
            ["img"=>"imgs/batalhanaval.jpg","titulo"=>"Batalha Naval","categoria"=>"classicos"],

            ["img"=>"imgs/catan.jpg","titulo"=>"CATAN","categoria"=>"estrategia"],
            ["img"=>"imgs/carcassone.jpg","titulo"=>"Carcassonne","categoria"=>"estrategia"],
            ["img"=>"imgs/7wonders.webp","titulo"=>"7 Wonders","categoria"=>"estrategia"],
            ["img"=>"imgs/risk.jpg","titulo"=>"Risk","categoria"=>"estrategia"],
            ["img"=>"imgs/azul.jpg","titulo"=>"Azul","categoria"=>"estrategia"],

            ["img"=>"imgs/dixit.jpg","titulo"=>"Dixit","categoria"=>"criativos"],
            ["img"=>"imgs/scrabble.jpg","titulo"=>"Scrabble","categoria"=>"criativos"],

            ["img"=>"imgs/monopoly.webp","titulo"=>"Monopoly","categoria"=>"familiares"],
            ["img"=>"imgs/cluedo.jpg","titulo"=>"Cluedo","categoria"=>"familiares"],
            ["img"=>"imgs/tickettoride.webp","titulo"=>"Ticket to Ride","categoria"=>"familiares"],

            ["img"=>"imgs/pandemic.jpg","titulo"=>"Pandemic","categoria"=>"grupos"]
        ];

        foreach ($jogos as $jogo):
        ?>
        <div class="game-card flex flex-col items-center" data-category="<?= $jogo['categoria']; ?>">
            <img src="<?= $jogo['img']; ?>" alt="<?= htmlspecialchars($jogo['titulo']); ?>" class="h-44 mb-3 shadow-lg rounded transform transition hover:scale-105 cursor-pointer">
            <p class="font-semibold text-lg"><?= htmlspecialchars($jogo['titulo']); ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
    const filterBtns = document.querySelectorAll('.filter-btn');
    const gameCards = document.querySelectorAll('.game-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.replace('bg-blue-600','bg-gray-200'));
            btn.classList.replace('bg-gray-200','bg-blue-600');

            const filter = btn.getAttribute('data-filter');
            gameCards.forEach(card => {
                if(filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

<footer class="mt-10 py-6 text-center w-full">
    <p>E-mail: <a href="mailto:cpontodeencontro@gmail.com">cpontodeencontro@gmail.com</a></p>
    <p>Telemóvel: 961254362</p>
    <p>Endereço: Rua dos Dados, nº 42, Coimbra</p>
</footer>

</body>
</html>



<?php include 'cabecalho.php'; ?>

    <main class="inner-content-wrapper">
        <div class="flex flex-col md:flex-row items-center md:items-start justify-between space-y-6 md:space-y-0 md:space-x-12">
            <div class="md:w-3/5 text-lg text-gray-800 leading-relaxed text-center md:text-left">
                <p class="mb-2">Bem-vinda/o ao Ponto de Encontro!</p>
                <p class="mb-2">Somos um clube dedicado a reunir pessoas que amam jogos de tabuleiro.</p>
                <p class ="mb-14">Se também partilhas esta paixão, junta-te a nós!</p>
                <a href="eventos.php" 
                class="inline-block bg-blue-800 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition">
                    Ver Encontros Semanais
                </a>
            </div>
            <div class="md:w-2/5 flex justify-end">
                <img class="max-h-68 w-auto shadow-lg rounded-lg" src="imgs/imagem_pagina_inicial.jpg" alt="Grupo a jogar jogo de tabuleiro">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12 border-t border-gray-300 pt-8">
            <div>
                <h2 class="text-xl font-semibold mb-4 border-b border-gray-400 pb-1">Próximos eventos</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="flex flex-col items-center bg-white border border-gray-300 p-3 rounded-lg shadow-md">
                        <img src="imgs/calendario.png" alt="Calendário" class="h-10 w-10">
                        <p class="text-lg font-extrabold text-black mt-1">20 DEZ</p>
                        <p class="text-sm font-medium">18H30</p>
                    </div>

                    <div class="flex flex-col items-center bg-white border border-gray-300 p-3 rounded-lg shadow-md">
                        <img src="imgs/calendario.png" alt="Calendário" class="h-10 w-10">
                        <p class="text-lg font-extrabold text-black mt-1">27 DEZ</p>
                        <p class="text-sm font-medium">21H30</p>
                    </div>

                    <div class="flex flex-col items-center bg-white border border-gray-300 p-3 rounded-lg shadow-md">
                        <img src="imgs/calendario.png" alt="Calendário" class="h-10 w-10">
                        <p class="text-lg font-extrabold text-black-600 mt-1">10 JAN</p>
                        <p class="text-sm font-medium">21H30</p>
                    </div>

                    <div class="flex flex-col items-center bg-white border border-gray-300 p-3 rounded-lg shadow-md">
                        <img src="imgs/calendario.png" alt="Calendário" class="h-10 w-10">
                        <p class="text-lg font-extrabold text-black-600 mt-1">17 JAN</p>
                        <p class="text-sm font-medium">18H30</p>
                    </div>
                </div>

                <div class="flex justify-center">
                    <a href="eventos.php" class="btn-mais-datas">Mais datas</a>
                </div>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-4 border-b border-gray-400 pb-1">Visite o nosso espaço</h2>
                <div class="text-gray-700">
                    <p class="mb-2">No centro de Coimbra, um espaço dedicado a quem gosta de se divertir.</p>
                    <p class="font-bold">Endereço: <span class="font-normal">Rua dos Dados, n° 42, Coimbra.</span></p>
                    <p class="font-bold mt-2">Horário de Funcionamento:</p>
                    <p class="font-normal block">Terça a Sexta: 17h00 - 00h00</p>
                    <p class="font-normal block">Sábado: 14h00 - 01h00</p>
                    <p class="font-normal block">Domingo: 14h00 - 20h00</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="mt-10 py-6 text-center w-full">
        <p>E-mail: <a href="mailto:cpontodeencontro@gmail.com">cpontodeencontro@gmail.com</a></p>
        <p>Telemóvel: 961254362</p>
    </footer>

</body>
</html>
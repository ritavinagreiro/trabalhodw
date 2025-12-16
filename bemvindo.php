<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bem-vindo | Ponto de Encontro</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-xl p-8 w-[400px] text-center">
    <h1 class="text-2xl font-bold text-blue-700 mb-4">
      Bem-vindo à família Ponto de Encontro, <?php echo htmlspecialchars($_SESSION['nome']); ?>!
    </h1>
    <p class="text-gray-600 mb-6">Agora és um de nós!</p>
    <a href="login.php" 
       class="inline-block bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 px-6 rounded-md transition">
       Fazer Login
    </a>
  </div>

</body>
</html>

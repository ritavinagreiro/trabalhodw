<?php
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$erro_login = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Ponto de Encontro</title>
  <link rel="shortcut icon" href="imgs/logo.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-lg rounded-xl p-8 w-[380px]">
    <div class="text-center mb-6">
      <img src="imgs/logo.png" alt="Logo Ponto de Encontro" class="mx-auto h-16 mb-3">
      <h1 class="text-2xl font-bold text-blue-700">Login</h1>
      <p class="text-gray-500 text-sm">Acede à tua conta</p>
    </div>

    <?php if ($erro_login): ?>
      <p class="text-red-600 text-sm text-center mb-4"><?php echo htmlspecialchars($erro_login); ?></p>
    <?php endif; ?>

    <form action="auth/tratalogin.php" method="post" class="space-y-4">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" required
          class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-blue-600">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Palavra-passe</label>
        <input id="password" name="password" type="password" required
          class="w-full rounded-md border border-gray-300 px-3 py-2 focus:outline-blue-600">
      </div>

      <button type="submit"
        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded-md transition duration-150">
        Entrar
      </button>

      <p class="text-center text-sm text-gray-500 mt-4">
        Ainda não tens conta? <a href="tornarsocio.php" class="text-blue-700 font-medium hover:underline">Torna-te sócio</a>
      </p>
    </form>

    <div class="text-center mt-4">
      <a href="index.php"
        class="inline-block px-3 py-1 text-sm rounded-md border border-gray-300 text-gray-600 hover:bg-gray-200 transition">
        Voltar
      </a>
    </div>
  </div>

</body>
</html>

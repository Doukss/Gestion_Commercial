<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion - Gestion Commerciale</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-xl rounded-xl flex overflow-hidden max-w-4xl w-full">
    
    <div class="hidden md:block md:w-1/2">
      <img src="asset/image/2672252.jpg" alt="Connexion" class="h-full w-full object-cover" />
    </div>

    <div class="w-full md:w-1/2 p-10 ">
      <h2 class="text-4xl font-bold text-center text-gray-800 mb-2">Bienvenue 👋</h2>
      <p class="text-gray-600 mb-8 text-center">Connectez-vous pour continuer</p>


      <form action="<?= $_ENV['WEB_ROOT'] ?>/login" method="POST" class="space-y-5">
        <div>
          <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
          <input type="text" id="email" name="email" value="<?= $_SESSION['old']['email'] ?? ''; ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
          <?php if (isset($_SESSION['errors']['email'])): ?>
            <p class="text-red-500 text-sm mt-1"><?= $_SESSION['errors']['email'] ?></p>
        <?php endif; ?>
        </div>

        <div>
          <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe</label>
          <input type="password" id="password" name="password" value="<?= $_SESSION['old']['password'] ?? ''; ?>" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-400" />
           <?php if (isset($_SESSION['errors']['password'])): ?>
            <p class="text-red-500 text-sm mt-1"><?= $_SESSION['errors']['password'] ?></p>
        <?php endif; ?>
        </div>

        <?php if (isset($_SESSION['errors']['connexion'])): ?>
        <p class="text-red-500 text-sm text-center"><?= $_SESSION['errors']['connexion'] ?></p>
    <?php endif; ?>

        <button type="submit" class="w-full bg-purple-600 text-white font-semibold rounded-lg py-3 hover:bg-purple-400 transition">Se connecter</button>
      </form>

      <p class="text-center text-gray-600 mt-6">Vous n'avez pas de compte ? 
        <a href="register.php" class="text-blue-600 hover:underline">Créer un compte</a>
      </p>
    </div>

  </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en" id="login">
<head>
  <meta charset="UTF-8">
  <title>login</title>
  <link rel="stylesheet" href="/css/login.css"> <!-- Actualitzat per a eliminar el '/../' -->
</head>
<body id="body2">
  <h1>Iniciar Sessió</h1>




  <form action="index.php?action=doLogin" method="POST"> <!-- Canviat a POST i afegit l'acció -->
    <div id="sessio">
    <!-- Campo de Correo Electrónico -->
    <label for="email">Adreça de correu electrònic:</label>
    <input type="email" id="email" name="email" required>
    <br>

    <!-- Campo de Contraseña -->
    <label for="password">Contrassenya:</label>
    <input type="password" id="password" name="password" required>
    <br>

    <!-- Botón de Enviar -->
    <input type="submit" value="Iniciar Sesión">
    
  </form>
  <?php if (!empty($error_message)): ?>
    <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

  <div id="seguent">
  <br>
  <p>Encara no tens compte?</p>
  <a href="index.php?action=register">Registra't</a>  
  <br>
  <a href="/../index.php">Pantalla d'inici</a>
  </div>
  
</body>
</html>

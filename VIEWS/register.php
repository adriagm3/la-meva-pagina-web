<!DOCTYPE html>
<html lang="es" id="registre">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre - Mi Página de Plantas</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body id="body1">
    <?php if (isset($error_message)) : ?>
        <div class="error-message">
            <p><?php echo htmlspecialchars($error_message); ?></p>
        </div>
    <?php endif; ?>

    <div class="container" id="grid">
        <!-- Actualitzem l'acció del formulari per enviar les dades a l'index.php amb una acció específica -->
        <form action="index.php?action=doRegister" method="post">
            <div class="row">
                <!-- Campo de Correo Electrónico -->
                <label for="email" id="elemento1">Adreça de correu electrònic: </label>
                <input type="email" id="email" name="email" required>
                <br>

                <!-- Campo de Contraseña -->
                <label for="password" id="elemento2">Contrassenya: </label>
                <input type="password" id="password" name="password" pattern="[A-Za-z0-9]+" required>
                <br>
            </div>
            <br>
            <br>
            <div class="row">
                <!-- Campo de Nombre -->
                <label for="nombre" id="elemento3">Nom: </label>
                <input type="text" id="nombre" name="nombre" pattern="[\u00C0-\u00FFA-Za-z\s]+" required>
                <br>

                <!-- Campo de Dirección -->
                <label for="direccion" id="elemento4">Adreça: </label>
                <input type="text" id="direccion" name="direccion" maxlength="30" required>
                <br>
            </div>
            <div class="row">
                <!-- Campo de Población -->
                <label for="poblacion" id="elemento5">Població: </label>
                <input type="text" id="poblacion" name="poblacion" maxlength="30" required>
                <br>

                <!-- Campo de Código Postal -->
                <label for="codigo_postal" id="elemento6">Codi Postal: </label>
                <input type="text" id="codigo_postal" name="codigo_postal" pattern="^\d{5}$" required>
                <br>
                <br>
                <br>
            </div>
            <!-- Botón de Enviar -->
            <input type="submit" value="Registrar" id="register">
        </form>

        <div id="seguent">
            <br>
            <h4>Ja tens compte?</h4>
            <!-- Actualitzem l'enllaç per a utilitzar l'encaminador -->
            <p><a href="index.php?action=login">Inicia sessió</a> - <a href="/../index.php">Pantalla d'inici</a></p>
        </div>
    </div>
</body>

</html>